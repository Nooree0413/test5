<?php $__env->startSection('contentcss'); ?>
    
        <link rel="stylesheet" href="<?php echo e(asset('css/show_found.css')); ?>">
    
    
        <link rel="icon" href="<?php echo e(asset('images/event.png')); ?>" />
    
    
        <title>Event Details</title>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

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
                <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event_status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($event_status->id); ?>"><?php echo e($event_status->status); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                        
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <?php echo e($event->name); ?>

                    </td>
                    <td>
                        <?php echo e($event->status); ?>

                    </td>
                    <td>
                        <?php echo e($event->duration); ?>

                    </td>
                    <td>
                        <?php echo e($event->date_start); ?>

                    </td>
                    <td>
                        <?php echo e($event->deadline); ?>

                    </td>
                    <td>
                    
                    <?php 
                        $going=DB::table('user_event')
                        ->where('event_id', '=', $event->id)
                        ->where('status', '=', 'going')
                        ->count();
                        echo $going;
                    ?>
                    
                    </td>
                    <td>
                    <a href="/eventfound/show/<?php echo e($event->id); ?>" data-tooltip tabindex="1" title="show">
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="far fa-eye"></i>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                        </a>|
                        <a href="/eventfound/edit/<?php echo e($event->id); ?>" data-tooltip tabindex="1" title="Edit">
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="fas fa-pencil-alt"></span></i>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                        </a>|                        
                        <a href="/eventfound/delete/<?php echo e($event->id); ?>"  class="btndelevent" data-target="#delete1"><span data-tooltip tabindex="1" title="Delete">
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="fas fa-trash-alt"></span></i>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<div class="cell small-1"></div>
</div>
    
<?php $__env->startSection('contentscript'); ?>
    <script>
        $(".btndelevent").on("click", {msg:'Do you want to delete this Event?'}, confirmMsg);
    </script>
    <?php if($errors->has('txtename')): ?>
    <script>
        $.alert({
            title: 'Errors',
            icon: 'fas fa-exclamation',
            boxWidth: '30%',
            type:'dark',
            useBootstrap: false,
            content: '<b><?php echo e($errors->first('txtename')); ?></b> Retry!' +
            '<hr>',
            });
    </script>
<?php endif; ?>

<?php if($errors->has('description')): ?>
<script>
    $.alert({
        title: 'Errors',
        icon: 'fas fa-exclamation',
        boxWidth: '30%',
        type:'dark',
        useBootstrap: false,
        content: '<b><?php echo e($errors->first('description')); ?></b> Retry!' +
        '<hr>',
        });
</script>
<?php endif; ?>

<?php if($errors->has('deadline')): ?>
<script>
    $.alert({
        title: 'Errors',
        icon: 'fas fa-exclamation',
        boxWidth: '30%',
        type:'dark',
        useBootstrap: false,
        content: '<b><?php echo e($errors->first('deadline')); ?></b> Retry!' +
        '<hr>',
        });
</script>
<?php endif; ?>

<?php if($errors->has('date_end')): ?>
<script>
    $.alert({
        title: 'Errors',
        icon: 'fas fa-exclamation',
        boxWidth: '30%',
        type:'dark',
        useBootstrap: false,
        content: '<b><?php echo e($errors->first('date_end')); ?></b> Retry!' +
        '<hr>',
        });
</script>
<?php endif; ?>

<?php if($errors->has('date_start')): ?>
<script>
    $.alert({
        title: 'Errors',
        icon: 'fas fa-exclamation',
        boxWidth: '30%',
        type:'dark',
        useBootstrap: false,
        content: '<b><?php echo e($errors->first('date_start')); ?></b> Retry!' +
        '<hr>',
        });
</script>
<?php endif; ?>

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
<?php echo $__env->make('layouts.global', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php if(session('alert')=='addEventSuccess'): ?>
    <?php
        $title=session('eventName');
        $message="Event has been added.";
        $type='success';
        alertSuccess($title, $message, $type);
    ?>
<?php elseif(session('alert')=='deleteEventSuccess'): ?>
    <?php
        $title=session('eventName');
        $message="Event has been deleted.";
        $type='success';
        alertSuccess($title, $message, $type);
    ?>
<?php elseif(session('alert')=='editEventSuccess'): ?>
    <?php        
        $title=session('eventName');
        $message="Event has been updated.";
        $type='success';
        alertSuccess($title, $message, $type);
    ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminfound', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>