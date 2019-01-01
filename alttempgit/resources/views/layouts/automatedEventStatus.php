<?php
date_default_timezone_set('Indian/Mauritius');
//gets all upcoming and on going events
//assuming id 1=upcoming, 2=ongoing 3=completed 4=cancelled
$events=DB::table('events')
    ->where('status_id','!=','4')
    ->get();
foreach($events as $event){
    $eventID=$event->id;
    $date_end = $event->date_end;
    $date_start = $event->date_start;
    
    if(time() > strtotime($date_start) && time() < strtotime($date_end)){
        //ongoing id=2   
        DB::table('events')            
        ->where('id', $eventID)
        ->update([
            'status_id' => '2'
        ]);
    }elseif(time() > strtotime($date_end)){
        //completed id = 3
        DB::table('events')            
        ->where('id', $eventID)
        ->update([
            'status_id' => '3'
        ]);
    }
}
?>