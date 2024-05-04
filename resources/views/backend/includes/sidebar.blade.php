@php
    $superAdminRole = \App\Enums\RoleType::SUPERADMIN;
@endphp
<div class="sidebar close">
    <div class="logo-details">
        <i class='bx bxl-c-plus-plus'></i>
        <span class="logo_name">Shop</span>
    </div>
    <ul class="nav-links">
        <li class="list-item">
            <a href="{{route('dashboard')}}">
                <i class='bx bx-grid-alt'></i>
                <span class="link_name">Dashboard</span>
            </a>
            <ul class="sub-menu blank">
                <li class="list-item"><a class="link_name" href="{{route('dashboard')}}">Dashboard</a></li>
            </ul>
        </li>
        <li class="divider">
            <hr class="horizontal dark">
            <h6 class="title-section ps-3 text-uppercase">General</h6>
        </li>
        <li class="list-item">
            <div class="icon-link">
                <a href="{{route('products')}}">
                    <i class='bx bx-collection'></i>
                    <span class="link_name">Product</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li class="list-item"><a class="link_name" href="#">Product</a></li>
                <li class="list-item"><a href="{{route('products')}}">Overview/Manage</a></li>
                <li class="list-item"><a href="#">Product Reviews</a></li>
                <li class="list-item"><a href="#">Stock Alerts</a></li>
            </ul>
        </li>
        <li class="list-item">
            <div class="icon-link">
                <a href="#">
                    <i class='bx bx-package'></i>
                    <span class="link_name">Orders</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li class="list-item"><a class="link_name" href="#">Orders</a></li>
                <li class="list-item"><a href="#">Overview/Manage</a></li>
                <li class="list-item"><a href="#">Status/Tracking</a></li>
                <li class="list-item"><a href="#">Stock Alerts</a></li>
            </ul>
        </li>
        <li class="list-item">
            <a href="{{route('category.index')}}">
                <i class='bx bx-category'></i>
                <span class="link_name">Categories</span>
            </a>
            <ul class="sub-menu blank">
                <li class="list-item"><a class="link_name" href="{{route('category.index')}}">Categories</a></li>
            </ul>
        </li>
        <li class="list-item">
            <a href="{{route('brand.index')}}">
                <i class='bx bx-shopping-bag'></i>
                <span class="link_name">Brands</span>
            </a>
            <ul class="sub-menu blank">
                <li class="list-item"><a class="link_name" href="{{route('brand.index')}}">Brands</a></li>
            </ul>
        </li>
        <li class="list-item">
            <a href="#">
                <i class='bx bx-pie-chart-alt-2'></i>
                <span class="link_name">Discounts</span>
            </a>
            <ul class="sub-menu blank">
                <li class="list-item"><a class="link_name" href="#">Discounts</a></li>
            </ul>
        </li>
        <li class="list-item">
            <a href="#">
                <i class='bx bxs-report'></i>
                <span class="link_name">Reports</span>
            </a>
            <ul class="sub-menu blank">
                <li class="list-item"><a class="link_name" href="#">Reports</a></li>
            </ul>
        </li>
        @if(Auth::user()->role == $superAdminRole)
        <li class="divider">
            <hr class="horizontal dark">
            <h6 class="title-section ps-3 text-uppercase">System</h6>
        </li>
        <li class="list-item">
            <a href="#">
                <i class='bx bx-user'></i>
                <span class="link_name">Users</span>
            </a>
            <ul class="sub-menu blank">
                <li class="list-item"><a class="link_name" href="#">Users</a></li>
            </ul>
        </li>
        <li class="list-item">
            <a href="#">
                <i class='bx bx-cog'></i>
                <span class="link_name">Settings</span>
            </a>
            <ul class="sub-menu blank">
                <li class="list-item"><a class="link_name" href="#">Settings</a></li>
            </ul>
        </li>
        @endif
        <li class="list-item">
            <div class="profile-details">
                <div class="profile-content">
                    <img src="https://st2.depositphotos.com/1104517/11965/v/950/depositphotos_119659092-stock-illustration-male-avatar-profile-picture-vector.jpg"
                        alt="profileImg">
                </div>
                <div class="name-job">
                    <div class="profile_name">Milan</div>
                    <div class="job">Admin</div>
                </div>
                <i class='bx bx-log-out' onclick="event.preventDefault(); document.getElementById('logout-form').submit();"></i>  
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</div>
