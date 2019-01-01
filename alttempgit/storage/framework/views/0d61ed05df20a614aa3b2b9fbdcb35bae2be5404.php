<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/form-icons.css')); ?>">
    <link rel="icon" href="<?php echo e(asset('images/editEvent.png')); ?>" />
    <title>Edit Event</title>
</head>


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
                <fieldset class="addUserFieldset editeventFieldset">
                    <legend class="addUserLegend">Edit Event</legend>
    <div class="cell small-11 eventFormContainer">
    <form method="POST" enctype="multipart/form-data" class="cssAddEvent" data-abide novalidate autocomplete="off"> 
      <?php echo csrf_field(); ?>
        
        
            <div class="input-group">
                <span class="input-group-label">
                <i class="fa fa-bookmark"></i>
                </span>
                <input class="input-group-field <?php echo e($errors->has('txtename') ? ' is-invalid-input' : ''); ?>" name="txtename" value="<?php echo e($event->name); ?>" type="text" placeholder="Event name">
            
                    <div class="input-group-button">
                        <label for="image_path" data-tooltip tabindex="2" title="Add an Event Image" class="custom-file-upload top" id="lblimg">
                            <i class="fa fa-image"></i>
                        </label>
                        <input  id="image_path" onchange="changeInputField()"class="button" type="file" name="image_path">
                    </div>
                    <input id="oldEventPic" name="oldEventPic" type="hidden" value="<?php echo e($event->image_path); ?>">
                    <img id="oldEventPic" src="<?php echo e(asset('images/'.$event->image_path)); ?>">
            
            </div>
            <?php if($errors->has('txtename')): ?>
                <span class="form-error is-visible"><?php echo e($errors->first('txtename')); ?></span>
            <?php endif; ?>
        
           
        
                <div class="input-group">
                <span class="input-group-label">
                    <i class="fa fa-book"></i>
                </span>
                <textarea class="input-group-field <?php echo e($errors->has('description') ? ' is-invalid-input' : ''); ?>" name="description" type="text" placeholder="Description of event"><?php echo e($event->description); ?></textarea>
                </div>
                <?php if($errors->has('description')): ?>
                    <span class="form-error is-visible"><?php echo e($errors->first('description')); ?></span>
                <?php endif; ?>
        
            
        <div class="grid-x grid-margin-x">
            <div class="cell medium-6">
        
            <div class="input-group">
                <span class="input-group-label">
                    <i class="fa fa-plus-circle"></i>
                </span> 
                <select id="status" class="input-group-field <?php echo e($errors->has('status') ? ' is-invalid-input' : ''); ?>" name="status">
                    <?php $status_id= $event->status_id?>
                    <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event_status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $id=$event_status->id ?>
                        <?php if($status_id==$id): ?>
                            <option value="<?php echo e($event_status->id); ?>" selected><?php echo e($event_status->status); ?></option>
                        <?php else: ?>
                            <option value="<?php echo e($event_status->id); ?>"><?php echo e($event_status->status); ?></option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <?php if($errors->has('status')): ?>
                <span class="form-error is-visible"><?php echo e($errors->first('status')); ?></span>
            <?php endif; ?>
        
            </div>
        
            <div class="cell medium-6">
         
            <div class="input-group">
                <span class="input-group-label">
                    <i class="fa fa-plus-circle"></i>
                </span>
                <select id="type" class="input-group-field <?php echo e($errors->has('type') ? ' is-invalid-input' : ''); ?>" name="type">
                    <option selected disabled>Choose type</option>
                    <?php $type_id= $event->type_id?>
                    <?php $__currentLoopData = $type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $id=$event_type->id ?>
                        <?php if($type_id==$id): ?>
                            <option value="<?php echo e($event_type->id); ?>" selected><?php echo e($event_type->type); ?></option>
                        <?php else: ?>
                            <option value="<?php echo e($event_type->id); ?>"><?php echo e($event_type->type); ?></option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <?php if($errors->has('type')): ?>
                <span class="form-error is-visible"><?php echo e($errors->first('type')); ?></span>
            <?php endif; ?>
         
            </div>
        </div>     
        
        <div class="grid-x grid-margin-x">
            <div class="cell medium-6">
        
            <div class="input-group">
                <span class="input-group-label">
                    <i class="fa fa-calendar-plus-o"></i>
                </span>
                <input id="date_start" class="input-group-field dt_picker <?php echo e($errors->has('date_start') ? ' is-invalid-input' : ''); ?>" name="date_start" value="<?php echo e($event->date_start); ?>" type="text" placeholder="Starting date of event">
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
                <input id="date_end" class="input-group-field dt_picker <?php echo e($errors->has('date_end') ? ' is-invalid-input' : ''); ?>" name="date_end" value="<?php echo e($event->date_end); ?>" type="text" placeholder="Ending date of event">
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
                <input id="deadline" class="input-group-field <?php echo e($errors->has('deadline') ? ' is-invalid-input' : ''); ?>" name="deadline" value="<?php echo e($event->deadline); ?>" type="text" placeholder="Deadline of event" onfocus="(this.type='date')" onblur="(this.type='text')">
            </div>
            <?php if($errors->has('deadline')): ?>
                <span class="form-error is-visible"><?php echo e($errors->first('deadline')); ?></span>
            <?php endif; ?>
        
            </div>
        
            <div class="cell medium-6">
        
            <div class="input-group radioBtnEdit">
                <?php $paid_activity=$event->paid_activity ?>    
                <?php if( $paid_activity == 1): ?>
                    <input id="paid_activity" name="paid_activity" type="checkbox" checked>
                <?php else: ?>
                    <input id="paid_activity" name="paid_activity" type="checkbox">
                <?php endif; ?>                
                <label for="paid_activity">Paid activity of Event </label>
            </div>    
             
            </div>
        </div>
        <br>
        
            <button class="button expanded btnUpdate">Update Event</button>
        
    </form>
</div>

</fieldset>

    </div>
</div>
    <script>
        $(function(){
            window.prettyPrint && prettyPrint();
            $('.dt_picker').fdatetimepicker({
                format: 'yyyy-mm-dd hh:ii:ss'
            });			
        });
    </script>
    <?php $__env->startSection('contentscript'); ?>
        <script>
            function changeInputField()
            {
                $(".custom-file-upload").css("background-color", "#6BA34D");
            }
        </script>
    <?php $__env->stopSection(); ?>

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
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.adminfound', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>