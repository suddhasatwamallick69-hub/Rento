

<?php $__env->startSection('content'); ?>
<div class="about_section layout_padding">
    <div class="container">
       <div class="about_section_2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                        <form action="<?php echo e(route('ins_verifyprofile')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                        <div class="col-md-12">
                            <p><input type="number" class="form-control" name="phone_number" value="<?php echo e($phone_number); ?>" id="" placeholder="Phone Number"></p>
                        </div>
                        <div class="col-md-12">
                            <p><input type="text"  maxlength="14" class="form-control" value="<?php echo e($aadhar_number); ?>" name="aadhar_number" id="" placeholder="Aadhar Number"></p>
                        </div>
                        <div class="col-md-12">
                            <p><input type="submit" value="Verify" class="btn btn-success"></p>
                        </div>
                       </form>
                </div>
            </div>
        </div>
       </div>
    </div>
 </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/verifyprofile.blade.php ENDPATH**/ ?>