<div class="header_section">
    <div class="container">
       <nav class="navbar navbar-expand-lg navbar-light">
          <a class="navbar-brand"href="<?php echo e(route('index')); ?>"><img src="<?php echo e(asset('images/Rento.jpg')); ?>"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                   <a class="nav-link" href="<?php echo e(route('index')); ?>">Home</a>
                </li>
                <li class="nav-item">
                   <a class="nav-link" href="<?php echo e(route('about')); ?>">About</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="#contact">Contact Us</a>
                </li>
                
                <li class="nav-item">
                   <a class="nav-link" href="<?php echo e(route('host')); ?>">Become a Host</a>
                </li>

                

                <?php if(Auth::guest()): ?>
                <li class="nav-item">
                   <a class="nav-link" href="<?php echo e(route('login_register')); ?>">Login/Register</a>
                </li>
                <?php endif; ?>

                <?php if(Auth::check()): ?>
               <div class="profile-container">
                   <img src="<?php echo e(asset('images/profile.png')); ?>" alt="Profile Icon" class="profile-icon">
                  <div class="dropdown-menu">
                    <a style="background-color:rgb(0, 0, 0);color:rgb(253, 200, 27)"><?php echo e(Auth::user()->name); ?></a>
                    <a href="<?php echo e(route('myprofile')); ?>"><i class="bi bi-person-fill"></i> My Profile</a>
                    <a href=""><i class="bi bi-gear-wide"></i> Settings</a>
                    <a href="<?php echo e(route('allbookings')); ?>"><i class="bi bi-car-front"></i> My Bookings</a>
                    <hr>
                    <a href=""><i class="bi bi-telephone-fill"></i> Help & Support</a>
                    <a href="<?php echo e(route('logout_user')); ?>"><i class="bi bi-box-arrow-left"></i> Sign Out</a>
                  </div>
               </div>
                <?php endif; ?>

             </ul>
             <form class="form-inline my-2 my-lg-0">
             </form>
          </div>
       </nav>
    </div>
 </div>
 <?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/partials/header.blade.php ENDPATH**/ ?>