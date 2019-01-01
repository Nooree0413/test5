<?php $__env->startSection("content"); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/multi-select.css')); ?>">

<select multiple="multiple" id="my-select" name="my-select[]">
    <option  value='elem_1'>Pizza  </option>
    <option value='elem_2'>Mine bouille </option>
    <option value='elem_3'>Riz Frite</option>
    <option value='elem_4'>Macaroni </option>
    <option value='elem_100'>Pasta</option>
  </select>
 
  
  
<script src="<?php echo e(asset('js/jquery.multi-select.js')); ?>"></script>
<script>
    $('#my-select').multiSelect({
  selectableHeader: "<div class='custom-header'><u><b>Menu Card</u></b></div>",
  selectionHeader: "<div class='custom-header'><b><u>Selected Menu</u></b></div>",
//   selectableFooter: "<div class='custom-header'></div>",
  selectionFooter: "<div class='custom-header'>Total Price:</div>"
});
    $('#my-select').multiSelect()
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.adminfound", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>