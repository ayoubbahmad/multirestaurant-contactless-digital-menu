@extends("admin.admin_layout.adminlayout")

@section("admin_content")
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-12">
            <div class="page-title-box page-title-box-alt">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">

                    </ol>
                </div>
                <h4 class="page-title">Recent Customers List</h4>
            </div>
        </div>
    </div>  
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing">

                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4></h4>
                                </div>
                            </div>
                        <!-- Light table -->
                        <div class="table-responsive mb-4">
                            @if(session()->has("MSG"))
                                <div class="alert alert-{{session()->get("TYPE")}}">
                                    <strong> <a>{{session()->get("MSG")}}</a></strong>
                                </div>
                            @endif
                            <div class="table-responsive">
                            <table class="table " style="width:100%">
                                <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Customer Name</th>
                                    <th>Customer Phone</th>
                                    <th>No of Orders</th>
                                    <th>Recent Order </th>
                                </tr>
                                </thead>
                                <tbody>

                                @php $i=1 @endphp
                                @foreach($customers as $key => $data)

                                    <tr>
                                        <td>{{ $customers->firstItem() + $key }}</td>
                                        <td>{{$data->customer_name}}</td>
                                        <td>{{$data->customer_phone}} </td>
                                        <td>
                                            {{$data->admin_total($data->customer_phone)}}
                                        </td>
                                        <td> {{$data->created_at->diffForHumans()}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                            {{ $customers->links('restaurants.orders.custom-pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
