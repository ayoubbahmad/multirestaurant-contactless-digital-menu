@extends("restaurants.layouts.restaurants_layout")

@section("restaurant_content")

     <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box page-title-box-alt">
                    <h4 class="page-title">{{$selected_language->data['store_panel_plan_subscription_history'] ?? 'Subscription History'}}</h4>
                </div>
            </div>
        </div>
        <div class="layout-px-spacing">

            <div class="row layout-top-spacing layout-spacing">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4></h4>
                                </div>
                            </div>
                        <div class="table-responsive">
                            @if(session()->has("MSG"))
                                <div class="alert alert-{{session()->get("TYPE")}}">
                                    <strong> <a>{{session()->get("MSG")}}</a></strong>
                                </div>
                            @endif
                            <table id="datatable" class="table table-hover" style="width:100%">
                                <thead>
                                <tr>
                                    <th>{{$selected_language->data['store_panel_common_no'] ?? 'No'}}</th>
                                    <th>{{$selected_language->data['store_panel_common_name'] ?? 'Name'}}</th>
                                    <th>{{$selected_language->data['store_panel_common_price'] ?? 'Price'}}</th>
                                    <th>{{$selected_language->data['store_panel_plan_no_of_days'] ?? 'No of Days'}}</th>
                                    <th>{{$selected_language->data['store_panel_plan_payment_status'] ?? 'Payment Status'}}</th>
                                    <th>{{$selected_language->data['store_panel_plan_gateway'] ?? 'Gateway'}}</th>
                                    <th>{{$selected_language->data['store_panel_plan_payment_transactional_id'] ?? 'Payment Transactional Id'}}</th>
                                    <th>{{$selected_language->data['store_panel_common_date'] ?? 'Date'}}</th>
                                </tr>
                                </thead>

                                <tbody>

                                @php $i=1 @endphp
                                @foreach($store_plan_history as $data)

                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$data->subscription_name}}</td>
                                        <td>{{$data->subscription_price}} </td>
                                        <td>
                                            <span class="btn-xs btn-info " style="width: 65px; height:50px">{{round($data->subscription_days)}} {{$selected_language->data['store_panel_plan_days'] ?? 'Days'}}</span>
                                        </td>
                                        <td>
                                            <span class="btn-xs btn-{{$data->payment_status != "paid"?"danger":"success"}}" style="width: 65px; height:50px">{{$data->payment_status}}</span>
                                        </td>
                                        <td>{{$data->gateway_name}}</td>
                                        <td>
                                                <input value="{{$data->payment_transactional_id}}" type="text" name="name" class="form-control" required>
                                        </td>
                                        <td> {{date('d-m-Y H:i:s', strtotime($data->created_at))}}</td>

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


@endsection
