<?php echo $__env->make('layouts.global', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
        <link rel="icon" href="<?php echo e(asset('images/configurations.png')); ?>" />
    
    
        <link rel="stylesheet" href="<?php echo e(asset('css/show_found.css')); ?>">
    
    
        <title>Configurations</title>
    
<?php $__env->startSection('content'); ?>
    <div class="grid-x padding_cell">
        <div class="cell small-1"></div>
        <div class="cell small-1 ">
            <a class="back-btn hvr-icon-pulse" href="/admin/dashboard"><i class="fa fa-home hvr-icon"></i> Home</a>
        </div>
    </div>
    <div class="grid-x">
        <div class="cell small-1"></div>
    <div class="cell small-10">
        <div class="tabwrapper">
            <ul class="tabs" data-active-collapse="true" data-tabs id="collapsing-tabs">
                <li class="tabs-title"><a href="#panel1c">Item</a></li>
                
                <li class="tabs-title"><a href="#panel3c">Type</a></li>
            </ul>
        <div class="tabs-content" data-tabs-content="collapsing-tabs">
        
            <div class="tabs-panel  <?php echo e($errors->has('txtitem') ? ' is-active' : ''); ?>" id="panel1c">
                <form method="post" action="<?php echo e(route('webconf.addItem')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="grid-x  grid-margin-x">
                        <div class="cell small-6">
                            <input type="text" name="txtitem" id="txtitem" placeholder="Item Name...">
                        </div>
                        <div class="cell small-6">
                            <input type="text" name="txtitemprice" id="txtitemprice" placeholder="Item Price...">
                        </div>
                        <div class="cell">
                            <textarea class="itemtxtarea" rows="4" cols="70" name="txtitemdesc" type="text" placeholder="Add a description of the item to be added."></textarea>
                        </div>
                        <div class="cell">
                            <button class="button expanded userform_btn btnfocus ">Add Item</button>
                        </div>
                    </div>  
                </form>
            <div class="table-container">
                <table id="tblevent" class=" table table-striped nowrap">
                    <thead>
                        <tr>
                            <th>
                            Name 
                            </th> 
                            <th>
                                Price
                            </th> 
                            <th>
                            Description
                            </th> 
                            <th>
                                Actions 
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>    
                                <?php echo e($item->item_name); ?> 
                            </td>
                            <td>
                                <?php echo e($item->item_price); ?>

                            </td>
                            <td>
                                <?php echo e($item->item_description); ?>

                            </td>
                            <td>
                                <a class="edititem" data-open="edititemmod" data-target="#edititemmod" data-myitemid="<?php echo e($item->id); ?>" data-myitemprice="<?php echo e($item->item_price); ?>" data-myitemname="<?php echo e($item->item_name); ?>" data-myitemdesc="<?php echo e($item->item_description); ?>"data-tooltip tabindex="1" title="Edit">
                                <span>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <i  class="fas fa-pencil-alt"></i>
                                </span>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                </a>|                        
                                <a href="/webconf/item/delete/<?php echo e($item->id); ?>" class=" deltitem"><span data-tooltip tabindex="1" title="Delete">
                                    <span>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <i class="fas fa-trash-alt"></i>
                                    </span>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            </div>
        
        
        
            
        

        
            <div class="tabs-panel <?php echo e($errors->has('txttype') ? ' is-active' : ''); ?>" id="panel3c">
                <form id="frmtype" action="<?php echo e(route('webconf.addEventType')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="grid-x grid-margin-x">
                        <div class="cell small-4">
                            <input type="text" name="txttype" id="txttype" placeholder="Type..">
                        </div>
                        <div class="cell small-4 check-box-status">
                            <input type="checkbox" name="orderStatus" id="orderStatus" value="1"><label for="orderStaus"> Confirm Order</label>
                        </div>
                        <div class="cell small-4">
                            <input type="submit" value="Add Type" id="btnaddtype" name="btnaddtype" class="button expanded userform_btn btnfocus">
                        </div>
                    </div>
                </form>
                <div class="grid-x">
                    <div class="cell small-12">
                        <div class="table-container">
                            <table id="tbltype" class="table table-striped nowrap">
                                <thead>
                                    <tr>
                                        <th>
                                            Type
                                        </th> 
                                        <th>
                                            Actions 
                                        </th>
                                        <th>
                                            <span data-tooltip class="top" tabindex="1" title="Status of order">Status</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                        <tr>
                                            <td>
                                                <?php echo e($type->type); ?>

                                            </td>
                                            <td>
                                            <a data-tooltip tabindex="1" title="Edit" class="edittype" data-open="editTypeMod" data-mytypeid="<?php echo e($type->id); ?>"  data-mytypename="<?php echo e($type->type); ?>" data-orderStatus="<?php echo e($type->order_status); ?>" data-target="#editTypeMod">
                                                    <span>
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </span>
                                                &nbsp;&nbsp;
                                                </a>
                                                |&nbsp;&nbsp;                        
                                                <a href="/webconft/<?php echo e($type->id); ?>"  class="btndeltype" data-target="#delete1">
                                                    <span data-tooltip tabindex="1" title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </span>
                                                </a>
                                            </td>
                                            <td>
                                                <?php if($type->order_status==1): ?>
                                                    Yes
                                                <?php else: ?>
                                                    No
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
    </div>
    <div class="cell small-1"></div>
    </div>
    
    <div class="reveal" id="editstatusmod" data-reveal>
        <!-- modal-head  -->
            <div class="modalheader">
                <div class="group-title">
                    <h4 class="subheader">Edit Status</h4>
                </div>
                    <button class="close-button" data-close aria-label="Close modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form action="<?php echo e(route('webconf.statusupdate', 'home')); ?>" method="post">
                <?php echo e(csrf_field()); ?>

                <div class="modal-body">
                <input type="hidden" name="statusid" id="statusid" value="">
                <input type="text" name="txtStatus" id="txtStatus">
                    <div class="modal-footer">
                        <button type="submit" class="button expanded savechangebtn">Save</button>
                    </div>
                </div>        
            </form>
        </div>
    

        <!-- modal for edit item -->
        <div class="reveal" id="edititemmod" data-reveal>
            <!-- modal-head  -->
                <div class="modalheader">
                    <div class="group-title">
                        <h4 class="subheader">Edit item</h4>
                    </div>
                    <button class="close-button" data-close aria-label="Close modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('webconf.itemupdate', 'home')); ?>" method="post">
                        <?php echo e(csrf_field()); ?>

                        <div class="modal-body">
                        <input type="hidden" name="itemid" id="itemid" value="">
                        <label> Item Name</label>
                        <input type="text"  name="txtItem" id="txtItem">
                        <input type="text" name="txtItemPrice" id="txtItemPrice">
                        <label> Item Description</label>
                        <textarea class="itemtxtarea" rows="4" cols="70" name="txtItemDesc" id="txtItemDesc" type="text" ></textarea>
                            <div class="modal-footer">
                                <button type="submit" class="button expanded savechangebtn">Save</button>
                            </div>
                        </div>        
                </form>
        </div>
        <!-- modal for edit Type -->
     <div class="reveal" id="editTypeMod" data-reveal>
            <!-- modal-head  -->
            <div class="modalheader">          
                <div class="group-title">
                    <h4 class="subheader">Edit Type</h4>
                </div>
                <button class="close-button" data-close aria-label="Close modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div >
            <form action="<?php echo e(route('webconf.typeupdate', 'home')); ?>"  method="post">
                <?php echo e(csrf_field()); ?>

                <div class="modal-body">
                    <div class="grid-x  grid-margin-x">
                        <div class="cell small-6">
                            <input type="hidden" name="typeid" id="typeid" value="">
                            <input type="text" name="txtType" id="txtType">
                        </div>
                        <div class="cell small-6 check-box">
                        <input type="checkbox" name="orderStatus2" id="orderStatus2" value="1"><label for="orderStaus"> Confirm Order</label>
                        </div>
                    </div>
                        <div class="cell small-6">
                            <button type="submit" class="button expanded savechangebtn">Save</button>
                       </div>  
                    </form>        
                </div>        
<?php $__env->startSection('contentscript'); ?>

<script>
    $(".btndelevent").on("click", {msg:'Do you want to delete this Status?', title:'Warning'}, confirmMsg);

    $('.edit1type').on('click', function (event) {                                                                
        var statusname = $(this).attr("data-mystatusname");
        var statusid = $(this).attr("data-mystatusid");
        $('#txtStatus').val(statusname);
        $('#statusid').val(statusid);
    });

    $('.edititem').on('click', function (event) {
        var itemname = $(this).attr("data-myitemname");
        var itemdesc = $(this).attr("data-myitemdesc");
        var itemprice = $(this).attr("data-myitemprice");
        var itemid = $(this).attr("data-myitemid");
            
        $('#txtItem').val(itemname);
        $('#txtItemPrice').val(itemprice);
        $('#txtItemDesc').val(itemdesc);
        $('#itemid').val(itemid);
    });
</script>

<?php if($errors->has('txtitem')): ?>
<script>
        $.alert({
            title: 'Errors',
            icon: 'fas fa-exclamation',
            boxWidth: '30%',
            type:'dark',
            useBootstrap: false,
            content: '<b><?php echo e($errors->first('txtitem')); ?></b> Retry!' +
            '<hr>',
            });
</script>
<?php endif; ?>
<?php if($errors->has('txtitemdesc')): ?>
<script>
        $.alert({
            title: 'Errors',
            icon: 'fas fa-exclamation',
            boxWidth: '30%',
            type:'dark',
            useBootstrap: false,
            content: '<b><?php echo e($errors->first('txtitemdesc')); ?></b> Retry!' +
            '<hr>',
            });
</script>
<?php endif; ?>
<?php if($errors->has('txtitemprice')): ?>
<script>
    $.alert({
        title: 'Errors',
        icon: 'fas fa-exclamation',
        boxWidth: '30%',
        type:'dark',
        useBootstrap: false,
        content: '<b><?php echo e($errors->first('txtitemprice')); ?></b> Retry!' +
        '<hr>',
        });
</script>
<?php endif; ?>
<?php if($errors->has('txtItem')): ?>
<script>
        $.alert({
            title: 'Errors',
            icon: 'fas fa-exclamation',
            boxWidth: '30%',
            type:'dark',
            useBootstrap: false,
            content: '<b><?php echo e($errors->first('txtItem')); ?></b> Retry!' +
            '<hr>',
            });
</script>
<?php endif; ?>
<?php if($errors->has('txtItemDesc')): ?>
<script>
        $.alert({
            title: 'Errors',
            icon: 'fas fa-exclamation',
            boxWidth: '30%',
            type:'dark',
            useBootstrap: false,
            content: '<b><?php echo e($errors->first('txtItemDesc')); ?></b> Retry!' +
            '<hr>',
            });
</script>
<?php endif; ?>
<?php if($errors->has('txtItemPrice')): ?>
<script>
    $.alert({
        title: 'Errors',
        icon: 'fas fa-exclamation',
        boxWidth: '30%',
        type:'dark',
        useBootstrap: false,
        content: '<b><?php echo e($errors->first('txtItemPrice')); ?></b> Retry!' +
        '<hr>',
        });
</script>
<?php endif; ?>

<?php if($errors->has('txtstatus')): ?>
<script>
        $.alert({
            title: 'Errors',
            icon: 'fas fa-exclamation',
            boxWidth: '30%',
            type:'dark',
            useBootstrap: false,
            content: '<b><?php echo e($errors->first('txtstatus')); ?></b> Retry!' +
            '<hr>',
            });
</script>
<?php endif; ?>


<script>
        $(".deltitem").on("click", {msg:'Delete Item?', title:'Warning'}, confirmMsg);
       
    </script>
    <?php if(session('alert')=='editEventSuccess'): ?>
    <?php        
        $title='Item';
        $message=" has been updated.";
        $type='success';
        alertSuccess($title, $message, $type);
    ?>
    <?php elseif(session('alert')=='deleteUserSuccess'): ?>
    <?php
        $title='Item';
        $message="has been deleted.";
        $type='success';
        alertSuccess($title, $message, $type);
    ?>
    <?php elseif(session('alert')=='addUserSuccess'): ?>
    <?php
        $title='Item';
        $message="has been added.";
        $type='success';
        alertSuccess($title, $message, $type);
    ?>

<?php endif; ?>

  <style>
    .tempcolor
    {
        border:1px solid black;
    }
    #frmtype span
    {
        padding-left:0%;
    }
  </style>

    
        <script>
            $('.edittype').on('click', function (event) {
                var typeid = $(this).attr("data-mytypeid");
                var typename = $(this).attr("data-mytypename");
                var orderStatus = $(this).attr("data-orderStatus");
                $('#typeid').val(typeid);
                $('#txtType').val(typename);

                if(orderStatus == '1')
                {
                    $('#orderStatus2').prop('checked', true);
                }
                else
                {
                    $('#orderStatus2').prop('checked', false);
                }
                
            });
        </script>
        <script>
            $(".btndeltype").on("click", {msg:'Do you want to delete this Type?', title:'Warning'}, confirmMsg);
        </script> 
        
                
        <?php if($errors->has('txtType')): ?>
        <script>
            $.alert({
                title: 'Errors',
                icon: 'fas fa-exclamation',
                boxWidth: '30%',
                type:'dark',
                useBootstrap: false,
                content: '<b><?php echo e($errors->first('txtType')); ?></b> Retry!' +
                '<hr>',
                });
        </script>
        <?php endif; ?>
                
        <?php if($errors->has('txttype')): ?>
        <script>
            $.alert({
                title: 'Errors',
                icon: 'fas fa-exclamation',
                boxWidth: '30%',
                type:'dark',
                useBootstrap: false,
                content: '<b><?php echo e($errors->first('txttype')); ?></b> Retry!' +
                '<hr>',
                });
        </script>
        <?php endif; ?>

<?php if($errors->has('id') || $errors->has('status') ): ?>
<script>
     var popup = new Foundation.Reveal($('#editstatusmod'));
    popup.open();
</script>
<?php endif; ?>
<?php if(session('alert')=='editStatusSuccess'): ?>
    <?php
        $title='Status';
        $message=" has been updated.";
        $type='success';
        alertSuccess($title, $message, $type);
    ?>
<?php elseif(session('alert')=='deleteStatusSuccess'): ?>
<?php
    $title='Status';
    $message=" has been deleted.";
    $type='success';
    alertSuccess($title, $message, $type);
?>
<?php elseif(session('alert')=='addStatusSuccess'): ?>
<?php
    $title='Status';
    $message="has been added.";
    $type='success';
    alertSuccess($title, $message, $type);
?>
<?php endif; ?>

 <?php if(session('alert')=='editTypeSuccess'): ?>
    <?php        
        $title='Type';
        $message=" has been updated.";
        $type='success';
        alertSuccess($title, $message, $type);
    ?>
<?php elseif(session('alert')=='deleteTypeSuccess'): ?>
    <?php
        $title='Type';
        $message="has been deleted.";
        $type='success';
        alertSuccess($title, $message, $type);
    ?>
<?php elseif(session('alert')=='addTypeSuccess'): ?>
    <?php
        $title='Type';
        $message="has been added.";
        $type='success';
        alertSuccess($title, $message, $type);
    ?>
<?php endif; ?>      
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
  


<?php echo $__env->make('layouts.adminfound', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>