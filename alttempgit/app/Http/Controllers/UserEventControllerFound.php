<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class UserEventControllerFound extends Controller
{
    public function updateUserStatus($uid,$eid,Request $request)
    {
        //check which link was clicked (going or not going) in mail
        if ($request->has('status')) {
            $status = $request->input('status');
        }

        $user_id = $uid;
        $event_id = $eid;
        // $paid_status = 0;
        // $user_event= DB::table('user_event')
        // ->select()
        // ->where(['user_id'=> $user_id])
        // ->where(['event_id'=> $event_id])
        // ->get();

        // if (count($user_event)>0) {
        //    return redirect('/login');    
        // }
        // else {
        //     $data = array(
        //     'user_id' => $user_id, 
        //     'event_id' => $event_id, 
        //     'status' => $status, 
        //     'paid_status' => $paid_status        
        // );
        DB::table('user_event')
        ->where('user_id', $user_id)
        ->where('event_id', $event_id)
        ->update([
                'status' => $status
            ]);

        // DB::table('user_event')->insert($data);
        
        return redirect('/login');
            
        // }
        
    }

    public function updateUserEventStatus($id)
    {
        $status="not_going";
        DB::table('user_event')
        ->where('user_id', $id)
        ->update(['status' => $status]);

        return back();
                  
    }

    public function checkEventStatus($id){
        $user_events=DB::table('user_event')
         ->select('user_event.event_id','user_event.status', 'user_event.user_id', 'users.firstname AS firstname' , 'users.lastname AS lastname')
         ->join("users", "users.id", "=", "user_event.user_id")
         ->where('event_id', $id)->where('status',"going")
         ->get();
        
        return view('events.eventstatus_found')->with(['user_event'=>$user_events])->with("event_id", $id);
    }
}
