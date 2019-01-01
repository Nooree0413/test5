<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/form-icons.css')); ?>">   
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/font-awesome.min.css')); ?>">  
    <link rel="icon" href="<?php echo e(asset('images/edituserprofile.png')); ?>" />
    <title>Edit Profile</title>
</head>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('layouts.global', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <div class="grid-x padding_cell">
        <div class="cell small-1"></div>
        <div class="cell small-1 ">            
            <a href="/usersfound/view" class="back-btn hvr-icon-back"><i class="fa fa-chevron-circle-left hvr-icon icon-back"></i> Back</a>           
        </div>
        
    </div>
    <form id="frmpro" method="POST" action="<?php echo e(route('user.editProfile')); ?>" class="frm-profile" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="grid-x cell-editprofilespace">
            <div class="cell small-1"></div>
                <h3>Edit Profile</h3>
            </div>
        <div class="grid-x">
            <div class="cell small-1"></div>
            <div class="cell small-3 tempborder temp">
                
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
            <div class="cell small-7 tempborder">
                <table class="hover tbldetails tbledituserdetails">
                    <tr>
                        <th>Last Name</th>
                        <td><input type="text" class="<?php echo e($errors->has('txtlname') ? ' is-invalid-input' : ''); ?>" name="txtlname" id="txtlname" value="<?php echo e($user_detail->lastname); ?>">
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
                </table>

            
                <div class="grid-x">
                    <div class="cell small-5"></div>
                    <div class="cell small-7">
                        <input type="submit" id="btnsave-profile" name="btnsave-profile" class="button expanded" value="Save Changes" name="submit">
                    </div>
                </div>
            
            </div>
        </div>    
    </form>
</div>
<div class="cell small-1"></div>
</div>
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
<?php echo $__env->make('layouts.adminfound', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>