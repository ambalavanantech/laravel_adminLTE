  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Full Stack Developer</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if(!empty(Auth::guard('admin')->user()->image))
          <img src="{{asset('admin/images/photos/'. Auth::guard('admin')->user()->image)}}" class="img-circle elevation-2" alt="User Image">
          @else
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          @endif
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::guard('admin')->user()->name}}</a>
        </div>
      </div>

      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

               <li class="nav-item">
            <!-- <a href="pages/widgets.html" class="nav-link"> -->
            <a href="{{url('admin/dashboard')}}"  class="nav-link {{ request()->routeIs('admin.dashboard') ? ' active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          @if(Auth::guard('admin')->user()->type == 'admin')

          <li @if(request()->routeIs('admin.updatePassword') || request()->routeIs('admin.updateDetails') || request()->routeIs('admin.subadmins')) class="nav-item menu-open" @else class="nav-item" @endif > 
            <a href="#" @if(request()->routeIs('admin.updatePassword') || request()->routeIs('admin.updateDetails') || request()->routeIs('admin.subadmins')) class="nav-link active" @else class="nav-link" @endif >
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('admin/update-password')}}" class="nav-link {{ request()->routeIs('admin.updatePassword') ? ' active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Password</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/update-details')}}" class="nav-link {{ request()->routeIs('admin.updateDetails') ? ' active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Details</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/subadmins')}}" class="nav-link {{ request()->routeIs('admin.subadmins') ? ' active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sub Admins</p>
                </a>
              </li>
             
            </ul>
          </li>

          @endif

          <li class="nav-item">
                <a href="{{url('admin/cms-page')}}" class="nav-link {{ request()->routeIs('cms_page') ? ' active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>CMS Page</p>
                </a>
              </li>
  
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>