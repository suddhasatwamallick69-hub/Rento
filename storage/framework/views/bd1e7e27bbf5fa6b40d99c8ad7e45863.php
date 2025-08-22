<!DOCTYPE html>
<html>
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title><?php echo $__env->yieldContent('title','Rento'); ?></title>
      <meta name="keywords" content="">
      <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/style.css')); ?>">
      <!-- Responsive-->
      <link rel="stylesheet" href="<?php echo e(asset('css/responsive.css')); ?>">
      <!-- fevicon -->
      <link rel="icon" href="<?php echo e(asset('images/favicon.png')); ?>" type="image/gif" />
      <!-- font css -->
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Raleway:wght@400;500;600;700;800&display=swap" rel="stylesheet">
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="<?php echo e(asset('css/jquery.mCustomScrollbar.min.css')); ?>">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      

      
      <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
      
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
      <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
      <link rel="stylesheet" href="https://unpkg.com/maplibre-gl@2.4.0/dist/maplibre-gl.css" />
  <!-- Geoapify Autocomplete CSS -->
  <link rel="stylesheet" href="https://unpkg.com/@geoapify/geocoder-autocomplete/styles/minimal.css" />
  <link rel="stylesheet" href="https://unpkg.com/@geoapify/geocoder-autocomplete/styles/minimal.css" />

  <link href="https://unpkg.com/maplibre-gl@2.4.0/dist/maplibre-gl.css" rel="stylesheet" />
  <script src="https://unpkg.com/maplibre-gl@2.4.0/dist/maplibre-gl.js"></script>
     

      
      <style>
  .scrollable::-webkit-scrollbar {
    width: 8px;
  }
   </style>
   <style>

      .suggestions {
        border: 1px solid #f1f1f1;
        width: 300px;
        /* max-height: 200px; */
        overflow-y: auto;
        background-color: white;
        z-index: 1000;
      }
   
      .suggestion {
        padding: 8px;
        cursor: pointer;
      }
   
      .suggestion:hover {
        background-color: #f0f0f0;
      }
    </style>
   </head>
   <body>
      <!-- header section start -->
      <?php echo $__env->make('partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- header section end -->
      <?php echo $__env->yieldContent('content'); ?>
      <!-- footer section start -->
      <?php if (! empty(trim($__env->yieldContent('hideFooter')))): ?>
      <style>
         body{
            overflow: hidden;
         }
      </style>
        <!-- Footer will be hidden if 'hideFooter' section is defined -->
       <?php else: ?>
         <?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php endif; ?>
      
      <!-- footer section end -->
      <!-- copyright section start -->
      <!-- copyright section end -->
      <!-- Javascript files-->
      
      <script src="<?php echo e(asset('js/popper.min.js')); ?>"></script>
      <script src="<?php echo e(asset('js/bootstrap.bundle.min.js')); ?>"></script>
      <script src="<?php echo e(asset('js/jquery-3.0.0.min.js')); ?>"></script>
      
      <!-- sidebar -->
      <script src="<?php echo e(asset('js/jquery.mCustomScrollbar.concat.min.js')); ?>"></script>
      <script src="<?php echo e(asset('js/custom.js')); ?>"></script>
   </body>
</html><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/layouts/app.blade.php ENDPATH**/ ?>