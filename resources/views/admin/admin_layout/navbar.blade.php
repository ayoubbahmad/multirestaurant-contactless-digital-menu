<div class="navbar-custom bg-light shadow">
    <ul class="list-unstyled topnav-menu float-end mb-0">

        <li class="d-none d-lg-block">

        </li>

        <li class="dropdown d-inline-block d-lg-none">
            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="fe-search noti-icon"></i>
            </a>
            <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
                <form class="p-3">
                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                </form>
            </div>
        </li>



        <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="{{asset('store_assets/images/users/user-1.jpg')}}" alt="user-image" class="rounded-circle">
                <span class="pro-user-name ms-1">
                    {{ Auth::user()->store_name }} <i class="mdi mdi-chevron-down"></i>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">

                <!-- item-->
                <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="#" class="dropdown-item notify-item">
                    <i class="fe-log-out"></i>
                    <span>Logout</span>
                </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
            </div>
        </li>



    </ul>

    <!-- LOGO -->
    <div class="logo-box">
        <a href="{{route('store_admin.dashboard')}}" class="logo logo-light text-center">
            <span class="logo-sm">
                <img src="{{asset('/store_assets/images/logo-sm.png')}}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{asset('/store_assets/images/logo-light.png')}}" alt="" height="35">
            </span>
        </a>
        <a href="{{route('store_admin.dashboard')}}" class="logo logo-dark text-center">
            <span class="logo-sm">
                <img src="{{asset('/store_assets/images/logo-sm.png')}}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{asset('/store_assets/images/logo-dark.png')}}" alt="" height="16">
            </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
        <li>
            <button class="button-menu-mobile disable-btn waves-effect">
                <i class="fe-menu"></i>
            </button>
        </li>

        <li>
            <h4 class="page-title-main">{{ Auth::user()->store_name }}</h4>
        </li>

    </ul>

    <div class="clearfix"></div>

</div>
