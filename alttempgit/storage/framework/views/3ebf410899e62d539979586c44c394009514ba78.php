<?php echo $__env->make('layouts.automatedEventStatus', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/foundation.min.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/dataTables.foundation.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/responsive.foundation.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/style.css')); ?>">
   
    <link rel="stylesheet" href="<?php echo e(asset('css/foundation-datepicker.css')); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/jquery-confirm.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/footercss.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/responsivetablecss.css')); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset('css/iziToast.min.css')); ?>"> 
    <link rel="stylesheet" href="<?php echo e(asset('css/media-reponsiveness.css')); ?>"> 
    <link rel="stylesheet" href="<?php echo e(asset('css/hover.css')); ?>"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    
    <?php echo $__env->yieldContent('contentcss'); ?>

    <script  src="<?php echo e(asset('js/jquery-3.3.1.js')); ?>"></script>
    <script src="<?php echo e(asset('js/numscroller-1.0.js')); ?>"></script>
    <script src="<?php echo e(asset('js/foundation-datetimepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jQueryRotate.js')); ?>"></script>
    
    <script  src="<?php echo e(asset('js/jquery.dataTables.min.js')); ?>"></script>
	<script  src="<?php echo e(asset('js/dataTables.foundation.min.js')); ?>"></script>
    <script  src="<?php echo e(asset('js/dataTables.responsive.min.js')); ?>"></script>
    <script  src="<?php echo e(asset('js/dataTables.rowGroup.min.js')); ?>"></script>
    <script  src="<?php echo e(asset('js/responsive.foundation.min.js')); ?>"></script>
    <script  src="<?php echo e(asset('js/jquery-confirm.min.js')); ?>"></script>
    <script  src="<?php echo e(asset('js/foundation.js')); ?>"></script>
    <script  src="<?php echo e(asset('js/iziToast.min.js')); ?>"></script>        
    <script>
    $(document).ready(function() {
        $(document).foundation();
        $('#tbluser, #tblevent').DataTable(
            {'responsive':'true'}
        );
        $('#tblAddStatus').DataTable(
            {'responsive':'true',
            "bLengthChange": false,
            "bFilter": true});

        $('#tbltype').DataTable(
            {
                'responsive':'true',
                "bLengthChange":false
            }
        );
        $('#tblEventMenu').DataTable(
            {
                'responsive':'true',
                "bLengthChange": false
            }
        );
        $('#tblEventsOrders').DataTable(
            {   
                responsive:true,
                bLengthChange: true,
                order: [[0, 'asc']],
                rowGroup: {
                    startRender: function ( rows, group ) {
                        var orderID = group;
                        var name = '<td>'+rows.data()[0][1]+'</td>';
                        var total='<td>Total: Rs'+rows.data()[0][7]+'</td>';
                        var paid=rows.data()[0][8];
                        var checked = '';                        
                        if(paid==1){
                            checked='checked';
                        }
                        var paid_data=
                            '<td><div class="switch small">'+
                                '<input class="switch-input" onchange="paid_order('+orderID+')" id="OrderStatus'+orderID+'" type="checkbox" name="OrderStatus'+orderID+'"'+checked+'>'+
                                '<label class="switch-paddle" for="OrderStatus'+orderID+'">'+
                                        '<span class="switch-active" aria-hidden="true">Yes</span>'+
                                        '<span class="switch-inactive" aria-hidden="true">No</span>'+
                                ' </label>'+
                            '</div></td>';                            
                        var data = '<table id="tblOrderHead"><tbody><tr>'+name+total+paid_data+'</tr></tbody></table>';

                        return (data);
                        
                    },
                    endRender: null
                    
                },dataSrc: 0
            }
        );
      
    });

    $(window).on('load', function() {
    $(".loader2").fadeOut("slow");
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

    <style>
        .respond-nav
        {
            display:none !important;
        }

        @media  screen and (max-width: 40em) 
        {
            .sidebar-height
            {
                display:none !important; /*Hide side-bar*/
            }
            .respond-nav
            {
                display:block !important;
            }
            #body-container
            {
                height:71.9vh !important;
            }
            #body-container.small-10
            {
                width:100% !important;
            }
        }
    </style>

    
    <div class="title-bar" data-responsive-toggle="responsive-menu" data-hide-for="medium">
        <button class="menu-icon" type="button" data-toggle></button>
        <div class="title-bar-title">Menu</div>
    </div>

    <div id="responsive-menu">
        <div class="top-bar respond-nav">
            <div class="top-bar-left">
                <ul class=" medium-horizontal vertical dropdown menu" data-responsive-menu="accordion medium-dropdown">
                    <li>
                        <i class="fas fa-user"></i><a href="#"><span style="color:'red';">Users</span></a>
                        <ul class="menu vertical nested">
                            <li><a href="/usersfound/view"><i class="fas fa-users"></i>View Users</a></li>
                            <li><a href="/create_foundation"><i class="fas fa-user-plus"></i> Add User</a></li>
                            <li><a href="/admin/editprofile"><i class="fas fa-user-edit"></i> Edit Profile</a></li>
                        </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fas fa-calendar-alt"></i> Events</a>
                            <ul class="menu vertical nested">
                                <li><a href="/eventfound/view"><i class="far fa-calendar-alt"></i> All Events</a></li>
                                
                                <li><a href="/eventform"><i class="fas fa-calendar-plus"></i></i> Add Event</a></li>
                                                                                   
                            </ul>
                        </li>
                        <li>
                            <a href='/orderfound/view'><i class="fas fa-list-alt"></i> Order List</a>
                        </li>
                        <li>
                            <a href="/webconf"><i class="fas fa-cog"></i> Configurations</a>
                        </li>
                        <li>
                            <a data-open="changepassword" data-target="#changepassword"><i class="fas fa-key"></i> Change Password</a>
                        </li>
                        <li>
                            <a href="/logout"><i class="fa fa-power-off" aria-hidden="true"></i> Log Out</a>
                        </li>
                </ul>
            </div>
        </div>
    </div>

               
    <div class="grid-x">
            <div class="small-2 cell sidebar-height">
                    <ul class="vertical menu accordion-menu" data-accordion-menu data-multi-open="false">
                    <li>
                        <a href="/admin/dashboard"><i class="fa fa-home"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-user"></i> Users</a>
                        <ul class="menu vertical nested">
                            <li><a href="/usersfound/view"><i class="fas fa-users"></i> View Users</a></li>
                            <li><a href="/create_foundation"><i class="fas fa-user-plus"></i> Add User</a></li>
                            <li><a href="/admin/editprofile"><i class="fas fa-user-edit"></i> Edit Profile</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-calendar-alt"></i> Events</a>
                        <ul class="menu vertical nested">
                            <li><a href="/eventfound/view"><i class="far fa-calendar-alt"></i> All Events</a></li>
                            
                            <li><a href="/eventform"><i class="fas fa-calendar-plus"></i></i> Add Event</a></li>
                                                                               
                        </ul>
                    </li>
                    <li>
                        <a href='/orderfound/view'><i class="fas fa-list-alt"></i> Order List</a>
                    </li>
                    <li>
                        <a href="/webconf"><i class="fas fa-cog"></i> Configurations</a>
                    </li>
                    <li>
                        <a data-open="changepassword" data-target="#changepassword"><i class="fas fa-key"></i> Change Password</a>
                    </li>
                    <li>
                        <a href="/logout"><i class="fa fa-power-off" aria-hidden="true"></i> Log Out</a>
                    </li>
                </ul>
            </div>
                <div class="small-10 cell" id="body-container">
                    <div class="grid-x">
                        <div class="small-2 cell" id="space-col"></div>
                    </div>
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>

            
            <footer>
               <img src="<?php echo e(asset('images/1694498923.png')); ?>" class="footerlogo" alt="logo astek">  Copyright &copy; <script type="text/JavaScript"> var theDate=new Date(); document.write(theDate.getFullYear()); </script> Astek Mauritius.
            </footer>
           
            <div class="reveal chngemod" id="changepassword" tabindex="-1"  role="dialog" data-reveal>
            <div class="changepasswrdmodal-header">
                <h4 class="modal-title chngepasstitle" >Change Password</h4>
            </div>
            
                <form action="<?php echo e(route('users.passchgadmin')); ?>" method="post"  class="form-body">
                
                <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="changepassword" id="changepassword" value="">
                    <?php echo $__env->make('users.changepasswordmod_found', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>   
                    <button class="close-button" data-close aria-label="Close modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
              </form>
            </div>
        

            <?php if($errors->has('txtpassword') || $errors->has('txtOldpassword') || session('alert')=='errChngPass'): ?>
                <script>
                    var popup = new Foundation.Reveal($('#changepassword'));
                    popup.open();
                </script>
            <?php endif; ?>
            
            <script>
            function confirmMsg(event)
            {
                event.preventDefault();
                var ref = $(this).attr('href');
                $.confirm({
                boxWidth: '30%',
                useBootstrap: false,
                backgroundDismiss: true, 
                title: event.data.title,
                content: event.data.msg,
                type: 'green',
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
            }
            $('.button').on("click", function() {
                $(".loader2").css("display", "block");
            });
            </script>
            <?php echo $__env->yieldContent('contentscript'); ?>
</body>
    <script>
        // $(".switch-input").on("change", function()
        
        // function test()
        // {
        //     var paid_status;
        //     var orderId = (this.id.split("OrderStatus"))[1];  
        //     if(this.checked)
        //     {
        //         paid_status = 1;
        //     }
        //     else
        //     {
        //         paid_status = 0;
        //     }

        //     $.get('/update-payment/'+ orderId + '/' + paid_status, function(data)
        //     {
        //      //success data
        //     if(data == "success")
        //     {
        //         iziToast.show({
        //             title: 'Success',
        //             message: 'Payment Status has been updated',
        //             position: 'bottomRight',
        //             transitionIn:'fadeInUp'
        //         });
        //     }
        //     });
        // });
    </script>
</html>