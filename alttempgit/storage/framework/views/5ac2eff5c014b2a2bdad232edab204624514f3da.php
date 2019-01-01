<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/form-icons.css')); ?>">
    <link rel="icon" href="<?php echo e(asset('images/addUser.png')); ?>" />
    <title>Add User</title>
<?php $__env->startSection('content'); ?>


  <div class="grid-x padding_cell">
      <div class="cell small-1"></div> 
      <div class="cell small-1 ">  
      <a href="/eventfound/view" class="back-btn hvr-icon-back"><i class="fa fa-chevron-circle-left hvr-icon icon-back"></i> Back</a> 
    </div>
  </div>
  <div class="grid-x">
      <div class="cell small-1"></div> 
      <div class="cell small-10">
    <fieldset class="addUserFieldset">
        <legend class="addUserLegend">Add User</legend>
    <div class="cell small-11">
        <div class="loader2"></div>
    <form id="frmAddUser" method="POST" action="<?php echo e(route('user.add')); ?>" class="cssAddUser" data-abide> 
      <?php echo csrf_field(); ?>
      <div class="grid-x grid-margin-x">
        <div class="cell small-6">
  
        <div class="input-group  ">
          <span class="input-group-label">
            <i class="fa fa-user"></i>
          </span>
          <input class="input-group-field <?php echo e($errors->has('txtlname') ? ' is-invalid-input' : ''); ?>" name="txtlname" value="<?php echo e(old('txtlname')); ?>" type="text" placeholder="Last name">
        </div>
        <?php if($errors->has('txtlname')): ?>
          <span class="form-error is-visible"><?php echo e($errors->first('txtlname')); ?></span>
        <?php endif; ?>
  
        </div>
      
        <div class="cell small-6">
  
        <div class="input-group ">
          <span class="input-group-label">
            <i class="fa fa-user"></i>
          </span>
          <input class="input-group-field <?php echo e($errors->has('txtfname') ? ' is-invalid-input' : ''); ?>" name="txtfname" value="<?php echo e(old('txtfname')); ?>" type="text" placeholder="First name">
        </div>
        <?php if($errors->has('txtfname')): ?>
          <span class="form-error is-visible"><?php echo e($errors->first('txtfname')); ?></span>
        <?php endif; ?>
  
        </div>
      </div>
      
      <div class="grid-x grid-margin-x">
        <div class="cell small-6">
  
      <div class="input-group ">
        <span class="input-group-label">
          <i class="fa fa-user"></i>
        </span>
        <input class="input-group-field <?php echo e($errors->has('txtuname') ? ' is-invalid-input' : ''); ?>" name="txtuname" value="<?php echo e(old('txtuname')); ?>" type="text" placeholder="Username">
      </div>
      <?php if($errors->has('txtuname')): ?>
        <span class="form-error is-visible"><?php echo e($errors->first('txtuname')); ?></span>
      <?php endif; ?>
  
        </div>

        <div class="cell small-6">
  
      <div class="input-group">
        <span class="input-group-label">
          <i class="fa fa-envelope"></i>
        </span>
        <input class="input-group-field <?php echo e($errors->has('txtemail') ? ' is-invalid-input' : ''); ?>" name="txtemail" value="<?php echo e(old('txtemail')); ?>" type="text" placeholder="Email">
      </div>
      <?php if($errors->has('txtemail')): ?>
        <span class="form-error is-visible"><?php echo e($errors->first('txtemail')); ?></span>
      <?php endif; ?>
  
        </div>
      </div> 

      <div class="grid-x grid-margin-x">
        <div class="cell small-6">
  
        <div class="input-group">
            <span class="input-group-label">
              <i class="fa fa-phone"></i>
            </span>
            <input class="input-group-field <?php echo e($errors->has('txtcnum') ? ' is-invalid-input' : ''); ?>" name="txtcnum" value="<?php echo e(old('txtcnum')); ?>" type="tel" placeholder="Contact number" min="8" maxlength="8"  title="8 digits code only and starting with number '5'.">
        </div>
        <?php if($errors->has('txtcnum')): ?>
          <span class="form-error is-visible"><?php echo e($errors->first('txtcnum')); ?></span>
        <?php endif; ?>
  
        </div>

        <div class="cell small-6">
  
      <div class="input-group radioBtn" >
        <input type="radio" name="usertype" value="0" checked="checked" id="user" style="width: 3%;height: 2%;"><label for="user">User</label>
        <input type="radio" name="usertype" value="1" id="admin" style="width: 3%;height: 2%;"><label for="admin" >Admin</label>
      </div>
  
        </div>
      </div>
      <button class="button round expanded btnAdd btnAddUserAlert userform_btn">Add User</button>      
    </form>
  </div>

</fieldset>
</div>
<div class="cell small-1"></div>
</div>
      <?php $__env->startSection('contentscript'); ?>
        <?php if(session('alert')): ?>
        <script>
       $.alert({
              boxWidth: '30%',
              useBootstrap: false,
              backgroundDismiss: true,
              type: 'green',
              typeAnimated: true,
              title: 'Add User!',
              content: 'User was successfully added!',
              });
        </script>
      <?php endif; ?>
      <?php $__env->stopSection(); ?>
      
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.adminfound', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>