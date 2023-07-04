
@extends('layouts.admin-layout')
@section('title','Area')
@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="font-weight-bold">Area</h4>
                        </div>
                        <div class="create-workform">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <div class="modal-product-search d-flex">

                                    <button type="button" class="btn btn-primary position-relative d-flex align-items-center justify-content-between" data-toggle="modal" data-target="#addBrandModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Add Area
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="addBrandModal" tabindex="-1" role="dialog" aria-labelledby="AddBrandTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="AddBrandTitle">Add Area</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="row g-3" enctype="multipart/form-data" id="myBrandForm" method="post">

                                            <div class="col-md-12 mb-3">
                                                <label class="form-label font-weight-bold text-muted text-uppercase">Area Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Area Name">
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <div class="d-flex justify-content-end mt-3">
                                                    <button type="reset" class="btn btn-secondary mr-3" data-dismiss="modal">
                                                        Cancel
                                                    </button>
                                                    <button type="submit" class="btn btn-primary add_area">
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
                    <div class="modal fade" id="editBrandModal" tabindex="-1" role="dialog" aria-labelledby="EditBrandTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="EditBrandTitle">Edit Area</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="row g-3" enctype="multipart/form-data" id="myBrandUpdateForm" method="post">
                                        <input type="hidden" name="id" id="id" />
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label font-weight-bold text-muted text-uppercase">Area Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="edit_name" name="edit_name" placeholder="Enter Area Name">
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <div class="d-flex justify-content-end mt-3">
                                                <button type="reset" class="btn btn-secondary mr-3" data-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <button type="submit" class="btn btn-primary update_area">
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
                                                <th scope="col"><label class="text-muted mb-0">Area Name</label></th>
                                                <th scope="col" class="text-center"><label class="text-muted mb-0">Total Customers</label></th>
                                                <th scope="col" class="text-center"><label class="text-muted mb-0">Total OrderTakers</label></th>
                                                <th scope="col" class="text-center"><label class="text-muted mb-0">Status</label></th>
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
                        ajax: "{{ url('admin/areas/') }}",
                        columns: [
                            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                            {data: 'name', name: 'name'},
                            {data: 'total_customers', name: 'total_customers'},
                            {data: 'total_ordertakers', name: 'total_ordertakers'},
                            {data: 'status', name: 'status'},
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
        function changeStatus(id) {
            if (id) {
                $.ajax({
                    url: "{{ url('admin/areas/updateStatus') }}",
                    data: {
                        id: id
                    },
                    type: "GET",
                    success: function (data) {
                    }
                });
            }
        }
    </script>

    <script>
        /* add area  */
        $(document).on("click", ".add_area", function (event) {
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var postData = new FormData($("#myBrandForm")[0]);

            if($('#name').val()=="") {
                swal("Failure!", "Please enter area name.", "error");
                return false;
            }
            $.ajax({
                url: "{{ url('admin/areas/create') }}",
                data: $('#myBrandForm').serialize(),
                type: "POST",
                success: function (data) {
                    if (data == "error") {
                        swal("Failure!", "Area Name already available.", "error");
                    } else {
                        $('#myBrandForm').trigger("reset");
                        $('#addBrandModal').modal('hide')
                        swal({
                            title:"Success",
                            text: "Area Added Successfully!",
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
        $('body').on('click', '.editBrand', function (event) {
            var id = $(this).data('id');
            var url = "{{ url('admin/areas/update') }}" + '/' + id;
            $.get(url, function (data) {
                $('#editBrandModal').modal('show');
                $('#edit_name').val(data.data.name);
                $('#id').val(data.data.id);
                var nameImage = "{{ asset('uploads/areas') }}" + '/' + data.data.image;
                var $html = '<input type="file" class="dropify edit_image" data-default-file="' + nameImage + '" data-max-file-size="2M" name="edit_image" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" accept=".png,.jpg,.jpeg,.PNG,.JPG,.JPEG" data-height="200"  data-show-remove="false"/>';
                $('.image_show').html($html);
                $('.edit_image').dropify();
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
        /* change active and inactive status */
        $(document).on("click", ".change-status", function () {
            var id = $(this).data('id');
            if (id) {
                $.ajax({
                    url: "{{ url('admin/areas/change-status-areas/') }}",
                    data: {
                        id : id
                    },
                    type: "GET",
                    success: function (data) {
                    }
                });
            }
        });
    </script>
@endpush
