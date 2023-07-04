@extends('layouts.admin-layout')
@section('title','Order')
@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="font-weight-bold">Create Order</h4>
                        </div>
                        <div class="create-workform">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <div class="modal-product-search d-flex">
                                    <a href="{{ url('admin/orders/')}}"
                                       class="btn btn-primary btn-sm d-flex align-items-center justify-content-between ml-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20"
                                             fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                        <span class="ml-2">Back</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    @php
                                        //$settings = new App\MasterSetting();
                                        //$site = $settings->siteData();
                                        $customers = App\User::where('user_type',2)->latest()->get();
                                        $products = App\Product::where('is_active', 1)->get();
                                        $currency = '₹';
                                    @endphp

                                    {{ @csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12 mb-5">
                                                    <div class="d-flex justify-content-center">
                                                        <p class="line-around text-secondary mb-0"><span
                                                                class="line-around-1 text-uppercase">Customer Details</span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label
                                                        class="form-label font-weight-bold text-muted text-uppercase">Customer<span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-control select2"
                                                            data-placeholder="Choose one (with searchbox)"
                                                            id="customer" name="customer">
                                                        <option value="">--choose_customer--</option>
                                                        @foreach ($customers as $row)
                                                            <option
                                                                value="{{ $row->id }}">{{ ($row->customer)?$row->customer->store_name:"" }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label
                                                        class="form-label font-weight-bold text-muted text-uppercase">Order
                                                        Date</label><span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" placeholder="order Date"
                                                           name="order_date" id="order_date"
                                                           value="{{ \Carbon\Carbon::today()->format('Y-m-d')}}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label
                                                        class="form-label font-weight-bold text-muted text-uppercase">Order
                                                        Number<span class="text-danger">*</span></label>
                                                    <input type="text" name="generated_order_number"
                                                           class="form-control"
                                                           id="generated_order_number"
                                                           value="{{ generate_ordernumber() }}" readonly>
                                                </div>
                                                <div class="col-md-6 mb-3">

                                                    <label for="area_id"
                                                           class="form-label font-weight-bold text-muted text-uppercase">Area <br>
                                                    <span class="mt-2 badge badge-light"><span id="area_name"></span></span>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="Text9"
                                                           class="form-label font-weight-bold text-muted text-uppercase">Bill
                                                        To<span class="text-danger">*</span></label>
                                                    <div class="billed-to">
                                                        <h6><span id="store_name"></span></h6>
                                                        <p><span id="address"></span><br>
                                                            <span id="license_number"></span><br>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-3 mb-5">
                                                    <div class="d-flex justify-content-center">
                                                        <p class="line-around text-secondary mb-0"><span
                                                                class="line-around-1 text-uppercase">Product Details</span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label
                                                        class="form-label font-weight-bold text-muted text-uppercase">Choose
                                                        Product<span class="text-danger">*</span></label>
                                                    <select class="form-control select2"
                                                            data-placeholder="Choose one (with searchbox)"
                                                            name="product" id="product">
                                                        <option value="">--choose_product--</option>
                                                        @foreach ($products as $row)
                                                            <option value="{{ $row->id }}">{{ $row->name }}/{{ $row->article_number}} [
                                                                {{ $currency }}{{ (($row->discount_price!="") || ($row->discount_price!=0)) ? $row->discount_price : $row->price  }}]
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-12 mt-3 mb-5">
                                                    <form id="product-form">
                                                        <div class="table-responsive mt-4">
                                                            <table class="table table-bordered border text-nowrap mb-0"
                                                                   id="order-table">
                                                                <thead>
                                                                <tr>
                                                                    <th class="wd-20p">product</th>
                                                                    <th class="tx-center">qty</th>
                                                                    <th class="tx-right">unit_price</th>
                                                                    <th class="tx-right">amount</th>
                                                                    <th class="tx-right">actions</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                </tbody>
                                                            </table>
                                                            <div class="col-md-12 mt-3 mb-5">
                                                                <table
                                                                    class="table table-bordered border text-nowrap mb-0">
                                        x                            <tbody>

                                                                    <tr>
                                                                        <td class="text-uppercase font-weight-semibold">
                                                                            total
                                                                        </td>
                                                                        <td class="tx-right">
                                                                            <h4 class="text-dark font-weight-bold">{{ $currency }}
                                                                                <b
                                                                                    class="net_total">0</b></h4>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                                <input type="hidden" name="customer_id"
                                                                       id="customer_id"/>
                                                                <input type="hidden" name="net_total" id="net_total"/>

                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                <div class="d-flex justify-content-end mt-3">
                                                                    <button type="button" class="btn btn-primary "
                                                                            id="submit_order">save
                                                                    </button>
                                                                </div>
                                                            </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="quantityModal" tabindex="-1" role="dialog"
         aria-labelledby="AddSliderTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Quantity and AddOns</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="col-md-12 mb-3">
                        @php
                            $addOnCategories = App\AddOnCategory::get();
                        @endphp

                        <div id="add_on_category_content_div"></div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label font-weight-bold text-uppercase"> Quantity <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="qty" name="qty" value=""/>
                        <input type="hidden" class="form-control" id="id" name="id" value=""/>
                        <input type="hidden" class="form-control" id="name" name="name" value=""/>
                        <input type="hidden" class="form-control" id="price" name="price" value=""/>
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="d-flex justify-content-end mt-3">
                            <button type="reset" class="btn btn-secondary mr-3"
                                    data-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-primary add_product">
                                Add
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <div class="modal fade" id="updateQuantityModal" tabindex="-1" role="dialog"
         aria-labelledby="AddSliderTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Quantity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="col-md-12 mb-3">
                        <label class="form-label font-weight-bold text-uppercase"> Quantity <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="update_qty" name="update_qty" value=""/>
                        <input type="hidden" class="form-control" id="update_id" name="update_id" value=""/>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label font-weight-bold text-uppercase"> Price <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="update_price" name="update_price" value=""/>
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="d-flex justify-content-end mt-3">
                            <button type="reset" class="btn btn-secondary mr-3"
                                    data-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-primary update_item">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            'use strict';
            var i = 0,
                payable = 0;

            /* tax calculation */
            function total_calculation() {
                'use strict';
                $('.outstanding').html(parseFloat(payable));
                $('.sub_total').html(payable.toFixed(2));
                $('.net_total').html((payable).toFixed(2));
            }

            /* customer address entry */
            $('select[name="customer"]').on('change', function () {
                'use strict';
                $("#product").val('').trigger('change');
                var customerId = $(this).val();
                var url = "{{ url('admin/orders/get-customer') }}" + '/' + customerId;
                $.get(url, function (data) {
                    /* if opening balance is available */
                    $('#address').html(data.customer.address);
                    $('#store_name').html(data.customer.store_name);
                    $('#license_number').html(data.customer.license_number);
                    $('#area_name').html(data.area_name);
                    total_calculation();
                })
            });
            /* quantity entry */
            $('select[name="product"]').on('change', function () {
                'use strict';
                if ($('#customer').val() == '') {
                    /* if the customer is null */
                    alert("Please choose customer before make order");
                    return false;
                }
                var productId = $(this).val();
                if (productId != "") {
                    /* if the product is non empty */
                    var url = "{{ url('admin/orders/get-product') }}" + '/' + productId;
                    $.get(url, function (data) {
                        $('#quantityModal').modal('show');
                        $("#qty").val('');
                        $('#name').val(data.data.name);
                        if(data.data.discount_price==0) {
                            $('#price').val(data.data.price);
                        } else {
                            $('#price').val(data.data.discount_price);
                        }

                        $('#id').val(data.data.id);
                        $('#add_on_category_content_div').html(data.addOnCategoryContent);
                    })
                }
            });

            /* add product to table */
            $(".add_product").on('click', function () {
                'use strict';
                i = i + 1;
                var qty = $("#qty").val();
                var price = $("#price").val();

                if (isNaN(qty)) {
                    /*  if the input is not a number */
                    alert("Please Provide the input as a number");
                    $("#qty").val('');
                    return false;
                }
                if (qty == "") {
                    /* if the quantity is empty */
                    alert("Please Provide a valid quantity.");
                    return false;
                }
                if (parseInt(qty) <= 0) {
                    /*  if the input is not valid */
                    alert("Please Provide a valid quantity");
                    $("#qty").val('');
                    return false;
                }

                if (isNaN(price)) {
                    /*  if the input is not a number */
                    alert("Please Provide the input as a number");
                    $("#price").val('');
                    return false;
                }
                if (price == "") {
                    /* if the quantity is empty */
                    alert("Please Provide a valid price.");
                    return false;
                }
                var count = $('.add_on_item').length;
                var add_on_item = "";
                var add_on_total = 0;
                var add_on_color_id=0;
                var add_on_size_id=0;
                var add_on_category_type;
                var add_on_count = 0;
                $('select[name="add_on_item[]"]').each(function (index) {
                    add_on_item = add_on_item + $(this).find(':selected').data('name');
                    add_on_total = add_on_total + parseFloat($(this).find(':selected').data('price'));
                    add_on_item = add_on_item + '  [ ₹ ' + $(this).find(':selected').data('price') + ']' + '<br/>';
                    add_on_category_type = $(this).find(':selected').data('type');
                    if(add_on_category_type==1)
                    {
                        add_on_color_id = $(this).find(':selected').val();
                    } else {
                        add_on_size_id = $(this).find(':selected').val();
                    }
                    add_on_count = add_on_count + 1;
                });
                var name = $("#name").val();
                var product_id = $("#id").val();
                price = parseFloat(price) + parseFloat(add_on_total);
                var total = parseInt(qty) * parseFloat(price);
                payable = payable + total;
                var markup = '<tr id="row' + i + '" class="no"> <td class="text-left"> <h6>' + name + '</h6><br>' + add_on_item +
                    '<input type="hidden" name="name[]" value="' + name +
                    '" readonly/></td> <td class="text-dark unit"> <span class="unit_qty"> ' + qty +
                    '</span> <input class="qty_product" type="hidden" name="qty[]" value="' + qty +
                    '" readonly/></td> <td class="text-dark qty"> <span class="unit_price">' + price +
                    '</span>  <input type="hidden" name="add_on_color_id[]" value="' +
                    add_on_color_id + '" readonly/> <input type="hidden" name="add_on_size_id[]" value="' +
                    add_on_size_id + '" readonly/> <input type="hidden" name="add_on_count[]" value="' +
                    add_on_count + '" readonly/> <input type="hidden" class="price_product unit" name="price[]" value="' +
                    price + '" readonly/><input type="hidden" class="product_id unit" name="product_id[]" value="' +
                    product_id + '" readonly/><input type="hidden" class="add_on_price_product unit" name="add_on_price[]" value="' +
                    add_on_total + '" readonly/><td class="total"> <span class="unit_total"> ' + total +
                    '</span><input type="hidden" class="total_product" name="total[]" value="' + total +
                    '" readonly/></td> <td class="unit"><a href="#" class="btn btn-sm btn-dark radius-10  btn_edit" data-update_id="' +
                    i +
                    '"> <i class="fas fa-edit" aria-hidden="true"></i></a> <a href="#"class="btn btn-sm btn-danger radius-10 btn_remove" data-id="' +
                    i +
                    '" > <i class="fas fa-trash del product-remove" aria-hidden="true"></i></a></td></tr>';

                $("table#order-table tbody").append(markup);
                $('#quantityModal').modal('hide');
                $("#product").val('').trigger('change');
                total_calculation();
            });
            /* remove product */
            $(document).on('click', '.btn_remove', function () {
                'use strict';
                swal({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    dangerMode: true,
                    buttons: {
                        confirm: {
                            text: 'Yes, delete it!',
                            value: true,
                            visible: true,
                            closeModal: true
                        },
                        cancel: {
                            text: "No, cancel please!",
                            value: false,
                            visible: true,
                            closeModal: true,
                        }
                    },
                })
                    .then((isConfirm) => {
                        if (isConfirm) {
                            /* if the response is ok */
                            var button_id = $(this).attr("id");
                            var price = $(this).closest("tr").find(".total_product").val();
                            $('.sub_total').html(parseFloat($('.sub_total').html()) - price);
                            $('.net_total').html(parseFloat($('.net_total').html()) - price);
                            $('.outstanding').html(parseFloat($('.outstanding').html()) - price);
                            payable = payable - price;
                            $(this).closest('tr').remove();
                            total_calculation();
                        } else {
                            /* if the response is cancel */
                            swal("Cancelled", "Your data is safe.", "error");
                        }
                    });
            });
            /* edit quantity */
            $(document).on('click', '.btn_edit', function () {
                'use strict';
                $('#update_qty').val($(this).closest("tr").find(".qty_product").val());
                $('#update_price').val($(this).closest("tr").find(".price_product").val());
                $('#update_id').val($(this).attr('data-update_id'));
                $('#updateQuantityModal').modal('show');
            });
            /* update quantity */
            $(document).on('click', '.update_item', function () {
                'use strict';
                if (isNaN($('#update_qty').val())) {
                    /* if the quantity is not a number */
                    alert("Please Provide the input as a number.");
                    return false;
                }
                if ($('#update_qty').val() == "") {
                    /* if the quantity is null */
                    alert("Please Provide a valid quantity.");
                    return false;
                }

                if (parseInt($('#update_qty').val()) <= 0) {
                    /*  if the input is not valid */
                    alert("Please Provide a valid quantity");
                    $("#update_qty").val('');
                    return false;
                }
                if (isNaN($('#update_price').val())) {
                    /*  if the input is not a number */
                    alert("Please Provide the input as a number");
                    $('#update_price').val('');
                    return false;
                }
                if ($('#update_price').val() == "") {
                    /* if the price is empty */
                    alert("Please Provide a valid price.");
                    return false;
                }
                if (parseInt($('#update_price').val()) <= 0) {
                    /*  if the input is not valid */
                    alert("Please Provide a valid Price");
                    $("#update_price").val('');
                    return false;
                }
                var button_id = $('#update_id').val();
                var total = $('#row' + button_id + '').find(".total_product").val();
                $('.sub_total').html(parseFloat($('.sub_total').html()) - total);
                $('.net_total').html(parseFloat($('.net_total').html()) - total);
                $('.outstanding').html(parseFloat($('.outstanding').html()) - total);
                payable = payable - total;
                var total = parseFloat($('#update_price').val()) * parseInt($('#update_qty').val());
                $('#row' + button_id + '').find(".total_product").val(total);
                $('#row' + button_id + '').find(".qty_product").val($('#update_qty').val())
                $('#row' + button_id + '').find(".price_product").val($('#update_price').val())
                $('#row' + button_id + '').find(".unit_total").html(total);
                $('#row' + button_id + '').find(".unit_qty").html($('#update_qty').val())
                $('#row' + button_id + '').find(".unit_price").html($('#update_price').val())
                $('.net_total').html(parseFloat($('.net_total').html()) + total);
                $('.outstanding').html(parseFloat($('.outstanding').html()) + total);
                payable = payable + total;
                $('#updateQuantityModal').modal('hide');
                total_calculation();
            });
        });
    </script>
    <script>

        $(document).ready(function () {
            'use strict';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            /* submit the order */
            $(document).on("click", "#submit_order", function (event) {
                'use_strict';
                event.preventDefault();
                if ($('#customer').val() == '') {
                    /* if the customer is empty */
                    swal("Error!", "Please choose customer to make order.", "error");
                    return false;
                }
                if ($('#order_date').val() == '') {
                    /* if the order date is empty */
                    swal("Error!", "Please choose order date.", "error");
                    return false;
                }
                if ($('#due_date').val() == '') {
                    /* if the due date is empty */
                    swal("Error!", "Please choose due date.", "error");
                    return false;
                }
                $('#net_total').val($('.net_total').html());
                $('#customer_id').val($("#customer option:selected").val());
                //alert("no");
                if (parseFloat($('#net_total').val()) == 0) {
                    /* if the product total is empty */
                    swal("Error!", "Please choose Product to make order.", "error");
                    return false;
                }
                $(this).hide();
                $.ajax({
                    url: "{{ url('admin/orders/create') }}",
                    method: "POST",
                    data: $('#product-form').serialize() + "&date=" + $('#order_date').val() + "&due_date=" + $('#due_date').val() +
                        "&generated_order_number=" + $('#generated_order_number').val(),
                    success: function (data) {
                        /* order placed successfully */
                        swal({
                            title: "Success!",
                            text: "order created successfully.",
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
        });
    </script>

    <script>
        $(document).ready(function () {
            'use strict';
            $('#quantityModal').on('hidden.bs.modal', function () {
                $("#product").val('').trigger('change');
            });

            $('#updateQuantityModal').on('hidden.bs.modal', function () {
                $("#product").val('').trigger('change');
            });
        });
    </script>
@endpush
