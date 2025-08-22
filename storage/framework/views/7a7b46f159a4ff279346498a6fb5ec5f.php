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
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
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
   </head>
   <body>
      <!-- header section start -->
      <?php echo $__env->make('partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- header section end -->
      <?php echo $__env->yieldContent('content'); ?>
      <!-- footer section start -->
      <?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- footer section end -->
      <!-- copyright section start -->
      <div class="copyright_section">
         <div class="container">
            <div class="row">
               <div class="col-sm-12">
                  <p class="copyright_text">All Rights Reserved.<a href="">Rento</a></p>
               </div>
            </div>
         </div>
      </div>
      <!-- copyright section end -->
      <!-- Javascript files-->
      <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
      <script src="<?php echo e(asset('js/popper.min.js')); ?>"></script>
      <script src="<?php echo e(asset('js/bootstrap.bundle.min.js')); ?>"></script>
      <script src="<?php echo e(asset('js/jquery-3.0.0.min.js')); ?>"></script>
      <script src="<?php echo e(asset('js/plugin.js')); ?>"></script>
      <!-- sidebar -->
      <script src="<?php echo e(asset('js/jquery.mCustomScrollbar.concat.min.js')); ?>"></script>
      <script src="<?php echo e(asset('js/custom.js')); ?>"></script>
   </body>
</html><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views////layouts/app.blade.php ENDPATH**/ ?>