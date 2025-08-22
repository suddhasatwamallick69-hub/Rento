

<?php $__env->startSection('content'); ?>
 <!-- gallery section start -->
 <div class="">
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-md-6">
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
                     <div class="col-md-12">
                      
                     </div>
                  </div>
                 </div>    
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Fill up Your Booking Details</h2>
                        <?php if($errors->any()): ?>
                  <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div style="color: brown;background-color:rgb(253, 179, 179);padding:20px 10px;font-size:19px"><?php echo e($error); ?></div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                        <form action="<?php echo e(route('booking_payments')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            
                            <div class="row">
                                <h3>Your Address</h3>
                                <div class="col-md-12">
                                   <p><textarea name="address" class="form-control" placeholder="Enter Address" id="" cols="10" rows="10"></textarea></p>
                                </div>
                                <div class="col-md-12">
                                    <h3>Area</h3>
                                    <p><textarea name="area" class="form-control" placeholder="Enter Area" id="" cols="5" rows="5"></textarea></p>
                                </div>
                                 <div class="col-md-12">
                                    <h3>Landmark</h3>
                                    <p><textarea name="landmark" class="form-control" placeholder="Enter Landmark" id=""  cols="5" rows="5"></textarea></p>
                                </div>
                                <div class="col-md-6">
                                    <h3>House No</h3>
                                    <p><p><input type="text" name="house_no" class="form-control"></p></p>
                                </div>
                                <div class="col-md-6">
                                    <h3>Pincode </h3>
                                    <p><p><input type="text" name="pincode" class="form-control"></p></p>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                      <h4>Base Price - ₹ <?php echo e($vrate->rate_per_hour); ?>/hr</h4>
                                    </div>
                                    <div class="col-md-12">
                                      <h4>Security Charge - ₹ 450</h4>
                                    </div>
                                    <div class="col-md-6">
                                      <h3 class="card-title">Total Price : </h3>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-end">
                                      <h4>₹ <?php echo e(($vrate->rate_per_hour * $duration) + 450); ?></h4>
                                    </div>
                                    <input type="hidden" name="vid" value="<?php echo e($vehicle->id); ?>">
                                    
                                    <input type="hidden" name="hid" value="<?php echo e($vehicle->oid); ?>">
                                    <input type="hidden" name="pickup_date" value="<?php echo e($pickup); ?>">
                                    <input type="hidden" name="dropoff_date" value="<?php echo e($dropoff); ?>">
                                    <input type="hidden" name="amount" value="<?php echo e(($vrate->rate_per_hour * $duration) + 450); ?>">
                                </div>
                                <div class="col-md-12">
                                    <p><input type="checkbox" name="" id="" required> I hereby agree to the terms and conditions of the Lease Agreement with Host</p>
                                    <p>View <a href="" style="color: red">Terms and Conditions</a></p>
                                    
                                    <?php if(Auth::check()): ?>
                                         <?php if(Auth::user()->is_verified==1): ?>
                                            <p><input type="submit" name="" value="Book and Proceed to Pay" class="btn btn-warning w-100"></p>
                                         <?php else: ?>
                                             <p>Verify your profile before booking</p>
                                             <p><a href="<?php echo e(route('myprofile')); ?>" class="btn btn-primary w-100">Verify Profile</a></p>
                                         <?php endif; ?>
                                    <input type="hidden" name="uid" value="<?php echo e(Auth::user()->id); ?>">
                                        
                                    <?php else: ?>
                                        <a href="<?php echo e(route('login_register')); ?>" class="btn btn-success w-100">Log In To Continue</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php echo e(session('orderId')); ?>

                            <?php echo e(session('paymentcount')); ?>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    Vehicles
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/booking.blade.php ENDPATH**/ ?>