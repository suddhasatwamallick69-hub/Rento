<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <form action="<?php echo e(route('otp_verification')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <h3>An OTP has been sent to your mail</h3>
        <p>Enter OTP : </p>
        <P><input type="text" name="otp" value=""></P>
        <p><input type="submit" value="Verify"></p>
    </form>
</body>
</html><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/authenticate.blade.php ENDPATH**/ ?>