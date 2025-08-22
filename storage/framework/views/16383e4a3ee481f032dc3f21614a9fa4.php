<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo e(asset('style.css')); ?>">
</head>
<body>    
    <div id="container" class="container">
        <!-- FORM SECTION -->
        <div class="row">
          <!-- SIGN UP -->
          <div class="col align-items-center flex-col sign-up">
            <div class="form-wrapper align-items-center">
              <div class="form sign-up">
                <?php if($errors->any()): ?>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p><?php echo e($error); ?></p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <form action="<?php echo e(route('register')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                <div class="input-group">
                    <i class='bx bxs-user'></i>
                    <input type="text" name="name" placeholder=" Enter your name">
                </div>
                <div class="input-group">
                  <i class='bx bxs-user'></i>
                  <input type="text" name="username" placeholder="Username">
                </div>
                <div class="input-group">
                  <i class='bx bx-mail-send'></i>
                  <input type="email"  name="email" placeholder="Email">
                </div>
                <div class="input-group">
                  <i class='bx bxs-lock-alt'></i>
                  <input type="password" name="password" placeholder="Password">
                </div>
                <div class="input-group">
                  <i class='bx bxs-lock-alt'></i>
                  <input type="password" name="password_confirmation" placeholder="Confirm password">
                </div>
                <button  type="submit">
                  Sign up
                </button>
                <p>
                  <span>
                    Already have an account?
                  </span>
                  <b onclick="toggle()" class="pointer">
                    Sign in here
                  </b>
                </p>
              </div>
              </form>
            </div>
      
          </div>
          <!-- END SIGN UP -->
          <!-- SIGN IN -->
          <div class="col align-items-center flex-col sign-in">
            <div class="form-wrapper align-items-center">
              <div class="form sign-in">
                <?php if($errors->any()): ?>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p><?php echo e($error); ?></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <form action="<?php echo e(route('login_auth_user')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="input-group">
                  <i class='bx bxs-user'></i>
                  <input type="text" name="username" placeholder="Username">
                </div>
                <div class="input-group">
                  <i class='bx bxs-lock-alt'></i>
                  <input type="password" name="password" placeholder="Password">
                </div>
                <button type="submit">
                  Sign in
                </button>
                <p>
                  <b>
                    Forgot password?
                  </b>
                </p>
                <p>
                  <span>
                    Don't have an account?
                  </span>
                  <b onclick="toggle()" class="pointer">
                    Sign up here
                  </b>
                </p>
              </div>
              </form>
            </div>
            <div class="form-wrapper">
      
            </div>
          </div>
          <!-- END SIGN IN -->
        </div>
        <!-- END FORM SECTION -->
        <!-- CONTENT SECTION -->
        <div class="row content-row">
          <!-- SIGN IN CONTENT -->
          <div class="col align-items-center flex-col">
            <div class="text sign-in">
              <h2>
                Welcome
              </h2>
      
            </div>
            <div class="img sign-in">
      
            </div>
          </div>
          <!-- END SIGN IN CONTENT -->
          <!-- SIGN UP CONTENT -->
          <div class="col align-items-center flex-col">
            <div class="img sign-up">
      
            </div>
            <div class="text sign-up">
              <h2>
                Join with us
              </h2>
      
            </div>
          </div>
          <!-- END SIGN UP CONTENT -->
        </div>
        <!-- END CONTENT SECTION -->
    </div>
</body>
<script src="<?php echo e(asset('login-signup.js')); ?>"></script>
</html>

<?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/login-register.blade.php ENDPATH**/ ?>