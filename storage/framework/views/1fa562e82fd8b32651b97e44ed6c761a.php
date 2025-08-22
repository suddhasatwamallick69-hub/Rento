<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php if($errors->any()): ?>
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <?php endif; ?>
    <form action="<?php echo e(route('login_auth_user')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <p><input type="text" name="username" placeholder="Enter your Username or Email"></p>
        <p><input type="password" name="password" placeholder="Enter your Password"></p>
        <p><input type="submit" value="Login"></p>

        <?php if($errors->any()): ?>
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <?php endif; ?>
    </form>
    <a href="<?php echo e(route('index')); ?>">register</a>
</body>
</html><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/login.blade.php ENDPATH**/ ?>