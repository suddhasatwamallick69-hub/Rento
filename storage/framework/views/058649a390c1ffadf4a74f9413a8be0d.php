<h3>Showing <?php echo e($numberOfRows); ?>  Vehicles</h3>
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
                                       <a href="<?php echo e(url("/vehicle_images")); ?>/<?php echo e($img); ?>" target="blank"> <img src="<?php echo e(url("/vehicle_images")); ?>/<?php echo e($img); ?>" style="height: 220px" class="d-block w-100" alt="..."></a>
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
                              <p class="" style="margin: 0%"><i class="bi bi-person-walking"></i><?php echo e(round($item->distance, 2)); ?> km away</p>
                           </div>
                          </div>
                          <input type="hidden" name="bid" value="<?php echo e($item->id); ?>">
                          <input type="hidden" name="duration" value="<?php echo e($duration); ?>">
                          <input type="hidden" name="pickup" value="<?php echo e($pickup); ?>" class="form-control">
                          <input type="hidden" name="dropoff" value="<?php echo e($dropoff); ?>" class="form-control">
                          <input type="hidden" name="latitude" value="<?php echo e($latitude); ?>" class="form-control">
                          <input type="hidden" name="longitude" value="<?php echo e($longitude); ?>" class="form-control">
                          
                          <div class="read_bt"><input type="submit" class="btn btn-warning" value="Book Now"></div>
                       </div>
                     </form>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/partials/search_vehicle_list.blade.php ENDPATH**/ ?>