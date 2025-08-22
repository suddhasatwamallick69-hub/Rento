<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="<?php echo e(route('admin_dashboard')); ?>">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-car-front"></i><span>Vehicle Components</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo e(route('addvehiclecategory')); ?>">
              <i class="bi bi-circle"></i><span>Add Vehicle Category</span>
            </a>
          </li>
          <li>
            <a href="<?php echo e(route('list_category')); ?>">
              <i class="bi bi-circle"></i><span>List Vehicle Category</span>
            </a>
          </li>
          
          <li>
            <a href="<?php echo e(route('manage_vehicle')); ?>">
              <i class="bi bi-circle"></i><span>Manage Host Vehicles</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person"></i><span>User Components</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="<?php echo e(route('manage_vehicle')); ?>">
              <i class="bi bi-circle"></i><span>List of Users</span>
            </a>
          </li>
          
          
          
        </ul>
      </li>
      <!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Bookings</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="tables-general.html">
              <i class="bi bi-circle"></i><span>General Tables</span>
            </a>
          </li>
          <li>
            <a href="tables-data.html">
              <i class="bi bi-circle"></i><span>Data Tables</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- End Tables Nav -->

      
      <!-- End Charts Nav -->

      
      <!-- End Icons Nav -->

      

    </ul>

  </aside><?php /**PATH C:\xampp\htdocs\laravel_auth\resources\views/admin/partials/sidebar.blade.php ENDPATH**/ ?>