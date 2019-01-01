<?php $__env->startSection('content'); ?>
    <?php $__env->startSection("contentcss"); ?>
        <link rel="stylesheet" href="<?php echo e(asset('css/show_found.css')); ?>">
        <link rel="icon" href="<?php echo e(asset('images/foodmenu.png')); ?>" />
        
        <title>Order List</title>
        
    <?php $__env->stopSection(); ?>
    <div class="grid-x padding_cell">
        <div class="cell small-1"></div>
        <div class="cell small-1 ">
            <a class="back-btn hvr-icon-pulse" href="/admin/dashboard"><i class="fa fa-home hvr-icon"></i> Home</a>
        </div>
    </div>
    <div class="grid-x">
        <div class="cell small-1"></div>
        <div class="cell small-10 adjpad">
            <div class="table-container">
                <h4 class="datatableTitleEvents">Order List</h4>
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
                                Start Date
                            </th>                            
                            <th>
                               Order Details
                            </th>
                        </tr>
                    </thead>                    
                    <tbody>
                        <?php $__currentLoopData = $Event_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Event_order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <?php echo e($Event_order->name); ?>

                            </td>
                            <td>
                                <?php echo e($Event_order->status); ?>

                            </td>
                            <td>
                                <?php echo e($Event_order->date_start); ?>

                            </td>
                            <td>
                                <a href="/view/order/<?php echo e($Event_order->id); ?>"><span data-tooltip tabindex="1" title="show"><i class="far fa-eye"></i></span> &nbsp; 
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