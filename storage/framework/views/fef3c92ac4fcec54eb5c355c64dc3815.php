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
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/admin/partials/search_by_listing.blade.php ENDPATH**/ ?>