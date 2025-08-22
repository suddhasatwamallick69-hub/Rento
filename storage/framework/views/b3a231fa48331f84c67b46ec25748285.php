

<?php $__env->startSection('content'); ?>
 
 <div class="container-fluid">
   <div class="row">
      <div class="col-md-2 text-dark p-4 border-end border-4">
         <h3>Filter Vehicles</h3>
         <form id="filterForm">
             <div class="form-group">
                 <label for="carType">Vehicle Type:</label>
                 <div>
                  <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <h3><?php echo e($category->name); ?></h3>
                       <?php $__currentLoopData = $subcategories[$category->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <input type="checkbox" class="form-check-input search_category" id="search_category" name="categories[]" value="<?php echo e($subcategory->name); ?>">   <?php echo e($subcategory->name); ?><br>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                        
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     
                     
                 </div>
             </div>

             <div class="form-group mt-3">
                <label for="fuelType">Delivery Type:</label>
                <div>
                    <input type="checkbox" class="form-check-input" name="fuelType" value="Home Delivery"> Home Delivery<br>
                </div>
             </div>
      
             <div class="form-group mt-3">
                 <label for="fuelType">Fuel Type:</label>
                 <div>
                     <input type="checkbox" class="form-check-input" name="fuelType" value="Petrol"> Petrol<br>
                     <input type="checkbox" class="form-check-input" name="fuelType" value="Diesel"> Diesel<br>
                     <input type="checkbox" class="form-check-input" name="fuelType" value="Electric"> Electric<br>
                 </div>
             </div>
      
             
         </form>
      </div>
       <!-- gallery section start -->
       <div class="col-md-10">
               <div class="container pt-4">
                  <?php if($errors->any()): ?>
                   <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <div class="alert alert-danger mt-2"><?php echo e($error); ?></div>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   <?php endif; ?>
                <form action="<?php echo e(route('ins_search')); ?>" method="get">
                    
                  <div class="row"> 
                     <div class="col-md-4">
                       <p><input type="datetime-local" name="pickup" value="<?php echo e($pickup); ?>" class="form-control" placeholder="Search..."></p>
                     </div>
                     <div class="col-md-4">
                       <p><input type="datetime-local" name="dropoff" value="<?php echo e($dropoff); ?>" class="form-control" placeholder="Search..."></p>
                     </div>
                     <div class="col-md-4">
                        <p><input type="submit" value="Set" class="btn btn-warning"></p>
                     </div>
                  </div>
                </form>
               </div>
               <div class="container">
                <div class="row" id="results">
                    <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                       $images=$item->images;
                       $images=explode(",",$images);
                       $carouselId = "carousel_".$item->id;
                    ?>
                    <div class="col-md-4">
                        <form action="<?php echo e(route('booking')); ?>" method="get">
                            
                       <div class="gallery_box">
                          <div class="gallery_img">
                             <div id="<?php echo e($carouselId); ?>" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                  
                                  <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="carousel-item <?php if($index == 0): ?> active <?php endif; ?>">
                                       <a href="<?php echo e(url("/vehicle_images")); ?>/<?php echo e($img); ?>" target="blank"> <img src="<?php echo e(url("/vehicle_images")); ?>/<?php echo e($img); ?>" class="d-block w-100" alt="..."></a>
                                    </div>
                                    
                                    <?php echo e($active=''); ?>

                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#<?php echo e($carouselId); ?>" data-bs-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#<?php echo e($carouselId); ?>" data-bs-slide="next">
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden"></span>
                                </button>
                             </div>
                             
                          </div>
                          <div class="row">
                             <div class="col-sm-7">
                                <h5 class="types_text"><?php echo e($item->model_name); ?></h5>
                             </div>
                             <div class="col-sm-5 d-flex justify-content-start">
                                 <?php $__currentLoopData = $vrate[$item->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <p class="vrate">₹ <?php echo e($rate->rate_per_hour); ?>/ hr</p>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                             </div>
                             <hr>
                             <div class="col-sm-7">
                                <p class="" style="margin: 0%"><?php echo e($item->fuel_type); ?> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                 <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                               </svg><?php echo e($item->category); ?><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                 <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                               </svg> <?php echo e($item->capacity); ?> seats </p>
                             </div>
                             <div class="col-sm-5">
                                <p class="" style="margin: 0%"></p>
                             </div>
                          </div>
                          <input type="hidden" name="bid" value="<?php echo e($item->id); ?>">
                          <input type="hidden" name="duration" value="<?php echo e($duration); ?>">
                          <input type="hidden" name="pickup" value="<?php echo e($pickup); ?>" class="form-control">
                          <input type="hidden" name="dropoff" value="<?php echo e($dropoff); ?>" class="form-control">
                          
                          <div class="read_bt"><input type="submit" class="btn btn-warning" value="Book Now"></div>
                                   
                       </div>
                       </form>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
               </div>
       </div>
   </div>
 </div>
 <script>
   $(document).ready(function () {
      var pickup = $("input[name='pickup']").val();  // Get pickup value
      var dropoff = $("input[name='dropoff']").val();
      var duration = $("input[name='duration']").val();
            $('.search_category').on('change', function () {
                var selectedCategories = [];
                $('.search_category:checked').each(function () {
                    selectedCategories.push($(this).val());
                });
                console.log(selectedCategories);
                console.log(pickup);
                console.log(dropoff);
                console.log(duration);
                if (selectedCategories.length === 0) {
                    location.reload(); // This will refresh the page to show original results
                    return;
                  }

                $.ajax({
                    url: "<?php echo e(route('search_category')); ?>",
                    method: "POST",
                    data: { _token: $('meta[name="csrf-token"]').attr('content'),categories: selectedCategories,pickup:pickup,dropoff:dropoff ,duration:duration},
                    success: function (response) {
                     if (response.trim() === "") {
                         location.reload(); // If no results, reload the original page
                     } else {
                         $('#results').html(response); // Update with filtered results
                        }
                    }
                });
               
            });
        });
 </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    Vehicles
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/search.blade.php ENDPATH**/ ?>