

<?php $__env->startSection('content'); ?>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper" id="bg-img">
      <div class="content-wrapper d-flex align-items-center auth px-0" style="background-color:transparent;">
        <div class="row w-100 mx-0">
            <div class="col-lg-7">
            
            </div>
          <div class="col-lg-5 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5" style="background-color: rgba(255, 255, 255, 0.911)">
              
              <h4>Want to Host your car at <a href="<?php echo e(route('index')); ?>">Rento</a></h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
              <?php if($errors->any() && !$errors->login->any()): ?>
                   <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <div style="color: brown;background-color:rgb(253, 179, 179);padding:20px 10px;font-size:19px"><?php echo e($error); ?></div>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
              <form class="pt-3"  action="<?php echo e(route('host_register')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email">
                </div>
                <div class="form-group">
                  <input type="number" name="phone_number" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Phone Number">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="password" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-lg" name="password_confirmation" id="exampleInputPassword1" placeholder="Retype Password">
                  </div>
                <div class="mb-4">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      I agree to all
                    </label>
                    <p><a href=""> Terms & Conditions</a></p>
                  </div>
                </div>
                <div class="mt-3">
                  <input class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit" value="SIGN UP">
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Already have an account? <a href="<?php echo e(route('hlogin')); ?>" class="text-primary">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('host.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/host/register.blade.php ENDPATH**/ ?>