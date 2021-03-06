    <?php $__env->startSection("contentcss"); ?>
        <link rel="icon" href="<?php echo e(asset('images/food.png')); ?>" />
        
            <title>View Order</title>
        
    <?php $__env->stopSection(); ?>
<?php $__env->startSection("content"); ?>
    <div class="gridContainerEventShow">
        <div class="grid-x grid-padding-y">
            <div class="cell small-1"></div>
            <div class="cell small-5">
                <a href="/users_view/userviewshow/<?php echo e($event_id); ?>" class="back-btn hvr-icon-back"><i class="fa fa-chevron-circle-left hvr-icon icon-back"></i> Back</a>
            </div>
        </div>
        <div class="gridContainerEventShowMain">
            <div class="grid-x grid-padding-y">
                <div class="cell small-1"></div>
                <div class="cell small-5 lblgridtitle bar1">
                    <h3>Orders</h3>
                </div>
                <?php if(time() <= ((int)strtotime($deadline->deadline)+(24*60*60))): ?>
                <div class="cell small-5 hollow lblgridtitle bar2 total spaceorderright">
                    <span class="total-price-span">Total Order Price: <?php echo e($getTotalPrice[0]->total_price); ?></span>
                    <a href="/order/modify/<?php echo e($order_id); ?>"><span data-tooltip tabindex="1" class="has-tip bottom spaceordertop " title="Modify order"><i class=" fas fa-cart-plus iconsize"></i></span></a>
                </div> 
                <?php else: ?>
                <div class="cell small-5 hollow lblgridtitle bar2 total-only spaceorderright">
                        <span class="total-price-span">Total Order Price: <?php echo e($getTotalPrice[0]->total_price); ?></span>
                    </div> 
                <?php endif; ?>   
            </div>
                <div class="grid-x">
                    <div class="cell small-1"></div>
                    <div class="cell small-10 ordwrapper">
                        <table id="tblshoworder" class="table unstriped tblord nowrap">
                            <thead>
                                <tr>
                                    <th>
                                        Item 
                                    </th>
                                    <th>
                                        Item Price
                                    </th>
                                    <th>
                                        Quantity
                                    </th>
                                    <th>
                                        Total Price
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $ordersdet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderdets): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <?php echo e($orderdets->item_name); ?>

                                    </td>
                                    <td>
                                        <?php echo e($orderdets->item_price); ?>

                                    </td>
                                    <td>
                                        <?php echo e($orderdets->item_quantity); ?>

                                    </td>
                                    <td>
                                        <?php
                                            echo( $orderdets->item_quantity)*($orderdets->item_price)
                                        ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="cell small-1"></div>
                </div>
        </div>
    </div>        
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.userfound", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>