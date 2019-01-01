<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\user;
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Mail\sendMail;
use Mail;
use Illuminate\Support\Facades\Hash;
use App\Rules\validateOldPassword;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use App\event;

class UserControllerFound extends Controller
{
    public function index()
    {
        $users = DB::table('users')->get();
        return view('users.viewuser_found')->with('users',$users);
    }

    public function delete($id)
    {
        $user = DB::table('users')
        ->select('firstname','lastname','img_path')
        ->where(['id'=>$id])
        ->get();
        $UserName=$user[0]->firstname.' '.$user[0]->lastname;
        $img_path = 'images/'.$user[0]->img_path;

        if(File::exists($img_path) && $img_path != 'images/userAvatar.png') 
        {
            File::delete($img_path);
        }

        DB::table('users')->where('id', $id)->delete();
        return redirect('/usersfound/view')
                ->with('alert', 'deleteUserSuccess')
                ->with('UserName',$UserName);
    }

    public function createview()
    {
        return view('users.create_foundation');
    }

    public function add_user(Request $request)
    {
        $this->validate($request,
        [
            'txtfname' => 'required|alpha|max:255',
            'txtlname' => 'required|alpha|max:255',
            'txtuname' => 'required|string|max:255|unique:users,username',
            'txtcnum' => 'required|digits:8|unique:users,contactnum',
            'txtemail' => 'required|string|email|max:255|unique:users,email',
        ]       
        );

        $fname = Input::get('txtfname');
        $lname = Input::get('txtlname');
        $uname = Input::get('txtuname');
        $cnum = Input::get('txtcnum');
        $email = Input::get('txtemail');
        $utype = Input::get('usertype');

        $generatedPassword=str_random(8);
        self::sendEmail($generatedPassword,$email,$fname,$lname,$uname);

        $data = array(
            'firstname' => $fname, 
            'lastname' => $lname, 
            'username' => $uname, 
            'contactnum' => $cnum, 
            'admin' => $utype,
            'email' => $email,
            'password' => Hash::make($generatedPassword)
        );
        $UserName=$fname.' '.$lname;
        // $event_id = DB::table('events')->insertGetId($data);
        $user_id = DB::table('users')->insertGetId($data);

        $user=(DB::table('users')->where('id',$user_id)->get())[0];

        $events = event::select('events.name', 'events.image_path','status.status' ,'events.description', 'events.id', 'events.date_start', 'events.date_end', 'events.deadline', 'events.duration', 'type.type', 'events.paid_activity', 'events.created_at', 'events.type_id', 'events.status_id')
        ->join('type', 'type.id', '=', 'events.type_id')
        ->join('status', 'status.id', '=', 'events.status_id')
        ->where('status_id',2)
        ->orwhere('status_id',3)
        ->get();      

        foreach ($events as $event) {
            $data = [
                'firstname'      => $fname,
                'lastname'       => $lname,
                'name'           => $event->name,
                'description'    => $event->description,
                'status'         => $event->status,
                'duration'       => $event->duration,
                'date_start'     => $event->date_start,
                'date_end'       => $event->date_end,
                'type'           => $event->type,
                'paid_activity'  => $event->paid_activity,
                'deadline'       => $event->deadline,
                'image_path'     => $event->image_path,
                'uid'            => $user_id,
                'eid'            => $event->id
            ];

            Mail::send('emails.email-invitation', $data, function($m) use ($user,$events){
            $m->to($user->email, 'Alt Team')->from('hi@example.com', 'Alt Team')->subject('Event Invitation');
            });

            DB::table("user_event")->insert([
                "user_id" => $user_id,
                "event_id" => $event->id
            ]);
        }

        return redirect('/usersfound/view')
                ->with('alert', 'addUserSuccess')
                ->with('UserName',$UserName);
        
    }

    public function sendEmail($genPass,$email,$fname,$lname,$uname)
    {
        Mail::send(new sendMail($genPass,$email,$fname,$lname,$uname));
    }
    public function passview()
    {
        return view('users.changePassword_found');
    }

    public function passchg(Request $request)
    {
        
        $this->validate($request,
        [
            'txtpassword' => 'required|string|min:6|confirmed',
            'txtOldpassword' => ['required', new validateOldPassword(auth()->user())]
        ]       
        );


        //retrieve the email address of the user logged in
        $email= Auth::user()->email;

        //retrieve the input of password
        $NewPassword = Input::get('txtpassword');
        
        //validating old password
        $result = DB::table('users')
                    ->where('email', $email)->get()
                    ->pluck('password');
        $password=$result[0];
        if (!(Hash::check($NewPassword, $password))) {
            //SQL update for updating the db
            DB::table('users')
            ->where(['email'=> $email])
            ->where(['password' => $password])
            ->update(['password' => Hash::make($NewPassword)]);
            Auth::logout();
            return redirect('/login')->with('alert', 'success');
            
        }else{            
            return back()->with('alert','errChngPass');
        }
        //end of validation     
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

     public function login()
     {
         return view('users.loginfound');
     }

    
     public function show($id)
     {
         $user = user::find($id);
        return view('users.show_foundation')->with('users', $user);
     }

     public function update(Request $request)
    {
        $this->validate($request,
        [
            'firstname' => 'required|regex:/^[a-zA-Z]+$/u|string|max:30',
            'lastname' => 'required|regex:/^[a-zA-Z]+$/u|string|max:30',
            'contactnum' => 'required|regex:/^[5][0-9]{7}+$/u|integer',
            'email' => 'required|string|email|max:30',
        ]       
        );

        $id = Input::get('userid');

        $email = Input::get('email');
        DB::table('users')
            ->where('id', $id)
        ->update(['email' => $email]);
            
        $fname = Input::get('firstname');
        DB::table('users')
            ->where('id', $id)
            ->update(['firstname' => $fname]);  

        $lname = Input::get('lastname');
        DB::table('users')
            ->where('id', $id)
            ->update(['lastname' => $lname]);

        $contactnum = Input::get('contactnum');
        DB::table('users')
            ->where('id', $id)
            ->update(['contactnum' => $contactnum]);
        
        $UserName=$fname.' '.$lname;
        return back()
            ->with('alert', 'editUserSuccess')
            ->with('UserName',$UserName);
    }

    public function profileviewa()
    {
        $user_id = Auth::user()->id;  
        $user_get = DB::table('users')
        ->where(['id'=>$user_id])
        ->get();
        $user_get = $user_get[0];
        return view('users.editprofile_found')->with('user_detail', $user_get);
    }

    public function profileAdminUpdate(Request $request)
    {
        $user_id = Auth::user()->id;
        $image=$request->file('fpropic');
        $fname = Input::get('txtfname');
        $lname = Input::get('txtlname');
        $cnum = Input::get('txtcnum');
        $uname = Input::get('txtuname');
        $email = Input::get('txtemail');

        $this->validate($request,
            [   
                'txtfname' => 'required',
                'txtlname' => 'required',
                'txtcnum' => 'required',
                'txtuname' => 'required',
                'txtemail' => 'required'
            ]       
            );

        if(isset($image))
        {   
            $img_path = "images/".Auth::user()->img_path;
            if(File::exists($img_path) && $img_path != 'images/userAvatar.png') 
            {
                File::delete($img_path);
            }
            //Image validation 500KB max
            $this->validate($request,
            [
                'fpropic' => 'mimes:jpeg,jpg,png | max:500',       
            ]       
            );

            $image = $request->file('fpropic');
            $path = rand() . '.' . $image->getClientOriginalExtension();
            //Image Resize to 215x215
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(215, 215);
            $image_resize->save(public_path('images/User_Profile_Image/'.$path));

            DB::table('users')
            ->where('id', $user_id)
            ->update(['img_path' => 'User_Profile_Image/'.$path]);
        }

            DB::table('users')
           ->where('id', $user_id)
           ->update(['firstname' => $fname,
                    'lastname' => $lname,
                    'username' => $uname,
                    'contactnum' => $cnum,
                    'email' => $email]);

                
       return back()->with('alert', 'editUserSuccess');
    }
    
}
