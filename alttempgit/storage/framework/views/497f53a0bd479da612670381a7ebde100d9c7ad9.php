    <?php $__env->startSection("contentcss"); ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/multi-select.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/show_found.css')); ?>">
        <link rel="icon" href="<?php echo e(asset('images/show_menu.png')); ?>" />
        <title>
            Menu
        </title>
    <?php $__env->stopSection(); ?>
<?php $__env->startSection("content"); ?> 
    <div class="grid-x grid-padding-y">
        <div class="cell small-1"></div>
        <div class="cell small-5"><a href="/eventfound/show/<?php echo e($get_event[0]->id); ?>" class="back-btn hvr-icon-back"><i class="fa fa-chevron-circle-left hvr-icon icon-back"></i> Back</a></div>
        <div class="cell small-5 hollow"><a href="#" name="btnAddItem" id="btnAddItem" class="back-btn hvr-icon-push"><i class="fas fa-plus icon-add-menu hvr-icon"></i> Add Item</a></div>
    </div>
    <div class="grid-x">
        <div class="cell cell-title">
            <h3>Menu for <?php echo e($get_event[0]->name); ?></h3>
        </div>
    </div>
<div class="grid-x">
    <div class="cell small-1"></div>
    <div class="cell small-10">
        <table id="tblEventMenu" class="table table-striped nowrap">
            <thead>
                <tr>
                    <th>
                        Item Name
                    </th>
                    <th>
                        Item Price (MUR)
                    </th>
                    <th>
                    
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $get_menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $get_menu_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <?php echo e($get_menu_item->item_name); ?>                         
                    </td>
                    <td>
                        <?php echo e($get_menu_item->item_price); ?>    
                    </td>
                    <td>
                    <a href="/delete/menu/<?php echo e($get_event[0]->id); ?>/<?php echo e($get_menu_item->id); ?>" class="del-item"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
        <div class="reveal" id="additemmod" data-reveal>
            <div class="grid-x">
                <div class="cell">
                    <h3>Select Items</h3>
                </div>
            </div>
                <div class="grid-x item-menu">
                    <div class="cell small-2"></div>
                    <div class="cell small-8">
                        <form action="" method="POST">
                            <?php echo csrf_field(); ?>
                            <select multiple="multiple" id="menu-select" name="menu-select[]">
                                <?php $__currentLoopData = $item_remained; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>"><?php echo e($item->item_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <div class="grid-x">
                                <div class="cell btnadditem-div">
                                    <button id="btnaddMenu" data-close type="submit" name="btnaddMenu" class="button hvr-icon-push"><i class="fas fa-plus hvr-icon"></i> Save to Event</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <button class="close-button" data-close aria-label="Close modal" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    <?php echo $__env->make('layouts.global', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php if(session('alert')=='deleteItemSuccess'): ?>
        <?php
            $title="Item";
            $message="has been deleted.";
            $type='success';
            alertSuccess($title, $message, $type);
        ?>
    <?php endif; ?>

     <?php if(session('alert')=='NewItemAdded'): ?>
        <?php
            $title="Items";
            $message="have been added.";
            $type='success';
            alertSuccess($title, $message, $type);
        ?>
    <?php endif; ?>
    
    <?php $__env->startSection("contentscript"); ?>
        <script>
            $(document).ready(function()
            {
                $('#menu-select').multiSelect();
            });
            $("#btnAddItem").on("click", function()
            {
               var popup = new Foundation.Reveal($('#additemmod'));
               popup.open();
            });
            $('#additemmod').on('closed.zf.reveal', function () {
                console.log("close");
            });
        </script>
       <script src="<?php echo e(asset('js/jquery.multi-select.js')); ?>"></script>
    <?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.adminfound", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>