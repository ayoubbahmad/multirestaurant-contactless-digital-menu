<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

        <title>{{ __('chef.adminpanel') }}</title>
        <style>



        </style>
        <link rel="icon" type="image/x-icon" href={{asset('assets/newcorkui/img/favicon.ico')}}/>
        <link href={{asset('assets/newcorkui/css/loader.css')}} rel="stylesheet" type="text/css" />
        <script src={{asset('assets/newcorkui/js/loader.js')}}></script>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
        <link href={{asset('assets/newcorkui/bootstrap/css/bootstrap.min.css')}} rel="stylesheet" type="text/css" />
        <link href={{asset('assets/newcorkui/css/plugins.css')}} rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->

        <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
        <link href={{asset('assets/newcorkui/plugins/apex/apexcharts.css')}} rel="stylesheet" type="text/css">
        <link href={{asset('assets/newcorkui/css/dashboard/dash_1.css')}} rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

        <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
        <link href={{asset("assets/newcorkui/css/scrollspyNav.css")}} rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href={{asset("assets/newcorkui/css/forms/theme-checkbox-radio.css")}}>
        <link href={{asset("assets/newcorkui/css/tables/table-basic.css")}} rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL CUSTOM STYLES -->

        <!-- BEGIN TRANSACTION PAGE LEVEL STYLES -->
        <link rel="stylesheet" type="text/css" href={{asset("assets/newcorkui/plugins/table/datatable/datatables.css")}}>
        <link rel="stylesheet" type="text/css" href={{asset("assets/newcorkui/plugins/table/datatable/dt-global_style.css")}}>
        <!-- END TRANSACTION PAGE LEVEL STYLES -->

        <!-- BEGIN STORE PAGE LEVEL CUSTOM STYLES -->
        <link rel="stylesheet" type="text/css" href={{asset("assets/newcorkui/plugins/table/datatable/custom_dt_html5.css")}}>
        <link rel="stylesheet" type="text/css" href={{asset("assets/newcorkui/plugins/table/datatable/dt-global_style.css")}}>

        <script src={{asset("assets/newcorkui/plugins/select2/select2.min.js")}}></script>
        <script src={{asset("assets/newcorkui/plugins/select2/custom-select2.js")}}></script>
        <!-- END STORE PAGE LEVEL CUSTOM STYLES -->

        <!-- Slider switch -->
        <link href={{asset("assets/newcorkui/css/scrollspyNav.css")}} rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href={{asset("assets/newcorkui/css/forms/switches.css")}}>

        <link href={{asset("assets/newcorkui/css/components/tabs-accordian/custom-tabs.css")}} rel="stylesheet" type="text/css" />
        <link href={{asset("assets/newcorkui/css/elements/tooltip.css")}} rel="stylesheet" type="text/css" />
        <link href={{asset("assets/newcorkui/plugins/bootstrap-select/bootstrap-select.min.css")}} rel="stylesheet" type="text/css" />
{{--        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />--}}

    </head>
    <body>
        <!-- BEGIN LOADER -->
        <div id="load_screen"> <div class="loader"> <div class="loader-content">
                    <div class="spinner-grow align-self-center"></div>
                </div></div></div>
        <!--  END LOADER -->

        <!--  BEGIN NAVBAR  -->
        @include('admin.admin_layout.navbar')
        <!--  END NAVBAR  -->

        <!--  BEGIN MAIN CONTAINER  -->
        <div class="main-container" id="container">

            <div class="overlay"></div>
            <div class="search-overlay"></div>

            <!--  BEGIN SIDEBAR  -->
            @include('admin.admin_layout.side_bar')
            <!--  END SIDEBAR  -->

                @yield("admin_content")


        </div>
        <!-- END MAIN CONTAINER -->


        <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
        <script src={{asset("assets/newcorkui/js/libs/jquery-3.1.1.min.js")}}></script>
        <script src={{asset("assets/newcorkui/bootstrap/js/popper.min.js")}}></script>
        <script src={{asset("assets/newcorkui/bootstrap/js/bootstrap.min.js")}}></script>
        <script src={{asset("assets/newcorkui/plugins/perfect-scrollbar/perfect-scrollbar.min.js")}}></script>
        <script src={{asset("assets/newcorkui/js/app.js")}}></script>
        <script>
            $(document).ready(function() {
                App.init();
            });
        </script>
        <script src={{asset("assets/newcorkui/plugins/highlight/highlight.pack.js")}}></script>
{{--        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>--}}
        <script src={{asset("assets/newcorkui/plugins/bootstrap-select/bootstrap-select.min.js")}}></script>
        <script src={{asset("assets/newcorkui/js/custom.js")}}></script>
        <!-- END GLOBAL MANDATORY SCRIPTS -->



        <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
        <script src={{asset("assets/newcorkui/plugins/apex/apexcharts.min.js")}}></script>
        <script src={{asset("assets/newcorkui/js/dashboard/dash_1.js")}}></script>
        <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

        <!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
        <script src={{asset("assets/newcorkui/js/scrollspyNav.js")}}></script>

        <script>
            checkall('todoAll', 'todochkbox');
            $('[data-toggle="tooltip"]').tooltip()
        </script>
        <!-- END PAGE LEVEL CUSTOM SCRIPTS -->

        <script src={{asset("assets/newcorkui/plugins/table/datatable/datatables.js")}}></script>
        <script>
            $('#zero-config').DataTable({
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                    "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [10, 25, 50, 100],
                "pageLength": 10
            });
        </script>

        @include('admin.admin_layout.scripts.javascript')


    </body>
</html>
