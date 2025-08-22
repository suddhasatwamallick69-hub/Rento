

<?php $__env->startSection('content'); ?>
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Verify Vehicles</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('admin_dashboard')); ?>">Home</a></li>
          
          <li class="breadcrumb-item active">Verify Vehicles</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Verify Vehicles</h5>
              <div class="row">
                <div class="col-md-6">
                  <select name="" id="" class="form-control">
                     <option value="">-Search by Approval-</option>
                     <option value="Yes">Approved</option>
                     <option value="No">Unapproved</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <select name="" id="" class="form-control">
                     <option value="">-Search by Listing-</option>
                     <option value="Yes">Listed</option>
                     <option value="No">Unlisted</option>
                  </select>
                </div>
              </div>

              <!-- Table with stripped rows -->
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Vehicle Name</th>
                    <th scope="col">Owner</th>
                    <th scope="col"></th>
                    <th scope="col">Status</th>
                    <th>Vehcile Listed</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $verify_vehicle2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <th scope="row"><?php echo e($items->id); ?></th>
                    <td><?php echo e($items->model_name); ?></td>
                    <td><a href=""><?php echo e($items->name); ?></a></td>
                    <td><?php if($items->availability && $items->approval): ?>
                      <a href="<?php echo e(url('/admin/vehicle_details')); ?>/<?php echo e($items->id); ?>"  class="btn btn-primary">Verify Details</a>
                    <?php else: ?>
                       <a href="<?php echo e(url('/admin/vehicle_details')); ?>/<?php echo e($items->id); ?>"  class="btn btn-success"> Details</a>
                    <?php endif; ?></td>
                    <td><?php if($items->availability=='No' && $items->approval=='No'): ?>
                       <p class="text-danger">Not Verified</p>
                    <?php else: ?>
                    <p class="text-success">Verified</p>
                    <?php endif; ?></td>
                    <td><?php if($items->availability=='Yes'): ?>
                      <p class="text-success">Vehicle Listed</p>
                   <?php else: ?>
                   <p class="text-primary">Unlisted</p>
                   <?php endif; ?></td>

                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php $__currentLoopData = $verify_vehicle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <th scope="row"><?php echo e($items->id); ?></th>
                    <td><?php echo e($items->model_name); ?></td>
                    <td><a href=""><?php echo e($items->name); ?></a></td>
                    <td><?php if($items->availability && $items->approval): ?>
                      <a href="<?php echo e(url('/admin/vehicle_details')); ?>/<?php echo e($items->id); ?>"  class="btn btn-primary">Verify Details</a>
                    <?php else: ?>
                       <a href="<?php echo e(url('/admin/vehicle_details')); ?>/<?php echo e($items->id); ?>"  class="btn btn-success"> Details</a>
                    <?php endif; ?></td>
                    <td><?php if($items->availability=='No' && $items->approval=='No'): ?>
                       <p class="text-danger">Not Verified</p>
                    <?php else: ?>
                    <p class="text-success">Verified</p>
                    <?php endif; ?></td>
                    <td><?php if($items->availability=='Yes'): ?>
                      <p class="text-success">Vehicle Listed</p>
                   <?php else: ?>
                   <p class="text-primary">Unlisted</p>
                   <?php endif; ?></td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>
        </div>
      </div>
    </section>

  </main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    Verify Vehicle
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/admin/verify_vehicle.blade.php ENDPATH**/ ?>