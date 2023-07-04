
@extends('layouts.admin-layout')
@section('title','AddOn')
@section('content')

    <div class="content-page">
        <div class="container-fluid">
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="font-weight-bold">Addon </h4>
                        </div>
                        <div class="create-workform">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <div class="modal-product-search d-flex">

                                    <button type="button" class="btn btn-primary position-relative d-flex align-items-center justify-content-between" data-toggle="modal" data-target="#addModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Add Addon
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="AddTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="AddTitle">Add addOn</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                            <form class="row g-3" enctype="multipart/form-data" id="myForm" method="post">
                                                @php
                                                    $addOnCategoryList=App\AddOnCategory::latest()->get();
                                                @endphp
                                                <div class="col-md-12 mb-3">
                                                    <label for="add_on_category_id" class="form-label font-weight-bold text-muted text-uppercase">Addon Category<span class="text-danger">*</span></label>
                                                    <select id="add_on_category_id" class="form-select form-control" name="add_on_category_id" required>
                                                        <option value="" selected>Select Addon Category</option>
                                                        @foreach($addOnCategoryList as $row)
                                                            <option value="{{$row->id}}" data-type="{{$row->type}}">{{$row->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                <label class="form-label font-weight-bold text-muted text-uppercase">addOn Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter addOn Name">
                                            </div>
                                                <div class="col-md-12 mb-3 color_div">
                                                    <label class="form-label font-weight-bold text-muted text-uppercase">Choose Color Code<span class="text-danger">*</span>
                                                    </label><br>
                                                    <input class="form-control" type="color" id="colorpicker" name="colorpicker" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#ff0000">
                                                    <input type="text" class="form-control" name="code" id="code" placeholder="Enter Color Code">
                                                </div>
                                                <script>
                                                    $('#colorpicker').on('input', function() {
                                                        $('#code').val(this.value);
                                                    });
                                                </script>
                                                <div class="col-md-12 mb-3  price_div">
                                                    <label class="form-label font-weight-bold text-muted text-uppercase">addOn Price<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="price" id="price" placeholder="Enter addOn Price">
                                                </div>
                                            <div class="col-md-12 mb-3">
                                                <div class="d-flex justify-content-end mt-3">
                                                    <button type="reset" class="btn btn-secondary mr-3" data-dismiss="modal">
                                                        Cancel
                                                    </button>
                                                    <button type="submit" class="btn btn-primary add_addOn">
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
                                    <h5 class="modal-title" id="EditTitle">Edit addOn</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                        <form class="row g-3" enctype="multipart/form-data" id="myUpdateForm" method="post">
                                            <input type="hidden" name="id" id="id" />
                                            @php
                                                $addOnCategoryList=App\AddOnCategory::latest()->get();
                                            @endphp
                                            <div class="col-md-12 mb-3">
                                                <label for="edit_add_on_category_id" class="form-label font-weight-bold text-muted text-uppercase">Addon Category<span class="text-danger">*</span></label>
                                                <select id="edit_add_on_category_id" class="form-select form-control" name="edit_add_on_category_id" required>
                                                    <option value="" selected>Select Addon Category</option>
                                                    @foreach($addOnCategoryList as $row)
                                                        <option value="{{$row->id}}" data-type="{{$row->type}}">{{$row->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                            <label class="form-label font-weight-bold text-muted text-uppercase">addOn Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="edit_name" name="edit_name" placeholder="Enter addOn Name">
                                        </div>
                                            <div class="col-md-12 mb-3 edit_color_div">
                                                <label class="form-label font-weight-bold text-muted text-uppercase">Choose Color Code<span class="text-danger">*</span></label> <br/>
                                                <input class="form-control" type="color" id="edit_colorpicker" name="edit_colorpicker" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#ff0000">
                                                <input type="text" class="form-control" id="edit_code" name="edit_code" placeholder="Enter Color Code">
                                            </div>
                                            <script>
                                                $('#edit_colorpicker').on('input', function() {
                                                    $('#edit_code').val(this.value);
                                                });
                                            </script>

                                            <div class="col-md-12 mb-3 edit_price_div">
                                                <label class="form-label font-weight-bold text-muted text-uppercase">addOn Price<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="edit_price" id="edit_price" placeholder="Enter addOn Price">
                                            </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="d-flex justify-content-end mt-3">
                                                <button type="reset" class="btn btn-secondary mr-3" data-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <button type="submit" class="btn btn-primary update_addOn">
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
                                                <th scope="col"><label class="text-muted mb-0">Addon  Name</label></th>
                                                <th scope="col"><label class="text-muted mb-0">Addon  Color</label></th>
                                                <th scope="col"><label class="text-muted mb-0">Addon  Category</label></th>
                                                <th scope="col" class="text-center"><label class="text-muted mb-0">price</label></th>
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
                        ajax: "{{ url('admin/inventory/add-ons/') }}",
                        columns: [
                            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                            {data: 'name', name: 'name'},
                            {data: 'color', name: 'color'},
                            {data: 'category', name: 'category'},
                            {data: 'price', name: 'price'},
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
        $(document).ready(function() {
            $('.price_div').hide();
            $('.color_div').hide();
            $('.edit_price_div').hide();
            $('.edit_color_div').show();
        });
    </script>
<script>
    /* add addOn  */
    $(document).on("click", ".add_addOn", function (event) {
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var postData = new FormData($("#myForm")[0]);

        if($('#name').val()=="") {
            swal("Failure!", "Please enter addOn name.", "error");
            return false;
        }

        if(($('#add_on_category_id').find(":selected").data('type'))!=1) {
            if ($('#price').val() == "") {
                swal("Failure!", "Please enter addOn Price.", "error");
                return false;
            }
        } else {
            if($('#code').val()=="") {
                swal("Failure!", "Please enter color code.", "error");
                return false;
            }
        }
        if(isNaN($('#price').val())) {
            swal("Failure!", "Please enter valid Price.", "error");
            return false;
        }

        if($('#add_on_category_id').val()=="") {
            swal("Failure!", "Please choose addOn Category.", "error");
            return false;
        }

        $.ajax({
            url: "{{ url('admin/inventory/add-ons/create') }}",
            data: $('#myForm').serialize(),
            type: "POST",
            success: function (data) {
                if (data == "error") {
                    swal("Failure!", "addOn Name already available.", "error");
                } else {
                    $('#myForm').trigger("reset");
                    $('#addModal').modal('hide')
                    swal({
                        title:"Success",
                        text: "AddOn added Successfully!",
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
    /* edit addOn */
    $('body').on('click', '.edit', function (event) {
        var id = $(this).data('id');
        var url = "{{ url('admin/inventory/add-ons/update') }}" + '/' + id;
        $.get(url, function (data) {

            $('#edit_name').val(data.data.add_on_name);
            $('#edit_colorpicker').val(data.data.add_on_color_code);
            $('#edit_code').val(data.data.add_on_color_code);
            $('#edit_price').val(data.data.add_on_price);
            $('#edit_add_on_category_id').val(data.data.add_on_category_id);

            if(($('#edit_add_on_category_id').find(":selected").data('type'))==1) {
                $('.edit_price_div').hide();
                $('.edit_color_div').show();
            } else {
                $('.edit_price_div').show();
                $('.edit_color_div').hide();
            }
            $('#id').val(data.data.id);
            $('#editModal').modal('show');
        })
    });

</script>

<script>

    /* update addOn  */
    $(document).on("click", ".update_addOn", function (event) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        event.preventDefault();
        var postData = new FormData($("#myUpdateForm")[0]);
        if($('#edit_name').val()=="") {
            swal("Failure!", "Please enter addOn name.", "error");
            return false;
        }
        if($('#edit_add_on_category_id').val()=="") {
            swal("Failure!", "Please choose addOn Category.", "error");
            return false;
        }
        if(($('#edit_add_on_category_id').find(":selected").data('type'))!=1) {
            if ($('#edit_price').val() == "") {
                swal("Failure!", "Please enter addOn Price.", "error");
                return false;
            }
        } else {
            if($('#edit_code').val()=="") {
                swal("Failure!", "Please enter color code.", "error");
                return false;
            }
        }
        if(isNaN($('#edit_price').val())) {
            swal("Failure!", "Please enter valid Price.", "error");
            return false;
        }

        var id = $('#id').val();
        $.ajax({
            url: "{{ url('admin/inventory/add-ons/update') }}" + '/' + id,
            data: $('#myUpdateForm').serialize(),
            type: "POST",
            success: function (data) {
                if (data == "error") {
                    swal("Failure!", "Name already Taken.", "error");
                } else {
                    $('#myUpdateForm').trigger("reset");
                    $('#editModal').modal('hide')
                    swal({
                        title:"Success",
                        text: "Add On updated Successfully!",
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
                    url: "{{ url('admin/inventory/add-ons/change-status-addOns/') }}",
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

    <script>
        /* hidden price field on add add_on*/
        $(document).on("change", "#add_on_category_id", function () {
            var type = $(this).find(":selected").data('type');
            if(type==1) {
                $('.price_div').hide();
                $('.color_div').show();
            } else {
                $('.price_div').show();
                $('.color_div').hide();
            }
        });
    </script>

    <script>
        /* hidden price field on edit add on*/
        $(document).on("change", "#edit_add_on_category_id", function () {
            var type = $("#edit_add_on_category_id").find(":selected").data('type');
            if(type==1) {
                $('.edit_price_div').hide();
                $('.edit_color_div').show();
             } else {
                $('.edit_price_div').show();
                $('.edit_color_div').hide();
            }
        });
    </script>
@endpush
