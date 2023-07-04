@extends("restaurants.layouts.restaurants_layout")

@section("restaurant_content")

     <div class="container-fluid">
        <div class="layout-px-spacing">

            <div class="row layout-top-spacing layout-spacing">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>{{$selected_language->data['store_panel_customers_head'] ?? 'Recent Customers'}}</h4>
                                </div>
                            </div>
                        <div class="table-responsive">
                            @if(session()->has("MSG"))
                                <div class="alert alert-{{session()->get("TYPE")}}">
                                    <strong> <a>{{session()->get("MSG")}}</a></strong>
                                </div>
                            @endif
                            <table id="zero-config" class="table table-hover text-center" style="width:100%">
                                <thead>
                                <tr>
                                    <th>{{$selected_language->data['store_panel_common_no'] ?? 'No'}}</th>
                                    <th>{{$selected_language->data['store_panel_common_name'] ?? 'Name'}}</th>
                                    <th>{{$selected_language->data['store_view_orders_customer_phone'] ?? 'Phone No'}}</th>
                                    <th>{{$selected_language->data['store_panel_no_of_orders'] ?? 'No of Orders'}}</th>
                                    <th>{{$selected_language->data['store_panel_recent_order'] ?? 'Recent Order'}}</th>
                                </tr>
                                </thead>
                                <tbody>

                                @php $i=1 @endphp
                                @foreach($customers as $key => $data)

                                    <tr>
                                        <td>{{$customers->firstItem() + $key}} </td>
                                        <td>{{$data->customer_name}}</td>
                                        <td>{{$data->customer_phone}} </td>
                                        <td>
                                            {{$data->total($data->customer_phone)}}
                                        </td>
                                        <td> {{$data->created_at->diffForHumans()}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $customers->links('restaurants.orders.custom-pagination') }}
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
