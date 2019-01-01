<link rel="stylesheet" href="<?php echo e(asset('css/found.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('css/show_found.css')); ?>">
    <div class="small-4 columns space">
    <label for="txtename">Event Name</label>
    <input type="text" name="txtename" id="txtename">
                        
        
        <br>            
</div> 



    <div class="small-6 column space ">
        <label for="description">Event Description</label>
        <textarea id="description" name="description"></textarea>
      
            
            <br>   
    </div>

    <div class="form-group space">
            <label for="status">Status</label>
            <select id="status" name="status">
                <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event_status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($event_status->id); ?>"><?php echo e($event_status->status); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
            </select>
    </div>
    <div class="all-grid-container">
    <div class="grid-container">
            <div class="grid-x grid-padding-x">
                <div class="medium-6 cell">
       
                    <label for="date_start"> Date Start</label>
            
                    <input id="date_start" type="date"  name="date_start">
              
                </div>

                <div class="medium-6 cell">
                    <label for="date_end"> Date End</label>
                
                     <input id="date_end" type="date"  name="date_end">
                  
                </div>
            </div>
    </div>

        <div class="grid-container">
            <div class="grid-x grid-padding-x">
                <div class="medium-5 cell">
                    <label for="deadline"> Deadline</label>
                    
                    <input id="deadline" type="date" name="deadline">
                </div>   
                
                
            </div>
            <div class="medium-3 cell">
                    <label for="type"> Type</label>
                        <select id="type"  name="type">
                            <?php $__currentLoopData = $type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($event_type->id); ?>"><?php echo e($event_type->type); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                </div>
        </div>
  </div>
