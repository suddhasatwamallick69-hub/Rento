

<?php $__env->startSection('content'); ?>
<main>
  <div class="container">

    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

            <div class="d-flex justify-content-center py-4">
              <a href="index.html" class="logo d-flex align-items-center w-auto">
                <img src="<?php echo e(asset('assets/img/Rento6.png')); ?>" alt="">
                <span class="d-none d-lg-block">Rento Admin</span>
              </a>
            </div><!-- End Logo -->

            <div class="card mb-3">

              <div class="card-body" style="background-image:url(<?php echo e(asset('assets/img/Rento6.png')); ?>); background-repeat: no-repeat; background-size:cover;background-position: center;min-height: 400px;">

                <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                  <p class="text-center small">Enter your username & password to login</p>
                </div>
                <?php if($errors->any()): ?>
                  <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="alert alert-danger" role="alert">
                        <?php echo e($error); ?>

                      </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <form class="row g-3 needs-validation" action="<?php echo e(route('login_auth')); ?>" method="post">
                  <?php echo csrf_field(); ?>
                  <div class="col-12">
                    <label for="yourUsername" class="form-label">Username</label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend">@</span>
                      <input type="text" name="email" class="form-control" id="yourUsername" style="background-color:#4242426f;color: aliceblue;font-weight: 800;">
                      <div class="invalid-feedback">Please enter your username.</div>
                    </div>
                  </div>

                  <div class="col-12">
                    <label for="yourPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="yourPassword" style="background-color:#4242426f;color: aliceblue;font-weight: 800;">
                    <div class="invalid-feedback">Please enter your password!</div>
                  </div>
                  <div class="col-12">
                    <button class="btn btn-primary" type="submit">Login</button>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>

    </section>

  </div>
</main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    Login
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/admin/index.blade.php ENDPATH**/ ?>