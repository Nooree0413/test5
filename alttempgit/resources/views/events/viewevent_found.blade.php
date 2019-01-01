@extends('layouts.adminfound')

@section('contentcss')
    {{-- Additional Page CSS --}}
        <link rel="stylesheet" href="{{asset('css/show_found.css')}}">
    {{-- /Additional Page CSS --}}
    {{-- Page Icon --}}
        <link rel="icon" href="{{asset('images/event.png')}}" />
    {{-- /Page Icon --}}
    {{-- Page Title --}}
        <title>Event Details</title>
    {{-- Page Title --}}
@endsection

@section('content')
{{-- Event Datatable --}}
<div class="grid-x padding_cell">
        <div class="cell small-1"></div>
        <div class="cell small-1 ">
            <a class="back-btn hvr-icon-pulse" href="/admin/dashboard"><i class="fa fa-home hvr-icon"></i> Home</a>
        </div>
    </div>
<div class="grid-x">
        <div class="cell small-1"></div>
        <div class="cell small-10 ">
    <div class="table-container">
    <h4 class="datatableTitleEvents">Events</h4>
        <div class="input-group" style="align:right; width:20%">
            <select id="EventStatus" name="EventStatus" onchange="statusChange()">
                <option value="0">All</option>
                @foreach ($status as $event_status)
                    <option value="{{$event_status->id}}">{{$event_status->status}}</option>
                @endforeach
            </select>
        </div>
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
                        <span data-tooltip tabindex="1" title="Number of people going to the event" data-position="bottom" data-alignment="center">
                            Going
                        </span>
                    </th>
                    <th >
                        {{-- class="actionsize" --}}
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
                    {{--Number for People coming --}}
                    <?php 
                        $going=DB::table('user_event')
                        ->where('event_id', '=', $event->id)
                        ->where('status', '=', 'going')
                        ->count();
                        echo $going;
                    ?>
                    {{--/Number for People coming --}}
                    </td>
                    <td>
                    <a href="/eventfound/show/{{$event->id}}" data-tooltip tabindex="1" title="show">
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="far fa-eye"></i>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                        </a>|
                        <a href="/eventfound/edit/{{$event->id}}" data-tooltip tabindex="1" title="Edit">
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="fas fa-pencil-alt"></span></i>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                        </a>|                        
                        <a href="/eventfound/delete/{{$event->id}}"  class="btndelevent" data-target="#delete1"><span data-tooltip tabindex="1" title="Delete">
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="fas fa-trash-alt"></span></i>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                        </a>
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
    <script>
        $(".btndelevent").on("click", {msg:'Do you want to delete this Event?'}, confirmMsg);
    </script>
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

<?php
    if(isset($_GET["status"])){
        $status_id=$_GET["status"];        
        echo("<script>
                document.getElementById('EventStatus').value=$status_id;
            </script>        
        ");
    }
?>

<script type="text/javascript">
    function statusChange(){
        var id = document.getElementById("EventStatus").value;
        if(id==0){
            location="/eventfound/view";
        }else{
            location="/eventfound/view?status="+id;
        }        
    }
    $('button warning').click(function() 
    {
     //Reset modal if it isn't visible
    if (!($('.modal.in').length)) 
    {
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


 $('.editeventbtn').on('click', function (event) {
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
@if (session('alert')=='addEventSuccess')
    <?php
        $title=session('eventName');
        $message="Event has been added.";
        $type='success';
        alertSuccess($title, $message, $type);
    ?>
@elseif (session('alert')=='deleteEventSuccess')
    <?php
        $title=session('eventName');
        $message="Event has been deleted.";
        $type='success';
        alertSuccess($title, $message, $type);
    ?>
@elseif (session('alert')=='editEventSuccess')
    <?php        
        $title=session('eventName');
        $message="Event has been updated.";
        $type='success';
        alertSuccess($title, $message, $type);
    ?>
@endif
@endsection
@endsection