<link rel="stylesheet" href="<?php echo e(asset('css/editEvent.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/show_found.css')); ?>">



<link rel="icon" href="<?php echo e(asset('images/event.png')); ?>" />
<title>Event Upcoming Details</title>

<?php $__env->startSection('content'); ?>
<div class="grid-x padding_cell">
        <div class="cell small-1"></div> 
        <div class="cell small-1 ">
            <a href="/eventfound/view" class="back-btn hvr-icon-back"><i class="fa fa-chevron-circle-left hvr-icon icon-back"></i> Back</a>
        </div>
    </div>
<div class="grid-x">
        <div class="cell small-1"></div>
        <div class="cell small-10">
    <div class="table-container">
        <h4 class="datatableTitleUpEvents">Upcoming Events</h4>
        <table id="tblevent" class="table table-striped nowrap">
            <thead>
                <tr>
                    <th>
                        Event Name
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
                        <?php echo e($event->duration); ?>

                    </td>
                    <td>
                        <?php echo e($event->date_start); ?>

                    </td>
                    <td>
                        <?php echo e($event->deadline); ?>

                    </td>
                    <td>
                    <?php $going=DB::table('user_event')
                    ->where('event_id', '=', $event->id)
                    ->where('status', '=', 'going')
                    ->count();
                    echo $going;
                    ?>
                    </td>
                    <td style="width: 21%" >
                        <a href="/eventfound/show/<?php echo e($event->id); ?>" data-tooltip tabindex="1" title="show">
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="far fa-eye"></i>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                        </a>|
                        <a href="/eventfound/edit/<?php echo e($event->id); ?>" data-tooltip tabindex="1" title="Edit"><span data-tooltip tabindex="1" title="Edit">
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


   

<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminfound', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>