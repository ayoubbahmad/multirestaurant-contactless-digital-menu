
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
                                    <a href="{{ url('admin/customers/') }}" class="btn btn-primary btn-sm d-flex align-items-center justify-content-between ml-2">
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
                            <div class="card p-card">
                                <div class="profile-box">
                                    <div class="profile-card-active rounded">
                                        <img src="{{(isset($user) && !empty($user->avatar) && File::exists('uploads/customers/'.$user->avatar)) ? asset('uploads/customers/'.$user->avatar):asset('uploads/customers/default.png') }}" alt="profile-bg" class="avatar-100 rounded-pill d-block mx-auto img-fluid mb-3">
                                        <h3 class="font-600 text-white text-center mb-1">{{ (isset($user) ?$user->name:'') }}</h3>
                                        <p class="text-center mb-5"><span class="badge badge-light">{{ area($user->area_id) }}</span></p>
                                    </div>
                                    <div class="pro-content rounded">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="p-icon mr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <p class="mb-0 eml">{{ (isset($user) ?$user->email:'') }}</p>
                                        </div>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="p-icon mr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                </svg>
                                            </div>
                                            <p class="mb-0">{{ (isset($user) ?$user->phone:'') }}</p>
                                        </div>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="p-icon mr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </div>
                                            <p class="mb-0">{{ (isset($user)&& isset($user->customer)?$user->customer->address:'') }}</p>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-6 text-center">
                                                <a href="{{ url('admin/customers/update/'.$user->id) }}" class="btn btn-block btn-sm btn-secondary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                    <span class="">Edit</span>
                                                </a>
                                            </div>
                                            <div class="col-6 text-center mb-2">
                                                @if($user->is_active==1)
                                                <a href="{{ url('admin/customers/disable/'.$user->id) }}" class="btn btn-block btn-sm btn-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
                                                    </svg>
                                                    <span class="">Disable</span>
                                                </a>
                                                @else
                                                    <a href="{{ url('admin/customers/enable/'.$user->id) }}" class="btn btn-block btn-sm btn-success">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5" />
                                                        </svg>
                                                        <span class="">Enable</span>
                                                    </a>
                                                    @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <p class="mb-2 text-muted">Total Orders</p>
                                                <div class="d-flex flex-wrap justify-content-start align-items-center">
                                                    <h4 class="mb-0 font-weight-bold">{{ App\Order::where('customer_id',$user->id)->count() }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-wrap align-items-center justify-content-between text-info">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <p class="mb-2 text-muted">Total Sales</p>
                                                <div class="d-flex flex-wrap justify-content-start align-items-center">
                                                    <h4 class="mb-0 font-weight-bold">₹{{ App\Order::where('customer_id',$user->id)->where('order_status',3)->sum('total') }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-wrap align-items-center justify-content-between text-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 8h6m-5 0a3 3 0 110 6H9l3 3m-3-6h6m6 1a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">
                                                @php
                                                  $sales_sum = App\Order::where('customer_id',$user->id)->sum('total');
                                                  $payment_sum = App\Payment::where('customer_id',$user->id)->sum('paid');
                                                @endphp
                                                <p class="mb-2 text-muted">Payment Remaining</p>
                                                <div class="d-flex flex-wrap justify-content-start align-items-center">
                                                    <h4 class="mb-0 font-weight-bold">₹{{ $sales_sum - $payment_sum }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-wrap align-items-center justify-content-between text-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 8h6m-5 0a3 3 0 110 6H9l3 3m-3-6h6m6 1a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center p-3">
                                        <h5>Previous Orders</h5>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="thead-light">
                                            <tr>
                                                <th scope="col"><label class="text-muted m-0">#</label></th>
                                                <th scope="col"><label class="text-muted mb-0">Order ID</label></th>
                                                <th scope="col"><label class="text-muted mb-0">Order Type</label></th>
                                                <th scope="col"><label class="text-muted mb-0">Total</label></th>
                                                <th scope="col"><label class="text-muted mb-0">Status</label></th>
                                                <th scope="col"><label class="text-muted mb-0">Placed At</label></th>
                                                <th scope="col" class="text-right"><label class="text-muted mb-0">Actions</label></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $orders = App\Order::where('customer_id',$user->id)->latest()->paginate(5);
                                            @endphp
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach($orders as $row)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td><span class="font-weight-bold">{{ $row->order_number }}</span></td>
                                                    <td><span class="font-weight-bold">{{ $row->customer_name }}</span></td>
                                                    <td><span class="mt-2 badge badge-light">{{ $row->total }}</span></td>
                                                    <td>
                                                        <span class="mt-2 badge {{status_with_badge($row->order_status)}}"> {{ status($row->order_status) }} </span>
                                                    </td>
                                                    <td>{{$row->order_date}}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-end align-items-center">
                                                            <a class="btn btn-sm bg-secondary mr-2" href="{{ url('admin/orders/show/'.$row->id) }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                                </svg> View
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
