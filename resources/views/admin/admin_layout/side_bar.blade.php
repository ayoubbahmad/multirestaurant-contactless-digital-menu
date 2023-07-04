
<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a href="{{route('dashboard')}}" @if($root=="dashboard") data-active="true" @endif class="nav-link arrow-none" id="topnav-dashboard" role="button"
                        aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i>
                            {{ __('chef.dashboard') }}
                        </a>
                    </li>
    
    
    
                    <li class="nav-item dropdown">
                        <a href="{{route('all_stores')}}" @if($root=="store") data-active="true" @endif class="nav-link arrow-none" >
                            <i class="mdi mdi-shopping"></i>
                            Store
                        </a>
                    </li>
    
                    <li class="nav-item dropdown">
                        <a href="{{route('transactions')}}" @if($root=="Transactions") data-active="true" @endif class="nav-link arrow-none" >
                            <i class="mdi mdi-list-status"></i>
                            <span> Transactions </span>
                        </a>
                    </li>
    
                    <li class="nav-item dropdown">
                        <a href={{route('expense')}} @if($root=="Expense") data-active="true" @endif class="nav-link arrow-none" >
                            <i class="mdi mdi-cash-100"></i>
                            <span> Expense</span>
                        </a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a href={{route('customers')}} @if($root=="Customers") @endif class="nav-link arrow-none" >
                            <i class="mdi mdi-hail"></i>
                            <span> Customers</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href={{route('testimonials')}} @if($root=="Testimonials") data-active="true" @endif class="nav-link arrow-none" >
                            <i class="mdi mdi-text-to-speech"></i>
                            <span> Testimonials</span>
                        </a>
                    </li>
                    
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-layout" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-tools me-1"></i> {{$selected_language->data['store_sidebar_tools'] ?? 'Tools'}} <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-layout">
                            <!-- <a href="layouts-horizontal.html" class="dropdown-item">Horizontal</a> -->
                            <a href={{route('all_subscription')}} class=" dropdown-item" ><span>{{ __('chef.subscriptions') }}</span></a>
                            <a href={{route('translations')}} class=" dropdown-item" ><span>Translations</span></a>
                            <a href={{route('all_modules')}} class=" dropdown-item" ><span>Premium Modules</span></a>
                        </div>
                    </li>
                    @if(Module::has('Customer'))                     
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-layout" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-card-bulleted-settings-outline me-1"></i>User App  <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-layout">
                            <!-- <a href="layouts-horizontal.html" class="dropdown-item">Horizontal</a> -->
                            <a href="{{route('all_sliders')}}"  class="dropdown-item"> Slider</a>
                            <a href="{{route('all_store_category')}}"  class="dropdown-item">Store Category</a>
                        </div>
                    </li>
                    @endif



                    <li class="nav-item dropdown">
                        <a href={{route('settings')}} @if($root=="settings") data-active="true"@endif class="nav-link arrow-none" >
                            <i class="mdi mdi-cog"></i>
                            <span>{{ __('chef.settings') }}</span>
                        </a>
                    </li>
                </ul> <!-- end navbar-->
            </div> <!-- end .collapsed-->
        </nav>
    </div> <!-- end container-fluid -->
</div> 