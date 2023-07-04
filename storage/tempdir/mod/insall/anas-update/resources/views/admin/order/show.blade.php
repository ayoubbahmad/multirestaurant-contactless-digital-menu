
@extends('layouts.admin-layout')
@section('title','Customer')
@section('content')

    <div class="content-page">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="font-weight-bold">Order Details</h4>
                        </div>
                        <div class="create-workform">
                            <div class="d-flex flex-wrap align-items-center justify-content-between text-white">
                                <div class="modal-product-search d-flex">
                                    <a class="session_clear_back btn btn-primary position-relative d-flex align-items-center justify-content-between">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                        </svg>
                                        Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="QuantityEditModel" tabindex="-1" role="dialog" aria-labelledby="EditItemTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="EditItemTitle">Edit Item</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="MyQuantityEditForm" enctype='multipart/form-data'>
                            {{ @csrf_field() }}
                            <div class="modal-body">
                                <form class="row g-3">
                                    <div class="col-md-12 mb-3">

                                        <label class="form-label font-weight-bold text-muted text-uppercase">Quantity<span class="text-danger">*</span></label>
                                        <span class="text-danger">Quantity must be Less than Previous Quantity</span> <br/>
                                        <input type="text" class="form-control" name="quantity" id="quantity" required placeholder="Enter Quantity">
                                        <input type="hidden" class="form-control" name="previous_quantity" id="previous_quantity" required placeholder="Enter Quantity">
                                        <input type="hidden" class="form-control" name="id" id="id">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="d-flex justify-content-end mt-3">
                                            <button class="btn btn-secondary mr-3" data-dismiss="modal">
                                                Cancel
                                            </button>
                                            <button type="submit" class="btn btn-primary edit_quantity">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item p-3">
                                <h5 class="font-weight-bold pb-2">Order Info</h5>
                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0">
                                        <tbody>
                                        <tr class="white-space-no-wrap">
                                            <td class="text-muted pl-0">
                                                ID
                                            </td>
                                            <td>
                                                {{$order->order_number}}
                                                <input type="hidden" name="order_id" id="order_id" value="{{$order->id}}"/>
                                            </td>
                                        </tr>
                                        <tr class="white-space-no-wrap">
                                            <td class="text-muted pl-0">
                                                Date &#38; Time
                                            </td>
                                            <td>
                                                {{$order->created_at}}
                                            </td>
                                        </tr>
                                        <tr class="white-space-no-wrap">
                                            <td class="text-muted pl-0">
                                                Order By
                                            </td>
                                            <td>
                                                <span class="mt-2 badge border border-dark text-dark mt-2">

                                                        {{orderBy($order->order_by)}}

                                                        </span>
                                            </td>
                                        </tr>
                                        <tr class="white-space-no-wrap">
                                            <td class="text-muted pl-0">
                                                Order Taker
                                            </td>
                                            <td>
                                                @isset($order->orderItemBy)
                                                    {{ $order->orderItemBy->name }}
                                                @endisset
                                            </td>
                                        </tr>
                                        <tr class="white-space-no-wrap">
                                            <td class="text-muted pl-0">
                                                Area
                                            </td>
                                            <td>
                                                <span class="mt-2 badge badge-light">
                                                    @isset($order->customer)
                                                        {{ area($order->customer->area_id) }}
                                                    @endisset
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="white-space-no-wrap">
                                            <td class="text-muted pl-0">
                                                Status
                                            </td>
                                            <td>
                                                <span class="mt-2 badge {{status_with_badge($order->order_status)}}">
                                                    {{status($order->order_status)}}
                                                </span>
                                            </td>
                                        </tr>
                                        @if(($order->order_status!=3))
                                            <tr class="white-space-no-wrap">
                                                <td class="text-muted pl-0">
                                                    Actions
                                                </td>
                                                <td>
                                                    <label
                                                        class="form-label font-weight-bold text-muted text-uppercase">Change order status To<span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-control select2"
                                                            data-placeholder="Choose one (with searchbox)"
                                                            id="status" name="status">
                                                        <option value="">--choose_order_staus--</option>
                                                        @if(($order->order_status==0))
                                                            <option value="1">Accept</option>
                                                            <option value="5">Reject</option>
                                                        @endif
                                                        @if(($order->order_status==1) || ($order->order_status==2) )
                                                            <option value="3">Completed</option>
                                                            <option value="6">Shipped</option>
                                                        @endif
                                                        @if($order->order_status==6)
                                                            <option value="3">Completed</option>
                                                        @endif
                                                    </select>
                                                </td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li class="list-group-item p-3">
                                <h5 class="font-weight-bold pb-2">Customer Details</h5>
                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0">
                                        <tbody>
                                        <tr class="white-space-no-wrap">
                                            <td class="text-muted pl-0">
                                                Name
                                            </td>
                                            <td>
                                                {{ $order->customer_name }}
                                            </td>
                                        </tr>
                                        <tr class="white-space-no-wrap">
                                            <td class="text-muted pl-0">
                                                Phone
                                            </td>
                                            <td>
                                                {{ $order->customer_phone_number }}
                                            </td>
                                        </tr>
                                        <tr class="white-space-no-wrap">
                                            <td class="text-muted pl-0">
                                                Address
                                            </td>
                                            <td>
                                                {{ $order->address }} <br/>
                                                {{ $order->district }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item p-3">
                                <h5 class="font-weight-bold">Order Items</h5>
                            </li>
                            <li class="list-group-item p-0">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="text-muted font-weight-bold mb-0">#</th>
                                            <th scope="col" class="text-muted font-weight-bold mb-0">Product</th>
                                            <th scope="col" class="text-muted font-weight-bold mb-0">Rate</th>
                                            <th scope="col" class="text-muted text-center font-weight-bold mb-0">Qty</th>
                                            <th scope="col" class="text-muted font-weight-bold mb-0">Total</th>
                                            <th scope="col" class="text-muted text-right font-weight-bold">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $i = 1;
                                            $total_sum = 0;
                                        @endphp
                                        @foreach($order->orderItemDetails as $item)
                                            @php
                                                $total = 0;
                                            @endphp
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>
                                                    <div class="data-content">
                                                        <div class="mb-1">
                                                            <span class="font-weight-bold">{{ $item->product_name }}</span>
                                                        </div>
                                                        <span class="text-muted">
                                                        @isset($order->orderItemAddOnDetails)
                                                                @foreach($order->orderItemAddOnDetails as $addOn)
                                                                    @if($addOn->order_item_details_id == $item->id)
                                                                        {{ addOnCategoryType($addOn->add_on_type) }} :
                                                                        @if($addOn->add_on_type=="1")

                                                                            {{ $addOn->add_on_name }}
                                                                            [{{ $addOn->add_on_color_code }}]
                                                                        @endif
                                                                        @if($addOn->add_on_type=="2")
                                                                            {{ $addOn->add_on_name }}
                                                                            [ ₹ {{ $addOn->add_on_price }}]
                                                                        @endif
                                                                        <br>
                                                                    @endif
                                                                    
                                                                @endforeach
                                                            @endisset
                                                            </span>
                                                    </div>
                                                </td>
                                                <td>₹{{ $item->product_price }}</td>
                                                <td class="text-center">
                                                    @php
                                                        $flag=0;
                                                    @endphp
                                                    @if (session()->has('orders'))

                                                        @foreach((array) session('orders') as $id => $details)
                                                            @if($details['id']==$item->id)
                                                                @php
                                                                    $flag=1;
                                                                    $quantity = $details['quantity'];
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                    @endif

                                                    @if($flag==1)
                                                        {{ $quantity }}
                                                        @php
                                                            $total = $total + ($quantity * $item->product_price);
                                                        @endphp

                                                    @else
                                                        {{ $item->product_quantity }}
                                                        @php
                                                            $total = $total + ($item->product_quantity * $item->product_price);
                                                        @endphp
                                                    @endif


                                                </td>
                                                <td>₹{{$total}}</td>
                                                @php
                                                    $edit_flag = 0;
                                                @endphp
                                                @if (session()->has('orders'))
                                                    @foreach((array) session('orders') as $id => $details)

                                                        @if($details['id']==$item->id)
                                                            @php
                                                                $edit_flag = 1;
                                                            @endphp
                                                        @endif
                                                    @endforeach


                                                    @if($edit_flag==0)
                                                        <td class="text-right">
                                                            <a class="btn btn-sm bg-light mr-2 editQuantity" data-item_detail_id="{{$item->id}}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                                </svg> Edit
                                                            </a>
                                                        </td>
                                                    @endif
                                                @else
                                                    <td class="text-right">
                                                        <a class="btn btn-sm bg-light mr-2 editQuantity" data-item_detail_id="{{$item->id}}" data-order_id="{{$order->id}}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                            </svg> Edit
                                                        </a>
                                                    </td>
                                                @endif
                                            </tr>
                                            @php
                                                $total_sum = $total_sum + $total;
                                            @endphp
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                            <li class="list-group-item p-3">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div>
                                            <h5>Total: <span class="ml-2 mb-0 font-weight-bold">₹{{$total_sum }}</span></h5>
                                        </div>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>

                    @if (session()->has('orders'))
                        <div class="col-lg-8">
                            <div class="card">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item p-3">
                                        <h5 class="font-weight-bold">Non Stock Items</h5>
                                    </li>
                                    <li class="list-group-item p-0">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th scope="col" class="text-muted font-weight-bold mb-0">#</th>
                                                    <th scope="col" class="text-muted font-weight-bold mb-0">Product</th>
                                                    <th scope="col" class="text-muted font-weight-bold mb-0">Rate</th>
                                                    <th scope="col" class="text-muted text-center font-weight-bold mb-0">Qty</th>
                                                    <th scope="col" class="text-muted font-weight-bold mb-0">Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $i = 1;
                                                @endphp


                                                @foreach((array) session('orders') as $id => $details)
                                                    @php
                                                        $item = App\OrderItemDetail::find($details['id']);
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $i++ }} <br></td>
                                                        <td>
                                                            <div class="data-content">
                                                                <div class="mb-1">
                                                                    <span class="font-weight-bold">{{ $item->product_name }}</span>
                                                                </div>
                                                                <span class="text-muted">
                                                            @php
                                                                $add_ons = App\OrderItemAddOnDetail::where('order_id',$item->order_id)->get();
                                                            @endphp
                                                               @if($add_ons)
                                                                        @foreach ($add_ons as $add_on)
                                                                     
                                                                        @if($add_on->order_item_details_id == $item->id)
                                                                      
                                                                                {{ addOnCategoryType($add_on->add_on_type) }} :
                                                                                @if($add_on->add_on_type=="1")

                                                                                    {{ $add_on->add_on_name }}
                                                                                    [{{ $add_on->add_on_color_code }}]
                                                                                @endif
                                                                                @if($add_on->add_on_type=="2")
                                                                                    {{ $add_on->add_on_name }}
                                                                                    [ ₹ {{ $add_on->add_on_price }}]
                                                                                @endif
                                                                            @endif

                                                                        @endforeach
                                                                    @endif
                                                            </span>
                                                            </div>
                                                        </td>
                                                        <td>₹{{ $item->product_price }}</td>
                                                        <td class="text-center"> {{ $item->product_quantity - $details['quantity'] }}</td>
                                                        <td>₹{{($item->product_quantity - $details['quantity']) * $item->product_price}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </li>

                                    <li class="list-group-item p-3">
                                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                                            <div class="modal-product-search d-flex">
                                                <button class="session_clear btn btn-primary position-relative d-flex align-items-center justify-content-between">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                                    </svg>
                                                    Cancel
                                                </button>
                                                <button class="update_non_stock_order btn btn-primary position-relative d-flex align-items-center justify-content-between">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                                    </svg>
                                                    Update
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    </div>
@endsection

@push('js')
    <script>
        /* order status change */

        $('#status').on('change', function () {
            var orderStatus = $('#status').val();
            var orderId = $('#order_id').val();
            if (orderStatus) {
                $.ajax({
                    url: "{{ url('admin/orders/change-order-status') }}",
                    data: {
                        order_status: orderStatus,
                        order_id: orderId,
                    },
                    type: "GET",

                    success: function (data) {
                        window.location.href = "{{ url('admin/orders/') }}";
                    }
                });
            }
        });
    </script>

    <script>
        /* edit Tax */
        $('body').on('click', '.editQuantity', function() {
            'use strict';
            var id = $(this).data('item_detail_id');
            var order_id = $('#order_id').val();
            var url = "{{ url('admin/orders/update') }}" + '/' + id+ '/' + order_id;
            $.get(url, function(data) {
                $('#QuantityEditModel').modal('show');
                $('#quantity').val(data.data.product_quantity);
                $('#previous_quantity').val(data.data.product_quantity);
                $('#id').val(data.data.id);
            })
        });
    </script>
    <script>
        /* update tax */
        $(document).on("click", ".edit_quantity", function(event) {
            'use strict';
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var id = $('#id').val();
            var order_id = $('#order_id').val();
            if ($('#quantity').val() == '') {
                alert("please enter quantity");
                return false;
            }

            if (isNaN($('#quantity').val())) {
                alert("please enter valid quantity.");
                return false;
            }

            if(parseInt($('#quantity').val())>=parseInt($('#previous_quantity').val())) {
                alert("Quantity must be Less than Previous quantity");
                return false;
            }

            $.ajax({
                url: "{{ url('admin/orders/update') }}" + '/' + id+ '/' + order_id,
                data: $('#MyQuantityEditForm').serialize(),
                type: "POST",
                success: function(data) {
                    if (data == "error") {
                        swal("Failure!", "Name already Taken.", "error");
                    } else {
                        $('#MyQuantityEditForm').trigger("reset");
                        $('#QuantityEditModel').modal('hide')
                        window.location.reload();
                    }
                }
            });

        });
    </script>

    <script>
        /* Session Clear */

        $('.session_clear').on('click', function () {
            $.ajax({
                url: "{{ url('admin/orders/session-clear') }}",
                success: function (data) {
                    location.reload();
                }
            });
        });
    </script>

    <script>
        /* Session Clear */

        $('.session_clear_back').on('click', function () {
            $.ajax({
                url: "{{ url('admin/orders/session-clear') }}",
                success: function (data) {
                    window.location.href = "{{ URL::to('admin/orders') }}";
                }
            });
        });
    </script>

    <script>
        /* Update Non Stock Order */

        $('.update_non_stock_order').on('click', function () {
            $.ajax({
                url: "{{ url('admin/orders/update-non-stock-order') }}",
                success: function (data) {
                    swal({
                        title: "Success!",
                        text: "Non Stock Order Updated successfully.",
                        icon: 'success',
                        dangerMode: true,
                        buttons: {
                            confirm: {
                                text: 'ok',
                                value: true,
                                visible: true,
                                closeModal: true
                            },
                        },
                    })
                        .then((isConfirm) => {
                            if (isConfirm) {
                                /* if the response is ok */
                                window.location.href = "{{ url('admin/orders/') }}";
                            }
                        });
                }
            });
        });

    </script>
@endpush
