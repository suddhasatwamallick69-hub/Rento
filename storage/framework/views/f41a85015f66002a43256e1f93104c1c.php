

<?php $__env->startSection('content'); ?>
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Approve Vehicle Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('admin_dashboard')); ?>">Home</a></li>
          <li class="breadcrumb-item">Approve Vehicle Details</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-6">
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
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                    <?php if($vehicle_details->name=='Admin'): ?>
                          <h5 class="card-title">Details - <?php echo e($vehicle_details->model_name); ?></h5>
                          <p>Owner - <?php echo e($vehicle_details->name); ?></p>
                          <p>Owner Email - <?php echo e($vehicle_details->email); ?></p>
                          <p>Owner Phone Number - <?php echo e($vehicle_details->phone_number); ?></p>
                          <p>Address - <?php echo e($vehicle_details->address); ?></p>
                          <p>Vehicle Category - <?php echo e($vehicle_details->category); ?></p>
                          <p>Vehicle Fuel Type - <?php echo e($vehicle_details->fuel_type); ?></p>
                          <p>Vehicle Registration Number - <?php echo e($vehicle_details->registration_number); ?></p>
                          <p>Availability - <?php echo e($vehicle_details->availability); ?></p>
                          <p>Approval - <?php echo e($vehicle_details->approval); ?></p>
                    <?php else: ?>
                       <h4 class="card-title"><a href="<?php echo e(url("/host_vehicle_resources")); ?>/<?php echo e($vehicle_details->registration_certificate); ?>" target="_blank">Registration Certificate</a></h4>
                       <h4 class="card-title"><a href="<?php echo e(url("/host_vehicle_resources")); ?>/<?php echo e($vehicle_details->aadhar_card); ?>" target="_blank">Aadhar Card</a></h4>
                       <h4 class="card-title"><a href="<?php echo e(url("/host_vehicle_resources")); ?>/<?php echo e($vehicle_details->driving_license); ?>" target="_blank">Driving License</a></h4>
                       <h5 class="card-title">Details - <?php echo e($vehicle_details->model_name); ?></h5>
                          <p>Owner - <?php echo e($vehicle_details->name); ?></p>
                          <p>Owner Email - <?php echo e($vehicle_details->email); ?></p>
                          <p>Owner Phone Number - <?php echo e($vehicle_details->phone_number); ?></p>
                          <p>Address - <?php echo e($vehicle_details->address); ?></p>
                          <p>Vehicle Category - <?php echo e($vehicle_details->category); ?></p>
                          <p>Vehicle Fuel Type - <?php echo e($vehicle_details->fuel_type); ?></p>
                          <p>Vehicle Registration Number - <?php echo e($vehicle_details->registration_number); ?></p>
                          <p>Availability - <?php echo e($vehicle_details->availability); ?></p>
                          <p>Approval - <?php echo e($vehicle_details->approval); ?></p>
                    <?php endif; ?>
                    <p><input type="submit" class="btn btn-success" value="Approve"></p>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </section>

  </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/admin/approvevehicle.blade.php ENDPATH**/ ?>