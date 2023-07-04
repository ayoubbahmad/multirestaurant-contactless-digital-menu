
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
                                    <a href="{{ url('admin/staffs/order-takers/')}}" class="btn btn-primary btn-sm d-flex align-items-center justify-content-between ml-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="ml-2">Back</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <div class="list-style-detail p-3">
                                                <h4 class="text-center font-weight-bold mb-2">{{$user->name}}</h4>
                                                <p class="text-center"><span class="badge badge-light">{{ ($user->area) ? $user->area->name: "" }}</span></p>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-6 text-center">
                                                    <a class="btn btn-block text-white btn-sm btn-secondary edit" data-id="{{$user->id}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                        </svg>
                                                        <span class="">Edit</span>
                                                    </a>
                                                </div>
                                                <div class="col-6 text-center mb-2">
                                                    @if($user->is_active==1)
                                                    <a href="{{ url('admin/staffs/order-takers/disable/'.$user->id) }}" class="btn btn-block btn-sm btn-danger">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
                                                        </svg>
                                                        <span class="">Disable</span>
                                                    </a>
                                                        @else
                                                        <a href="{{ url('admin/staffs/order-takers/enable/'.$user->id) }}" class="btn btn-block btn-sm btn-success">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
                                                            </svg>
                                                            <span class="">Enable</span>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <table class="table table-borderless mb-0">
                                                <tr>
                                                    <td class="p-0">
                                                        <p class="mb-0 text-muted">Phone Number</p>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0 ">{{ $user->phone }}</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="p-0">
                                                        <p class="mb-0 text-muted">Email ID</p>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0 ">{{ $user->email }}</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="p-0">
                                                        <p class="mb-0 text-muted">Total Orders</p>
                                                    </td>
                                                    <td>
                                                        <span class="mt-1 badge badge-light">{{ App\Order::where('order_taker_id',$user->id)->count() }}</span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </li>
                                    </ul>
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
                                                    @foreach($areaList as $area_user)
                                                        <option value="{{$area_user->id}}">{{$area_user->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label font-weight-bold text-muted text-uppercase">Email Id<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="edit_email" id="edit_email" placeholder="Enter Email">
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
                                                    <button type="submit" class="btn btn-primary update_orderTaker">
                                                        Save
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                     <div class="col-lg-12 order-tab p-2">
                                        <a href="{{ url('admin/staffs/order-takers/show/'.$user->id)}}" class="btn btn-light rounded-pill btn-sm btn-order-tab mr-1"><i class="ri-alert-line"></i>Previous Orders</a>
                                        <a href="{{ url('admin/staffs/order-takers/show-payment/'.$user->id)}}" class="btn btn-light active rounded-pill btn-sm btn-order-tab mr-1"><i class="ri-alert-line"></i>Payment Collection</a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="thead-light">
                                            <tr>
                                            <th scope="col"><label class="text-muted m-0">#</label></th>
                                                        <th scope="col"><label class="text-muted mb-0">Date</label></th>
                                                        <th scope="col"><label class="text-muted mb-0">Customer Name</label></th>
                                                        <th scope="col"><label class="text-muted mb-0">Amount</label></th>
                                                        <th scope="col"><label class="text-muted mb-0">Status</label></th>
                                                        <th scope="col"><label class="text-muted mb-0">Actions</label></th>
                                                        <th scope="col" class="text-right"><label class="text-muted mb-0">More</label></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                             $orders = App\Payment::where('created_by',$user->id)->latest()->paginate(5);
                                             @endphp
                                           
                                            @php
                                                $i = 1;
                                            @endphp

                                            @foreach($orders as $row)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td><span class="font-weight-bold">{{ $row->paid_date }}</span></td>
                                                <td><span class="font-weight-bold">{{ $row->customer_store_name }}</span></td>
                                                <td>{{ $row->paid }}</td>
                                                <td>  <span class="mt-2 badge {{payment_status_with_badge($row->approved_status)}}"> {{ payment_status($row->approved_status) }} </span> </td>
                                                <td>
                                                            @if($row->approved_status==0) 
                                                                <button type="button" class="btn btn-success btn-sm mr-1 change-status" data-status="1" data-id="{{$row->id}}">Accept</button>
                                                                <button type="button" class="btn btn-danger btn-sm mr-1 change-status" data-status="2" data-id="{{$row->id}}">Reject</button>
                                                            @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-end align-items-center">
                                                      <a href="{{url('admin/payments/delete/'.$row->id)}}" class="delete-btn btn btn-sm bg-danger">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @if (count($orders) > 0)
                                        <nav aria-label="Page navigation orders" class="mt-2 float-right">
                                            <ul class="pagination mb-0">
                                                {!! $orders->links() !!}
                                            </ul>
                                        </nav>
                                    @endif
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
                    $('#myUpdateForm').trigger("reset");
                    $('#editModal').modal('hide')
                    swal("Success!", "orderTaker Updated Successfully.", "success");
                    window.setTimeout(function(){location.reload()},3000);
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
