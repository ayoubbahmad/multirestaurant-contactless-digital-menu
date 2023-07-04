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
                <h4 class="page-title">All Transactions</h4>
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
                        <div class="table-responsive">
                            <table id="zero-config" class="table" style="width:100%">
                                <thead>
                                <tr>
                                    <th class="text-center">Sl.</th>
                                    <th class="text-center">Store Name</th>
                                    <th class="text-center">Subscription Name / Price</th>
                                    <th class="text-center">Subscription Days</th>
                                    <th class="text-center">Payment Status</th>
                                    <th class="text-center">Payment Gateway</th>

                                </tr>
                                </thead>
                                <tbody>



                                @php $i=1 @endphp
                                @foreach($transactions as $value)
                                    <tr class="text-center">

                                        <td>
                                            <span class="text-muted">{{ $i++}}</span>
                                        </td>

                                        <td>
                                            @foreach($value->store($value->store_id) as $data)
                                                {{$data->store_name }}
                                            @endforeach
                                        </td>

                                        <td>
                                            <span class="text-muted">{{ $value->subscription_name}} / {{ $value->subscription_price}}</span>
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ $value->subscription_days}}</span>
                                        </td>

                                        <td>
                                            <span class="badge badge-soft-{{$value->payment_status == 'paid' ? "success":"danger"}}" style="width: 65px">
                                                {{$value->payment_status == 'unpaid' ? "UnPaid":"Paid"}}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="text-dark"><strong>{{ $value->gateway_name}}</strong></span>
                                        </td>

                                    </tr>

                                @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
