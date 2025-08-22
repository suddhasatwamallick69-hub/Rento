

<?php $__env->startSection('content'); ?>
<main id="main" class="main">

    <div class="pagetitle">
      <h1>List of Vehicle Category</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('admin_dashboard')); ?>">Home</a></li>
          
          <li class="breadcrumb-item active">List of Vehicle Category</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of Vehicle Category</h5>

              <!-- Table with stripped rows -->
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Parent Category</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Description</th>
                    <th scope="col">DELETE</th>
                    <th scope="col">EDIT</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                  <tr>
                    <th scope="row"><?php echo e($l->id); ?></th>
                    <td>
                        <?php if($l->parent_id == 0): ?>
                        <?php echo e('-------'); ?>

                        
                    <?php else: ?>
                    <?php
                    $parent_id=$l->parent_id;
                    $parent_name = DB::table('vehicle_categories')->where('id','=',$parent_id)->get();
                    // echo $parent_id;

                    ?>
                    <?php $__currentLoopData = $parent_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($name->name); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                    
                        
                      <?php endif; ?>
                    </td>
                    <td><?php echo e($l->name); ?></td>
                    <td><img src="<?php echo e(url("/Vehicle_category_image")); ?>/<?php echo e($l->image); ?>" style="width:100px"></td>
                    <td><?php echo e($l->description); ?></td>
                    <td><?php if($l->parent_id == 0): ?>
                        <?php echo e('Cannot delete parent category'); ?>

                        
                    <?php else: ?>
                    <a href="" onclick="return confirm('Are you sure??')">delete</a>
                    
                      <?php endif; ?></td>
                    <th><a href="">edit</a></th>
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
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/admin/view_category.blade.php ENDPATH**/ ?>