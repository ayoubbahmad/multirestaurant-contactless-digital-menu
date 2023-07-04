@extends("restaurants.layouts.restaurants_layout")

@section("restaurant_content")

    <div class="container-fluid">
        <div class="layout-px-spacing">
            
            <div class="row layout-top-spacing layout-spacing">
                <div class="col-lg-12">
                    <div class="shadow card card-body">

                        <div class="row">
                            <div class="col-md-12">
                                <!-- Tabs nav -->
                                <div class="border-top-tab">

                                    <ul class="nav nav-tabs mb-3 mt-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="site-settings-tab" data-bs-toggle="tab" href="#site-settings" role="tab" aria-controls="site-settings" aria-selected="true">
                                                {{$selected_language->data['store_panel_settings_site'] ?? 'Site Settings'}}
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="app-settings-tab" data-bs-toggle="tab" href="#app-settings" role="tab" aria-controls="app-settings" aria-selected="false">
                                                {{$selected_language->data['store_panel_settings_app'] ?? 'App Settings'}}
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" id="payment-settings-tab" data-bs-toggle="tab" href="#payment-settings" role="tab" aria-controls="payment-settings" aria-selected="false">
                                                {{$selected_language->data['store_panel_settings_payment'] ?? 'Payment Settings'}}
                                            </a>
                                        </li>
                                    </ul>

                                </div>

                            @if(session()->has("MSG"))
                                <div class="alert alert-{{session()->get("TYPE")}}">
                                    <strong> <a>{{session()->get("MSG")}}</a></strong>
                                </div>
                            @endif
                            @if($errors->any()) @include('admin.admin_layout.form_error') @endif

                            <div class="widget-content col-12">

                                    <!-- Tabs content -->
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade pl-3 pr-4 pb-1 show active" id="site-settings" role="tabpanel" aria-labelledby="site-settings-tab">
                                            <form class="form-horizontal" method="post" action="{{route('store_admin.update_store_settings')}}" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            @include('restaurants.settings.site_setttings')
                                        </div>
                                        <div class="tab-pane fade  pl-3 pr-4 pb-1" id="app-settings" role="tabpanel" aria-labelledby="app-settings-tab">
                                            @include('restaurants.settings.app_settings')

                                            </form>
                                        </div>
                                        <div class="tab-pane fade  pl-3 pr-4 pb-1" id="payment-settings" role="tabpanel" aria-labelledby="payment-settings-tab">
                                            @include('restaurants.settings.payment_settings')
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



