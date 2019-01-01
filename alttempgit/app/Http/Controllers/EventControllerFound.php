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
use App\EventCalendar;
use File;



class EventControllerFound extends Controller
{
    public function index()
    {
        if(isset($_GET["status"])){
            $status_id=$_GET["status"];
            $events = DB::table('events')
            ->select('events.id', 'events.status_id', 'events.name', 'events.description', 'events.duration', 'events.date_start', 'events.deadline', 'status.status', 'events.type_id', 'events.date_end', 'events.paid_activity', 'events.admin_id', 'events.image_path', 'events.created_at', 'events.updated_at')
            ->join('status', 'status.id', '=', 'events.status_id')
            ->where('events.status_id',$status_id)
            ->get();
        }else{
            $events = DB::table('events')
            ->select('events.id', 'events.status_id', 'events.name', 'events.description', 'events.duration', 'events.date_start', 'events.deadline', 'status.status', 'events.type_id', 'events.date_end', 'events.paid_activity', 'events.admin_id', 'events.image_path', 'events.created_at', 'events.updated_at')
            ->join('status', 'status.id', '=', 'events.status_id')
            ->get();
        }      

        $status = DB::table('status')->get();
        $type = DB::table('type')->get();

        return view('events.viewevent_found',['status' => $status],['type' => $type])->with('events',$events);;
    }
  
    public function delete($id)
    {
        $event = DB::table('events')
        ->select('events.name', 'events.image_path')
        ->where(['events.id'=>$id])
        ->get();

        $eventName=$event[0]->name;

        $img_path = 'images/'.$event[0]->image_path;

        if(File::exists($img_path) && $img_path != 'images/SampleEvent.jpg') 
        {
            File::delete($img_path);
        }

        DB::table('events')->where('id', $id)->delete();
        return redirect('/eventfound/view')
            ->with('alert','deleteEventSuccess')
            ->with('eventName',$eventName);
    }

    public function add_event(Request $request)
    {
        $this->validate($request,
        [
            'txtename' => 'required|string|max:255',
            'description' => 'required',
            'date_start' => 'required',
            'date_end' => 'required|after_or_equal:date_start',
            'type' => 'required',
            'image_path' => 'mimes:jpeg,jpg,png|max:500', 
            'deadline' => 'required|before:date_start',          
        ]       
        );

        $ename = Input::get('txtename');
        $description = Input::get('description');
        $date_start = Input::get('date_start');
        $date_end = Input::get('date_end');
        $type = Input::get('type');
        $paid_activity = Input::get('paid_activity');
        $deadline = Input::get('deadline');
        $admin_id = Auth::user()->id;
        
        $date1=date_create($date_start);
        $date2=date_create($date_end);

        // $interval = date_diff($datetime1, $datetime2);    
        // $duration = $interval->format($differenceFormat);

        $data = array(
            'name' => $ename, 
            'description' => $description, 
            'status_id' => '2', 
            'duration' =>date_diff($date1,$date2)->format("%dd %hh %im"),
            'date_start' => $date_start,
            'date_end' => $date_end,
            'type_id' => $type, 
            'paid_activity' => $paid_activity,
            'deadline' => $deadline,
            'admin_id' => $admin_id
        );

        $image = $request->file('image_path');
        if(isset($image))
        {
            $new_name = rand() . '.' . $image->getClientOriginalExtension();

            //Image Resize to 1200x394
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(1200, 394);
            $image_resize->save(public_path('images/eventImages/'.$new_name));
            $data['image_path'] = 'eventImages/'.$new_name;
        }

        $event_id = DB::table('events')->insertGetId($data);
        $menu_arr_json = Input::get("hfmenu");

        if(!empty($event_id) && !empty($menu_arr_json))
        {
            $menu_arr = json_decode($menu_arr_json);
            foreach ($menu_arr as $item_id) 
            {
                DB::table('event_item')->insertGetId(
                    [
                        'event_id' => $event_id,
                        'item_id' => $item_id
                    ]
                );
            }
        }

        return redirect('/eventfound/view')
            ->with('alert','addEventSuccess')
            ->with('eventName',$ename);
    }

    public function sendInvEmail($id)
    { 
        $update_invite = DB::table("events")
        ->where('id', $id)
        ->update([
            'invite_status' => true
        ]);


        $user = DB::table('users')->select('id','firstname','lastname','email')->where("admin", "0")
                        ->get();
        $events = event::select('events.name', 'events.image_path','status.status' ,'events.description', 'events.id', 'events.date_start', 'events.date_end', 'events.deadline', 'events.duration', 'type.type', 'events.paid_activity', 'events.created_at', 'events.type_id', 'events.status_id')
        ->join('type', 'type.id', '=', 'events.type_id')
        ->join('status', 'status.id', '=', 'events.status_id')
        ->where('events.id', '=', $id)
        ->get();
        
        foreach ($user as $users) {
            foreach ($events as $event) {
                $data = [
                    'firstname'      => $users->firstname,
                    'lastname'       => $users->lastname,
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
                    'uid'            => $users->id,
                    'eid'            => $event->id
                ];

                Mail::send('emails.email-invitation', $data, function($m) use ($users,$events){
                $m->to($users->email, 'Alt Team')->from('hi@example.com', 'Alt Team')->subject('Event Invitation');
                });

                DB::table("user_event")->insert([
                    "user_id" => $users->id,
                    "event_id" => $event->id
                ]);
            }
        }
         return redirect('/eventfound/view');
     }

    public function eventview()
    {
        return view('events.viewevent_found');
    }
    public function show($id)
    {
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

        $user_event_count = DB::table('user_event')
        ->where('event_id', '=', $id)
        ->where('status', '=', 'going')
        ->count();
      
        $status = DB::table('status')->get();
        $type = DB::table('type')->get();

        return view('events.eventshow_found',['status' => $status],['type' => $type])->with('events',$event_show)->with('user_event_count', $user_event_count)->with($arrDateTime);
    }
    public function edit($id)
    {
        $status = DB::table('status')->orderby('status.status','DESC')->get();
        $type = DB::table('type')->get();
        $event = event::select('events.name', 'events.image_path', 'events.description', 'events.id','events.status_id', 'events.date_start', 'events.date_end', 'events.deadline', 'events.duration','events.type_id', 'type.type', 'events.paid_activity', 'events.created_at')
        ->join('type', 'type.id', '=', 'events.type_id')
        ->where('events.id', '=', $id)
        
        ->get();
        $event = $event[0];

       return view('events.eventform_edit')->with(compact('event','status','type'));
    }
    public function edit_event(Request $request, $id){
        $this->validate($request,
        [
            'txtename' => 'required|string|max:255',
            'description' => 'required',
            'status' => 'required',
            'date_start' => 'required',
            'date_end' => 'required|after_or_equal:date_start',
            'type' => 'required',
            'deadline' => 'required|before:date_start',           
        ]       
        );

        $name = Input::get('txtename');  
        $description = Input::get('description');       
        $type_id = Input::get('type');      
        $date_start = Input::get('date_start');
        $date_end = Input::get('date_end');
        $deadline = Input::get('deadline');       
        $status_id = Input::get('status');
        if(Input::get('paid_activity')=='on')
            $paid_activity = 1;
        else
            $paid_activity = 0;

        $date1 = date_create($date_start);
        $date2= date_create($date_end);
        $duration =date_diff($date1,$date2)->format("%dd %hh %im");                
        
        $image=$request->file('image_path');
        if(isset($image))
        {
            $this->validate($request,
            [
                'image_path' => 'mimes:jpeg,jpg,png | max:500'
            ]       
            );

            $getEventImg = DB::table('events')
            ->where('id', '=', $id)
            ->select('image_path')
            ->get();

            $old_path = "images/".$getEventImg[0]->image_path;
        
            if(File::exists($old_path) && $old_path != 'images/SampleEvent.jpg') 
            {
                File::delete($old_path);
            }
           
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            //Image Resize to 1200x394
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(1200, 394);
            $image_resize->save(public_path('images/eventImages/'.$new_name));

            DB::table('events')
            ->where('id', $id)
            ->update([
                'image_path' => 'eventImages/'.$new_name
            ]);
        }

        DB::table('events')
        ->where('id', $id)
        ->update([
            'name' => $name,
            'description' => $description,
            'type_id' => $type_id,
            'date_start' => $date_start,
            'date_end' => $date_end,
            'deadline' => $deadline,
            'duration' => $duration,
            'status_id' => $status_id,
            'paid_activity' => $paid_activity
        ]);

        return redirect('/eventfound/view')
                ->with('alert','editEventSuccess')
                ->with('eventName',$name);
    }
    
    public function add_event_form()
    {
        $type = DB::table('type')->get();
        $items = DB::table('items')->get();
        return view('events.eventform',['type' => $type])->with('items', $items);
    }

    public function deleteUserEvent($event_id, $user_id)
    {
        DB::table('user_event')->where(['event_id'=> $event_id], ['user_id'=> $user_id])->delete();
        return redirect('/eventfound/view');
    }

    public function update(Request $request)
    {
        $this->validate($request,
        [
            'txtename' => 'required|string|max:255',
            'description' => 'required',
            'status' => 'required',
            'date_start' => 'required',
            'date_end' => 'required|after_or_equal:date_start',
            'type' => 'required',
            'deadline' => 'required|before:date_start',           
        ]       
        );

        $id = Input::get('event');

       $name = Input::get('txtename');
        DB::table('events')
            ->where('id', $id)
        ->update(['name' => $name]);
            

        $desc = Input::get('description');
        DB::table('events')
            ->where('id', $id)
        ->update(['description' => $desc]);
        
            
        $type = Input::get('type');
        DB::table('events')
            ->where('id', $id)
        ->update(['type_id' => $type]);

        $datestart = Input::get('date_start');
        DB::table('events')
            ->where('id', $id)
        ->update(['date_start' => $datestart]);

        $dateend = Input::get('date_end');
        DB::table('events')
            ->where('id', $id)
        ->update(['date_end' => $dateend]);

        $deadline = Input::get('deadline');
        DB::table('events')
            ->where('id', $id)
        ->update(['deadline' => $deadline]);

        $status = Input::get('status');
        DB::table('events')
            ->where('id', $id)
        ->update(['status_id' => $status]);

        $date1=date_create($datestart);
        $date2=date_create($dateend);
        

        $dur=date_diff($date2,$date1)->format("%a");
        DB::table('events')
        ->where('id', $id)
       ->update(['duration' => $dur]);


        return back();
    }
    
    public function show_menu($id)
    {
        $get_menu = DB::table("event_item")
        ->select("event_item.*", "items.item_name AS item_name", "items.item_price AS item_price", "items.id")
        ->join("items", 'items.id', '=', 'event_item.item_id')
        ->where("event_item.event_id", $id)
        ->get();

        $get_event = DB::table("events")
        ->select("name", "id")
        ->where("id", $id)
        ->get();
        
        $item_remained_sql = "SELECT * from items where NOT EXISTS 
                                (  SELECT * 
                                FROM event_item
                                WHERE items.id = event_item.item_id
                                AND event_item.event_id = $id);";

        $item_remained= DB::SELECT($item_remained_sql);

        return view("events.showEventMenu", ["get_menu" => $get_menu], ["get_event" => $get_event])->with("item_remained", $item_remained);
    }
    public function viewOrder($id){
        $orders = DB::table('orders')
        ->select(
            'users.firstname',
            'users.lastname',

            'items.item_name',
            'items.item_description',
            'items.item_price',

            'order_details.item_quantity',

            'orders.id',
            'orders.total_price',
            'orders.paid_status'            
        )
        ->join('order_details','order_details.order_id','=','orders.id')
        ->join('items', 'items.id', '=', 'order_details.item_id')
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->where('orders.event_id',$id)        
        ->get();



        return view('orders.view_order_found')->with('orders',$orders)->with("event_id", $id);
    }
    public function delete_menu_item($event_id, $item_id)
    {
       DB::table("event_item")
       ->where("event_id", $event_id)
       ->where("item_id", $item_id)
       ->delete();

       return redirect('/show/menu/'.$event_id)
                ->with('alert', 'deleteItemSuccess');
    }

    public function add_item_menu($id)
    {
        $item_array = Input::get("menu-select");
        foreach ($item_array as $item_id ) {
            DB::table("event_item")->insert(["event_id" => $id, "item_id" => $item_id]);
        }

        return back()->with('alert', 'NewItemAdded');;
    }

    public function pay_event()
    {
        return view('events.event_payment_details');
    }

}
