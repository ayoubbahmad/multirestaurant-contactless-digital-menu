@extends("restaurants.layouts.restaurants_layout")

@section('restaurant_content')

    <style>
        .ticket * {
            font-size: 18px;
            font-family: 'Times New Roman';
        }


        .tickettd.description,
        th.description {
            width: 180px;
            max-width: 180px;
        }

        .ticket td.quantity,
        th.quantity {
            width: 60px;
            max-width: 60px;
            word-break: break-all;
        }

        .ticket td.price,
        th.price {
            width: 90px;
            max-width: 90px;
            word-break: break-all;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 310px;
            max-width: 310px;
        }

        img {
            max-width: inherit;
            width: inherit;
        }

    </style>

    {{-- {{$selected_language->data['store_view_orders_receipt'] ?? 'Receipt'}} --}}



    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 p-0">
                <div class="card">
                    <div class="card-header bg-white">
                        <div class="row">
                            <div class="col-6">

                                @if ($order->status == 1)
                                    <a class="btn btn-primary btn-sm text-white btn-icon"
                                        onclick="document.getElementById('accept_order{{ $order->id }}').submit();"><span
                                            class="btn-inner--icon"><i class="fas fa-check-circle"></i></span><span
                                            class="btn-inner--text">{{ $selected_language->data['store_orders_action_accept'] ?? 'Accept Order' }}</span></a>
                                    <a class="btn btn-danger btn-sm text-white btn-icon"
                                        onclick="document.getElementById('reject_order{{ $order->id }}').submit();"><span
                                            class="btn-inner--icon"><i class="fas fa-times-circle"></i></span><span
                                            class="btn-inner--text">{{ $selected_language->data['store_orders_action_reject'] ?? 'Reject Order' }}</span></a>
                                @endif
                                @if ($order->order_type == 1 && $order->payment_type == 1)
                                    <a class="btn btn-success btn-sm text-white btn-icon    "
                                        onclick="document.getElementById('merge_order{{ $order->id }}').submit();"><span
                                            class="btn-inner--icon"><i class="fas fa-plus-circle"></i></span><span
                                            class="btn-inner--text">{{ $selected_language->data['store_orders_action_merge'] ?? 'Merge Order' }}</span></a>
                                @endif


                                <form style="visibility: hidden" method="post"
                                    action="{{ route('store_admin.update_order_status', ['id' => $order->id]) }}"
                                    id="accept_order{{ $order->id }}">
                                    @csrf
                                    @method('patch')
                                    <input style="visibility:hidden" name="status" type="hidden" value="2">
                                </form>
                                <form style="visibility: hidden" method="post"
                                    action="{{ route('store_admin.update_order_status', ['id' => $order->id]) }}"
                                    id="reject_order{{ $order->id }}">
                                    @csrf
                                    @method('patch')
                                    <input style="visibility:hidden" name="status" type="hidden" value="3">
                                </form>

                                @if ($order->order_type == 1)
                                    <form style="visibility: hidden" method="post"
                                        action="{{ route('store_admin.merge_order', ['id' => $order->id]) }}"
                                        id="merge_order{{ $order->id }}">
                                        @csrf
                                        @method('patch')
                                        <input style="visibility:hidden" name="status" type="hidden" value="11">
                                    </form>
                                @endif
                            </div>
                            <div class="col-6 text-right d-flex justify-content-end">

                                <span class="btn btn-sm btn-secondary rounded-pill btn-icon">
                                    {{ $order->order_type == 1 ? 'Dining' : null }}
                                    {{ $order->order_type == 2 ? 'Takeaway' : null }}
                                    {{ $order->order_type == 3 ? 'Delivery' : null }}
                                    {{ $order->order_type == 4 ? 'Room' : null }}



                                </span>

                                <span class="btn btn-sm btn-secondary rounded-pill btn-icon" style="margin-left: 5px">
                                    {{ $order->status == 1 ? 'Order Placed' : null }}
                                    {{ $order->status == 2 ? 'Order Accepted' : null }}
                                    {{ $order->status == 5 ? 'Ready to Serve' : null }}
                                    {{ $order->status == 3 ? 'Order Rejected' : null }}
                                    {{ $order->status == 4 ? 'Order Completed' : null }}


                                </span>


                                <a href="javascript:void(0)" OnClick="printDiv('PrintBill')" id="printButton"
                                    class="btn btn-sm btn-danger rounded-pill btn-icon" style="margin-left: 5px">
                                    <span class="btn-inner--icon"><i class="fas fa-print"></i></span>
                                    <span
                                        class="btn-inner--text">{{ $selected_language->data['store_view_orders_print'] ?? 'Print' }}</span>
                                </a>

                                <a href="javascript:void(0)" OnClick="printDiv('PrintThermalBill')" id="thermalprintButton"
                                    class="btn btn-sm btn-primary rounded-pill btn-icon" style="margin-left: 5px">
                                    <span class="btn-inner--icon"><i class="fas fa-receipt"></i></span>
                                    <span
                                        class="btn-inner--text">{{ $selected_language->data['store_view_orders_print_thermal'] ?? 'Print Thermal' }}</span>
                                </a>


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-8 col-sm-12 p-0 shadow-md card p-3">

                        <div id="PrintBill" class="d-flex align-items-between flex-column justify-content-between"
                            style="    height: 648px;">
                            <div class="">
                                <div class="row inv--detail-section">
                                    @php
                                        $rating = \App\Models\OrderRating::where('order_id', $order->id)->first();
                                        
                                    @endphp
                                    @if ($rating && $rating->rating)
                                        <div class="col-sm-7 align-self-center">
                                            <p class="inv-detail-title">

                                                Rating:

                                                @for ($i = 0; $i < $rating->rating; $i++)
                                                    <i class="fas fa-star"></i>
                                                @endfor

                                            </p>

                                        </div>
                                        <div class="col-sm-5 align-self-center  text-sm-right order-sm-0 order-1">

                                        </div>
                                    @endif
                                    <div class="col-sm-7 align-self-center">
                                        <p class="inv-to">
                                            <b>{{ $selected_language->data['store_view_orders_customer_details'] ?? 'Customer Details' }}</b>
                                        </p>
                                    </div>
                                    <div class="col-sm-5 align-self-center  text-sm-right order-sm-0 order-1">
                                        <p class="inv-detail-title">
                                            <b>{{ $selected_language->data['store_view_orders_details'] ?? 'Order Details' }}</b>
                                        </p>
                                    </div>

                                    <div class="col-sm-7 align-self-center">
                                        <p class="inv-customer-name"><span class="inv-title"><b>
                                                    {{ $selected_language->data['store_view_orders_customer_name'] ?? 'Customer Name' }}
                                                    : </b></span>{{ $order->customer_name }}
                                        </p>
                                        <p class="inv-email-address"><span class="inv-title"><b>
                                                    {{ $selected_language->data['store_view_orders_customer_phone'] ?? 'Phone No' }}
                                                    : </b></span>{{ $order->customer_phone }}
                                        </p>
                                        <p class="inv-street-addr">
                                            @if ($order->order_type == 3)
                                                <b> Address
                                                    :</b> {{ $order->address }}
                                            @endif
                                        </p>
                                    </div>

                                    <div class="col-sm-5 align-self-center  text-sm-right order-2">
                                        <p class="inv-list-number"><span class="inv-title"><b>
                                                    {{ $selected_language->data['store_orders_order_id'] ?? 'Order Id' }} :
                                                </b></span>
                                            <span class="inv-number">{{ $order->order_unique_id }}</span>
                                        </p>

                                        <p class="inv-created-date"><span
                                                class="inv-title"><b>@include('layouts.render.translation',["key" =>
                                                    "store_panel_common_date", "default"=> "store_panel_common"]):
                                                </b></span>
                                            <span
                                                class="inv-date">{{ date('d-m-Y', strtotime($order->created_at)) }}</span>
                                        </p>

                                        @if ($order->order_type == 1)
                                            <p class="inv-due-date">
                                                <b> {{ $selected_language->data['store_orders_table_no'] ?? 'Table No' }}
                                                    :</b> {{ $order->table_no }}
                                            </p>
                                        @elseif($order->order_type == 4)
                                            <p class="inv-due-date">
                                                <b> {{ $selected_language->data['store_orders_room_no'] ?? 'Room No' }}
                                                    :</b> {{ $order->room_number }}
                                            </p>
                                        @endif
                                    </div>

                                </div>

                                <div class="row inv--product-table-section">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{ $selected_language->data['store_view_orders_item_name'] ?? 'Name' }}
                                                        </th>
                                                        <th>{{ $selected_language->data['store_view_orders_item_price'] ?? 'Price' }}
                                                        </th>
                                                        <th>{{ $selected_language->data['store_view_orders_item_qty'] ?? 'Qty' }}
                                                        </th>
                                                        <th>{{ $selected_language->data['store_orders_total'] ?? 'Total' }}
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($orderDetails as $order_data)
                                                        {{-- {{}} --}}
                                                        @foreach ($order_data['order_details'] as $key => $data)
                                                            <tr>
                                                                <th scope="row">{{ $key + 1 }}</th>

                                                                <td><b>{{ $data['name'] }}</b><br>


                                                                    @foreach ($data['order_details_extra_addon'] as $key => $exra)


                                                                        <span
                                                                            class="badge badge-primary">{{ $key + 1 }}</span>
                                                                        Name: <strong>{{ $exra['addon_name'] }}
                                                                            ( {{ $exra['addon_price'] }}
                                                                            )</strong>
                                                                        x
                                                                        <strong> {{ $exra['addon_count'] }}</strong>
                                                                        =
                                                                        <strong>
                                                                            {{ $account_info != null ? $account_info->currency_symbol : '₹' }}{{ $exra['addon_count'] * $exra['addon_price'] }}</strong>
                                                                        <br>
                                                                    @endforeach


                                                                </td>
                                                                <td>{{ $data['price'] }}</td>
                                                                <td>{{ $data['quantity'] }}</td>
                                                                <td class="color-primary">
                                                                    {{ $data['quantity'] * $data['price'] }}</td>


                                                            </tr>

                                                        @endforeach
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4 d-flex justify-content-end">
                                <div class="col-sm-7 col-12 order-sm-1 order-0">
                                    <div class="inv--total-amounts text-sm-right">
                                        <div class="row ">
                                            <div class="row">
                                                <div class="col-sm-4 col-7">
                                                    <p class="m-0 p-0">
                                                        {{ $selected_language->data['store_view_orders_sub_total'] ?? 'Sub Total:' }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-4 col-5">
                                                    <p class="m-0 p-0">
                                                        @include('layouts.render.currency',["amount"=>$order->sub_total])
                                                    </p>
                                                </div>
                                            </div>
                                            @if ($order->order_type == 3)
                                                <div class="row">
                                                    <div class="col-sm4 col-7">
                                                        <p class="m-0 p-0">
                                                            {{ $selected_language->data['delivery_charge'] ?? 'Delivery Charge:' }}
                                                        </p>
                                                    </div>
                                                    <div class="col-sm-4 col-5">
                                                        <p class="m-0 p-0">
                                                            @include('layouts.render.currency',["amount"=>$order->delivery_charge])
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="row">
                                                <div class="col-sm-4 col-7">
                                                    <p class="m-0 p-0">
                                                        {{ $selected_language->data['store_view_orders_service_charge'] ?? 'Service Charge' }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-4 col-5">
                                                    <p class="m-0 p-0">
                                                        @include('layouts.render.currency',["amount"=>$order->store_charge
                                                        ?? 0.00])</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4 col-7">
                                                    <p class=" discount-rate">
                                                        {{ $selected_language->data['store_view_orders_tax'] ?? 'Tax' }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-4 col-5">
                                                    <p class="">
                                                        @include('layouts.render.currency',["amount"=>$order->tax])</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-7 m-0 grand-total-title">
                                                <h4 class="m-0">
                                                    {{ $selected_language->data['store_orders_total'] ?? 'Total:' }} </h4>
                                            </div>
                                            <div class="col-sm-4 col-5 m-0 grand-total-amount">
                                                <h4 class="m-0">
                                                    @include('layouts.render.currency',["amount"=>$order->total])</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="col-lg-3 col-sm-6 shadow-md card p-3" style="margin-left: 5rem">
                        <div class="main" id="PrintThermalBill">

                            <div class="ticket w-auto d-flex align-items-center flex-column" style="max-width: 100%">

                                <p style="width: 300px; text-align: center">
                                    <strong
                                        style="font-size: 22px; font-weight: bold">{{ Auth::user()->store_name }}</strong><br>
                                    {{ $selected_language->data['store_view_orders_customer_phone'] ?? 'Phone No' }}:
                                    {{ Auth::user()->phone }}
                                    <br>{{ $selected_language->data['store_view_orders_email'] ?? 'Email' }}:
                                    {{ Auth::user()->email }}
                                    <br> {{ Auth::user()->address }}
                                </p>

                                <p style="width: 300px;text-align: center;">
                                    <small>{{ $order->customer_name }} - ({{ $order->customer_phone }})
                                        <br>@include('layouts.render.translation',["key" => "store_panel_common_date",
                                        "default"=> "store_panel_common"]): {{ $order->order_unique_id }}<br>Placed:
                                        {{ date('d-m-Y', strtotime($order->created_at)) }}</small>
                                </p>

                                <p style="width: 300px;font-size: 22px; font-weight: bold; text-align: center">
                                    {{ $selected_language->data['store_view_orders_thermal_cash_receipt'] ?? 'Cash Receipt' }}
                                </p>

                                <table>
                                    <thead>
                                        <tr style="border-bottom: 0.1em solid #999898">
                                            <th style="width: 50px;">
                                                {{ $selected_language->data['store_view_orders_item_qty'] ?? 'Qty' }}</th>
                                            <th style="width: 170px;">
                                                {{ $selected_language->data['store_view_orders_item_name'] ?? 'Name' }}
                                            </th>
                                            <th style="width: 65px;">
                                                {{ $selected_language->data['store_view_orders_amount'] ?? 'Amount' }}</th>
                                        </tr>

                                    </thead>
                                    <tbody>

                                        @foreach ($orderDetails as $order_data)
                                            @foreach ($order_data['order_details'] as $key => $data)
                                                <tr style="border-bottom: 0.1em solid #999898">
                                                    <td class="thermal-head-titile">{{ $data['quantity'] }}</td>
                                                    <td><b>{{ $data['name'] }}</b><br>


                                                        @foreach ($data['order_details_extra_addon'] as $key => $exra)


                                                            <span>{{ $key + 1 }}</span>.
                                                            {{ $exra['addon_name'] }}
                                                            ( {{ $exra['addon_price'] }})
                                                            x
                                                            {{ $exra['addon_count'] }} =
                                                            {{ $account_info != null ? $account_info->currency_symbol : '₹' }}{{ $exra['addon_count'] * $exra['addon_price'] }}
                                                            <br>
                                                        @endforeach


                                                    </td>

                                                    {{-- <td class="thermal-head-titile">{{$data['price']}}</td> --}}
                                                    <td class="thermal-head-titile">
                                                        {{ $data['quantity'] * $data['price'] }}</td>


                                                </tr>


                                            @endforeach
                                        @endforeach


                                    </tbody>
                                </table>

                                <br>

                                <div class="clearfix px-3" style="width: 300px;">

                                    {{ $selected_language->data['store_view_orders_sub_total'] ?? 'Subtotal' }} <span
                                        class="float-right">@include('layouts.render.currency',["amount"=>$order->sub_total])</span><br>

                                    {{ $selected_language->data['store_view_orders_service_charge'] ?? 'Service Charge' }}
                                    <span
                                        class="float-right">@include('layouts.render.currency',["amount"=>$order->store_charge])</span><br>

                                    {{ $selected_language->data['store_view_orders_tax'] ?? 'Tax' }}
                                    <span
                                        class="float-right">@include('layouts.render.currency',["amount"=>$order->tax])</span><br>

                                    @if ($order->order_type == 3)
                                        {{ $selected_language->data['delivery_charge'] ?? 'Delivery Charge' }}<span
                                            class="float-right">
                                            @include('layouts.render.currency',["amount"=>$order->delivery_charge])</span><br>
                                    @endif
                                    <div class="total-order">
                                        {{ $selected_language->data['store_orders_total'] ?? 'Total' }}
                                        <span
                                            class="float-right">@include('layouts.render.currency',["amount"=>$order->total])</span>
                                    </div>
                                </div>


                                <div class="px-3" style="width: 300px; text-align: center">
                                    <hr>
                                    {{ $selected_language->data['store_view_orders_thermal_thank_you'] ?? ' Thank you !' }}
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


            </div>
          
                        @if($order->comments)
                        <div class="col-12 p-0">
                            <div class="card">
                                <div class="card-body">
                         <b>Comments : {{$order->comments}}</b>
                        </div>
                    </div>
                </div>
                          @endif
               
        </div>




    </div>

    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>




@endsection
