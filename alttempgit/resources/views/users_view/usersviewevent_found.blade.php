@extends('layouts.userfound')
    @section('contentcss')
    <!-- Additional Page CSS -->
        <link rel="stylesheet" href="{{asset('css/editEvent.css')}}">
        <link rel="stylesheet" href="{{asset('css/show_found.css')}}">
    <!-- /Additional Page CSS -->
    @endsection

    <link rel="icon" href="{{asset('images/event.png')}}" />
    <title>Event Details</title>

@section('content')
<div class="grid-x grid-padding-y">
    <div class="cell small-1"></div>
    <div class="cell small-5"><a href="/eventfound/view" class="back-btn btninvisible"><i class="fa fa-chevron-circle-left hvr-icon icon-back"></i>Back</a></div>
    <div class="cell small-5 hollow"></div>
</div>


<div class="grid-x">
    <div class="cell small-1"></div>
    <div class="cell small-10">

    <div class="table-container">
        <h4 class="datatableTitleEvents">Events</h4>
        <table id="tblevent" class="table table-striped nowrap">
            <thead>
                <tr>
                    <th>
                        Event Name
                    </th>
                    <th>
                        Status
                    </th>
                    <th>
                       Duration (day)
                    </th>
                    <th>
                        Date Start
                    </th> 
                    <th>
                        Deadline
                    </th> 
                    <th>
                        <span data-tooltip tabindex="1" title="Number of people going to the event" data-position="bottom" data-alignment="center">Going</span>
                    </th>
                    <th class="actionsize">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                    <td>
                        {{$event->name}}
                    </td>
                    <td>
                        {{$event->status}}
                    </td>
                    <td>
                        {{$event->duration}}
                    </td>
                    <td>
                        {{$event->date_start}}
                    </td>
                    <td>
                        {{$event->deadline}}
                    </td>
                    <td>
                        <?php $going=DB::table('user_event')
                        ->where('event_id', '=', $event->id)
                        ->where('status', '=', 'going')
                        ->count();                        
                        ?>
                        <div class="switch small">
                        <input class="switch-input" id="evntStatus{{$event->id}}" type="checkbox" name="exampleSwitch"
                        <?php
                            $user_id = Auth::user()->id;
                            $event_id=$event->id;
                            $flag = DB::table('user_event')                            
                            ->where('user_id','=',$user_id)
                            ->where('event_id','=',$event_id)
                            ->pluck('user_event.status');
                            if(sizeof($flag)!=0){
                                $flag=$flag[0];
                                if ($flag=="going"){
                                    echo ('checked');
                                }
                            }
                            
                        ?>
                        >
                            <label class="switch-paddle" for="evntStatus{{$event->id}}">
                              <span class="switch-active" aria-hidden="true">Yes</span>
                              <span class="switch-inactive" aria-hidden="true">No</span>
                            </label>
                          </div>
                    </td>
                    <td>
                        <a href="/users_view/userviewshow/{{$event->id}}"><span data-tooltip tabindex="1" title="show"><i class="far fa-eye"></i></span> &nbsp;
                    </td>                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="cell small-1"></div>
</div>
    
    @section('contentscript')
    @if($errors->has('txtename'))
<script>
    $.alert({
        title: 'Errors',
        icon: 'fas fa-exclamation',
        boxWidth: '30%',
        type:'dark',
        useBootstrap: false,
        content: '<b>{{$errors->first('txtename')}}</b> Retry!' +
        '<hr>',
        });
</script>
@endif
@if($errors->has('description'))
<script>
    $.alert({
        title: 'Errors',
        icon: 'fas fa-exclamation',
        boxWidth: '30%',
        type:'dark',
        useBootstrap: false,
        content: '<b>{{$errors->first('description')}}</b> Retry!' +
        '<hr>',
        });
</script>
@endif
@if($errors->has('deadline'))
<script>
    $.alert({
        title: 'Errors',
        icon: 'fas fa-exclamation',
        boxWidth: '30%',
        type:'dark',
        useBootstrap: false,
        content: '<b>{{$errors->first('deadline')}}</b> Retry!' +
        '<hr>',
        });
</script>
@endif
@if($errors->has('date_end'))
<script>
    $.alert({
        title: 'Errors',
        icon: 'fas fa-exclamation',
        boxWidth: '30%',
        type:'dark',
        useBootstrap: false,
        content: '<b>{{$errors->first('date_end')}}</b> Retry!' +
        '<hr>',
        });
</script>
@endif
@if($errors->has('date_start'))
<script>
    $.alert({
        title: 'Errors',
        icon: 'fas fa-exclamation',
        boxWidth: '30%',
        type:'dark',
        useBootstrap: false,
        content: '<b>{{$errors->first('date_start')}}</b> Retry!' +
        '<hr>',
        });
</script>
@endif


<script>
    $('button warning').click(function() {
        // reset modal if it isn't visible
        if (!($('.modal.in').length)) {
            $('.modal-dialog').css({
            top: 0,
            left: 0
            });
        }
        $('.editevent').modal({
            backdrop: false,
            show: true
        });

        $('editevent').draggable({
            handle: ".modal-header"
        });
    });


    $('.editeventbtn').on('click', function (event)  {
        
        //  var button = $(event.relatedTarget) 
        
        var ename =  $(this).attr("data-eventname");

        var edesc =  $(this).attr("data-eventdesc");
        var etype= $(this).attr("data-eventtype");
        var estatus= $(this).attr("data-eventstatus"); 
        var sdate= $(this).attr("data-datestart"); 
        var edate= $(this).attr("data-dateend"); 
        var deadln= $(this).attr("data-edeadline"); 
        var etype =  $(this).attr("data-eventtype"); 
        var eventid =  $(this).attr("data-eventid"); 

        $('#txtename').val(ename);
        $('#description').val(edesc);
        $("#type").val(etype);
        $("#status").val(estatus);
        $('#date_start').val(sdate);
        $(' #date_end').val(edate);
        $('#deadline').val(deadln);
        $('#eventid').val(eventid);
    });
</script>

@include('layouts.global')
@if (session('alert')=='order_added')
    <?php
        $title='Order';
        $message="has been added.";
        $type='success';
        alertSuccess($title, $message, $type);
    ?>
@endif

<script type="text/javascript">
    $(document).ready(function() {
        $(".switch-input").change(function() {
            var status="";
            if(this.checked){
                status="going";
            }else{
                status="not_going";
            }
            var userID = <?php echo Auth::user()->id ?>;
            var eventID = (this.id.split("evntStatus"))[1];            
            $.ajax({
                type:"GET",
                url: "updateStatus",
                data: {
                    user_id:userID,
                    event_id:eventID,
                    status:status
                },
                success: function(result) {                   
                    if(result=="success"){
                        var type="";                        
                        if(status=="going"){
                            type='green';
                        }else{
                            type='yellow';
                        }
                        iziToast.show({
                            title: 'Success',
                            message: 'Status has been updated',
                            position: 'bottomRight',
                            color:type,
                            transitionIn:'fadeInUp'
                        });
                    }else{
                        iziToast.show({
                            title: 'Error',
                            message: 'Status could not be updated',
                            position: 'bottomRight',
                            color:'red',
                            transitionIn:'fadeInUp'
                        });
                    }
                }                    
            });
        });
    });		
</script>
@endsection
@endsection