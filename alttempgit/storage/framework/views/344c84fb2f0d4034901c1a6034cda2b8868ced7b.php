<?php $__env->startSection("contentcss"); ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/form-icons.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/multi-select.css')); ?>">
    <link rel="icon" href="<?php echo e(asset('images/addEvent.png')); ?>" />
    

    <title>Add Event</title>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="grid-x padding_cell">
        <div class="cell small-1"></div> 
        <div class="cell small-1 space-cell"> 
            <a href="/eventfound/view" class="back-btn hvr-icon-back"><i class="fa fa-chevron-circle-left hvr-icon icon-back"></i> Back</a>
        </div>
    </div>
    <div class="grid-x">
        <div class="cell small-1"></div> 
        <div class="cell small-10">
        <fieldset class="addEventFieldset">
    <legend class="addEventLegend">Add Event</legend>

    <div class="cell small-11 eventFormContainer">
    <form method="POST" action="<?php echo e(route('user.addEvent')); ?>" enctype="multipart/form-data" class="cssAddEvent" data-abide autocomplete="off"> 
      <?php echo csrf_field(); ?>
        
                <div class="input-group">
                    <span class="input-group-label">
                    <i class="fa fa-bookmark"></i>
                    </span>
                    <input class="input-group-field <?php echo e($errors->has('txtename') ? ' is-invalid-input' : ''); ?>" name="txtename" value="<?php echo e(old('txtename')); ?>" type="text" placeholder="Event name" >
            
                    <div class="input-group-button">
                        <label for="image_path" data-tooltip tabindex="2" title="Add an Event Image" class="custom-file-upload top" id="lblimg">
                            <i class="fa fa-image"></i>
                        </label>
                        <input  id="image_path" onchange="changeInputField()"class="button" type="file" name="image_path" >
                    </div>
                </div>
            
            <?php if($errors->has('txtename')): ?>
                <span class="form-error is-visible"><?php echo e($errors->first('txtename')); ?></span>
            <?php endif; ?>
        
           
        
            <div class="input-group">
                <span class="input-group-label">
                <i class="fa fa-book"></i>
            </span>
                <textarea class="input-group-field <?php echo e($errors->has('description') ? ' is-invalid-input' : ''); ?>" name="description" type="text" placeholder="Description of event" ><?php echo e(old('description')); ?></textarea>
            </div>
            <?php if($errors->has('description')): ?>
                <span class="form-error is-visible"><?php echo e($errors->first('description')); ?></span>
            <?php endif; ?>
        
              
        
            <div class="grid-x grid-margin-x">
                <div class="cell medium-6">
                <div class="input-group">
                    <span class="input-group-label">
                        <i class="fa fa-calendar-plus-o"></i>
                    </span>
                    <input id="date_start" class="input-group-field dt_picker <?php echo e($errors->has('date_start') ? ' is-invalid-input' : ''); ?>" name="date_start" value="<?php echo e(old('date_start')); ?>" type="text" placeholder="Starting date of event">
                </div>
                <?php if($errors->has('date_start')): ?>
                    <span class="form-error is-visible"><?php echo e($errors->first('date_start')); ?></span>
                <?php endif; ?>
            </div>
        
             
        
            <div class="cell medium-6">
                <div class="input-group">
                    <span class="input-group-label">
                        <i class="fa fa-calendar-minus-o"></i>
                    </span>
                    <input id="date_end" class="input-group-field dt_picker <?php echo e($errors->has('date_end') ? ' is-invalid-input' : ''); ?>" name="date_end" value="<?php echo e(old('date_end')); ?>" type="text" placeholder="Ending date of event" >
                </div>
                <?php if($errors->has('date_end')): ?>
                    <span class="form-error is-visible"><?php echo e($errors->first('date_end')); ?></span>
                <?php endif; ?>
                </div>
            </div>
        
            
        
            <div class="grid-x grid-margin-x">
                <div class="cell medium-6">
                    <div class="input-group">
                        <span class="input-group-label">
                            <i class="fa fa-calendar-times-o"></i>
                        </span>
                        <input id="deadline" class="input-group-field <?php echo e($errors->has('deadline') ? ' is-invalid-input' : ''); ?>" name="deadline" value="<?php echo e(old('deadline')); ?>" type="text" placeholder="Deadline of event" onfocus="(this.type='date')" onblur="(this.type='text')" >
                    </div>
                    <?php if($errors->has('deadline')): ?>
                        <span class="form-error is-visible"><?php echo e($errors->first('deadline')); ?></span>
                    <?php endif; ?>
            </div>
        

        
            <div class="cell medium-4">
                <div class="input-group">
                    <span class="input-group-label">
                        <i class="fa fa-plus-circle"></i>
                    </span>
                    <select id="type" class="input-group-field <?php echo e($errors->has('type') ? ' is-invalid-input' : ''); ?>" name="type" >
                        <option selected disabled value="">Choose type</option>
                        <?php $__currentLoopData = $type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($event_type->id); ?>"><?php echo e($event_type->type); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <div class="input-group-button">
                        <button class="button" id="btnadditem" name="btnadditem" type="button"><i class="fas fa-plus-square"></i></button>
                    </div>
                </div>
                
                <?php if($errors->has('type')): ?>
                    <span class="form-error is-visible"><?php echo e($errors->first('type')); ?></span>
                <?php endif; ?>
            </div>
        
            
        
            <div class="cell medium-2">
                <div class="input-group radioBtn">
                    <input id="paid_activity" name="paid_activity" value="1" type="checkbox"><label for="paid_activity">Paid activity</label>
                </div>    
            </div>
        </div>
             
            
        
            <button class="button expanded btnAdd btnAddEventAlert eventform_btn">Add Event</button>
        

        
        <div class="reveal" id="additemmod" data-reveal>
            <div class="grid-x">
                <div class="cell">
                    <h3>Select Items</h3>
                </div>
            </div>
            <div class="grid-x item-menu">
                <div class="cell small-2"></div>
                <div class="cell small-8">
                    <select multiple="multiple" id="menu-select" name="menu-select[]">
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->id); ?>"><?php echo e($item->item_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="grid-x">
                <div class="cell btnsavitem-div">
                    <button data-close id="btnaddMenu" name="btnaddMenu" type="button" class="button hvr-icon-push"><i class="fas fa-plus hvr-icon"></i> Save to Event </button>
                </div>
            </div>
            <button class="close-button" data-close aria-label="Close modal" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        
        <input type="hidden" name="hfmenu" id="hfmenu">
    </form>
</div>
</fieldset> 
       
</div>
<div class="cell small-1"></div>
</div>
    <?php $__env->startSection('contentscript'); ?>
        <?php if($errors->has('image_path')): ?>
            <script>
                $.alert({
                    title: 'Errors',
                    icon: 'fas fa-exclamation',
                    type: 'orange',
                    boxWidth: '30%',
                    useBootstrap: false,
                    content: '<b><?php echo e($errors->first('image_path')); ?></b> Retry!' +
                    '<hr>',
                    });
            </script> 
        <?php endif; ?>

        <script>    
        $(document).ready(function()
        {
            $("#btnadditem").hide();
            $('#menu-select').multiSelect();
        });

        $('select[name=type]').change(function(e) {
            var type_id = e.target.value;
            //console.log(type_id);
            $.get('/check-type/'+type_id, function(data)
            {
            //success data
            data.forEach(function (d) 
            {
                if(d.order_status == 1)
                {
                    $("#btnadditem").show();
                }
                else
                {
                    $("#btnadditem").hide();
                }
                //console.log(d.order_status);
            });
                // console.log(data);
            });

            $("#btnadditem").on("click", function()
            {
                var popup = new Foundation.Reveal($('#additemmod'));
                popup.open();
            });
    
            $('#additemmod').on('closed.zf.reveal', function () {
                var menu = $("#menu-select").val();
                var menu_json = JSON.stringify(menu);
                $("#hfmenu").val(menu_json);
                //console.log(menu_json);
            });
            });
        
        $(function(){
            window.prettyPrint && prettyPrint();
            $('.dt_picker').fdatetimepicker({
                format: 'yyyy-mm-dd hh:ii:ss'
            });			
        });   
        </script>
        <script src="<?php echo e(asset('js/jquery.multi-select.js')); ?>"></script>
    <?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.adminfound', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>