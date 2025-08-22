

<?php $__env->startSection('content'); ?>
<div class="layout_padding">
    <div class="container-fluid">
       <div class="about_section_2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>My Bookings <i class="bi bi-car-front-fill"></i></h3>
                    <hr>
                </div>
                <div class="col-lg-12" style="padding-top:20px;padding-bottom:30px;max-height: 80vh;overflow-y: auto;scroll-behavior: smooth;scrollbar-width:none; scrollbar-color: #888 transparent;">
                    <?php
                        $count=1;
                    ?>
                    <?php $__currentLoopData = $upcomingBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                        <a href="<?php echo e(url("/trip")); ?>/<?php echo e($item->id); ?>">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h2 class="card-title">Booking Date - <?php echo e($booking_date); ?></h2>
                                        </div>
                                        <div class="col-lg-6 d-flex justify-content-end">
                                            <?php $__currentLoopData = $booking_status[$item->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <h2>BOOKING ID : <?php echo e($i->booking_reference); ?></h2>
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
                                            </div>
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <h3>Pickup Date</h3>
                                                        <h1><?php echo e($pickup_date); ?></h1>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h3>Duration</h3>
                                                        <h1><?php echo e($duration_in_days); ?> <?php echo e($duration_in_hours); ?></h1>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h3>Dropoff Date</h3>
                                                        <h1><?php echo e($dropoff_date); ?></h1>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <?php if($currentDateTime>=$item->pickup_date && $currentDateTime<=$item->dropoff_date): ?>
                                                            <p><a href="" class="btn btn-danger">Trip Live</a></p>
                                                            
                                                        <?php elseif($currentDateTime<$item->pickup_date): ?>
                                                            <p class="btn btn-warning"><i class="bi bi-car-front-fill"></i> Trip Upcoming</p>
                                                                
                                                        <?php else: ?>
                                                            <p><a href="" class="btn btn-success">Trip Ended</a></p>
                                                        <?php endif; ?>
                                                        <?php $__currentLoopData = $booking_status[$item->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($i->status=='Verified'): ?>
                                                                    <p class="btn btn-success">Verified</p>
                                                                <?php endif; ?>
                                                                <?php if($i->status=='ended'): ?>
                                                                    <p class="btn btn-primary">Vehicle returned</p>
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
        </div>
       </div>
    </div>
 </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('hideFooter'); ?>
<!-- This section triggers the footer removal -->
<?php $__env->stopSection(); ?>







<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/mybookings.blade.php ENDPATH**/ ?>