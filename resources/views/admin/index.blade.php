@extends("admin.admin_layout.adminlayout")

@section("admin_content")
<style>
    td{
        vertical-align: middle;
    }
</style>
<div class="container-fluid">

    <div class="row mt-0">

                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body widget-user">
                            <div class="text-center">
                                <h2 class="fw-normal text-primary" data-plugin="counterup">{{$store_count}}</h2>
                                <h5>{{ __('chef.stores') }}</h5>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body widget-user">
                            <div class="text-center">
                                <h2 class="fw-normal text-danger" data-plugin="counterup">{{$product_count}}</h2>
                                <h5>{{ __('chef.products') }}</h5>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body widget-user">
                            <div class="text-center">
                                <h2 class="fw-normal text-success" data-plugin="">@include('layouts.render.currency',["amount"=>$earnings])</h2>
                                <h5>{{ __('chef.earnings') }}</h5>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body widget-user">
                            <div class="text-center">
                                <h2 class="fw-normal text-info" data-plugin="counterup">{{$pending_stores }}</h2>
                                <h5>{{ __('chef.pendingstores') }}</h5>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="card">
                        
                        <div class="card-body">
                        <div class="header-title">
                            <a href={{route('transactions')}}>
                                <h5 class="">Transactions</h5>
                            </a>
                        </div>
                        <div class="inbox-widget">
                            @foreach($transactions as $value)

                                <div class="inbox-item">
                            <a href="">          

                                    <div class="inbox-item-img">
                                        <svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                    </div>
                                           
                                        <h4 class="inbox-item-author mt-0 mb-1">
                                            @foreach($value->store($value->store_id) as $data)
                                                {{ $data->store_name }}
                                            @endforeach
                                        </h4>
                                    <p class="inbox-item-text">{{ $value->subscription_name}} / @include('layouts.render.currency',["amount"=>$value->subscription_price])</p>
                                        <p class="inbox-item-date"><span>{{$value->payment_status == 'unpaid' ? "UnPaid":"Paid"}}</span> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-down"><line x1="12" y1="5" x2="12" y2="19"></line><polyline points="19 12 12 19 5 12"></polyline></svg></p>
                                    
                                    </div>
                                </a>   
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

                <div class="col-lg-6 layout-spacing">
                    <div class="card">

                        

                        <div class="card-body">
                            <div class="header-title">
                                <h5 class="">New Registrations</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th><div class="th-content">Store</div></th>
                                        <th><div class="th-content">Email</div></th>
                                        <th><div class="th-content th-heading">Phone number</div></th>
                                        <th><div class="th-content">Subscription End Date</div></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($new_stores as $data)
                                            <tr>
                                                <td><div class="td-content customer-name"><img src="{{asset(($data->logo_url !=NULL) && ($data->logo_url != "NaN") ? $data->logo_url :'assets/images/store.jpg')}}" class="mx-2 rounded-circle" style="width:40px; height:40px;" >{{$data->store_name}}</div></td>
                                                <td><div class="td-content product-brand">{{$data->email}}</div></td>
                                                <td><div class="td-content">{{$data->phone}}</div></td>
                                                <td><div class="td-content pricing"><span class="">{{date('d-m-Y',strtotime($data->subscription_end_date))}}</span></div></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 layout-spacing">
                    <div class="card">

                        

                        <div class="card-body">
                            <div class="header-title">
                                <h5 class="">Expired Stores</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th><div class="th-content">Store</div></th>
                                        <th><div class="th-content th-heading">Email</div></th>
                                        <th><div class="th-content th-heading">Phone number</div></th>
                                        <th><div class="th-content">Subscription End Date</div></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($expired_stores as $data)
                                            <tr>
                                                <td><div class="td-content product-name"><img src="{{asset(($data->logo_url !=NULL) && ($data->logo_url != "NaN") ? $data->logo_url :'assets/images/store.jpg')}}" class="mx-2 rounded-circle" style="width:40px; height:40px;">{{$data->store_name}}</div></td>
                                                <td><div class="td-content"><span class="pricing">{{$data->email}}</span></div></td>
                                                <td><div class="td-content"><span class="discount-pricing">{{$data->phone}}</span></div></td>
                                                <td><div class="td-content">{{date('d-m-Y',strtotime($data->subscription_end_date))}}</div></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
{{--        <div class="footer-wrapper">--}}
{{--            <div class="footer-section f-section-1">--}}
{{--                <p class="">Copyright © 2020 <a target="_blank" href="https://designreset.com">DesignReset</a>, All rights reserved.</p>--}}
{{--            </div>--}}
{{--            <div class="footer-section f-section-2">--}}
{{--                <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>

@endsection
