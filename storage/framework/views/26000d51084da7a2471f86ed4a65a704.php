

<?php $__env->startSection('content'); ?>
<main id="main" class="main">
                            <?php
                             $previousRoute = session('previous_route', '');
                          ?>
    <div class="pagetitle">
      <?php if($previousRoute === 'verify_vehicle'): ?>
      <h1>Verify Vehicle Details</h1>
      <?php else: ?>
      <h1>Vehicle Details</h1>
      <?php endif; ?>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('admin_dashboard')); ?>">Home</a></li>
          <li class="breadcrumb-item">Vehicle Details</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
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
            <div class="col-lg-12">
              <div class="card">
                  <div class="card-body">
                     <h3 class="card-title">Edit Vehicle Details</h3>
                      <form action="<?php echo e(route('admin_update_vehicle')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                          <label>RC certificate (JPG,JPEG)</label>
                          <input type="file" name="registration_certificate" class="form-control">
                        </div>
                        <p>Registration Certificate - <a href="<?php echo e(url("/host_vehicle_resources")); ?>/<?php echo e($vehicle_details->registration_certificate); ?>" target="_blank"><img src="<?php echo e(url("/host_vehicle_resources")); ?>/<?php echo e($vehicle_details->registration_certificate); ?>" width="100"></a></p>
                        <p>Registration Number - <input type="text" value="<?php echo e($vehicle_details->registration_number); ?>" name="registration_number"></p>

                        <p>Registration Date - <input type="date" value="<?php echo e($vehicle_details->registration_date); ?>" name="registration_date"></p>

                        <p>Registration Validity date - <input type="date" value="<?php echo e($vehicle_details->validity_date); ?>" name="validity_date"></p>

                        <p><input type="hidden" name="vid" value="<?php echo e($vehicle_details->id); ?>"></p>

                        <p><input type="submit" value="Update" class="btn btn-primary"></p>

                      </form>
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
                                 <h3 class="text-danger">Vehicle InValid !! Validity Date exceeded</h3>
                            <?php endif; ?>
                            <?php
                            $registration_date = date('dS M Y', strtotime($vehicle_details->registration_date));
                            $validity_date = date('dS M Y,', strtotime($vehicle_details->validity_date));
                            date_default_timezone_set('Asia/Kolkata');
                            $current_date = date("Y-m-d");
                          ?>
                      <form action="<?php echo e(route('approvevehicle')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                          <h5 class="card-title">Details - <?php echo e($vehicle_details->model_name); ?></h5>
                          <p>Owner - <?php echo e($vehicle_details->name); ?></p>
                          <p>Owner Email - <?php echo e($vehicle_details->email); ?></p>
                          <p>Owner Phone Number - <?php echo e($vehicle_details->phone_number); ?></p>
                          <p>Address - <?php echo e($vehicle_details->address); ?></p>
                          <p>Vehicle Category - <?php echo e($vehicle_details->category); ?></p>
                          <p>Vehicle Fuel Type - <?php echo e($vehicle_details->fuel_type); ?></p>
                          <p>Vehicle Registration Number - <?php echo e($vehicle_details->registration_number); ?></p>
                          <p>Vehicle Registration Date - <?php echo e($registration_date); ?></p>
                          <p>Validity till - <?php echo e($validity_date); ?></p>
                          <p>Availability - <?php echo e($vehicle_details->availability); ?></p>
                          <p>Approval - <?php echo e($vehicle_details->approval); ?></p>
                          <p><input type="hidden" name="vid" value="<?php echo e($vehicle_details->id); ?>"></p>
                          <p><input type="hidden" name="approval" value="<?php echo e($vehicle_details->approval); ?>"></p>
                          <p><input type="hidden" name="availability" value="<?php echo e($vehicle_details->availability); ?>"></p>
                          


                          <?php if($previousRoute === 'manage_vehicle' || $previousRoute === 'admin_dashboard'): ?>
                          <?php if($vehicle_details->availability=='No' && $vehicle_details->approval=='No'): ?>
                              <p><input type="submit" class="btn btn-primary" value="Approve"></p>
                          <?php elseif($vehicle_details->availability=='No'): ?>
                              <p class="text-success">Verified</p>
                              <p><input type="submit" class="btn btn-primary" value="List this vehicle"></p>
                          <?php elseif($vehicle_details->availability=='Yes'): ?>
                              <p class="text-success">Verified</p>
                              <p class="text-success">Vehicle Listed</p>
                              <p><input type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')" value="Unlist this vehicle"></p>
                          <?php else: ?>
                              <p class="text-success">Verified</p>
                              <p><input type="submit" class="btn btn-primary" value="List this vehicle"></p>
                          <?php endif; ?>
                         <?php endif; ?>  
                      </form>
                  </div>
                </div>
            </div>
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body"> 
                    
                    <form action="<?php echo e(route('set_price')); ?>" method="post">
                      <?php echo csrf_field(); ?>
                        <p class="card-title">Set Price per hour (Rs)</p>
                        <p><input type="text" name="price" value="<?php echo e($vehicle_rate); ?>"></p>
                        <p><input type="hidden" name="vid" value="<?php echo e($vehicle_details->id); ?>"></p>
                        <p><input type="submit" value="Set Price"></p>
                    </form>
                </div>
              </div>
            </div>
        </div>
      </div>
    </section>

  </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/admin/vehicle_details.blade.php ENDPATH**/ ?>