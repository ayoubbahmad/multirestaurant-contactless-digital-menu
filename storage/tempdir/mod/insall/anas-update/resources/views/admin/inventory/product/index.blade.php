
@extends('layouts.admin-layout')
@section('title','Inventory Product')
@section('content')

    <div class="content-page">
        <div class="container-fluid">
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="font-weight-bold">Products</h4>
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
                                    <a href="{{ url('admin/inventory/products/create') }}" class="btn btn-primary position-relative d-flex align-items-center justify-content-between">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Add Product
                                    </a>
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
                                                <th scope="col"><label class="text-muted mb-0">Product Name</label></th>
                                                <th scope="col"><label class="text-muted mb-0">Article Number</label></th>
                                                <th scope="col"><label class="text-muted mb-0">Category</label></th>
                                                <th scope="col"><label class="text-muted mb-0">Brand</label></th>
                                                <th scope="col"><label class="text-muted mb-0">Price</label></th>
                                                <th scope="col"><label class="text-muted mb-0">Discount Price</label></th>
                                                <th scope="col"><label class="text-muted mb-0">Product Tags</label></th>
                                                <th scope="col"><label class="text-muted mb-0">Created At</label></th>
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
                        ajax: "{{ url('admin/inventory/products/') }}",
                        columns: [
                            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                            {data: 'name', name: 'name'},
                            {data: 'article_number', name: 'article_number'},
                            {data: 'category', name: 'category'},
                            {data: 'brand', name: 'brand'},
                            {data: 'price', name: 'price'},
                            {data: 'discount_price', name: 'discount_price'},
                            {data: 'tag', name: 'tag'},
                            {data: 'created_at', name: 'created_at'},
                            {data: 'status', name: 'status'},
                            {data: 'action', name: 'action', orderable: false, searchable: false, sWidth: "10%"},
                        ],
                        "fnDrawCallback": function () {
                        },
                    });
                });
</script>

    <script>
        /* change active and inactive status */
        $(document).on("click", ".change-status", function () {
            var id = $(this).data('id');
            if (id) {
                $.ajax({
                    url: "{{ url('admin/inventory/products/change-status-products/') }}",
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
