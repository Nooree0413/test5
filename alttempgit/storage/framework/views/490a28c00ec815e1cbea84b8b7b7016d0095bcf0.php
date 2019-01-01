<?php echo $__env->make('layouts.automatedEventStatus', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/foundation.min.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/dataTables.foundation.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/responsive.foundation.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/jquery-confirm.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/footercss.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/responsivetablecss.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/hover.css')); ?>"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset('css/iziToast.min.css')); ?>"> 
  
    <?php echo $__env->yieldContent('contentcss'); ?>
    
    
    <script  src="<?php echo e(asset('js/jquery-3.3.1.js')); ?>"></script>
	<script  src="<?php echo e(asset('js/jquery.dataTables.min.js')); ?>"></script>
	<script  src="<?php echo e(asset('js/dataTables.foundation.min.js')); ?>"></script>
	<script  src="<?php echo e(asset('js/dataTables.responsive.min.js')); ?>"></script>
    <script  src="<?php echo e(asset('js/responsive.foundation.min.js')); ?>"></script>
    <script  src="<?php echo e(asset('js/jquery-confirm.min.js')); ?>"></script>
    <script  src="<?php echo e(asset('js/foundation.js')); ?>"></script>
    <script  src="<?php echo e(asset('js/iziToast.min.js')); ?>"></script>
    <script>
    $(document).ready(function() {
        $(document).foundation();
        $('#tlbuser, #tblevent').DataTable(
            {'responsive':'true'}
        );
    });
</script>
</head>
<body>
        <div class="top-bar borderdown">
                <div class="top-bar-left">
                  <ul class="dropdown menu" data-dropdown-menu>
                    <li class="menu-text skills">ALT</li>
                  </ul>
                </div>
                
                <div class="top-bar-right">
                    <a  class="usernameNavBar" href="#"><b>Welcome, <?php echo e(ucfirst(strtolower(Auth::user()->firstname))); ?></b></a> 
                </div>
        </div>
               
    <div class="grid-x">
            <div class="small-2 cell sidebar-height">
                <ul class="vertical menu accordion-menu" data-accordion-menu data-multi-open="false">
                        <li>
                            <a href="/user/profile/view"><i class="fas fa-user-edit"></i> My Profile</a>
                            
                        </li>
                    <li>
                        <a href="/eventfound/view"><i class="fas fa-calendar-alt"></i> Events</a>
                        
                    </li>
                    <li>
                        <a href="/logout"><i class="fa fa-power-off" aria-hidden="true"></i> Log Out</a>
                    </li>
                </ul>
            </div>
                <div class="small-10 cell">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>

            
            <footer>
               <img src="<?php echo e(asset('images/1694498923.png')); ?>" height="1.5%" width="1.5%" alt="logo astek">  Copyright &copy; 2018 Astek Mauritius.
            </footer>
           
            <div class="reveal chngemod" id="changepassword" tabindex="-1" role="dialog" data-reveal>
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
        

            

            
            <script type="text/javascript">
                $('.btndelevent').on('click', function (e) { 
                    e.preventDefault();
                    var ref = $(this).attr('href');
                    $.confirm({
                    boxWidth: '30%',
                    useBootstrap: false,
                    title: 'Warning',
                    content: 'Are you sure?',
                    type: 'blue',
                    typeAnimated: true,
                    buttons: 
                    {
                        Yes: {
                            text: 'Yes',
                            action: function()
                            {
                                window.location = ref;
                            }
                        },
                        No: 
                        {
                            text:'No',
                            backgroundDismiss: true,
                        },
                    }
                    });
                });
            </script>
            <?php echo $__env->yieldContent('contentscript'); ?>
</body>
</html>