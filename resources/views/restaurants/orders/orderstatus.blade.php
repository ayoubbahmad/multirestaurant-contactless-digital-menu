@extends("restaurants.layouts.restaurants_layout")

@section("restaurant_content")
    <div class="container-fluid">

        <div class="row">
            <div id="" class="col-lg-4 col-md-4 col-sm-12 col-12 layout-spacing">
                <div class="card" style="background-color: #e2a03f">
                    <div class="card-header" style="background-color: #e2a03f;">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4 class="text-white" style="padding-left: 0">{{$selected_language->data['store_view_order_status_new_order'] ?? 'New Order'}}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="" style="background-color: #fff">
                        <div class="table-responsive">
                            <table class="table table-hover mb-3 text-center">
                                <thead>
                                <tr>
                                    <th style="padding-bottom: 0; font-size: 15px">{{$selected_language->data['store_orders_order_id'] ?? 'Order Id'}}</th>
                                    <th style="padding-bottom: 0; font-size: 15px">{{$selected_language->data['store_orders_table_no'] ?? 'Table No'}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($neworder as $new)
                                    <tr style="border-bottom: 1px solid #d9d9d9">
                                        <td style="padding: 10px; font-size: 15px">{{ $new->order_unique_id }}</td>
                                        <td style="padding: 10px; font-size: 15px">{{ $new->table_no }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div id="" class="col-lg-4 col-md-4 col-sm-12 col-12 ">
                <div class="card" style="background-color: #e2a03f">
                    <div class="card-header" style="background-color: #8dbf42;">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4 class="text-white" style="padding-left: 0">{{$selected_language->data['store_orders_status_processing'] ?? 'Processing'}}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="" style="background-color: #fff">
                        <div class="table-responsive">
                            <table class="table table-hover mb-3 text-center">
                                <thead>
                                <tr>
                                    <th style="padding-bottom: 0; font-size: 15px">{{$selected_language->data['store_orders_order_id'] ?? 'Order Id'}}</th>
                                    <th style="padding-bottom: 0; font-size: 15px">{{$selected_language->data['store_orders_table_no'] ?? 'Table No'}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $data)
                                    <tr style="border-bottom: 1px solid #d9d9d9">
                                        <td style="padding:10px; font-size: 15px">{{ $data->order_unique_id }}</td>
                                        <td style="padding:10px; font-size: 15px">{{ $data->table_no }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div id="" class="col-lg-4 col-md-4 col-sm-12 col-12 layout-spacing">
                <div class="card" style="background-color: #5c1ac3">
                    <div class="card-header" style="background-color: #5c1ac3">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4 class="text-white" style="padding-left: 0">{{$selected_language->data['store_orders_status_ready'] ?? 'Ready'}}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content" style="background-color: #fff">
                        <div class="table-responsive">
                            <table class="table table-hover mb-3 text-center">
                                <thead>
                                <tr>
                                    <th style="padding-bottom: 0; font-size: 15px">{{$selected_language->data['store_orders_order_id'] ?? 'Order Id'}}</th>
                                    <th style="padding-bottom: 0; font-size: 15px">{{$selected_language->data['store_orders_table_no'] ?? 'Table No'}}</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($ready as $read)
                                    <tr>
                                        <td style="padding:10px; font-size: 15px">{{ $read->order_unique_id }}</td>
                                        <td style="padding:10px; font-size: 15px;">{{ $read->table_no }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
