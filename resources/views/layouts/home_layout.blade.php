<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" href="{{$favicon ?? '' != NULL ?asset($favicon):asset("home_assets_new/images/favicon.ico")}}" type="image/x-icon"/> 
    <title>{{$title ?? '' != NULL ?$title:"Chef QR Menu"}}</title>
    <meta name="theme-color" content="#ff4c3b"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="msapplication-TileColor" content="#FFFFFF"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- bootstrap css -->
    <link rel="stylesheet" id="rtl-link" type="text/css" href="{{asset('home_assets_new/css/vendors/bootstrap.css')}}"/>

    <!-- slick css -->
    <link rel="stylesheet" type="text/css" href="{{asset('home_assets_new/css/vendors/slick-theme.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('home_assets_new/css/vendors/slick.css')}}"/>
    <!-- iconly css -->
    <link rel="stylesheet" type="text/css" href="{{asset('home_assets_new/css/vendors/iconly.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('home_assets_new/css/custom.css')}}"/>
    
    <link href="{{asset('home_assets_new/icons/css/all.css')}}" rel="stylesheet">
    <link href="{{asset('home_assets_new/icons/js/all.js')}}" rel="stylesheet">

    <link rel="stylesheet" id="change-link" type="text/css" href="{{asset('home_assets_new/css/style.css')}}"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">
   

    <script defer src="https://unpkg.com/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script src="{{asset('home_assets_new/js/jquery-3.3.1.min.js')}}" ></script>

    
  
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js" defer></script>
    
    @livewireStyles
    <script src="{{ asset('js/app.js') }}" defer></script>
    @livewireScripts
    <script src="//unpkg.com/alpinejs" defer></script>
    @stack('head')
    <style>
        @media screen and (-webkit-min-device-pixel-ratio:0) {
            select,
            textarea,
            input {
                font-size: 16px;
            }
        }
        {{$customcss ?? ''}}
    </style>
</head>
<body>
@yield('content')
<div class="internet-connection-status" id="internetStatus"></div>


<script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false"></script>
@stack('js')
<script src="{{asset('home_assets_new/js/slick.js')}}"></script>
<script src="{{asset('home_assets_new/js/bootstrap.bundle.min.js')}}" ></script>
<script src="{{asset('home_assets_new/js/offcanvas-popup.js')}}" ></script>
<script src="{{asset('home_assets_new/js/script.js')}}" ></script>
</body>

</html>