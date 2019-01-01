<?php $__env->startSection('contentcss'); ?>
    <!-- Additional Page CSS -->
        <link rel="stylesheet" href="<?php echo e(asset('css/editUser.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/show_found.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/found.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/responsive-tables.css')); ?>">
    <!-- /Additional Page CSS -->

    
        <link rel="icon" href="<?php echo e(asset('images/users.png')); ?>" />
    

    
        <title>View Users</title>
    

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
            <div class="cell small-10">
        <div class="table-container">
            <h4 class="datatableTitleUsers">Users</h4>
            <table id="tbluser" class=" table table-striped nowrap">
                <thead>
                    <tr>
                        <th>
                            Full Name
                        </th> 
                        <th>
                            Email-Address
                        </th> 
                        <th>
                            Contact Number
                        </th> 
                        <th>
                            
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr >
                        <td>    
                            <?php echo e($user->firstname); ?> <?php echo e($user->lastname); ?>

                        </td>
                        <td>
                            <?php echo e($user->email); ?>

                        </td>
                        <td>
                            <?php echo e($user->contactnum); ?>

                        </td>
                        <td>
                            
                                <a href="/usersfound/show/<?php echo e($user->id); ?>">
                                    <span data-tooltip tabindex="1" style="border-bottom:none" title="show">
                                        <i class="far fa-eye font-color"></i>
                                    </span>
                                </a> 
                            
                            &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
                            
                                <a class="editbtn" data-open="editusermod" data-mycontactnum="<?php echo e($user->contactnum); ?>" data-myfirstname="<?php echo e($user->firstname); ?>" data-mylastname="<?php echo e($user->lastname); ?>" data-myemail="<?php echo e($user->email); ?>" data-userid="<?php echo e($user->id); ?>" data-target="#editusermod">
                                    <span style="border-bottom:none" data-tooltip tabindex="1" title="Edit">
                                        <i class="fas fa-pencil-alt font-color"></i> 
                                    </span>
                                </a>
                            
                            &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
                            
                            
                                <?php if($user->id== Auth::id()): ?> 
                                    <a class="btndelevent not-active-link disabled" href="/usersfound/delete/<?php echo e($user->id); ?>">
                                        <span style="border-bottom:none" data-tooltip tabindex="1" title="Delete">
                                            <i class="fas fa-trash-alt font-color"></i>
                                        </span>
                                    </a>
                                <?php else: ?>
                                    <a class="btndelevent" href="/usersfound/delete/<?php echo e($user->id); ?>">
                                        <span style="border-bottom:none" data-tooltip tabindex="1" title="Delete">
                                            <i class="fas fa-trash-alt font-color"></i>
                                        </span>
                                    </a>
                                <?php endif; ?>
                            
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="cell small-1"></div>
    </div>
    

<!-- modal for edit user -->
    <div class="reveal" id="editusermod" data-reveal>
    <!-- modal-head  -->
        <div class="modalheader">
            <div class="group-title">
                <h4 class="subheader">User Edit</h4>
            </div>
            <button class="close-button" data-close aria-label="Close modal" type="button">
                    <span aria-hidden="true">&times;</span>
            </button>
        </div >
    <!-- /modal-head  -->
    <!-- modal-content  -->
        <form action="<?php echo e(route('users.update', 'home')); ?>" method="post">
            <?php echo e(method_field('patch')); ?>

            <?php echo e(csrf_field()); ?>

            <div class="modal-body">
            <input type="hidden" name="userid" id="userid" value="">
                <?php echo $__env->make('users.editform_found', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <button type="submit" class="button expanded savechangebtn">Save</button>
            </div>        
        </form>
           
    <!-- modal-content  -->
    </div>
<!-- /modal for edit user -->

<?php $__env->startSection('contentscript'); ?>
    <script>
        $(".btndelevent").on("click", {msg:'Do you want to delete this User?', title:'Warning'}, confirmMsg);
    </script>

<script>
$('.editbtn').on('click', function (event) {
    var fname = $(this).attr("data-myfirstname");
    var lname = $(this).attr("data-mylastname");
    var email = $(this).attr("data-myemail");
    var cnum = $(this).attr("data-mycontactnum");
    var userid = $(this).attr("data-userid");

    $('#firstname').val(fname);
    $('#email').val(email);
    $('#lastname').val(lname);
    $('#contactnum').val(cnum);
    $('#userid').val(userid);
});
</script>

<?php if($errors->has('firstname') || $errors->has('email') || $errors->has('lastname') || $errors->has('contactnum')): ?>
<script>
     var popup = new Foundation.Reveal($('#editusermod'));
    popup.open();
</script>
<?php endif; ?>

<?php echo $__env->make('layouts.global', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php if(session('alert')=='addUserSuccess'): ?>
    <?php
        $title=session('UserName');
        $message="has been added.";
        $type='success';
        alertSuccess($title, $message, $type);
    ?>
<?php elseif(session('alert')=='deleteUserSuccess'): ?>
    <?php
        $title=session('UserName');
        $message="has been deleted.";
        $type='success';
        alertSuccess($title, $message, $type);
    ?>
<?php elseif(session('alert')=='editUserSuccess'): ?>
    <?php        
        $title=session('UserName');
        $message="has been updated.";
        $type='success';
        alertSuccess($title, $message, $type);
    ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminfound', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>