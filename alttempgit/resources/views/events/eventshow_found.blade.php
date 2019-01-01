@extends("layouts.adminfound")
    @section('contentcss')
    {{-- Tab icon Page --}}
        <link rel="icon" href="{{asset('images/eventDetails.png')}}" />
        <title>{{$events[0]->name}}</title>
    {{-- /Tab icon Page --}}
    @endsection
@section("content")

<div class="loader2"></div>
<div class="gridContainerEventShow">
    <div class="grid-x grid-padding-y">
            <div class="cell small-1"></div>
            <div class="cell small-5"><a href="/eventfound/view" class="back-btn hvr-icon-back"><i class="fa fa-chevron-circle-left hvr-icon icon-back"></i>Back</a></div>
            <div class="cell small-5 hollow"><a href="/eventfound/edit/{{$events[0]->id}}" class="back-btn hvr-icon-buzz-out"><i class="fas fa-marker hvr-icon icon-edit"></i>Edit</a></div>
        </div>
    <div class="gridContainerEventShowMain">
        <div class="grid-x grid-padding-y">
            <div class="cell small-1"></div>
            <div class="cell small-5 lblgridtitle bar1"><h3>{{$events[0]->name}}</h3></div>
            <div class="cell small-5 hollow lblgridtitle bar2">

                @if(DB::table('events')->where('events.id', $events[0]->id)->where('type.order_status', '1')->join("type", "type.id", "=", "events.type_id")->count() > 0)
                    <a href="/view/order/{{$events[0]->id}}" class="viewOrder"><span data-tooltip tabindex="1" class="has-tip bottom" title="View event orders"><i class="fa fa-shopping-basket"></i></span></a>
                    <a href="/show/menu/{{$events[0]->id}}" class="show-menu"><span data-tooltip tabindex="1" class="has-tip bottom" title="Show Menu"><i class="fas fa-utensils"></i></span></a>
                @endif

                @if(DB::table('events')->where('id', $events[0]->id)->where('paid_activity', '1')->count() > 0)
                    <a href="/show/payment" class="viewPBill"><span data-tooltip tabindex="1" class="has-tip bottom" title="View Payment Details"><i class="fas fa-file-invoice-dollar"></i></span></a>
                @endif

                
                @if (DB::table('events')->where('id', $events[0]->id)->where('invite_status', '1')->count()>0) 
                    <a href="#" class="sendInvite-lock"><span data-tooltip tabindex="1" class="has-tip bottom" title="Invite was already sent"><i class="far fa-envelope iconColor"></i></span></a>
                @elseif(DB::table('events')->where('id', $events[0]->id)->where('status_id', '3')->count()>0)
                    <a href="#" class="sendInvite-complete"><span data-tooltip tabindex="1" class="has-tip bottom" title="Event is Completed"><i class="far fa-envelope iconColor"></i></span></a>
                @elseif(DB::table('events')->where('id', $events[0]->id)->where('status_id', '4')->count()>0)
                    <a href="#" class="sendInvite-cancelled"><span data-tooltip tabindex="1" class="has-tip bottom" title="Event is Completed"><i class="far fa-envelope iconColor"></i></span></a>
                @else
                    <a href="/eventform/{{$events[0]->id}}" class="sendInvite"><span data-tooltip tabindex="1" class="has-tip bottom" title="invite"><i class="far fa-envelope iconColor" style="color:#363B50"></i></span></a>
                @endif

                <a href="/eventfound/checkEventStatus/{{$events[0]->id}}" class="checkEventStatusShow"><span data-tooltip tabindex="1" class="has-tip bottom" title="status"><i class="far fa-address-card iconColor" style="color:#363B50"></i></span></a>
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
                <div class="cell small-3 lblpaid_activity">  @if($events[0]->paid_activity==1)
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

    @section('contentscript')
        <script>
            $(".sendInvite").on("click", function(){
                event.preventDefault();
                var ref = $(this).attr('href');
                $.confirm({
                boxWidth: '30%',
                useBootstrap: false,
                backgroundDismiss: true, 
                title: 'Notice',
                content: 'Are you sure you want to send invite for this event?',
                type: 'green',
                typeAnimated: true,
                buttons: 
                {
                    Yes: {
                        text: 'Yes',
                        action: function()
                        {
                            $(".loader2").css("display", "block");
                            window.location = ref;
                        }
                    },
                    No: 
                    {
                        text:'No',
                        backgroundDismiss: true,
                    },
                }
                });
            });

            $(".sendInvite-lock").on("click", function(){
                $.confirm({
                boxWidth: '30%',
                useBootstrap: false,
                backgroundDismiss: true, 
                title: 'Notice',
                content: 'Invite for this event was already sent!',
                type: 'orange',
                typeAnimated: true,
                buttons: 
                {
                    Yes: {
                        text: 'Yes',
                        action: function()
                        {
                            backgroundDismiss: true
                        }
                    },
                }
                });
            });

            $(".sendInvite-complete").on("click", function(){
                $.confirm({
                boxWidth: '30%',
                useBootstrap: false,
                backgroundDismiss: true, 
                title: 'Notice',
                content: 'This Event is completed!',
                type: 'orange',
                typeAnimated: true,
                buttons: 
                {
                    Yes: {
                        text: 'Yes',
                        action: function()
                        {
                            backgroundDismiss: true
                        }
                    },
                }
                });
            });

            $(".sendInvite-cancelled").on("click", function(){
                $.confirm({
                boxWidth: '30%',
                useBootstrap: false,
                backgroundDismiss: true, 
                title: 'Notice',
                content: 'Event was cancelled!',
                type: 'orange',
                typeAnimated: true,
                buttons: 
                {
                    Yes: {
                        text: 'Yes',
                        action: function()
                        {
                            backgroundDismiss: true
                        }
                    },
                }
                });
            });
        </script>
    @endsection
@endsection