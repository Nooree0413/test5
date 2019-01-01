<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Mail\sendInvEmail;
use Mail;
use Illuminate\Support\Facades\Hash;

class AdminControllerFound extends Controller
{
    public function index()
    {
        $users_count = DB::table('users')
        ->where(['users.admin'=>0])
        ->count();
        //$users_count='123';

        //gets all upcoming and on going events
        //assuming id 1=upcoming, 2=ongoing
        $LatestEvent = (DB::table('events')
        ->where(function($q) {
            $q  ->where('status_id','1')
                ->orwhere('status_id','2');
        })
        ->where('invite_status','1')        
        ->orderBy('date_start', 'ASC')
        ->get());
        //var_dump ($LatestEvent);
        if(sizeof($LatestEvent)>0){
            $LatestEvent=$LatestEvent[0];
            $eventID=$LatestEvent->id;
            
            $UsersInvited = DB::table("events")
            ->where("id", $eventID)
            ->where("invite_status", "1")
            ->join("user_event", "user_event.event_id", "=", "events.id")
            ->count();

            $users_going = DB::table('user_event')
            ->where('event_id',$eventID)
            ->where('status','going')
            ->count();
            $users_NotGoing=$UsersInvited-$users_going;

            $arrData['LatestEvent']=$LatestEvent;
            $arrData['UsersInvited']=$UsersInvited; 
            $arrData['users_going']=$users_going;
            $arrData['users_NotGoing']=$users_NotGoing;
        }

        $events = DB::table('events')
        ->count();

        $eventStatusCount = DB::table('events')
        ->select('status.status','status.id',DB::raw('count(events.id) as total'))
        ->rightjoin('status', 'events.status_id', '=', 'status.id')
        ->groupBy('status.id')
        ->orderby('status.status','DESC')
        ->get();       
        

        $arrData['users_count']=$users_count;        
        $arrData['events']=$events;
        $arrData['eventStatusCount']=$eventStatusCount;
        
        
        // var_dump ($arrData);
        return view('dashboard.admin_dashboard')->with($arrData);
    }
}
