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
        <li class="dropdown {{ setActive([
            'admin.dashboard',
        ]) }}">
          <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
        </li>

        <li class="dropdown {{ setActive([
            'admin.slider.*',
        ]) }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Menus</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('admin.slider.index')}}">Slider</a></li>
          </ul>
        </li>


        <li class="dropdown {{ setActive([
            'admin.category.*',
            'admin.sub-category.*',
            'admin.child-category.*'
        ]) }}">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Manage Categories</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link {{ request()->routeIs('admin.category.*') ? 'active' : '' }}" href="{{route('admin.category.index')}}">Categories</a></li>
            <li><a class="nav-link" href="{{route('admin.sub-category.index')}}">Sub Categories</a></li>
            <li><a class="nav-link" href="{{route('admin.child-category.index')}}">Child Categories</a></li>
          </ul>
        </li>

        <li class="dropdown {{ setActive([
            'admin.vendor-profile.*',
            'admin.flash-sale.*',
            'admin.coupens.*',
            'admin.shipping-rule.*',
            'admin.payment-settings.*'
        ]) }}" >
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>E-Commerce</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{route('admin.vendor-profile.index')}}">Vendor Profile</a></li>
              <li><a class="nav-link" href="{{route('admin.flash-sale.index')}}">Flash Sale</a></li>
              <li><a class="nav-link" href="{{route('admin.coupens.index')}}">Coupens</a></li>
              <li><a class="nav-link" href="{{route('admin.shipping-rule.index')}}">Shipping Rule</a></li>
              <li><a class="nav-link" href="{{route('admin.payment-settings.index')}}">Payment Settings</a></li>
            </ul>
          </li>

        <li class="dropdown {{ setActive([
            'admin.brand.*',
            'admin.products.*',
            'admin.seller-products.*',
            'admin.seller-pending-products.*'
        ]) }}" >
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Manage Products</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{route('admin.brand.index')}}">Brands</a></li>
              <li><a class="nav-link" href="{{route('admin.products.index')}}">Products</a></li>
              <li><a class="nav-link" href="{{route('admin.seller-products.index')}}">Vendor Products</a></li>
              <li><a class="nav-link" href="{{route('admin.seller-pending-products.index')}}">Vendor Pending Products</a></li>
            </ul>
          </li>

          <li><a class="nav-link" href="{{ route('admin.settings.index') }}"><i class="fa fa-cog"></i> <span>Settings</span></a></li>

        {{-- <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li> --}}


      </ul>

    </aside>
  </div>
