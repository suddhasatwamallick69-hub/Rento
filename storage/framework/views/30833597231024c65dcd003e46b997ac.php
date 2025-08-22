<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Rento Host</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?php echo e(asset('host_assets/vendors/feather/feather.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('host_assets/vendors/ti-icons/css/themify-icons.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('host_assets/vendors/css/vendor.bundle.base.css')); ?>">
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- endinject -->
  <!-- Plugin css for this page -->
  
  
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo e(asset('host_assets/css/vertical-layout-light/style.css')); ?>">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo e(asset('host_assets/images/favicon.png')); ?>" />
  <link rel="stylesheet" href="https://unpkg.com/maplibre-gl@2.4.0/dist/maplibre-gl.css" />
  <!-- Geoapify Autocomplete CSS -->
  <link rel="stylesheet" href="https://unpkg.com/@geoapify/geocoder-autocomplete/styles/minimal.css" />
  <link rel="stylesheet" href="https://unpkg.com/@geoapify/geocoder-autocomplete/styles/minimal.css" />

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php echo $__env->make('host.partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <?php echo $__env->make('host.partials.settings_panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <?php echo $__env->make('host.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- partial -->
      <div class="main-panel">
        <?php echo $__env->yieldContent('content'); ?>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php echo $__env->make('host.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="<?php echo e(asset('host_assets/vendors/js/vendor.bundle.base.js')); ?>"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="<?php echo e(asset('host_assets/vendors/chart.js/Chart.min.js')); ?>"></script>
  <script src="<?php echo e(asset('host_assets/vendors/datatables.net/jquery.dataTables.js')); ?>"></script>
  
  <script src="<?php echo e(asset('host_assets/js/dataTables.select.min.js')); ?>"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="<?php echo e(asset('host_assets/js/off-canvas.js')); ?>"></script>
  <script src="<?php echo e(asset('host_assets/js/hoverable-collapse.js')); ?>"></script>
  <script src="<?php echo e(asset('host_assets/js/template.js')); ?>"></script>
  <script src="<?php echo e(asset('host_assets/js/settings.js')); ?>"></script>
  <script src="<?php echo e(asset('host_assets/js/todolist.js')); ?>"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?php echo e(asset('host_assets/js/dashboard.js')); ?>"></script>
  <script src="<?php echo e(asset('host_assets/js/Chart.roundedBarCharts.js')); ?>"></script>
  <!-- End custom js for this page-->
  
</body>

</html>

<?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/host/layouts/app.blade.php ENDPATH**/ ?>