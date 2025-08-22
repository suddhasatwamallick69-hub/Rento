<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload RC Certificate</title>
</head>
<body>
    <form action="<?php echo e(route('upload.rc')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <label>Upload RC Certificate:</label>
        <input type="file" name="image" required>
        <button type="submit">Upload</button>
    </form>
</body>
</html><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/welcome.blade.php ENDPATH**/ ?>