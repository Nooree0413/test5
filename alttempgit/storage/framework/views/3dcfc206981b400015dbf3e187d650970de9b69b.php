<!--  First name label and input -->
<div class="row <?php echo e($errors->has('firstname') ? ' has-error' : ''); ?>">
  <div class="small-8 columns">
    <label for="firstname">First Name
      <input type="text" placeholder="First Name" name="firstname" id="firstname" value="<?php echo e(old('firstname')); ?>"/>
    </label>
  </div>
</div>
<?php if($errors->has('firstname')): ?>
        <span class="form-error is-visible"><?php echo e($errors->first('firstname')); ?></span>
        <?php endif; ?>
<!--  Last name label and input -->
<div class="row <?php echo e($errors->has('lastname') ? ' has-error' : ''); ?>">
  <div class="large-12 columns">
    <label for="lastname">Last Name
      <input type="text" placeholder="Last Name" name="lastname" value="<?php echo e(old('lastname')); ?>" id="lastname" />
    </label>
  </div>
</div>
<?php if($errors->has('lastname')): ?>
        <span class="form-error is-visible"><?php echo e($errors->first('lastname')); ?></span>
        <?php endif; ?>

<!--  Email label and input -->
<div class="row <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
  <div class="large-12 columns">
    <label for="email">Email
      <input type="text" placeholder="email@email.com"  name="email" value="<?php echo e(old('email')); ?>" id="email" />
    </label>
  </div>
</div>
<?php if($errors->has('email')): ?>
        <span class="form-error is-visible"><?php echo e($errors->first('email')); ?></span>
        <?php endif; ?>

<!--  contact Number label and input -->
<div class="row <?php echo e($errors->has('contactnum') ? ' has-error' : ''); ?>">
  <div class="large-12 columns">
    <label for="contactnum">Contact Number
      <input placeholder="xxxx-xxxx" value="<?php echo e(old('contactnum')); ?>" id="contactnum" type="tel"  name="contactnum" maxlength="8" />
    </label>
  </div>
</div>
<?php if($errors->has('contactnum')): ?>
<span class="form-error is-visible"><?php echo e($errors->first('contactnum')); ?></span>
<?php endif; ?>
