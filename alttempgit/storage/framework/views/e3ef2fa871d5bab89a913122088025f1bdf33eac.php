    <?php $__env->startSection("contentcss"); ?>
        <link rel="icon" href="<?php echo e(asset('images/order_details.png')); ?>" />
        
        <title>Order Details</title>
        
    <?php $__env->stopSection(); ?>
<?php $__env->startSection("content"); ?>
    <div class="grid-x padding_cell">
        <div class="cell small-1"></div> 
        <div class="cell small-1 space-cell">
            <a href="/orderlist" class="back-btn hvr-icon-back"><i class="fa fa-chevron-circle-left hvr-icon icon-back"></i> Back</a>
        </div>
    </div>
    <div class="grid-x">
        <div class="small-1"></div>
        <div class="cell small-10 orderDe-heading">
            <h4><?php echo e($getUserName[0]->firstname); ?> <?php echo e($getUserName[0]->lastname); ?>'s Order Details for <?php echo e($getEventName[0]->name); ?></h4>
        </div>
    </div>
    <div class="grid-x">
        <div class="cell small-1"></div>
        <div class="cell small-10 adjpad">
            <div class="table-container">
                <table id="" class="table table-striped nowrap">
                    <thead>
                        <tr>
                            <th>
                                Item Name
                            </th> 
                            <th>
                                Quantity
                            </th>
                            <th>
                                Created at
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $getOrderDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getOrderDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <?php echo e($getOrderDetail->item_name); ?>

                            </td>
                            <td>
                                <?php echo e($getOrderDetail->item_quantity); ?> 
                            </td>
                            <td>
                                <?php echo e($getOrderDetail->created_at); ?>

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
<?php echo $__env->make("layouts.adminfound", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>