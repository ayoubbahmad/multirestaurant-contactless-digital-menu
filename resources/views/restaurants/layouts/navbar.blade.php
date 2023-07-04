<div class="navbar-custom bg-light shadow">
        <ul class="list-unstyled topnav-menu float-end mb-0">


            

            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="fe-globe"></i>
                </a>


    
                    <div class="dropdown-menu dropdown-menu-end profile-dropdown">
                        @php
                           
                            
                        @endphp
                        <!-- item-->
                        @forelse ($languages as $language)                            
                        <a href="#" class="dropdown-item notify-item" href="" onclick="document.getElementById('lang_{{$language->id}}').submit();">
                            <span class="">{{$language->language_name}}</span>
                        </a>
                        <form method="post" action="{{route("change_language")}}" id="lang_{{$language->id}}">
                            @csrf
                            <input type="hidden" name="selected_language" value="{{$language->id}}" id="">
                        </form>
                        @empty
                        @endforelse
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

        
        <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">

            <li>
                <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
            </li>


        </ul>
        <div class="logo-box d-sm-none" >
            <a href="{{route('store_admin.dashboard')}}" class="logo logo-light text-center">

                <span class="logo-lg">
                    <img src="{{asset('/store_assets/images/logo-light.png')}}" alt="" height="35">
                </span>
            </a>
            <a href="{{route('store_admin.dashboard')}}" class="logo logo-dark text-center">

                <span class="logo-lg">
                    <img src="{{asset('/store_assets/images/logo-dark.png')}}" alt="" height="16">
                </span>
            </a>
        </div>
        <div class="clearfix"></div>

</div>
