

<?php $__env->startSection('content'); ?>
<div class="layout_padding">
    <div class="container-fluid">
       <div class="about_section_2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>My Profile <i class="bi bi-person-fill"></i></h3>
                    <hr>
                    <h3>Account Details</h3>
                    <hr>
                    <form action="<?php echo e(route('updateprofile')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="row p-2">
                            <div class="col-md-4">
                                <h2>Name : </h2>
                            </div>
                            <div class="col-md-4">
                            <input type="text" class="form-control" name="name" value="<?php echo e($user->name); ?>" placeholder="Enter your Name">
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-md-4">
                                <h2>Email : </h2>
                            </div>
                            <div class="col-md-4">
                                <input type="email" value="<?php echo e($user->email); ?>"  class="form-control" id="" placeholder
                                ="Enter your Email" disabled>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-md-4">
                                <h2>Phone Number : </h2>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" value="<?php echo e($user->phone_number); ?>" name="phone_number" disabled>
                                <?php
                                    if($user->phone_number=='')
                                    echo 'Verify Your Phone Number';
                                    else
                                    echo'';
                                ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <p><input type="submit" value="Update" class="btn btn-success"></p>
                        </div>
                    </form>
                    <h3>Verify Your Profile</h3>
                    <hr>
                    <form action="<?php echo e(route('ins_verifyprofile')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="row p-2">
                            <div class="col-md-4">
                                <h2>Aadhar Number : </h2>
                            </div>
                            <div class="col-md-4">
                                <input type="text"  maxlength="14" class="form-control" value="<?php echo e($aadhar); ?>" name="aadhar_number" id="" placeholder="Aadhar Number" <?php
                                if($user->is_verified==1)echo 'disabled'
                            ?>>
                                <?php
                                    if($aadhar=='')
                                    echo 'Verify Your aadhar Number';
                                    else
                                    echo'';
                                ?>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-md-4">
                                <h2>Driving Lisence : </h2>
                            </div>
                            <div class="col-md-4">
                                <input type="text"  maxlength="14" class="form-control" value="<?php echo e($driving_license); ?>" name="Driving_Lisence" id="" placeholder="Driving Lisence" <?php
                                    if($user->is_verified==1)echo 'disabled'
                                ?>>
                                <?php
                                    if($driving_license=='')
                                    echo 'Verify Your driving_license';
                                    else
                                    echo'';
                                ?>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <?php if($user->is_verified==0): ?>
                                <p><input type="submit" value="verify profile" class="btn btn-success"></p>
                            <?php else: ?>
                                <p class="btn btn-warning">Profile Verified</p>
                            <?php endif; ?>
                            
                        </div>

                    </form>
                     <h3>Personal Details</h3>
                     <hr>
                </div>
                <div class="col-lg-12" style="padding-top:20px;padding-bottom:30px;max-height: 80vh;overflow-y: auto;scroll-behavior: smooth;scrollbar-width:none; scrollbar-color: #888 transparent;">

                </div>
            </div>
        </div>
       </div>
    </div>
 </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/myprofile.blade.php ENDPATH**/ ?>