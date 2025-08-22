

<?php $__env->startSection('content'); ?>
<main id="main" class="main">

    <div class="pagetitle">
      <h1>List of Vehicles</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('admin_dashboard')); ?>">Home</a></li>
          
          <li class="breadcrumb-item active">List of Vehicles</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of Vehicles</h5>
              <p><select name="" id="" class="">  
                    <option value="">--Search--</option>
                    <option value="Admin">Availability</option>
                    <option value="User">Approval</option>
                 </select>
              </p>

              <!-- Table with stripped rows -->
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Vehicle Name</th>
                    <th scope="col">Vehicle Category</th>
                    <th scope="col">Owner</th>
                    <th scope="col"></th>
                    <th scope="col">Availability</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $list_vehicle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <th scope="row"><?php echo e($items->id); ?></th>
                    <td><?php echo e($items->model_name); ?></td>
                    <td><?php echo e($items->category); ?></td>
                    <td><a href=""><?php echo e($items->name); ?></a></td>
                    <th scope="col"><a href="<?php echo e(url('/admin/vehicle_details')); ?>/<?php echo e($items->id); ?>">Details</a></th>
                    <td><?php echo e($items->availability); ?></td>
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
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/admin/list_vehicle.blade.php ENDPATH**/ ?>