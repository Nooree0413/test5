@extends('layouts.userfound')

@section('contentcss')
{{-- Tab icon Page --}}
    <link rel="icon" href="{{asset('images/eventDetails.png')}}" />
    <title>Event Details</title>
{{-- /Tab icon Page --}}
@endsection
@section("content")
<style>
    
</style>
<div class="loader2"></div>
<div class="gridContainerEventShow">
    <div class="grid-x grid-padding-y">
            <div class="cell small-1"></div>
            <div class="cell small-5"><a href="/eventfound/view" class="back-btn hvr-icon-back"><i class="fa fa-chevron-circle-left hvr-icon icon-back"></i> Back</a></div>
            <div class="cell small-5 hollow"></div>
        </div>
    <div class="gridContainerEventShowMain">
        <div class="grid-x grid-padding-y">
            <div class="cell small-1"></div>
            <div class="cell small-5 lblgridtitle bar1"><h3>{{$events[0]->name}}</h3></div>
            <div class="cell small-5 hollow lblgridtitle bar2">

            @if(DB::table('user_event')->where('user_id', Auth::user()->id)->where('event_id',$events[0]->id)->where("status", "going")->count()>0)
                @if(DB::table('events')->join("type", "type.id", "=", "events.type_id")->where('events.id',$events[0]->id)->where("type.order_status", "1")->count()>0)
                    {{-- View Order Enable --}}
                    @if (DB::table('orders')->where('user_id', Auth::user()->id)->where('event_id',$events[0]->id)->exists()) 
                    <a href="/order/view/{{$events[0]->id}}/{{$get_order[0]->id}}">
                        <span data-tooltip tabindex="1" title="View Order" class="span-rightpad">
                            <i class="fas fa-shopping-basket icon-position-size icon-active"></i>
                        </span>
                    </a>
                    
                    {{-- View Order Disable --}}
                    @else 
                    <a href="#" >
                        <span data-tooltip tabindex="1" title="View Order" class="span-rightpad">
                            <i class="fas fa-shopping-basket icon-position-size icon-disable"></i>
                        </span>
                    </a>            
                    @endif   
                    @if(time() <= ((int)strtotime($events[0]->deadline)+(24*60*60)))
                        {{-- Add Order Disable --}}
                        @if (DB::table('orders')->where('user_id',  Auth::user()->id)->where('event_id',$events[0]->id)->exists()) 
                        <a href="#" class="span-rightpad">
                            <span data-tooltip tabindex="1" title="Add Order">
                                <i class="fas fa-cart-plus icon-position-size icon-disable"></i>
                            </span>     
                        </a>

                        {{-- Add Order Enable --}}
                        @else  
                        <a href="/order/add/{{$events[0]->id}}">
                            <span data-tooltip tabindex="1" title="Add Order" class="span-rightpad">
                                <i class="fas fa-cart-plus icon-position-size icon-active"></i>
                            </span>  
                        </a>
                        @endif
                    @endif
                @endif
            @endif

            </div>    
        </div>
        <div class="grid-x grid-padding-y">
            <div class="cell small-1"></div>
            <div class="cell small-2 lblStartDate"><b>Start Date:</b> {{$StartDate}}<br>
                <b>Time: </b>{{$StartTime}}
            </div>
            <div class="cell small-3 lblEndDate"><b>End Date:</b> {{$EndDate}}<br>
                <b>Time: </b>{{$EndTime}}
            </div>
            <div class="cell small-3 lblStatus"><b>Status:</b> {{$events[0]->status}}</div>
            <div class="cell small-2 lblDuration"><b>Duration:</b> {{$events[0]->duration}}</div>
        </div>
        <div class="grid-x grid-padding-y">
                <div class="cell small-1"></div>
                <div class="cell small-2 lblType"><b>Type:</b> {{$events[0]->type}}</div>
                <div class="cell small-3 lblDeadline"><b>Deadline:</b> {{$events[0]->deadline}}</div>
                <div class="cell small-3 lblpaid_activity"> @if($events[0]->paid_activity==1)
                                                                <b>Paid Activity:</b> Yes
                                                            @else
                                                                <b>Paid Activity:</b> No
                                                            @endif
                </div>
                <div class="cell small-2 emptycell"></div>
        </div>
        <div class="grid-x grid-padding-y">
                <div class="cell small-1"></div>
                <div class="cell small-10 lblImage"><img  class="imgsize" src="  {{asset('images/'.$events[0]->image_path)}}" alt="Avatar" ></div>
        </div>
        <div class="grid-x grid-padding-y">
                <div class="cell small-1"></div>
                <div class="cell small-5 lblEventDescription"><b>Event Description:</b> </div>
                <div class="cell small-5 lblDescription"> {{$events[0]->description}} </div>
        </div>  
    </div>
</div>
@endsection

  
  