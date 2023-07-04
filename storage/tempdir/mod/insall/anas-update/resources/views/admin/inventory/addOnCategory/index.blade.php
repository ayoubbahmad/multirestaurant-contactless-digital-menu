
@extends('layouts.admin-layout')
@section('title','AddOnCategory')
@section('content')

    <div class="content-page">
        <div class="container-fluid">
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="font-weight-bold">Addon Category</h4>
                        </div>
                        <div class="create-workform">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <div class="modal-product-search d-flex">

                                    <button type="button" class="btn btn-primary position-relative d-flex align-items-center justify-content-between" data-toggle="modal" data-target="#addCategoryModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Add Addon Category
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="AddCategoryTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="AddCategoryTitle">Add addOnCategory</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                            <form class="row g-3" enctype="multipart/form-data" id="myCategoryForm" method="post">

                                            <div class="col-md-12 mb-3">
                                                <label class="form-label font-weight-bold text-muted text-uppercase">addOnCategory Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter addOnCategory Name">
                                            </div>

                                                <div class="col-md-12 mb-3">
                                                    <label for="type" class="form-label font-weight-bold text-muted text-uppercase">Addon Category Type<span class="text-danger">*</span></label>
                                                    <select id="type" class="form-select form-control" name="type" required>
                                                        <option value="" selected>Select Addon Category Type</option>
                                                        <option value="1">Color</option>
                                                        <option value="2">Size</option>
                                                    </select>
                                                </div>
                                            <div class="col-md-12 mb-3">
                                                <div class="d-flex justify-content-end mt-3">
                                                    <button type="reset" class="btn btn-secondary mr-3" data-dismiss="modal">
                                                        Cancel
                                                    </button>
                                                    <button type="submit" class="btn btn-primary add_addOnCategory">
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
                    <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="EditCategoryTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="EditCategoryTitle">Edit addOnCategory</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                        <form class="row g-3" enctype="multipart/form-data" id="myCategoryUpdateForm" method="post">
                                            <input type="hidden" name="id" id="id" />
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label font-weight-bold text-muted text-uppercase">addOnCategory Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="edit_name" name="edit_name" placeholder="Enter addOnCategory Name">
                                        </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="edit_type" class="form-label font-weight-bold text-muted text-uppercase">Addon Category Type<span class="text-danger">*</span></label>
                                                <select id="edit_type" class="form-select form-control" name="edit_type" required>
                                                    <option value="" selected>Select Addon Category Type</option>
                                                    <option value="1">Color</option>
                                                    <option value="2">Size</option>
                                                </select>
                                            </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="d-flex justify-content-end mt-3">
                                                <button type="reset" class="btn btn-secondary mr-3" data-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <button type="submit" class="btn btn-primary update_addOnCategory">
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
                                                <th scope="col"><label class="text-muted mb-0">Addon Category Name</label></th>
                                                <th scope="col"><label class="text-muted mb-0">Addon Category Type</label></th>
                                                <th scope="col" class="text-center"><label class="text-muted mb-0">Total AddOns</label></th>
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
                        ajax: "{{ url('admin/inventory/add-on-categories/') }}",
                        columns: [
                            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                            {data: 'name', name: 'name'},
                            {data: 'type', name: 'type'},
                            {data: 'total', name: 'total'},
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
    /* add addOnCategory  */
    $(document).on("click", ".add_addOnCategory", function (event) {
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var postData = new FormData($("#myCategoryForm")[0]);

        if($('#name').val()=="") {
            swal("Failure!", "Please enter addOnCategory name.", "error");
            return false;
        }

        if($('#type').val()=="") {
            swal("Failure!", "Please choose addOnCategory type.", "error");
            return false;
        }

        $.ajax({
            url: "{{ url('admin/inventory/add-on-categories/create') }}",
            data: $('#myCategoryForm').serialize(),
            type: "POST",
            success: function (data) {
                if (data == "error") {
                    swal("Failure!", "addOnCategory Name already available.", "error");
                } else {
                    $('#myCategoryForm').trigger("reset");
                    $('#addCategoryModal').modal('hide')
                    swal({
                        title:"Success",
                        text: "AddOn category Added Successfully!",
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
    /* edit addOnCategory */
    $('body').on('click', '.editCategory', function (event) {
        var id = $(this).data('id');
        var url = "{{ url('admin/inventory/add-on-categories/update') }}" + '/' + id;
        $.get(url, function (data) {
            $('#editCategoryModal').modal('show');
            $('#edit_name').val(data.data.name);
            $('#edit_type').val(data.data.type);
            $('#id').val(data.data.id);

        })
    });
</script>

<script>

    /* update addOnCategory  */
    $(document).on("click", ".update_addOnCategory", function (event) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        event.preventDefault();
        var postData = new FormData($("#myCategoryUpdateForm")[0]);
        if($('#edit_name').val()=="") {
            swal("Failure!", "Please enter addOnCategory name.", "error");
            return false;
        }
        if($('#edit_type').val()=="") {
            swal("Failure!", "Please choose addOnCategory type.", "error");
            return false;
        }

        var id = $('#id').val();
        $.ajax({
            url: "{{ url('admin/inventory/add-on-categories/update') }}" + '/' + id,
            data: $('#myCategoryUpdateForm').serialize(),
            type: "POST",
            success: function (data) {
                if (data == "error") {
                    swal("Failure!", "Name already Taken.", "error");
                } else {
                    $('#myCategoryUpdateForm').trigger("reset");
                    $('#editCategoryModal').modal('hide')
                    swal({
                        title:"Success",
                        text: "AddOn Category Updated Successfully!",
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
                    url: "{{ url('admin/inventory/add-on-categories/change-status-addOnCategories/') }}",
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
