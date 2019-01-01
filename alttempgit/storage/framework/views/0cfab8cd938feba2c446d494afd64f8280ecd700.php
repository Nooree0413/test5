<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/form-icons.css')); ?>">
    <link rel="icon" href="<?php echo e(asset('images/edituserprofile.png')); ?>" />
    <title>Edit Profile</title>
</head>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.global', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>



<div class="grid-x grid-padding-y">
    <div class="cell small-1"></div>
    <div class="cell small-5"><a href="/eventfound/view" class="back-btn"><i class="fa fa-chevron-circle-left hvr-icon icon-back"></i>Back</a></div>
    <div class="cell small-5 hollow"></div>
</div>


    <form id="frmpro-user" method="POST" class="frm-profile" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="grid-x">
            <div class="cell small-1"></div>
                <h3>Edit Profile</h3>
            </div>
        <div class="grid-x">
            <div class="cell small-1"></div>
            <div class="cell small-4 tempborder">
                <div class="grid-x">
                    <div class="cell cell-space"></div>
                </div>
                
                    <img class="profileImage" src="<?php echo e(asset('images/'.$user_detail->img_path)); ?>" alt="User Profile Image">
                
                
                    <div class="cell small-4">
                        <div class="input-group-button upload-btn">
                            <label for="fpropic" data-tooltip tabindex="2" title="Upload Profile Picture" class="custom-file-uploadpro top" id="lblproimg">
                                <i class="fas fa-file-upload"></i>
                            </label>
                            <input  id="fpropic" onchange="changeInputField('.custom-file-uploadpro')" class="button" type="file" name="fpropic">
                        </div>
                    </div>
                
            </div>
            <div class="cell small-6 tempborder">
                <table class="hover tbldetails tbledituserdetails">
                    <tr>
                        <th>Last Name</th>
                        <td>
                            <input class="<?php echo e($errors->has('txtlname') ? ' is-invalid-input' : ''); ?>" type="text" name="txtlname" id="txtlname" value="<?php echo e($user_detail->lastname); ?>">
                            <?php if($errors->has('txtlname')): ?>
                                <span class="form-error is-visible"><?php echo e($errors->first('txtlname')); ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>First Name</th>
                        <td>
                            <input class="<?php echo e($errors->has('txtfname') ? ' is-invalid-input' : ''); ?>" type="text" name="txtfname" id="txtfname" value="<?php echo e($user_detail->firstname); ?>">
                            <?php if($errors->has('txtfname')): ?>
                                <span class="form-error is-visible"><?php echo e($errors->first('txtfname')); ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Contact Number</th>
                        <td>
                            <input class="<?php echo e($errors->has('txtcnum') ? ' is-invalid-input' : ''); ?>" type="text" name="txtcnum" id="txtcnum" value="<?php echo e($user_detail->contactnum); ?>">
                            <?php if($errors->has('txtcnum')): ?>
                                <span class="form-error is-visible"><?php echo e($errors->first('txtcnum')); ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>
                            <input class="<?php echo e($errors->has('txtuname') ? ' is-invalid-input' : ''); ?>" type="text" name="txtuname" id="txtuname" value="<?php echo e($user_detail->username); ?>">
                            <?php if($errors->has('txtuname')): ?>
                                <span class="form-error is-visible"><?php echo e($errors->first('txtuname')); ?></span>
                            <?php endif; ?>  
                        </td>
                    </tr>
                    <tr>
                        <th>E-mail</th>
                        <td>
                            <input class="<?php echo e($errors->has('txtemail') ? ' is-invalid-input' : ''); ?>" type="email" name="txtemail" id="txtemail" value="<?php echo e($user_detail->email); ?>">
                            <?php if($errors->has('txtemail')): ?>
                                <span class="form-error is-visible"><?php echo e($errors->first('txtemail')); ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Password</th>
                        <td class="link-top"><a data-open="changepassword" data-target="#changepassword">Change</a></td>  
                    </tr>
                </table>
            
                <input type="submit" id="btnsave-profile" name="btnsave-profile" class="button expanded userform_btn btnfocus" value="Save Changes" name="submit">
            
            </div>
        </div>
    </form>

    
    <div class="reveal chngemod" id="changepassword" tabindex="-1"  role="dialog" data-reveal>
        <div class="changepasswrdmodal-header">
            <h4 class="modal-title chngepasstitle" >Change Password</h4>
        </div>
        
            <form action="<?php echo e(route('users.passchg')); ?>" method="post"  class="form-body">
            
            <?php echo e(csrf_field()); ?>

                <input type="hidden" name="changepassword" id="changepassword" value="">
                <?php echo $__env->make('users.changepasswordmod_found', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>   
                <button class="close-button" data-close aria-label="Close modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
          </form>
        </div>
    

        <?php if($errors->has('txtpassword') || $errors->has('txtOldpassword') || session('alert')=='errChngPass'): ?>
            <script>
                var popup = new Foundation.Reveal($('#changepassword'));
                popup.open();
            </script>
        <?php endif; ?>

        
    <?php if(session('alert')=='editUserSuccess'): ?>
    <?php        
        $title="User Details";
        $message="have been updated.";
        $type='success';
        alertSuccess($title, $message, $type);
    ?>
    <?php endif; ?>
    <?php $__env->startSection('contentscript'); ?>
    
        <script>
            function changeInputField(btn)
            {
                $(btn).css("background-color", "#6BA34D");
            }
        </script>
    
    
        <?php if($errors->has('fpropic')): ?>
        <script>
            $.alert({
                title: 'Errors',
                icon: 'fas fa-exclamation',
                type: 'orange',
                boxWidth: '30%',
                useBootstrap: false,
                backgroundDismiss: true,
                content: '<b><?php echo e($errors->first('fpropic')); ?></b> Retry!' +
                '<hr>',
            });
        </script> 
        <?php endif; ?>
    
    <?php $__env->stopSection(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.userfound', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>