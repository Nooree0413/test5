<?php $__env->startSection('contentcss'); ?>
    <!-- Additional Page CSS -->
        <link rel="stylesheet" href="<?php echo e(asset('css/editUser.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/show_found.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/found.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('css/responsive-tables.css')); ?>">
    <!-- /Additional Page CSS -->
  <link rel="icon" href="<?php echo e(asset('images/userDetails.png')); ?>" />
  <title>User Details</title>
<?php $__env->startSection('content'); ?>
    <div class="grid-x grid-padding-y">
            <div class="cell small-1"></div>
            <div class="cell small-5"><a href="/usersfound/view" class="back-btn hvr-icon-back"><i class="fa fa-chevron-circle-left hvr-icon icon-back"></i>Back</a></div>
            <div class="cell small-5 hollow"><a  class="back-btn editbtn hvr-icon-buzz-out" data-open="editusermod"  data-mycontactnum="<?php echo e($users->contactnum); ?>" data-myfirstname="<?php echo e($users->firstname); ?>" data-mylastname="<?php echo e($users->lastname); ?>" data-myemail="<?php echo e($users->email); ?>" data-userid="<?php echo e($users->id); ?>" data-target="#editusermod"><i class="fas fa-marker icon-edit hvr-icon"></i>Edit</a></div>
        </div>

    <div class="wrapperProfile">
    <div class="grid-x "style="padding: 4% 0% 0% 0%;">
            
            <div class="cell small-1 "></div>
            <div class="cell small-10 username lblusergridtitle"><h3><b><?php echo e($users->lastname); ?>&nbsp;<?php echo e($users->firstname); ?></b></h3></div>
            <div class="cell small-1 "></div>
        </div>
    <div class="grid-x">
        <div class="cell small-1 "></div>
            <div class="cell small-4 lblusercell4 ">                
                <img class="profilePic" src="<?php echo e(asset('images/'.$users->img_path)); ?>"  alt="Avatar" >                         
            </div>
            <div class="cell small-3  alignment lblusercell3_detail1">                   
                <div >
                        <div>
                           Username:<br>
                           First Name:<br>
                           Last Name:<br>
                           Role:</br>
                           Email:</br> 
                           Contact Number:<br>
                        </div> 
                  </div>
            </div>
            <div class="cell small-3 lblusercell_detail2 ">
                <div class="thirdshowdiv">
                        <div class="datafield">
                        
                            &nbsp;<?php echo e($users->username); ?><br>
                            &nbsp;<?php echo e($users->firstname); ?><br>
                            &nbsp;<?php echo e($users->lastname); ?><br>
                            <?php if($users->admin==1): ?>
                            &nbsp;Administrator<br>
                                <?php else: ?>
                                &nbsp;User<br>
                                <?php endif; ?>
                                &nbsp;<?php echo e($users->email); ?><br>
                                &nbsp;<?php echo e($users->contactnum); ?><br>
                        </div>
                    </div>
            </div>
        <div class="cell small-1 "></div>
        <!-- modal edit -->
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
                    <form action="<?php echo e(route('users.update', 'home')); ?>" method="post">
                                <?php echo e(method_field('patch')); ?>

                                <?php echo e(csrf_field()); ?>

                            <div class="modal-body">
                            <input type="hidden" name="userid" id="userid" value="">
                                <?php echo $__env->make('users.editform_found', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <button type="submit" class="button expanded savechangebtn">Save</button>
                            </div>        
                    </form>
        </div>
    </div>
</div>
<?php $__env->startSection('contentscript'); ?>
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
            <?php if(session('alert')=='editUserSuccess'): ?>
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