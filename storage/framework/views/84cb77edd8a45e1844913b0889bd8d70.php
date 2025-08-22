

<?php $__env->startSection('content'); ?>
 <!-- gallery section start -->
 <div class="">
    <div class="container-fluid">
      <form action="" method="post">
        <?php echo csrf_field(); ?>
       <div class="row">
        <div class="col-md-8" style="max-height: 100vh;overflow-y: auto;scroll-behavior: smooth;scrollbar-width:none; scrollbar-color: #888 transparent;">
          <div class="col-md-12">
             <?php
               $images=$vehicle->images;
               $images=explode(",",$images);
               $carouselId = "carousel_".$vehicle->id;
             ?>
             <div class="card pb-4">
              <div class="card-body">
                <div id="<?php echo e($carouselId); ?>" class="carousel slide" data-bs-ride="carousel">
                  <div class="carousel-inner">
                    
                    <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="carousel-item <?php if($index == 0): ?> active <?php endif; ?>">
                         <a href="<?php echo e(url("/vehicle_images")); ?>/<?php echo e($img); ?>" target="blank"> <img src="<?php echo e(url("/vehicle_images")); ?>/<?php echo e($img); ?>" class="d-block w-100" alt="..."></a>
                      </div>
                      
                      <?php echo e($active=''); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#<?php echo e($carouselId); ?>" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden"></span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#<?php echo e($carouselId); ?>" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden"></span>
                  </button>
                </div>
                <p class="card-title"><i class="fa fa-user"></i> Hosted by <?php echo e($vehicle->name); ?></p>
                <h1 class="card-title"><?php echo e($vehicle->model_name); ?></h1>
                <h5><?php echo e($vehicle->category); ?> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                  <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                </svg> <?php echo e($vehicle->capacity); ?> seats <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                  <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                </svg> <?php echo e($vehicle->fuel_type); ?> </h5>
                <div class="col-md-12" id="location">
                  <h2 class="p-4">Car Location</h2>
                   <div class="card">
                    <div class="card-body">
                      <h3><?php echo e($vehicle->address); ?></h3>
                      <h4>Pincode - <?php echo e($vehicle->pincode); ?></h4>
                    </div>
                   </div>
                </div>
                 <div class="col-md-12" id="features">
                  <h2 class="p-4">Features and Details</h2>
                   <div class="card">
                    <div class="card-body">
                      <h4>Model Name - <?php echo e($vehicle->model_name); ?></h4>
                      <h4>Category - <?php echo e($vehicle->category); ?></h4>
                      <h4>Capacity - <?php echo e($vehicle->capacity); ?></h4>
                      <h4>Type - <?php echo e($vehicle->fuel_type); ?></h4>
                    </div>
                   </div>
                 </div>
              </div>
             </div>    
          </div> 
        </div>
        <div class="col-md-4 sticky-sidebar" style="position: sticky;top: 0;height: 100vh;overflow-y: auto;">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                 <h3><?php echo e($vehicle->model_name); ?></h3>
                <div class="row">
                  <div class="col-md-12">
                    <h4>Base Price - ₹ <?php echo e($vrate->rate_per_hour); ?>/hr</h4>
                  </div>
                  <div class="col-md-12">
                    <h4>Security Charge - ₹ 250</h4>
                  </div>
                  <div class="col-md-6">
                    <h3 class="card-title">Total Price : </h3>
                  </div>
                  <div class="col-md-6 d-flex justify-content-end">
                    <h4>₹ <?php echo e(($vrate->rate_per_hour * 4) + 250); ?></h4>
                  </div>
                </div>
                <?php if(Auth::check()): ?>
                    <a href="<?php echo e(url('/booking')); ?>/<?php echo e($vehicle->id); ?>" class="btn btn-success">Book Now</a>
                <?php else: ?>
                    <a href="<?php echo e(route('login_register')); ?>" class="btn btn-warning">Log In To Continue</a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
       </div>
      </form>
    </div>
 </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    Vehicles
<?php $__env->stopSection(); ?>

<?php $__env->startSection('hideFooter'); ?>
<!-- This section triggers the footer removal -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/vehicle_details.blade.php ENDPATH**/ ?>