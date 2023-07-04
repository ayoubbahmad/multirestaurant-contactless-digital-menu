@extends('Home.home_layout.qr')
@section('home_content')
    <section>
        <div class="row mx-0 p-5 d-flex justify-content-center" style="margin-top: 40px">
            <div class="col-xs-4 col-sm-6 col-md-5 col-lg-4 col-xl-3">
                <div class="card shadow-lg">
                    <div class="card-header card-header-divider text-center pt-4"><h1>{{$data->store_name}}</h1><br>
                    </div>
                    <div class="card-header card-header-divider text-center pt-4 pb-4">
                        {!! QrCode::size(250)->generate(route('view_store',['view_id'=>$data->view_id])); !!}</div>
                    <div class="card-body px-0">
                        <p class="text-center"><strong>@include('layouts.render.translation',["key" => "store_panel_qr_head", "default"=> "store_panel_qr"])</strong></p>

                        <h4 class="text-center"><strong>@include('layouts.render.translation',["key" => "store_panel_qr_table_no", "default"=> "store_panel_qr"])</strong></h4>

                        <p class="text-muted text-center"><strong>@include('layouts.render.translation',["key" => "store_panel_qr_alert_one", "default"=> "store_panel_qr"])<br>
                                @include('layouts.render.translation',["key" => "store_panel_qr_alert_two", "default"=> "store_panel_qr"]) </strong><br><br><br>
                            @include('layouts.render.translation',["key" => "store_panel_qr_alert_powered_by", "default"=> "store_panel_qr"])<br>
                            <img
                                src="{{asset($account_info !=NULL ? $account_info->application_logo:'assets_home/images/logo/logo.png')}}"
                                alt="logo" width="292px" height="69px;"><br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
