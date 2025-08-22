

<?php $__env->startSection('content'); ?>
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Verify Vehicles</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('admin_dashboard')); ?>">Home</a></li>
          
          <li class="breadcrumb-item active"> Vehicles</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of Vehicles <a href="" class="btn btn-primary">Refresh</a></h5>
              <div class="row">
                <div class="col-md-4">
                  <select name="approval" id="approval" class="form-control">
                     <option value="">-Search by Approval-</option>
                     <option value="Yes">Approved</option>
                     <option value="No">Unapproved</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <select name="listing" id="listing" class="form-control">
                     <option value="">-Search by Listing-</option>
                     <option value="Yes">Listed</option>
                     <option value="No">Unlisted</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <select name="validity" id="validity" class="form-control">
                     <option value="">-Search by Validity-</option>
                     <option value="Yes">Valid</option>
                     <option value="No">Not Valid</option>
                  </select>
                </div>
                <div class="col-md-12 mt-3">
                  <p><input type="text" class="form-control" placeholder="Search by Hostname" id="search_by_host_name"></p>
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
                    <th>Vehcile Validity</th>
                  </tr>
                </thead>
                <tbody id="results">
                  <?php
                      $id=1;
                  ?>
                  <?php $__currentLoopData = $verify_vehicle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <th scope="row"><?php echo e($id); ?></th>
                    <td><?php echo e($items->model_name); ?></td>
                    <td><a href=""><?php echo e($items->name); ?></a></td>
                    <td><?php if($items->availability=='No' || $items->approval=='No'): ?>
                      <a href="<?php echo e(url('/admin/vehicle_details')); ?>/<?php echo e($items->id); ?>"  class="btn btn-primary">Verify Details</a>
                    <?php else: ?>
                       <a href="<?php echo e(url('/admin/vehicle_details')); ?>/<?php echo e($items->id); ?>"  class="btn btn-success"> Details</a>
                    <?php endif; ?></td>
                    <td><?php if($items->availability=='No' && $items->approval=='No'): ?>
                       <p class="badge bg-danger">Not Verified</p>
                    <?php else: ?>
                    <p class="badge bg-success">Verified</p>
                    <?php endif; ?></td>
                    <td><?php if($items->availability=='Yes'): ?>
                            <p class="text-success">Vehicle Listed</p>
                        <?php else: ?>
                            <p class="badge bg-danger">Unlisted</p>
                        <?php endif; ?>
                    </td>
                    <td>
                      <?php
                        date_default_timezone_set('Asia/Kolkata');
                        $current_date = date("Y-m-d");
                      ?>
                      <?php if($current_date>=$items->validity_date): ?>
                           <span class="badge bg-danger">Vehicle Invalid</span>
                      <?php else: ?>
                          <span>Vehicle Valid</span>
                      <?php endif; ?>
                    </td>
                  </tr>
                  <?php
                      $id++;
                  ?>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script>
    $(document).ready(function () 
    {
             $('#approval').on('change', function () 
             {
                 var selectedValue = $(this).val();
                 console.log(selectedValue);
                 $.ajax({
                     url: "<?php echo e(route('admin_search_by_approval')); ?>",
                     method: "GET",
                     data: {approval: selectedValue,
                     },
                     success: function (response) {
                      $('#results').html(response); // Update with filtered results
                      console.log(response);
                     }
                 });
             });

             $('#listing').on('change', function () 
             {
                 var selectedValue = $(this).val();
                 console.log(selectedValue);
                 $.ajax({
                     url: "<?php echo e(route('admin_search_by_listing')); ?>",
                     method: "GET",
                     data: {listing: selectedValue,
                     },
                     success: function (response) {
                      $('#results').html(response); // Update with filtered results
                      console.log(response);
                     }
                 });
             });

             $('#validity').on('change', function () 
             {
                 var selectedValue = $(this).val();
                 console.log(selectedValue);
                 $.ajax({
                     url: "<?php echo e(route('admin_search_by_validity')); ?>",
                     method: "GET",
                     data: {validity: selectedValue,
                     },
                     success: function (response) {
                      $('#results').html(response); // Update with filtered results
                      console.log(response);
                     }
                 });
             });

             $('#search_by_host_name').on('input',function() {  
                    var search = $(this).val();
                    console.log(search);
                    if (search.length>0) {
                      console.log(search.length);
                      $.ajax({
                          url: "<?php echo e(route('admin_search_by_host_name')); ?>",
                          type: 'GET',
                          data: { input: search },
                          success: function(response) {
                              $('#results').html(response);
                          }
                      });
                    }
                   else if(search.length==0)
                   {
                       console.log(search.length);
                       $.ajax({
                           url: '<?php echo e(route('admin_search_by_host_name')); ?>',
                           type: 'GET',
                           data: { input_none: search },
                           success: function(response) {
                               $('#results').html(response);
                           }
                       });
                   }
              });
    });
  </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    Verify Vehicle
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/admin/manage_vehicle.blade.php ENDPATH**/ ?>