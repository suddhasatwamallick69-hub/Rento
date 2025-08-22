
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
            <div class="col-md-12">
                <h3>My Listed Vehicles</h3>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">List of Vehicles</h5>
                      <p><select name="" id="" class="">  
                            <option value="">--Search--</option>
                            <option value="Admin">Approved</option>
                            <option value="User">Listed</option>
                         </select>
                      </p>
        
                      <!-- Table with stripped rows -->
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Model Name</th>
                            <th scope="col">Approved</th>
                            <th scope="col">Listed</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                                $id=1;
                            ?>
                          <?php $__currentLoopData = $myvehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr>
                            <th scope="row"><?php echo e($id++); ?></th>
                            <td><?php echo e($items->model_name); ?></td>
                            <td><?php echo e($items->approval); ?></td>
                            <td><?php echo e($items->availability); ?></td>
                            <th scope="col"><a href="<?php echo e(url('/host/vehicle_details')); ?>/<?php echo e($items->id); ?>">Details</a></th>
                            <th><a href="">Edit</a></th>
                          </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                      </table>
                      <!-- End Table with stripped rows -->
        
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
   </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('host.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/host/myvehicles.blade.php ENDPATH**/ ?>