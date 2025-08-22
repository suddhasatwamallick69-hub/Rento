<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo e(route('ins_trip_end_otp')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <p><input type="text" name="otp"></p>
        <p><input type="submit" value="Verify"></p>
    </form>
</body>
</html><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/trip_end_otp.blade.php ENDPATH**/ ?>