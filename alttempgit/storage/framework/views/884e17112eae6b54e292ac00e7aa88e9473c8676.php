<?php $__env->startSection('contentcss'); ?>
    <!-- Additional Page CSS -->
        <link rel="stylesheet" href="<?php echo e(asset('css/editUser.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/show_found.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/found.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/responsive-tables.css')); ?>">
    <!-- /Additional Page CSS -->

    
        <link rel="icon" href="<?php echo e(asset('images/eventStatus.png')); ?>" />
    

    
        <title>View Event Status</title>
    

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    

        <div class=" grid-x padding_cell">
            <div class="cell small-1"></div>
            <div class="cell small-1">
                <a href="/eventfound/show/<?php echo e($event_id); ?>/" class="back-btn hvr-icon-back"><i class="fa fa-chevron-circle-left hvr-icon icon-back"></i>Back</a>
            </div>
        </div>

        <div class="grid-x">
            <div class="cell small-1"></div>
            <div class="cell small-10">
            
                <div class="table-container">
                    <h4 class="datatableTitleUsers">Event Status</h4>
                    <table id="tbluser" class="table table-striped nowrap">
                        <thead>
                            <tr>
                                <th>
                                    First Name
                                </th>
                                <th>
                                    Last Name
                                </th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $user_event; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_events): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <?php echo e($user_events->firstname); ?> 
                                    </td>
                                    <td>
                                        <?php echo e($user_events->lastname); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                        </tbody>
                    </table>
                </div>   
            </div> 
            <div class="cell small-1"></div>
        </div>    

<?php $__env->stopSection(); ?>


    
<?php echo $__env->make('layouts.adminfound', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>