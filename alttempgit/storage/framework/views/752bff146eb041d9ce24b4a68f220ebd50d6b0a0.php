<?php echo $__env->make('layouts.automatedEventStatus', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>ALT | Login</title>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/foundation.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/footercss.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/iziToast.min.css')); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    

    <script  src="<?php echo e(asset('js/iziToast.min.js')); ?>"></script>
</head>
<body>
    

        <div class="login_page">
                <!--LOGIN_WRAPPER--> 
                <div class="login_wrapper">
                    <div class="large-12 cell">
                        <!--FORM-->   
                        <form  class="login" action="<?php echo e(route('login')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="grid-x grid-padding-x">
                                <p class="title">Astek Life Team</p>
                            </div>
                            

                            <div class="medium-12 cell before-textbox credentials-error help-block">

                            <?php if($errors->has('username')): ?>
                            <span class="form-error is-visible">
                                <strong><?php echo e($errors->first('username')); ?></strong>
                            </span>
                        <?php endif; ?>
                        <?php if($errors->has('password')): ?>
                                <span class="form-error is-visible">
                                    <strong><?php echo e($errors->first('password')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                   


                            <div class="medium-12 cell before-textbox">
                                <input type="text" id="username" name="username" class="text-box" placeholder="Username">
                                <i class="fa fa-user"></i>
                            </div>
                           

                            <div class="medium-12 cell">
                                <input type="password" name="password" id="password" class="text-box" placeholder="Password">
                                <i class="fa fa-key"></i>
                            </div>
                            
                            <div class="medium-12 cell">
                                <button type="submit" class="btn_login" >LOG IN</button>
                            </div>
                        </form>
                    <!--END FORM-->
                    </div>
                </div>
                <!--END LOGIN_WRAPPER--> 
            </div>
            <!--LOGIN_PAGE--> 
            

    <script  src="<?php echo e(asset('js/jquery-3.3.1.js')); ?>"></script>
    <script  src="<?php echo e(asset('js/foundation.js')); ?>"></script>
    <script  src="<?php echo e(asset('js/iziToast.min.js')); ?>"></script>
    <script>
        $(document).foundation();
    </script>
    <?php echo $__env->make('layouts.global', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php if(session('alert')): ?>
        <?php       
            $title="Password Changed<br>";
            $message="Please login again.";
            $type=session('alert');
            alertSuccess($title, $message, $type);
        ?>
    <?php endif; ?>
 

</body>
<footer>
    <img src="<?php echo e(asset('images/1694498923.png')); ?>" class="footerlogo" alt="logo astek">  Copyright &copy; <script type="text/JavaScript"> var theDate=new Date(); document.write(theDate.getFullYear()); </script> Astek Mauritius.
 </footer>
</html>



<?php if(session('alertChangePassword')): ?>
    <script>
        iziToast.show({
        title: 'Change Password!',
        message: 'Password was successfully changed!'
    })
    </script>
<?php endif; ?>


