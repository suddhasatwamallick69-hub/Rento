
<?php $__env->startSection('content'); ?>
 <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Welcome Host <?php echo e(Auth::user()->name); ?></h3>
          </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="col-lg-12">
                    <div class="card">
                      <div class="card-body">
                          <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                              <div class="carousel-inner">
                                
                                <?php
                                    $images=$vehicle_details->images;
                                    $images=explode(",",$images);
                                    $active='active';
                                ?>
                                <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <div class="carousel-item <?php echo e($active); ?>">
                                    <img src="<?php echo e(url("/vehicle_images")); ?>/<?php echo e($img); ?>" class="d-block w-100" alt="...">
                                  </div>
                                  
                                  <?php echo e($active=''); ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </div>
                              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                              </button>
                              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                              </button>
                          </div>
                      </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if($vehicle_details->name=='Admin'): ?>
                                <p>Owner - <?php echo e($vehicle_details->name); ?></p>
                            <?php else: ?>
                            <h4 class="card-title"><a href="<?php echo e(url("/host_vehicle_resources")); ?>/<?php echo e($vehicle_details->registration_certificate); ?>" target="_blank">Registration Certificate</a></h4>
                            <h4 class="card-title"><a href="<?php echo e(url("/host_vehicle_resources")); ?>/<?php echo e($vehicle_details->pollution_certificate); ?>" target="_blank">Pollution Certificate</a></h4>
                            <?php endif; ?>      
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="col-lg-12">
                    <div class="card">
                      <div class="card-body">
                        <?php
                        date_default_timezone_set('Asia/Kolkata');
                        $current_date = date("Y-m-d");
                        ?>
                            <?php if($current_date==$vehicle_details->validity_date): ?>
                                 <h3 class="text-danger">Vehicle Not Valid, Renew your validity</h3>
                            <?php endif; ?>
                              <h5 class="card-title">Details - <?php echo e($vehicle_details->model_name); ?></h5>
                              <h4>Owner - <?php echo e($vehicle_details->name); ?></h4>
                              <h4>Owner Email - <?php echo e($vehicle_details->email); ?></h4>
                              <h4>Owner Phone Number - <?php echo e($vehicle_details->phone_number); ?></h4>
                              <h4>Address - <?php echo e($vehicle_details->address); ?></h4>
                              <h4>Vehicle Category - <?php echo e($vehicle_details->category); ?></h4>
                              <h4>Vehicle Fuel Type - <?php echo e($vehicle_details->fuel_type); ?></h4>
                              <?php
                                 $registration_date = date('dS M Y', strtotime($vehicle_details->registration_date));
                                 $validity_date = date('dS M Y,', strtotime($vehicle_details->validity_date));
                                 date_default_timezone_set('Asia/Kolkata');
                                 $current_date = date("Y-m-d");
                              ?>
                              <h4>Vehicle Registration Number - <?php echo e($vehicle_details->registration_number); ?></h4>
                              <h3>Registration Date - <?php echo e($registration_date); ?></h3>
                              <h3>Valid till - <?php echo e($validity_date); ?></h3>
                              <h4>Availability - <?php echo e($vehicle_details->availability); ?></h4>
                              <h4>Approval - <?php echo e($vehicle_details->approval); ?></h4>
                      </div>
                    </div>
                </div>
                
            </div>
          </div>
      </div>
    </div>
   </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('host.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/host/vehicle_details.blade.php ENDPATH**/ ?>