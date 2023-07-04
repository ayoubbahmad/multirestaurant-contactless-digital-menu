
@extends('layouts.admin-layout')
@section('title','Order Taker')
@section('content')

    <div class="content-page">
        <div class="container-fluid">
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="font-weight-bold">Order Taker</h4>
                        </div>
                        <div class="create-workform">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <div class="modal-product-search d-flex">

                                    <button type="button" class="btn btn-primary position-relative d-flex align-items-center justify-content-between" data-toggle="modal" data-target="#addModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Add Order Taker
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="AddTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="AddTitle">Add orderTaker</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="row g-3" enctype="multipart/form-data" id="myForm" method="post">

                                            <div class="col-md-12 mb-3">
                                                <label class="form-label font-weight-bold text-muted text-uppercase">Full Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter orderTaker Name">
                                            </div>
                                            @php
                                                $areaList=App\Area::where('is_active',1)->latest()->get();
                                            @endphp
                                            <div class="col-md-12 mb-3">
                                                <label for="area_id" class="form-label font-weight-bold text-muted text-uppercase">Area<span class="text-danger">*</span></label>
                                                <select id="area_id" class="form-select form-control" name="area_id">
                                                    <option value="" selected>Select Area</option>
                                                    @foreach($areaList as $row)
                                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label font-weight-bold text-muted text-uppercase">Email Id<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control check-email" name="email" id="email" placeholder="Enter Email">
                                                <b><span class="text-danger email_status"></span></b>
                                                <input type="hidden" class="form-control" id="flag" name="flag" value="0">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label font-weight-bold text-muted text-uppercase">Phone Number<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone Number">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label font-weight-bold text-muted text-uppercase">Password<span class="text-danger">*</span></label>
                                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <div class="d-flex justify-content-end mt-3">
                                                    <button type="reset" class="btn btn-secondary mr-3" data-dismiss="modal">
                                                        Cancel
                                                    </button>
                                                    <button type="submit" class="btn btn-primary add_orderTaker next_btn">
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
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="EditTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="EditTitle">Edit orderTaker</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="row g-3" enctype="multipart/form-data" id="myUpdateForm" method="post">

                                        <input type="hidden" name="id" id="id" />
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label font-weight-bold text-muted text-uppercase">Full Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="edit_name" id="edit_name" placeholder="Enter orderTaker Name">
                                        </div>
                                        @php
                                            $areaList=App\Area::latest()->get();
                                        @endphp
                                        <div class="col-md-12 mb-3">
                                            <label for="edit_area_id" class="form-label font-weight-bold text-muted text-uppercase">Area<span class="text-danger">*</span></label>
                                            <select id="edit_area_id" class="form-select form-control" name="edit_area_id">
                                                <option value="" selected>Select Area</option>
                                                @foreach($areaList as $row)
                                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label font-weight-bold text-muted text-uppercase">Email Id<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control edit-check-email" name="edit_email" id="edit_email" placeholder="Enter Email">
                                            <b><span class="text-danger edit_email_status"></span></b>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label font-weight-bold text-muted text-uppercase">Phone Number<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="edit_phone" id="edit_phone" placeholder="Enter Phone Number">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label font-weight-bold text-muted text-uppercase">Password<span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" name="edit_password" id="edit_password" placeholder="Enter Password">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="d-flex justify-content-end mt-3">
                                                <button type="reset" class="btn btn-secondary mr-3" data-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <button type="submit" class="btn btn-primary update_orderTaker edit_next_btn">
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
                    <div class="table table-responsive">
                        <table class="table" id="datatable">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col"><label class="text-muted m-0">#</label></th>
                                <th scope="col"><label class="text-muted mb-0">Full Name</label></th>
                                <th scope="col"><label class="text-muted mb-0">Area</label></th>
                                <th scope="col"><label class="text-muted mb-0">Email ID</label></th>
                                <th scope="col"><label class="text-muted mb-0">Phone Number</label></th>
                                <th scope="col" class="text-right"><label class="text-muted mb-0">Actions</label></th>
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
                        ajax: "{{ url('admin/staffs/order-takers') }}",
                        columns: [
                            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                            {data: 'name', name: 'name'},
                            {data: 'area', name: 'area'},
                            {data: 'email', name: 'email'},
                            {data: 'phone_number', name: 'phone_number'},
                            {data: 'action', name: 'action', orderable: false, searchable: false, sWidth: "10%"},
                        ],
                        "fnDrawCallback": function () {
                        },
                    });
                });
            </script>


    <script>
        $(".dropify").dropify();
    </script>

    <script>
        /* add orderTaker  */
        $(document).on("click", ".add_orderTaker", function (event) {
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            if($('#name').val()=="") {
                swal("Failure!", "Please enter orderTaker name.", "error");
                return false;
            }

            if($('#email').val()=="") {
                swal("Failure!", "Please enter Email.", "error");
                return false;
            }

            if($('#phone').val()=="") {
                swal("Failure!", "Please enter Phone Number.", "error");
                return false;
            }

            if($('#password').val()=="") {
                swal("Failure!", "Please enter password.", "error");
                return false;
            }

            if($('#area_id').val()=="") {
                swal("Failure!", "Please choose Area.", "error");
                return false;
            }

            $.ajax({
                url: "{{ url('admin/staffs/order-takers/create') }}",
                data: $('#myForm').serialize(),
                type: "POST",
                success: function (data) {
                    if (data == "error") {
                        swal("Failure!", "Email already Taken.", "error");
                    } else {
                        $('#myForm').trigger("reset");
                        $('#addModal').modal('hide')
                        swal({
                            title:"Success",
                            text: "Order Taker Added Successfully!",
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
        /* edit orderTaker */
        $('body').on('click', '.edit', function (event) {
            var id = $(this).data('id');
            var url = "{{ url('admin/staffs/order-takers/update') }}" + '/' + id;
            $.get(url, function (data) {
                $('#editModal').modal('show');
                $('#edit_name').val(data.data.name);
                $('#edit_email').val(data.data.email);
                $('#edit_phone').val(data.data.phone);
                $('#edit_area_id').val(data.data.area_id);
                $('#id').val(data.data.id);
            })
        });
    </script>

    <script>
        /* update orderTaker  */
        $(document).on("click", ".update_orderTaker", function (event) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            event.preventDefault();
            if($('#edit_name').val()=="") {
                swal("Failure!", "Please enter orderTaker name.", "error");
                return false;
            }
            if($('#edit_email').val()=="") {
                swal("Failure!", "Please enter Email.", "error");
                return false;
            }
            if($('#edit_phone').val()=="") {
                swal("Failure!", "Please enter Phone Number.", "error");
                return false;
            }

            if($('#edit_area_id').val()=="") {
                swal("Failure!", "Please choose Area.", "error");
                return false;
            }
            var id = $('#id').val();
            $.ajax({
                url: "{{ url('admin/staffs/order-takers/update') }}" + '/' + id,
                data: $('#myUpdateForm').serialize(),
                type: "POST",
                success: function (data) {
                    if (data == "error") {
                        swal("Failure!", "Email already Taken.", "error");
                    } else {
                        $('#myUpdateForm').trigger("reset");
                        $('#editModal').modal('hide')
                        swal({
                            title:"Success",
                            text: "Ordertaker Updated Successfully!",
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
        /* check email uniqueness */
        $(document).on("keyup", ".check-email", function () {
            'use strict';
            var email=$("#email" ).val();
            var flag=$('#flag').val();
            var id=$('#id').val();
            if(email)
            {
                $.ajax({
                    type: 'post',
                    url: '{{ url('checkEmail') }}',
                    data: {
                        user_email:email,
                        flag:flag,
                        id:id,
                        "_token": "{{ csrf_token() }}",
                    },
                    dataType: 'json',
                    success: function (response) {
                        if(response=="OK")
                        {
                            $('.email_status').html("");
                            $('.next_btn').prop('disabled',false);
                            return true;
                        }
                        else
                        {
                            $( '.email_status').html(response);
                            $('#email').focus();
                            $('.next_btn').prop('disabled',true);
                            return false;
                        }
                    }
                });
            }

        });
    </script>

    <script>
        /* check email uniqueness */
        $(document).on("keyup", ".edit-check-email", function () {
            'use strict';
            var email=$("#edit_email" ).val();
            var flag=1;
            var id=$('#id').val();
            if(email)
            {
                $.ajax({
                    type: 'post',
                    url: '{{ url('checkEmail') }}',
                    data: {
                        user_email:email,
                        flag:flag,
                        id:id,
                        "_token": "{{ csrf_token() }}",
                    },
                    dataType: 'json',
                    success: function (response) {
                        if(response=="OK")
                        {
                            $('.edit_email_status').html("");
                            $('.edit_next_btn').prop('disabled',false);
                            return true;
                        }
                        else
                        {
                            $( '.edit_email_status').html(response);
                            $('#edit_email').focus();
                            $('.edit_next_btn').prop('disabled',true);
                            return false;
                        }
                    }
                });
            }

        });
    </script>

@endpush
