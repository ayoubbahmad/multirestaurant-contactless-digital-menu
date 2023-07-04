@extends('layouts.admin-layout')
@section('title','Customer')
@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="font-weight-bold">Payments</h4>
                        </div>
                        <div class="create-workform">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                               <div class="modal-product-search d-flex">
                      
                                   <button type="button" class="btn btn-primary position-relative d-flex align-items-center justify-content-between" data-toggle="modal" data-target="#addPaymentModal">
                                       <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                       </svg>
                                       Add Payment
                                   </button>
                               </div>
                            </div>
                        </div>
                        <div class="modal fade" id="addPaymentModal" tabindex="-1" role="dialog" aria-labelledby="addPaymentModal" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="AddPaymentTitle">Add Payment</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @php
                                            $customers = App\User::where('user_type',2)->latest()->get();
                                            $currency = '₹';
                                        @endphp
                                        <form class="row g-3" enctype="multipart/form-data" id="myPaymentForm" method="post">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label font-weight-bold text-muted text-uppercase" for="ExpenseDate">Payment Date<span class="text-danger">*</span></label>
                                                <input type="date" name="paid_date" class="form-control" required id="ExpenseDate" value="{{ Carbon\Carbon::today()->toDateString() }}">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="customer" class="form-label font-weight-bold text-muted text-uppercase">Customer<span class="text-danger">*</span></label>
                                                <select id="customer" class="form-select form-control choicesjs" required name="customer">
                                                    <option value="">--select customer--</option>
                                                    @foreach ($customers as $row)
                                                        <option
                                                            value="{{ $row->id }}">{{ ($row->customer)?$row->customer->store_name:"" }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <label class="form-label font-weight-bold text-muted text-uppercase">Remaining Balance<span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" name="balance" id="balance" readonly>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <label class="form-label font-weight-bold text-muted text-uppercase">Amount<span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="paid" name="paid" placeholder="Enter Amount">
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <label for="Text9" class="form-label font-weight-bold text-muted text-uppercase">Notes</label>
                                                <textarea class="form-control" id="note" rows="2" placeholder="Enter Notes" name="note"></textarea>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <div class="d-flex justify-content-end mt-3">
                                                    <button type="reset" class="btn btn-secondary mr-3" data-dismiss="modal">
                                                        Cancel
                                                    </button>
                                                    <button type="submit" class="add_payment btn btn-primary">
                                                        Save
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="editPaymentModal" tabindex="-1" role="dialog" aria-labelledby="EditPaymentTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="EditPaymentTitle">Edit Payment</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @php
                                        $customers = App\User::where('user_type',2)->latest()->get();
                                        $currency = '₹';
                                    @endphp
                                    <form class="row g-3">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label font-weight-bold text-muted text-uppercase" for="ExpenseDate">Payment Date<span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" required id="edit_paid_date" name="edit_paid_date">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="edit_customer" class="form-label font-weight-bold text-muted text-uppercase">Customer<span class="text-danger">*</span></label>
                                            <select id="edit_customer" class="form-select form-control choicesjs" required>
                                                <option value="">--select customer--</option>
                                                @foreach ($customers as $row)
                                                    <option
                                                        value="{{ $row->id }}">{{ ($row->customer)?$row->customer->store_name:"" }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label font-weight-bold text-muted text-uppercase">Remaining Balance<span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="edit_balance" id="edit_balance" readonly value="">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label font-weight-bold text-muted text-uppercase">Amount<span class="text-danger">*</span></label>
                                            <input type="number" name="edit_paid" id="edit_paid" class="form-control" required placeholder="Enter Amount">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="Text9" class="form-label font-weight-bold text-muted text-uppercase">Notes</label>
                                            <textarea class="form-control" id="edit_note" id="edit_note" rows="2" placeholder="Enter Notes"></textarea>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="d-flex justify-content-end mt-3">
                                                <button type="reset" class="btn btn-secondary mr-3" data-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    Save
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table  table-responsive">
                                        <table class="table" id="datatable">
                                            <thead class="thead-light">
                                            <tr>
                                                <th scope="col"><label class="text-muted m-0">#</label></th>
                                                <th scope="col"><label class="text-muted mb-0">Date</label></th>
                                                <th scope="col"><label class="text-muted mb-0">Customer Name</label></th>
                                                <th scope="col"><label class="text-muted mb-0">Amount</label></th>
                                                <th scope="col"><label class="text-muted mb-0">Collected By</label></th>
                                                <th scope="col"><label class="text-muted mb-0">Status</label></th>
                                                <th scope="col"><label class="text-muted mb-0">Actions</label></th>
                                                <th scope="col" class="text-right"><label class="text-muted mb-0">More</label></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            
                                            </tbody>
                                        </table>
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
@endsection
    @push('js')

    <script>
                $(document).ready(function () {
                    $('#datatable').DataTable({

                        "lengthMenu": [10, 15, 20],
                        "pageLength": 10,
                        processing: true,
                        serverSide: true,
                        ajax: "{{ url('admin/payments') }}",
                        columns: [
                            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                            {data: 'date', name: 'date'},
                            {data: 'customer_name', name: 'customer_name'},
                            {data: 'amount', name: 'amount'},
                            {data: 'collected_by', name: 'collected_by'},
                            {data: 'status', name: 'status'},
                            {data: 'action', name: 'action', orderable: false, searchable: false, sWidth: "10%"},
                            {data: 'more', name: 'more', orderable: false, searchable: false, sWidth: "10%"},
                        ],
                        "fnDrawCallback": function () {
                        },
                    });
                });
            </script>


        <script>
        /* customer address entry */
        $('select[name="customer"]').on('change', function () {
        'use strict';
        $("#product").val('').trigger('change');
        var customerId = $(this).val();
        var url = "{{ url('admin/payments/balance') }}" + '/' + customerId;
        $.get(url, function (data) {
        /* if opening balance is available */
        $('#balance').val(data.data);
        {{-- alert(data.data); --}}

        })
        });
        </script>

        <script>
            /* add payment to table */
            $(".add_payment").on('click', function () {
                'use strict';
                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var balance = $("#balance").val();
                var paid = $("#paid").val();

                if ($('#customer').val() == "") {
                    /* if the paid is empty */
                    alert("Please Choose Customer to choose payment.");
                    return false;
                }

                if (paid == "") {
                    /* if the paid is empty */
                    alert("Payment amount cannot be empty.");
                    return false;
                }

                if (isNaN(paid)) {
                    /*  if the input is not a number */
                    alert("Please Provide the valid payment");
                    $("#paid").val('');
                    return false;
                }

                $.ajax({
                    url: "{{ url('admin/payments/create') }}",
                    data: $('#myPaymentForm').serialize(),
                    type: "POST",
                    success: function (data) {
                        if (data=="success") {
                            $('#myPaymentForm').trigger("reset");
                            $('#addPaymentModal').modal('hide')
                            swal({
                                title:"Success",
                                text: "Payment Added Successfully!",
                                icon: "success",
                                buttons: {
                                    confirm: {
                                        text: 'ok',
                                        value: true,
                                        visible: true,
                                        closeModal: true
                                    }                            },
                            })
                                .then((isConfirm) => {
                                    if (isConfirm) {
                                        /* if the response is ok */
                                        location.reload();
                                    }
                                });
                        }
                    }
                });

            });
        </script>

        <script>
            /* edit area */
            $('body').on('click', '.editPayment', function (event) {
                var id = $(this).data('id');
                var url = "{{ url('admin/payments/update') }}" + '/' + id;
                $.get(url, function (data) {
                    $('#editPaymentModal').modal('show');
                    $('#edit_customer').val(data.data.customer_id);
                    $('#id').val(data.data.id);
                    $('#edit_paid').val(data.data.paid);
                    $('#edit_paid_date').val(data.data.paid_date);
                    $('#edit_note').val(data.data.note);
                })
            });

        </script>

        <script>

            /* update area  */
            $(document).on("click", ".update_area", function (event) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                event.preventDefault();
                var postData = new FormData($("#myBrandUpdateForm")[0]);
                if($('#edit_name').val()=="") {
                    swal("Failure!", "Please enter area name.", "error");
                    return false;
                }
                var id = $('#id').val();
                $.ajax({
                    url: "{{ url('admin/areas/update') }}" + '/' + id,
                    data: $('#myBrandUpdateForm').serialize(),
                    type: "POST",
                    success: function (data) {
                        if (data == "error") {
                            swal("Failure!", "Name already Taken.", "error");
                        } else {
                            $('#myBrandUpdateForm').trigger("reset");
                            $('#editBrandModal').modal('hide')
                            swal({
                                title:"Success",
                                text: "Area Updated Successfully!",
                                icon: "success",
                                buttons: {
                                    confirm: {
                                        text: 'ok',
                                        value: true,
                                        visible: true,
                                        closeModal: true
                                    }                            },
                            })
                                .then((isConfirm) => {
                                    if (isConfirm) {
                                        /* if the response is ok */
                                        location.reload();
                                    }
                                });
                        }
                    }
                });
            });
        </script>
        <script>
            /* change accept and reject status */
            $(document).on("click", ".change-status", function () {
                var id = $(this).data('id');
                var status = $(this).data('status');
                if (id) {
                    $.ajax({
                        url: "{{ url('admin/payments/change-status/') }}",
                        data: {
                            id : id,
                            status : status
                        },
                        type: "GET",
                        success: function (data) {
                            swal({
                                title:"Success",
                                text: "Status Changed Successfully!",
                                icon: "success",
                                buttons: {
                                    confirm: {
                                        text: 'ok',
                                        value: true,
                                        visible: true,
                                        closeModal: true
                                    }                            },
                            })
                                .then((isConfirm) => {
                                    if (isConfirm) {
                                        /* if the response is ok */
                                        location.reload();
                                    }
                                });
                        }
                    });
                }
            });
        </script>

    @endpush
