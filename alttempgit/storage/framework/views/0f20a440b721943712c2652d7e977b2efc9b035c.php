<?php $__env->startSection('contentcss'); ?>

    <link rel="icon" href="<?php echo e(asset('images/eventDetails.png')); ?>" />
    <title>Event Details</title>

<?php $__env->stopSection(); ?>
<?php $__env->startSection("content"); ?>
<style>
    
</style>
<div class="loader2"></div>
<div class="gridContainerEventShow">
    <div class="grid-x grid-padding-y">
            <div class="cell small-1"></div>
            <div class="cell small-5"><a href="/eventfound/view" class="back-btn hvr-icon-back"><i class="fa fa-chevron-circle-left hvr-icon icon-back"></i> Back</a></div>
            <div class="cell small-5 hollow"></div>
        </div>
    <div class="gridContainerEventShowMain">
        <div class="grid-x grid-padding-y">
            <div class="cell small-1"></div>
            <div class="cell small-5 lblgridtitle bar1"><h3><?php echo e($events[0]->name); ?></h3></div>
            <div class="cell small-5 hollow lblgridtitle bar2">

            <?php if(DB::table('user_event')->where('user_id', Auth::user()->id)->where('event_id',$events[0]->id)->where("status", "going")->count()>0): ?>
                <?php if(DB::table('events')->join("type", "type.id", "=", "events.type_id")->where('events.id',$events[0]->id)->where("type.order_status", "1")->count()>0): ?>
                    
                    <?php if(DB::table('orders')->where('user_id', Auth::user()->id)->where('event_id',$events[0]->id)->exists()): ?> 
                    <a href="/order/view/<?php echo e($events[0]->id); ?>/<?php echo e($get_order[0]->id); ?>">
                        <span data-tooltip tabindex="1" title="View Order" class="span-rightpad">
                            <i class="fas fa-shopping-basket icon-position-size icon-active"></i>
                        </span>
                    </a>
                    
                    
                    <?php else: ?> 
                    <a href="#" >
                        <span data-tooltip tabindex="1" title="View Order" class="span-rightpad">
                            <i class="fas fa-shopping-basket icon-position-size icon-disable"></i>
                        </span>
                    </a>            
                    <?php endif; ?>   
                    <?php if(time() <= ((int)strtotime($events[0]->deadline)+(24*60*60))): ?>
                        
                        <?php if(DB::table('orders')->where('user_id',  Auth::user()->id)->where('event_id',$events[0]->id)->exists()): ?> 
                        <a href="#" class="span-rightpad">
                            <span data-tooltip tabindex="1" title="Add Order">
                                <i class="fas fa-cart-plus icon-position-size icon-disable"></i>
                            </span>     
                        </a>

                        
                        <?php else: ?>  
                        <a href="/order/add/<?php echo e($events[0]->id); ?>">
                            <span data-tooltip tabindex="1" title="Add Order" class="span-rightpad">
                                <i class="fas fa-cart-plus icon-position-size icon-active"></i>
                            </span>  
                        </a>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>

            </div>    
        </div>
        <div class="grid-x grid-padding-y">
            <div class="cell small-1"></div>
            <div class="cell small-2 lblStartDate"><b>Start Date:</b> <?php echo e($StartDate); ?><br>
                <b>Time: </b><?php echo e($StartTime); ?>

            </div>
            <div class="cell small-3 lblEndDate"><b>End Date:</b> <?php echo e($EndDate); ?><br>
                <b>Time: </b><?php echo e($EndTime); ?>

            </div>
            <div class="cell small-3 lblStatus"><b>Status:</b> <?php echo e($events[0]->status); ?></div>
            <div class="cell small-2 lblDuration"><b>Duration:</b> <?php echo e($events[0]->duration); ?></div>
        </div>
        <div class="grid-x grid-padding-y">
                <div class="cell small-1"></div>
                <div class="cell small-2 lblType"><b>Type:</b> <?php echo e($events[0]->type); ?></div>
                <div class="cell small-3 lblDeadline"><b>Deadline:</b> <?php echo e($events[0]->deadline); ?></div>
                <div class="cell small-3 lblpaid_activity"> <?php if($events[0]->paid_activity==1): ?>
                                                                <b>Paid Activity:</b> Yes
                                                            <?php else: ?>
                                                                <b>Paid Activity:</b> No
                                                            <?php endif; ?>
                </div>
                <div class="cell small-2 emptycell"></div>
        </div>
        <div class="grid-x grid-padding-y">
                <div class="cell small-1"></div>
                <div class="cell small-10 lblImage"><img  class="imgsize" src="  <?php echo e(asset('images/'.$events[0]->image_path)); ?>" alt="Avatar" ></div>
        </div>
        <div class="grid-x grid-padding-y">
                <div class="cell small-1"></div>
                <div class="cell small-5 lblEventDescription"><b>Event Description:</b> </div>
                <div class="cell small-5 lblDescription"> <?php echo e($events[0]->description); ?> </div>
        </div>  
    </div>
</div>
<?php $__env->stopSection(); ?>

  
  
<?php echo $__env->make('layouts.userfound', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>