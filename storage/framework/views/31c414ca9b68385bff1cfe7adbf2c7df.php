
<?php $__env->startSection('content'); ?>
 <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Welcome Host <?php echo e(Auth::user()->name); ?></h3>
            <p>Logout to return as User</p>
            <h6 class="font-weight-normal mb-0">
              
            </h6>
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
      </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>My Bookings <i class="bi bi-car-front-fill"></i></h3>
            <hr>
        </div>
        <div class="col-lg-12" style="padding-top:20px;padding-bottom:30px;max-height: 80vh;overflow-y: auto;scroll-behavior: smooth;scrollbar-width:none; scrollbar-color: #888 transparent;">
            <?php
                $count=1;
            ?>
            <?php $__currentLoopData = $Bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <?php
                   $booking_date = date('d M Y', strtotime($item->booking_date));
                   $pickup_date = date('d M, g:i A', strtotime($item->pickup_date));
                   $dropoff_date = date('d M, g:i A', strtotime($item->dropoff_date));
                   $pickup_obj=new DateTime($pickup_date);
                   $dropoff_obj=new DateTime($dropoff_date);
                   $duration = $pickup_obj->diff($dropoff_obj);
                   $duration_in_days = $duration->format('%d days');
                   $duration_in_hours = $duration->format('%h hours');
               ?>
                <h2> <?php echo e($count); ?></h2>
                <a href="">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h2 class="card-title">Booking Date - <?php echo e($booking_date); ?></h2>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-end">
                                    <?php $__currentLoopData = $booking_status[$item->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <h3>BOOKING ID : <?php echo e($i->booking_reference); ?></h3>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            
                            <?php $__currentLoopData = $vehicle[$item->vid]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $images=$i->images;
                                $images=explode(",",$images);
                                $carouselId = "carousel_".$i->id;
                                ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div id="<?php echo e($carouselId); ?>" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                              
                                              <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="carousel-item <?php if($index == 0): ?> active <?php endif; ?>">
                                                   <a href="<?php echo e(url("/vehicle_images")); ?>/<?php echo e($img); ?>" target="blank"> <img src="<?php echo e(url("/vehicle_images")); ?>/<?php echo e($img); ?>" style="height: 220px" class="d-block w-100" alt="..."></a>
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

                                        <h3>Model name - <?php echo e($i->model_name); ?></h3>
                                        <h3>Registratioon Number - <?php echo e($i->registration_number); ?></h3>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h3>Pickup Date</h3>
                                                <h3><?php echo e($pickup_date); ?></h3>
                                            </div>
                                            <div class="col-md-4">
                                                <h3>Duration</h3>
                                                <h3><?php echo e($duration_in_days); ?> <?php echo e($duration_in_hours); ?></h3>
                                            </div>
                                            <div class="col-md-4">
                                                <h3>Dropoff Date</h3>
                                                <h3><?php echo e($dropoff_date); ?></h3>
                                            </div>
                                            <div class="col-md-4">
                                                <?php if($currentDateTime>=$item->pickup_date && $currentDateTime<=$item->dropoff_date): ?>
                                                    <p><a href="" class="btn btn-danger">Trip Live</a></p>
                                                <?php elseif($currentDateTime<$item->pickup_date): ?>
                                                    <p class="btn btn-warning"><i class="bi bi-car-front-fill"></i> Trip Upcoming</p>
                                                    <p><a href="" class="btn btn-primary">View Details</a></p>
                                                <?php else: ?>
                                                    <p><a href="" class="btn btn-success">Trip Ended</a></p>
                                                    <p><a href="" class="btn btn-primary">View Details</a></p>
                                                <?php endif; ?>
                                                <?php $__currentLoopData = $booking_status[$item->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                         <?php if($i->status=='Verified'): ?>
                                                             <p class="btn btn-warning">Verfied</p>
                                                             <form action="<?php echo e(route('end_trip_otp')); ?>" method="post">
                                                                <?php echo csrf_field(); ?>
                                                                <input type="hidden" name="uid" value="<?php echo e($item->uid); ?>">
                                                                <input type="hidden" name="id" value="<?php echo e($item->id); ?>">
                                                            <p><input type="submit" class="btn btn-warning" value="Return Vehicle"></p>
                                                            </form>
                                                         <?php elseif($i->status=='ended'): ?>
                                                             <p class="btn btn-warning">Ended</p>
                                                         <?php else: ?>
                                                            <form action="<?php echo e(route('authenticate_client')); ?>" method="get">
                                                               <?php echo csrf_field(); ?>
                                                               <input type="hidden" name="uid" value="<?php echo e($item->uid); ?>">
                                                               <input type="hidden" name="id" value="<?php echo e($item->id); ?>">
                                                           <p><input type="submit" class="btn btn-warning" value="Verify User"></p>
                                                           </form>
                                                         <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </a>
                <?php
                    $count++;
                ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('host.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/host/bookings.blade.php ENDPATH**/ ?>