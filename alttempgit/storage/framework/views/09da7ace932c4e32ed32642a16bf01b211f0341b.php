

  <div class="input-group spaceInBetween">
    <span class="input-group-label oldpass">
      <i class="fa fa-key"></i>
    </span>
    <input class="input-group-field <?php echo e($errors->has('txtOldpassword') ? ' is-invalid-input' : ''); ?>" type="password" placeholder="Old Password" id="txtOldpassword" name="txtOldpassword">
  </div>
 
  <?php if($errors->has('txtOldpassword')): ?>
    <span class="form-error is-visible spaceInBetween2"><?php echo e($errors->first('txtOldpassword')); ?></span>
  <?php endif; ?>


                  
  <div class="input-group spaceInBetween ">
    <span class="input-group-label">
      <i class="fa fa-key"></i>
    </span>
    <input class="input-group-field <?php echo e($errors->has('txtpassword') ? ' is-invalid-input' : ''); ?>" type="password" placeholder="New Password" id="txtpassword" name="txtpassword">
  </div>
  
  <?php if($errors->has('txtpassword')): ?>
  <span class="form-error is-visible spaceInBetween2"><?php echo e($errors->first('txtpassword')); ?></span>
  <?php endif; ?>
  <?php if(session('alert')=='errChngPass'): ?>
    <span class="form-error is-visible spaceInBetween2">Please use a new password</span>
  <?php endif; ?>


  
  <div class="input-group spaceInBetween" >
      <span class="input-group-label">
        <i class=" fa fa-key"></i>
      </span>
    
      <input class="input-group-field" <?php echo e($errors->has('txtpassword-confirm') ? ' is-invalid-input' : ''); ?> type="password" placeholder="Confirm Password" id="txtpassword_confirmation"  name="txtpassword_confirmation">
  </div>


  <div class="modbtncontainer spaceInBetween spacecontainer">
    <button class="button expanded modbtn" type="submit">Change Password</button>
    <a href="#" data-close class="button expanded modbtn"><span> Back</span></a>
  </div>



  
