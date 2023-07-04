<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a href="{{route('store_admin.dashboard')}}" class="nav-link arrow-none" id="topnav-dashboard" >
                            <i class="mdi mdi-view-dashboard"></i>
                            {{$selected_language->data['store_sidebar_dashboard'] ?? 'Dashboard'}}
                        </a>
                    </li>
    
    
    
                    <li class="nav-item dropdown">
                        <a href="{{route('store_admin.orders')}}" class="nav-link arrow-none" >
                            <i class="mdi mdi-shopping"></i>
                            {{$selected_language->data['store_sidebar_orders'] ?? 'Orders'}}
                        </a>
                    </li>
    
                    <li class="nav-item dropdown">
                        <a href="{{route('store_admin.orderstatus')}}" class="nav-link arrow-none" >
                            <i class="mdi mdi-list-status"></i>
                            <span> {{$selected_language->data['store_sidebar_order_status_screen'] ?? 'Orders Status'}} </span>
                        </a>
                    </li>
    
                    <li class="nav-item dropdown">
                        <a href="{{route('store_admin.waiter_calls')}}" class="nav-link arrow-none" >
                            <i class="mdi mdi-hail"></i>
                            <span> {{$selected_language->data['store_sidebar_waiter_call'] ?? 'Waiter Call'}}</span>
                        </a>
                    </li>             
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-layout" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-card-bulleted-settings-outline me-1"></i> {{$selected_language->data['store_sidebar_inventory'] ?? 'Inventory'}} <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-layout">
                            <!-- <a href="layouts-horizontal.html" class="dropdown-item">Horizontal</a> -->
                            <a href="{{route('store_admin.inventory')}}"  class="dropdown-item"> {{$selected_language->data['store_panel_common_category'] ?? 'Category'}}</a>
                            <a href="{{route('store_admin.products')}}"  class="dropdown-item">{{$selected_language->data['store_panel_common_products'] ?? 'Products'}}</a>
                            <a href="{{route('store_admin.addon_categories')}}"  class="dropdown-item">{{$selected_language->data['store_panel_common_addon_categories'] ?? 'Addon Categories'}}</a>
                            <a href="{{route('store_admin.addon')}}"  class="dropdown-item">{{$selected_language->data['store_panel_common_addon_addons'] ?? 'Addons'}}</a>
                        </div>
                    </li>


                    <li class="nav-item dropdown">
                        <a href="{{route('store_admin.customers')}}" class="nav-link arrow-none" >
                            <i class="mdi mdi-human-male-male"></i>
                            {{$selected_language->data['store_sidebar_customers'] ?? 'Customers'}}
                        </a>
                    </li>
                    @if(Module::find('Waiter'))  
                    <li class="nav-item dropdown">
                        <a href="{{url('/admin/store/waiter/')}}" class="nav-link arrow-none" >
                            <i class="mdi mdi-human-male-male"></i>
                            {{$selected_language->data['waiter'] ?? 'Waiters'}}
                        </a>
                    </li>
                    @endif

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-layout" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-tools me-1"></i> {{$selected_language->data['store_sidebar_tools'] ?? 'Tools'}} <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-layout">
                            <!-- <a href="layouts-horizontal.html" class="dropdown-item">Horizontal</a> -->
                            <a href="{{route('store_admin.coupons')}}"  class="dropdown-item"> {{$selected_language->data['store_sidebar_coupons'] ?? 'Coupons'}}</a>
                            <a href="{{route('store_admin.all_tables')}}"  class="dropdown-item">{{$selected_language->data['store_sidebar_tables'] ?? 'Tables'}}</a>
                            <a href="{{route('store_admin.banner')}}"  class="dropdown-item">{{$selected_language->data['store_sidebar_promo_banner'] ?? 'Promo Banner'}}</a>
                            <a href="{{route('download_qr',[Auth::user()->view_id])}}" target="_blank" class="dropdown-item">{{$selected_language->data['store_sidebar_print_qr_code'] ?? 'Qr-Code'}}</a>
                            <a href="{{route('store_admin.store_expense')}}"  class="dropdown-item">{{$selected_language->data['store_sidebar_expense'] ?? 'Expense'}}</a>
                            <a href="{{route('store_admin.subscription_plans')}}"  class="dropdown-item">{{$selected_language->data['store_sidebar_subscription_plans'] ?? 'Subscriptions'}}</a>
                        </div>
                    </li>



                    <li class="nav-item dropdown">
                        <a href="{{route('store_admin.settings')}}" class="nav-link arrow-none" >
                            <i class="mdi mdi-cog"></i>
                            <span>{{$selected_language->data['store_sidebar_settings'] ?? 'Settings'}}</span>
                        </a>
                    </li>
                </ul> <!-- end navbar-->
            </div> <!-- end .collapsed-->
        </nav>
    </div> <!-- end container-fluid -->
</div> 