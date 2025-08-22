

<?php $__env->startSection('content'); ?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Vehicle Category</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('admin_dashboard')); ?>">Home</a></li>
          
          <li class="breadcrumb-item active">add vehicle category</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Vehicle Category</h5>

              <!-- Floating Labels Form -->
              <form class="row g-3" action="<?php echo e(route('vehicle_category_submit')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="col-md-12">
                  <div class="form-floating mb-3">
                    <select class="form-select" name="parent_id" id="floatingSelect" aria-label="Parent Category">
                      <option selected>--Select Parent Category--</option>
                      <option value="0">Parent Category</option>
                      <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      
                    </select>
                    <label for="floatingSelect">Parent Category</label>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" name="name" class="form-control" id="floatingName" placeholder="Your Name">
                    <label for="floatingName">Category Name</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating">
                    <textarea class="form-control" name="description" placeholder="Address" id="floatingTextarea" style="height: 100px;"></textarea>
                    <label for="floatingTextarea">Category Description</label>
                  </div>
                </div>
                <div class="col-md-12">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Category Image Upload</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" name="image" multiple id="formFile">
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End floating Labels Form -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    Admin Add Category
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/admin/add_vehicle_category.blade.php ENDPATH**/ ?>