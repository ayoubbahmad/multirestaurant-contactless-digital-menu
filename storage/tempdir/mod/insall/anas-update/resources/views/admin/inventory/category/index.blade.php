
@extends('layouts.admin-layout')
@section('title','Inventory')
@section('content')

    <div class="content-page">
        <div class="container-fluid">
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="font-weight-bold">Product Category</h4>
                        </div>
                        <div class="create-workform">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <div class="modal-product-search d-flex">
{{--                                    <form class="mr-3 position-relative">--}}
{{--                                        <div class="form-group mb-0">--}}
{{--                                            <input type="text" class="form-control" id="exampleInputText" placeholder="Search here">--}}
{{--                                            <a class="search-link" href="#">--}}
{{--                                                <svg xmlns="http://www.w3.org/2000/svg" class="" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />--}}
{{--                                                </svg>--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                    </form>--}}
                                    <button type="button" class="btn btn-primary position-relative d-flex align-items-center justify-content-between" data-toggle="modal" data-target="#addCategoryModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Add Category
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="AddCategoryTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="AddCategoryTitle">Add Category</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                            <form class="row g-3" enctype="multipart/form-data" id="myCategoryForm" method="post">
                                            <div class="col-md-12 mb-3 card">
                                                <div class="card-body bg-light rounded">
                                                    <div class="d-flex justify-content-center mt-5">
                                                        <div class="card-body bg-light rounded">
                                                            <input type="file" class="form-control dropify" id="image"
                                                                   accept=".png,.jpg,.jpeg,.PNG,.JPG,.JPEG" data-height="150" name="image"
                                                                   data-default-file="{{(isset($category) && !empty($category->image) && File::exists('uploads/categories/'.$category->image)) ? asset('uploads/categories/'.$category->image):asset('uploads/categories/default.png') }}"
                                                                   data-show-remove="false">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label font-weight-bold text-muted text-uppercase">Category Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Category Name">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="Text9" class="form-label font-weight-bold text-muted text-uppercase">Description</label>
                                                <textarea class="form-control" name="description" id="description" rows="2" placeholder="Enter Description"></textarea>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <div class="d-flex justify-content-end mt-3">
                                                    <button type="reset" class="btn btn-secondary mr-3" data-dismiss="modal">
                                                        Cancel
                                                    </button>
                                                    <button type="submit" class="btn btn-primary add_category">
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
                                    <h5 class="modal-title" id="EditCategoryTitle">Edit Category</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                        <form class="row g-3" enctype="multipart/form-data" id="myCategoryUpdateForm" method="post">
                                        <div class="col-md-12 mb-3 card">
                                            <div class="card-body bg-light rounded">
                                                <div class="form-group image_show">

                                                </div>
                                            </div>
                                        </div>
                                            <input type="hidden" name="id" id="id" />
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label font-weight-bold text-muted text-uppercase">Category Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="edit_name" name="edit_name" placeholder="Enter Category Name">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="Text9" class="form-label font-weight-bold text-muted text-uppercase">Description</label>
                                            <textarea class="form-control" id="edit_description" name="edit_description" rows="2" placeholder="Enter Description"></textarea>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="d-flex justify-content-end mt-3">
                                                <button type="reset" class="btn btn-secondary mr-3" data-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <button type="submit" class="btn btn-primary update_category">
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
                                                <th scope="col"><label class="text-muted mb-0">Category Name</label></th>
                                                <th scope="col" class="text-center"><label class="text-muted mb-0">Total Products</label></th>
                                                <th scope="col" class="text-center"><label class="text-muted mb-0">Status</label></th>
                                                <th scope="col" class="text-right"><label class="text-muted mb-0">Actions</label></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                           
                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- @if (count($categories) > 0)
                                    <nav aria-label="Page navigation orders" class="mt-2 float-right">
                                        <ul class="pagination mb-0">
                                            {!! $categories->links() !!}
                                        </ul>
                                    </nav>
                                    @endif --}}
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
                        ajax: "{{ url('admin/inventory/categories/') }}",
                        columns: [
                            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                            {data: 'name', name: 'name'},
                            {data: 'total', name: 'total'},
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
                url: "{{ url('admin/inventory/categories/updateStatus') }}",
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
    /* add category  */
    $(document).on("click", ".add_category", function (event) {
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var postData = new FormData($("#myCategoryForm")[0]);

        if($('#name').val()=="") {
            swal("Failure!", "Please enter category name.", "error");
            return false;
        }
        $.ajax({
            url: "{{ url('admin/inventory/categories/create') }}",
            data: postData,
            cache: false,
            contentType: false,
            processData: false,
            type: "POST",
            success: function (data) {
                if (data == "error") {
                    swal("Failure!", "Category Name already available.", "error");
                } else {
                    $('#myCategoryForm').trigger("reset");
                    $('#addCategoryModal').modal('hide')
                    swal({
                        title:"Success",
                        text: "Category Created Successfully!",
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
    /* edit category */
    $('body').on('click', '.editCategory', function (event) {
        var id = $(this).data('id');
        var url = "{{ url('admin/inventory/categories/update') }}" + '/' + id;
        $.get(url, function (data) {
            $('#editCategoryModal').modal('show');
            $('#edit_name').val(data.data.name);
            $('#edit_description').val(data.data.description);
            $('#id').val(data.data.id);
            var nameImage = "{{ asset('uploads/categories') }}" + '/' + data.data.image;
            var $html = '<input type="file" class="dropify edit_image" data-default-file="' + nameImage + '" data-max-file-size="2M" name="edit_image" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" accept=".png,.jpg,.jpeg,.PNG,.JPG,.JPEG" data-height="200"  data-show-remove="false"/>';
            $('.image_show').html($html);
            $('.edit_image').dropify();
        })
    });

</script>

<script>

    /* update category  */
    $(document).on("click", ".update_category", function (event) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        event.preventDefault();
        var postData = new FormData($("#myCategoryUpdateForm")[0]);
        if($('#edit_name').val()=="") {
            swal("Failure!", "Please enter category name.", "error");
            return false;
        }
        var id = $('#id').val();
        $.ajax({
            url: "{{ url('admin/inventory/categories/update') }}" + '/' + id,
            data: postData,
            cache: false,
            contentType: false,
            processData: false,
            type: "POST",
            success: function (data) {
                if (data == "error") {
                    swal("Failure!", "Name already Taken.", "error");
                } else {
                    $('#myCategoryUpdateForm').trigger("reset");
                    $('#editCategoryModal').modal('hide')
                    swal({
                        title:"Success",
                        text: "Category updated Successfully!",
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
                    url: "{{ url('admin/inventory/categories/change-status-categories/') }}",
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
