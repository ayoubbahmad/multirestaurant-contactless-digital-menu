<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="HelpDev" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ __('chef.adminpanel') }}</title>
    <link rel="icon" type="image/x-icon" href={{ asset('assets/newcorkui/img/favicon.ico') }} />

    <link href="{{ asset('store_assets/css/config/creative/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('store_assets/css/config/creative/app.min.css') }}" rel="stylesheet" type="text/css"
        id="app-default-stylesheet" />
    <link href="{{ asset('store_assets/css/config/creative/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css"
        id="bs-dark-stylesheet" disabled="disabled" />
    <link href="{{ asset('store_assets/css/config/creative/app-dark.min.css') }}" rel="stylesheet" type="text/css"
        id="app-dark-stylesheet" disabled="disabled" />
    <link href="{{ asset('store_assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <link href=" {{ asset('assets/newcorkui/plugins/drag-and-drop/dragula/dragula.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/newcorkui/plugins/drag-and-drop/dragula/example.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/newcorkui/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('store_assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('store_assets/libs/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href={{ asset('assets/newcorkui/plugins/table/datatable/datatables.css') }}>
    <link rel="stylesheet" type="text/css"
        href={{ asset('assets/newcorkui/plugins/table/datatable/dt-global_style.css') }}>

    <link href={{ asset('assets/newcorkui/css/scrollspyNav.css') }} rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href={{ asset('assets/newcorkui/css/forms/switches.css') }}>

    <link href={{ asset('assets/newcorkui/css/components/tabs-accordian/custom-tabs.css') }} rel="stylesheet"
        type="text/css" />
    <link href={{ asset('assets/newcorkui/css/elements/tooltip.css') }} rel="stylesheet" type="text/css" />
    <link href={{ asset('assets/newcorkui/plugins/bootstrap-select/bootstrap-select.min.css') }} rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('store_assets/libs/selectize/css/selectize.css') }}" rel="stylesheet" type="text/css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <link rel="stylesheet" href={{ asset('new/css/toastr.min.css') }} type="text/css">

</head>

<body class="loading" data-layout-mode="horizontal"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
    <div id="wrapper">

        @include('admin.admin_layout.navbar')
        <!--  BEGIN SIDEBAR  -->
        @include('admin.admin_layout.side_bar')
        <!--  END SIDEBAR  -->
        <div class="content-page">
            <div class="overlay"></div>
            <div class="search-overlay"></div>
            <div class="content mt-2">

                @yield("admin_content")


            </div>
        </div>
    </div>

    <!-- END MAIN CONTAINER -->

    <!-- Vendor js -->
    <script src="{{ asset('store_assets/js/vendor.min.js') }}"></script>


    <script src={{ asset('new/js/toastr.min.js') }}></script>
    {!! Toastr::message() !!}
    <!-- App js-->
    <!-- Slider switch --> <script src={{ asset('assets/newcorkui/plugins/bootstrap-select/bootstrap-select.min.js') }}></script>

    <script src="{{ asset('store_assets/js/app.min.js') }}"></script>
    <script src="{{ asset('store_assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ asset('store_assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('store_assets/js/datatables.js') }}"></script>

    <script src="{{ asset('store_assets/libs/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/newcorkui/plugins/drag-and-drop/dragula/dragula.min.js') }}"></script>
    <script src="{{ asset('assets/newcorkui/plugins/drag-and-drop/dragula/custom-dragula.js') }}"></script>

    <script src="{{ asset('store_assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>
    <script>
        $(function() {
            $('.selectpickers').selectize();
        });
    </script>
    <script>
        $('#zero-config').DataTable({
            language: {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
            }
        });
    </script>
    @include('admin.admin_layout.scripts.javascript')
</body>

</html>
