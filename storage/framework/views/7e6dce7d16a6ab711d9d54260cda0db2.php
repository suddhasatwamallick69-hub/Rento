<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('hostdashboard')); ?>">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="icon-layout menu-icon"></i>
          <span class="menu-title">Host Components</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="<?php echo e(route('hostvehicle')); ?>">Host a Vehicle</a></li>
            <li class="nav-item"> <a class="nav-link" href="<?php echo e(route('hostbookings')); ?>">Bookings</a></li>
            <li class="nav-item"> <a class="nav-link" href="<?php echo e(route('myvehicles')); ?>">Listed Vehicles</a></li>
          </ul>
        </div>
      </li>
      
    </ul>
  </nav><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/host/partials/sidebar.blade.php ENDPATH**/ ?>