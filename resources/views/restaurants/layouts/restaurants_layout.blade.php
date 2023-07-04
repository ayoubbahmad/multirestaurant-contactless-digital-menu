<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="HelpDev" name="author" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>{{ Auth::user()->store_name }}</title>
        @if($account_info)
        <link rel="icon" type="image/png" href="{{asset($account_info->fav_icon !=NULL ? $account_info->fav_icon:'themes/default/images/all-img/fav.png')}}">
        @else 
        <link rel="icon" type="image/png" href="{{asset('themes/default/images/all-img/fav.png')}}">

        @endif
        <link href="{{asset('store_assets/css/config/creative/bootstrap.min.css')}}"  rel="stylesheet" type="text/css" />
        <link href="{{asset('store_assets/css/config/creative/app.min.css')}}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
        <link href="{{asset('store_assets/css/config/creative/bootstrap-dark.min.css')}}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet"  disabled="disabled"/>
        <link href="{{asset('store_assets/css/config/creative/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" disabled="disabled" />
        <link href="{{asset('store_assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />


        <link href="{{asset('store_assets/libs/dropify/css/dropify.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('store_assets/libs/selectize/css/selectize.css')}}" rel="stylesheet" type="text/css">
        <link href=" {{asset('assets/newcorkui/plugins/drag-and-drop/dragula/dragula.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/newcorkui/plugins/drag-and-drop/dragula/example.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('store_assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href={{asset('new/css/toastr.min.css')}} type="text/css">

    </head>
    <body class="loading" data-layout-mode="horizontal" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
    <div id="wrapper">

        @include('restaurants.layouts.navbar')

            <!--  BEGIN SIDEBAR  -->
            @include('restaurants.layouts.side_bar')
            <!--  END SIDEBAR  -->
        <div class="content-page">
                <div class="content mt-2">

            @yield("restaurant_content")


        </div>
</div>
</div>

        <!-- END MAIN CONTAINER -->
        
 <!-- Vendor js -->
        <script src="{{asset('store_assets/js/vendor.min.js')}}"></script>
        <script>
            $('#printButton').on('click',function(){
                $('#printThis').printThis();
            })
            //on single click, accept order and disable button
            $('body').on("click", ".acceptOrderBtn", function(e) {
                $(this).addClass('pointer-none');
            });
            //on Single click do not cancel order
            $('body').on("click", ".cancelOrderBtn", function(e) {
                return false;
            });
            //cancel order on double click
            $('body').on("dblclick", ".cancelOrderBtn", function(e) {
                $(this).addClass('pointer-none');
                window.location = this.href;
                return false;
            });
        </script>

        <script>
            $('#thermalprintButton').on('click',function(){
                $('#thermalprintThis').printThis();
            })
        </script>

<script src={{asset("new/js/toastr.min.js")}}></script>
        {!! Toastr::message() !!}
        <!-- App js-->

        <script src="{{asset('store_assets/libs/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('store_assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <script src="{{asset('store_assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('store_assets/libs/selectize/js/standalone/selectize.min.js')}}"></script>

        <script src="{{asset('store_assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
        <script src="{{asset('store_assets/js/datatables.js')}}"></script>
        <script src="{{asset('store_assets/libs/dropify/js/dropify.min.js')}}"></script>

        <script src="{{asset("assets/newcorkui/plugins/drag-and-drop/dragula/dragula.min.js")}}"></script>
        <script src="{{asset("assets/newcorkui/plugins/drag-and-drop/dragula/custom-dragula.js")}}"></script>
        <script src="{{asset('store_assets/js/app.min.js')}}"></script>

        <script>
            $(function () {
    $('.selectpickers').selectize();
});
        </script>
        <script>
            dragula([$('left-defaults'), $('right-defaults')])
                .on('drag', function (el) {

                    console.log(el);
                    el.className += ' el-drag-ex-1';
                }).on('drop', function (el) {
                console.log(el);
                el.className = el.className.replace('el-drag-ex-1', '');
            }).on('cancel', function (el) {
                console.log(el);
                el.className = el.className.replace('el-drag-ex-1', '');
            });
        </script>
    </body>
@stack('js');
</html>
