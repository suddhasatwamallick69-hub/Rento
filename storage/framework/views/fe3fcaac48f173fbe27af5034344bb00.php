<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo e(route('ins_authenticate_client')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <p><input type="text" name="otp"></p>
        <p><input type="hidden" name="uid" value="<?php echo e($uid); ?>"></p>
        <p><input type="hidden" name="id" value="<?php echo e($id); ?>"></p>
        <p><input type="submit" value="Verify"></p>
        <p></p>
    </form>

    <form action="<?php echo e(route('resend_otp_for_authenticating_client')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <p><input type="hidden" name="uid" value="<?php echo e($uid); ?>"></p>
        <p><input type="hidden" name="id" value="<?php echo e($id); ?>"></p>
        <p><input type="submit" value="Resend Otp"></p>
    </form>
</body>
</html><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/host/authenticate_client.blade.php ENDPATH**/ ?>