<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{$account_info ?? '' != NULL ?$account_info->application_name:"Chef Digital Menu"}}</title>
    <link rel="icon" type="image/x-icon" href={{asset("assets/newcorkui/assets/img/favicon.ico")}}/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href={{asset("assets/newcorkui/bootstrap/css/bootstrap.min.css")}} rel="stylesheet" type="text/css" />
    <link href={{asset("assets/newcorkui/css/plugins.css")}} rel="stylesheet" type="text/css" />
    <link href={{asset("assets/newcorkui/css/authentication/form-1.css")}} rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href={{asset("assets/newcorkui/css/forms/theme-checkbox-radio.css")}}>
    <link rel="stylesheet" type="text/css" href={{asset("assets/newcorkui/css/forms/switches.css")}}>
</head>
    <body class="form">

        @yield('content')


        <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
        <script src={{asset("assets/newcorkui/js/libs/jquery-3.1.1.min.js")}}></script>
        <script src={{asset("assets/newcorkui/bootstrap/js/popper.min.js")}}></script>
        <script src={{asset("assets/newcorkui/bootstrap/js/bootstrap.min.js")}}></script>

        <!-- END GLOBAL MANDATORY SCRIPTS -->
        <script src={{asset("assets/newcorkui/js/authentication/form-1.js")}}></script>

    </body>
</html>
