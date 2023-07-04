@extends('admin.admin_layout.adminlayout')

@section("admin_content")

<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-12">
            <div class="page-title-box page-title-box-alt">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">

                    </ol>
                </div>
                <h4>Settings</h4>
            </div>
        </div>
    </div>  
      

            <div class="row layout-top-spacing layout-spacing">
                <div class="col-lg-12">
                    <div class="pt-0">

                        <div class="card-body">
                            <div class="col-md-12">
                                <!-- Tabs nav -->
                                <div class="border-top-tab">

                                    <ul class="nav nav-tabs mt-0 col-12" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="site-settings-tab" data-bs-toggle="tab" href="#site-settings" role="tab" aria-controls="site-settings" aria-selected="true">
                                                Site Settings
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="account-settings-tab" data-bs-toggle="tab" href="#account-settings" role="tab" aria-controls="account-settings" aria-selected="false">
                                                Account Settings
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="payment-settings-tab" data-bs-toggle="tab" href="#payment-settings" role="tab" aria-controls="payment-settings" aria-selected="false">
                                                Payment Settings
                                            </a>
                                        </li>
                                        
                                        <li class="nav-item">
                                            <a class="nav-link" id="privacy-tab" data-bs-toggle="tab" href="#privacy" role="tab" aria-controls="privacy" aria-selected="false">
                                                Pages
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="cache-settings-tab" data-bs-toggle="tab" href="#cache-settings" role="tab" aria-controls="cache-settings" aria-selected="false">
                                                Cache Settings
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-css-tab" data-bs-toggle="tab"
                                               href="#custom-css" role="tab" aria-controls="custom-css" aria-selected="false">
                                                Custom CSS
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </div>


                            <div class="card card-body">
                                <div class="col-12 mx-2">

                                    <!-- Tabs content -->
                                    <div class="tab-content" id="v-pills-tabContent" style="margin-top : -20px">
                                        <div class="tab-pane fade pt-3 pr-4 pb-1 show active" id="site-settings" role="tabpanel" aria-labelledby="site-settings-tab">
                                            @include('admin.settings.site_settings')
                                        </div>
                                        <div class="tab-pane fade pt-3 pr-4 pb-1" id="account-settings" role="tabpanel"  style="margin-top : -20px" aria-labelledby="account-settings-tab">
                                            @include('admin.settings.account_settings')
                                        </div>
                                        <div class="tab-pane fade pt-3 pr-4 pb-1" style="margin-top : -20px" id="payment-settings" role="tabpanel" aria-labelledby="payment-settings-tab">
                                            @include('admin.settings.paymentsettings')
                                        </div>
                                        <div class="tab-pane fade pt-3 pr-4 pb-1" style="margin-top : -20px" id="whatsapp-notification-settings" role="tabpanel" aria-labelledby="whatsapp-settings-tab">
                                            @include('admin.settings.whatsapp')
                                        </div>
                                        <div class="tab-pane fade pt-3 pr-4 pb-1" style="margin-top : -20px" id="privacy" role="tabpanel" aria-labelledby="privacy-tab">
                                            @include('admin.settings.privacy_policy')
                                        </div>
                                        <div class="tab-pane fade pt-3 pr-4 pb-1" style="margin-top : -20px" id="cache-settings" role="tabpanel" aria-labelledby="cache-settings-tab">
                                            @include('admin.settings.cache_settings')
                                        </div>
                                        <div class="tab-pane fade pt-3 pr-4 pb-1" style="margin-top : -20px" id="custom-css" role="tabpanel" aria-labelledby="custom-css-tab">
                                            @include('admin.settings.custom_css')
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
  
    </div>




    <script>
        $(document).ready(() => {
            let url = location.href.replace(/\/$/, "");

            if (location.hash) {
                const hash = url.split("#");
                $('#v-pills-tabContent a[href="#'+hash[1]+'"]').tab("show");
                url = location.href.replace(/\/#/, "#");
                history.replaceState(null, null, url);
                setTimeout(() => {
                    $(window).scrollTop(0);
                }, 400);
            }

            $('a[data-toggle="tab"]').on("click", function() {
                let newUrl;
                const hash = $(this).attr("href");
                if(hash == "#site-settings") {
                    newUrl = url.split("#")[0];
                } else {
                    newUrl = url.split("#")[0] + hash;
                }
                newUrl += "/";
                history.replaceState(null, null, newUrl);
            });
        });
    </script>

@endsection
