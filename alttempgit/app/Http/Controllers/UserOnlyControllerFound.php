<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Mail\sendInvEmail;
use Mail;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;
use App\event;
use Calendar;
use File;

class UserOnlyControllerFound extends Controller
{
    public function index()
    {
        
        $events = DB::table('events')
        ->select('events.id', 'events.status_id', 'events.name', 'events.description', 'events.duration', 'events.date_start', 'events.deadline', 'status.status', 'events.type_id', 'events.date_end', 'events.paid_activity', 'events.admin_id', 'events.image_path', 'events.created_at', 'events.updated_at')
        ->join('status', 'status.id', '=', 'events.status_id')
        ->join('type', 'type.id', '=', 'events.type_id')
        ->where('invite_status',"1")
        ->get();

        
        return view('users_view.usersviewevent_found')->with('events',$events);
    }

    public function showEvent($id)
    {
        $user_id = Auth::user()->id;

        $event_show = event::select('events.name', 'events.image_path','status.status' ,'events.description', 'events.id', 'events.date_start', 'events.date_end', 'events.deadline', 'events.duration', 'type.type', 'events.paid_activity', 'events.created_at', 'events.type_id', 'events.status_id')
        ->join('type', 'type.id', '=', 'events.type_id')
        ->join('status', 'status.id', '=', 'events.status_id')
        ->where('events.id', '=', $id)
        ->get();

        $dateTime = explode(' ',$event_show[0]->date_start);
        $StartDate = $dateTime[0];
        $StartTime = $dateTime[1];
        
        $dateTime = explode(' ',$event_show[0]->date_end);
        $EndDate = $dateTime[0];
        $EndTime = $dateTime[1];

        $arrDateTime['StartDate']=$StartDate;
        $arrDateTime['StartTime']=$StartTime;
        $arrDateTime['EndDate']=$EndDate;
        $arrDateTime['EndTime']=$EndTime;


        $get_order = DB::table('orders')
        ->select('orders.id')
        ->join('events', 'events.id', '=', 'orders.event_id')
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->where('user_id', $user_id)
        ->where('event_id',$id)
        ->get();

         return view('users_view.usersviewshow_found')->with('events',$event_show)->with('get_order', $get_order)->with($arrDateTime);

    }

    public function profileview()
    {
        $user_id = Auth::user()->id;  
        $user_get = DB::table('users')
        ->where(['id'=>$user_id])
        ->get();

        $user_get = $user_get[0];
        return view('users_view.user_profile')->with('user_detail', $user_get);
    }
    public function update_status(){
        
        $user_id=$_GET['user_id'];
        $event_id=$_GET['event_id'];
        $status=$_GET['status'];

        DB::table('user_event')
        ->where('user_id', $user_id)
        ->where('event_id',$event_id)
        ->update(['status' => $status]);
        echo ("success");
    }
    public function profileupdate(Request $request)
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
                'txtemail' => 'required',
                'txtuname' => 'required'
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
                'fpropic' => 'mimes:jpeg,jpg,png | max:500'      
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
