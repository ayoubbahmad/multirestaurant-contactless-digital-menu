
@extends('layouts.admin-layout')
@section('title','Customer')
@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="font-weight-bold">Customers</h4>
                        </div>
                        <div class="create-workform">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <div class="modal-product-search d-flex">
                                    <a href="{{ url('admin/customers/create') }}" class="btn btn-primary position-relative d-flex align-items-center justify-content-between">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Add Customer
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-lg-12 order-tab">
                                        <a href="{{ url('admin/customers/') }}" class="btn btn-primary rounded-pill btn-sm btn-order-tab mr-1"><i class="ri-alert-line"></i>Active Customers</a>
                                        <a href="{{ url('admin/customers/pending') }}" class="btn btn-light rounded-pill btn-sm btn-order-tab mr-1"><i class="ri-alert-line"></i>Pending Verification</a>
                                        <a href="{{ url('admin/customers/disabled') }}" class="btn btn-light rounded-pill btn-sm btn-order-tab mr-1"><i class="ri-alert-line"></i>Disabled Customers</a>
                                    </div>
                                    <div class=" table table-responsive">
                                        <table class="table" id="datatable">
                                            <thead class="thead-light">
                                            <tr>
                                                <th scope="col"><label class="text-muted m-0">#</label></th>
                                                <th scope="col"><label class="text-muted mb-0">Customer Name</label></th>
                                                <th scope="col"><label class="text-muted mb-0">Store Name</label></th>
                                                <th scope="col"><label class="text-muted mb-0">Area</label></th>
                                                <th scope="col"><label class="text-muted mb-0">Phone Number</label></th>
                                                <th scope="col"><label class="text-muted mb-0">Address</label></th>
                                                <th scope="col"><label class="text-muted mb-0">Total Orders</label></th>
                                                <th scope="col"><label class="text-muted mb-0">Recent Order</label></th>
                                                <th scope="col"><label class="text-muted mb-0">Status</label></th>
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
                        ajax: "{{ url('admin/customers/') }}",
                        columns: [
                            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                            {data: 'name', name: 'name'},
                            {data: 'store_name', name: 'store_name'},
                            {data: 'area', name: 'area'},
                            {data: 'phone_number', name: 'phone_number'},
                            {data: 'address', name: 'address'},
                            {data: 'total_orders', name: 'total_orders'},
                            {data: 'recent_order', name: 'recent_order'},
                            {data: 'status', name: 'status'},
                            {data: 'action', name: 'action', orderable: false, searchable: false, sWidth: "10%"},
                        ],
                        "fnDrawCallback": function () {
                        },
                    });
                });
            </script>
@endpush
