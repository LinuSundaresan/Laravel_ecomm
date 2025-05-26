<style>
    .main-sidebar .sidebar-menu li ul.dropdown-menu li a:active { {
        background-color : red; /* Primary theme color */
        color: #fff !important;
        font-weight: bold;
        border-radius: 5px;
    }
</style>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">Stisla</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="dropdown active">
          <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
        </li>

        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Menus</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('admin.slider.index')}}">Slider</a></li>
          </ul>
        </li>


        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Manage Categories</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link {{ request()->routeIs('admin.category.*') ? 'active' : '' }}" href="{{route('admin.category.index')}}">Categories</a></li>
            <li><a class="nav-link" href="{{route('admin.sub-category.index')}}">Sub Categories</a></li>
            <li><a class="nav-link" href="{{route('admin.child-category.index')}}">Child Categories</a></li>
          </ul>
        </li>

        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>E-Commerce</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{route('admin.vendor-profile.index')}}">Vendor Profile</a></li>
            </ul>
          </li>

        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Manage Products</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{route('admin.brand.index')}}">Brands</a></li>
              <li><a class="nav-link" href="{{route('admin.products.index')}}">Products</a></li>
              <li><a class="nav-link" href="{{route('admin.seller-products.index')}}">Vendor Products</a></li>
              <li><a class="nav-link" href="{{route('admin.seller-pending-products.index')}}">Vendor Pending Products</a></li>
            </ul>
          </li>


        {{-- <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li> --}}


      </ul>

    </aside>
  </div>
