

<?php $__env->startSection('content'); ?>

<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper" id="bg-img2">
      <div class="content-wrapper d-flex align-items-center auth px-0" style="background-color:transparent;">
        <div class="row w-100 mx-0">
          <div class="col-lg-7">
            
          </div>
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              
              <h4>Earn More!!! Happy Hosting</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
                <?php if($errors->login->any()): ?>
                  <?php $__currentLoopData = $errors->login->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div style="color: brown;background-color:rgb(253, 179, 179);padding:20px 10px;font-size:19px"><?php echo e($error); ?></div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
              <form class="pt-3" action="<?php echo e(route('host_inslogin')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                  <input type="text" name="email"  class="form-control form-control-lg" id="exampleInputEmail1" placeholder="email">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="mt-3">
                  <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="SIGN IN">
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>
                <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="ti-facebook mr-2"></i>Connect using facebook
                  </button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="<?php echo e(route('host')); ?>" class="text-primary">Create</a>
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
<?php echo $__env->make('host.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/host/login.blade.php ENDPATH**/ ?>