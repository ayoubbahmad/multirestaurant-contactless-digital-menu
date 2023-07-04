<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
<meta content="Coderthemes" name="author" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>{{ __('chef.adminpanel') }}</title>

        <link rel="icon" type="image/png" href="{{asset('themes/default/images/all-img/fav.png')}}">

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

    <body class="loading  authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center align-items-center" style="height: 80vh;">
                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <div class="text-center">
                            <a href="index.html">
                                
                            </a>
                        </div>
                        <div class="card">

                            <div class="card-body p-4">
                                @if(!$data)
                                <div class="text-center mb-4">
                                    <h4 class="text-uppercase mt-0 mb-4">ACTIVATE CHEF QR MENU</h4>
                                   
                                    <p class="text-muted my-4">Enter your client name and key to activate Chef QR Menu.</p>

                                </div>

                                <form action="{{route('restore')}}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="text" class="form-label">User Name</label>
                                        <input class="form-control" required type="text" required="" name="user_name" id="text" placeholder="Enter your user name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Purchase Key</label>
                                        <input class="form-control" required type="text" required="" name="purchase_key" id="password" placeholder="Enter your pruchase key">
                                    </div>

                                    <div class="mb-0 text-center d-grid">
                                        <button class="btn btn-primary" type="submit"> Activate </button>
                                    </div>

                                </form>
                                @elseif(isset($data['status']))
                                @if($data['status'] == true)
                                {{$data['message']}}
                                <div class="row mt-3">
                                    <a href="{{route('dashboard')}}" class="d-flex align-items-center justify-content-center"> <button class="btn btn-primary">Go To Dashboard</button></a> 
                                </div>
                                @else 
                                {{$data['message']}}
                                @endif
                                @endif

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

        
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->
      
        <!-- Vendor js -->
        <script src="{{asset('store_assets/js/vendor.min.js')}}"></script>

        <!-- App js -->
        <script src="{{asset('store_assets/js/app.min.js')}}"></script>

        
    </body>
</html>