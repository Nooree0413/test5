<?php $__env->startSection('content'); ?>
    <?php $__env->startSection("contentcss"); ?>
        <link rel="stylesheet" href="<?php echo e(asset('css/show_found.css')); ?>">
        <link rel="icon" href="<?php echo e(asset('images/foodmenu.png')); ?>" />
        
        <title>Orders</title>
        
    <?php $__env->stopSection(); ?>
    <div class="grid-x padding_cell">
        <div class="cell small-1"></div>
        <div class="cell small-1 ">
            <a class="back-btn hvr-icon-back" href="/eventfound/show/<?php echo e($event_id); ?>"><i class="fa fa-chevron-circle-left hvr-icon"></i> Back</a>
        </div>
    </div>
    <div class="grid-x">
        <div class="cell small-1"></div>
        <div class="cell small-10 adjpad">
            <div class="table-container">
                <h4 class="datatableTitleEventsOrders" align="center">Orders</h4>
                <table id="tblEventsOrders" class="table table-striped nowrap">
                    <thead>
                        <tr>
                             <th hidden>
                                Order ID
                            </th> 
                            <th hidden>
                                Name
                            </th> 
                            <th>
                                Item
                            </th>
                            <th>
                                Description
                            </th>
                            <th>
                                Price
                            </th>
                            <th>
                                Quantity
                            </th>
                            <th>
                                Total
                            </th>
                            <th hidden>
                                Grand Total
                            </th>
                            <th hidden>
                                Paid
                            </th>
                        </tr>
                    </thead>                    
                    <tbody>
                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td hidden>
                                <?php echo e($order->id); ?>

                            </td>
                            <td hidden>
                                <?php echo e($order->firstname); ?> <?php echo e($order->lastname); ?>

                            </td>
                            <td>
                                <?php echo e($order->item_name); ?>

                            </td>
                            <td>
                                <?php echo e($order->item_description); ?>

                            </td>
                            <td>
                                <?php echo e($order->item_price); ?>

                            </td>
                            <td>
                                <?php echo e($order->item_quantity); ?>

                            </td>
                            <td>
                                <?php echo e($order->item_price * $order->item_quantity); ?>

                            </td>
                            <td hidden>
                                <?php echo e($order->total_price); ?>

                            </td>
                            <td hidden>
                                <?php echo e($order->paid_status); ?>

                                
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="cell small-1"></div>
    </div>
    <?php $__env->startSection("contentscript"); ?>
        <script>
            function paid_order(orderId)
                {
                    var paid_status;
                    var check = document.getElementById("OrderStatus"+orderId).checked;
                    var type;
                    if(check)
                    {
                        paid_status = 1;
                        type="green";
                    }
                    else
                    {
                        paid_status = 0;
                        type="yellow";
                    }

                    $.get('/update-payment/'+ orderId + '/' + paid_status, function(data)
                    {
                    //success data
                    if(data == "success")
                    {
                        iziToast.show({
                            title: 'Success',
                            message: 'Payment Status has been updated',
                            color:type,
                            position: 'bottomRight',
                            transitionIn:'fadeInUp'
                        });
                    }
                    });
                }
        </script>
    <?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminfound', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>