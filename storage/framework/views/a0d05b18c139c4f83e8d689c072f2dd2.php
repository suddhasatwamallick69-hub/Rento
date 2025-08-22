
<?php $__env->startSection('content'); ?>
 <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Welcome Host <?php echo e(Auth::user()->name); ?></h3>
            <a href="<?php echo e(route('logout_host')); ?>">Logout</a><p>Logout to return as User</p>
            <h6 class="font-weight-normal mb-0"><span class="text-primary"></span></h6>
          </div>
          <div class="col-12 col-xl-4">
           <div class="justify-content-end d-flex">
            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
              <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
               <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
              </button>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                <a class="dropdown-item" href="#">January - March</a>
                <a class="dropdown-item" href="#">March - June</a>
                <a class="dropdown-item" href="#">June - August</a>
                <a class="dropdown-item" href="#">August - November</a>
              </div>
            </div>
           </div>
          </div>
        </div>
        <div class="row">
            <form action="<?php echo e(route('ins_hostverifyprofile')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="col-md-12">
                    <p><input type="text" maxlength="16" class="form-control" name="aadhar_number" value="<?php echo e($aadhar); ?>" id="" placeholder="Aadhar" <?php
                      if($user->is_verified==1)echo 'disabled'
                  ?>></p>
                </div>
                <div class="col-md-12">
                  <?php if($user->is_verified==0): ?>
                            <p><input type="submit" value="Verify" class="btn btn-success"></p>
                                <?php else: ?>
                                    <p class="btn btn-warning">Profile Verified</p>
                                <?php endif; ?>
                    
                </div>
            </form>
            <div class="col-md-12">
            <form action="<?php echo e(route('hostupdateprofile')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="row p-2">
                            <div class="col-md-4">
                                <h2>Name : </h2>
                            </div>
                            <div class="col-md-4">
                            <input type="text" class="form-control" name="name" value="<?php echo e($user->name); ?>" placeholder="Enter your Name">
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-md-4">
                                <h2>Email : </h2>
                            </div>
                            <div class="col-md-4">
                                <input type="email" value="<?php echo e($user->email); ?>"  class="form-control" id="" placeholder
                                ="Enter your Email" disabled>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-md-4">
                                <h2>Phone Number : </h2>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" value="<?php echo e($user->phone_number); ?>" name="phone_number" disabled>
                                <?php
                                    if($user->phone_number=='')
                                    echo 'Verify Your Phone Number';
                                    else
                                    echo'';
                                ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <p><input type="submit" value="Update" class="btn btn-success"></p>
                        </div>
            </form>
            </div>
        </div>
      </div>
    </div>
   </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('host.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/host/myprofile.blade.php ENDPATH**/ ?>