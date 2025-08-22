

<?php $__env->startSection('content'); ?>
<div class="layout_padding">
    <div class="container-fluid">
       <div class="about_section_2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>My Trip <i class="bi bi-car-front-fill"></i></h3>
                    <hr>
                       <?php
                           $booking_date = date('d M Y', strtotime($Booking->booking_date));
                           $pickup_date = date('d M, g:i A', strtotime($Booking->pickup_date));
                           $dropoff_date = date('d M, g:i A', strtotime($Booking->dropoff_date));
                           $pickup_obj=new DateTime($pickup_date);
                           $dropoff_obj=new DateTime($dropoff_date);
                           $duration = $pickup_obj->diff($dropoff_obj);
                           $duration_in_days = $duration->format('%d days');
                           $duration_in_hours = $duration->format('%h hours');
                       ?>
                </div>
                <div class="col-lg-12" style="padding-top:20px;padding-bottom:30px;max-height: 80vh;overflow-y: auto;scroll-behavior: smooth;scrollbar-width:none; scrollbar-color: #888 transparent;">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h2 class="card-title">Booking Date - <?php echo e($booking_date); ?></h2>
                                    </div>
                                    <div class="col-lg-6 d-flex justify-content-end">
                                                <h2>BOOKING ID : <?php echo e($booking_status->booking_reference); ?></h2>
                                    </div>
                                </div>
                                    <?php
                                    $images=$vehicle->images;
                                    $images=explode(",",$images);
                                    $carouselId = "carousel_".$vehicle->id;
                                    ?>
                                    <div class="row">
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
                                                    <?php if($currentDateTime>=$Booking->pickup_date && $currentDateTime<=$Booking->dropoff_date): ?>
                                                        <p><a href="" class="btn btn-danger">Trip Live</a></p>
                                                        <?php if($booking_status->status=='confirmed'): ?>
                                                        <p>Confirmed. <span class="text-primary">To be Verified....</span></p>
                                                        <?php elseif($booking_status->status=='verified'): ?>
                                                            <p>Confirmed & Verified. <span class="text-primary">Good to Go...</span></p>
                                                        <?php endif; ?>
                                                    <?php elseif($currentDateTime<$Booking->pickup_date): ?>
                                                        <p class="btn btn-warning"><i class="bi bi-car-front-fill"></i> Trip Upcoming</p>
                                                        <p><a href="" class="btn btn-primary">View Details</a></p>
                                                    <?php else: ?>
                                                        <p><a href="" class="btn btn-success">Trip Ended</a></p>
                                                        <p><a href="" class="btn btn-primary">View Details</a></p>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-md-4">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/trip.blade.php ENDPATH**/ ?>