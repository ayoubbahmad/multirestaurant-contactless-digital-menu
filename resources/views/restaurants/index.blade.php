@extends("restaurants.layouts.restaurants_layout")

@section("restaurant_content")

    <div class="container-fluid">

  <div class="row mt-0">
     
        <div>
            <div class="row p-0">

                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body widget-user">
                            <div class="text-center">
                                 <input type="text" readonly id="copyMe" value="{{route('view_store',[Auth::user()->view_id])}}"
                                           class="form-control">
                                           <div class="d-grid">
                                           <button class="btn btn-sm btn-primary waves-effect waves-light mt-2" type="button"
                                           id="copybtn">{{$selected_language->data['store_dashboard_copy'] ?? 'Copy'}}</button>
                                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body widget-user">
                            <div class="text-center">
                                <h2 class="fw-normal text-primary" data-plugin="counterup">{{$order_count}}</h2>
                                <h5>{{$selected_language->data['store_dashboard_total_orders'] ?? 'Total Orders'}}</h5>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body widget-user">
                            <div class="text-center">
                                <h2 class="fw-normal text-info" data-plugin="counterup">{{$item_sold}}</h2>
                                <h5>{{$selected_language->data['store_dashboard_item_sold'] ?? 'Item Sold'}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body widget-user">
                            <div class="text-center">
                                <h2 class="fw-normal text-success">@include('layouts.render.currency',["amount"=>$earnings])</h2>
                                <h5>{{$selected_language->data['store_dashboard_total_earnings'] ?? 'Total Earnings'}}</h5>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="row">
                @foreach($orders as $pending)
                @if($pending->is_merged==0)
                    <div class="col-lg-4 col-sm-12 pb-1">
                        <div class="card shadow">
                            <div class="card-header bg-secondary text-white">
                                <div class="row">
                                    <div class="col-6">{{$selected_language->data['store_dashboard_order_id'] ?? 'Order ID'}}</div>
                                    <div class="col-6"><strong>{{ $pending->order_unique_id }}</strong></div>
                                </div>
                            </div>
                            <div class="card-body">

                                <p class="card-text">
                                    {{$selected_language->data['store_dashboard_table_no'] ?? 'Table No'}} : <b
                                        class="float-right text-primary">{{ $pending->table_no }}</b><br>
                                    {{$selected_language->data['store_dashboard_total'] ?? 'Total'}} <b
                                        class="float-right text-primary">@include('layouts.render.currency',["amount"=>$pending->total])</b>
                                </p>
                                <hr class="bg-primary" style="opacity: 30%">

                                <div class="row">
                                    <div class="col-8">
                                            <i class="fas fa-user"></i> &nbsp; <b class="text-primary">{{ $pending->customer_name }}</b>
                                    </div>
                                    <div class="col-4 text-right">
                                        @if($pending->status == 1)
                                                <a onclick="document.getElementById('accept_order-{{$pending->id}}').submit();">
                                                    <i class="fas fa-check-circle fa-2x text-success"></i></a>
                                                <a onclick="document.getElementById('reject_order{{$pending->id}}').submit();"><i
                                                        class="fas fa-times-circle fa-2x text-danger"></i></a>
                                        @endif
                                    </div>

                                </div>

                            </div>
                        </div>
                        <form style="visibility: hidden" method="post"
                              action="{{route('store_admin.update_order_status',['id'=>$pending->id])}}"
                              id="accept_order-{{$pending->id}}">
                            @csrf
                            @method('patch')
                            <input style="visibility:hidden" name="status" type="hidden" value="2">
                        </form>

                        <form style="visibility: hidden" method="post"
                              action="{{route('store_admin.update_order_status',['id'=>$pending->id])}}"
                              id="reject_order{{$pending->id}}">
                            @csrf
                            @method('patch')
                            <input style="visibility:hidden" name="status" type="hidden" value="3">
                        </form>

                        <form style="visibility: hidden" method="post"
                              action="{{route('store_admin.update_order_status',['id'=>$pending->id])}}"
                              id="complete_order{{$pending->id}}">
                            @csrf
                            @method('patch')
                            <input style="visibility:hidden" name="status" type="hidden" value="4">
                        </form>
                    </div>
                    @endif
                @endforeach
                </div>
                
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="card-header bg-primary ">
                    <h4 class="text-white">{{$selected_language->data['store_dashboard_latest_reviews'] ?? 'Latest Reviews'}}</h4>
                </div>
                <div class="card card-body">
                    <ul class="list-group">
                        @foreach ($ratings as $item)
                            @php
                                $ordertemp = \App\Models\Order::where('id',$item->order_id)->first();
                            @endphp
                            @if($ordertemp)
                                <li class="list-group-item ">
                                    <div class="row d-flex justify-content-between">
                                        <div class="col-8">
                                          <p class="m-0 p-0">  {{$selected_language->data['store_dashboard_customer'] ?? 'Customer'}} : <b>  {{$ordertemp->customer_name ?? 'Customer Name'}} </b></p>
                                          {{$selected_language->data['store_dashboard_order_id'] ?? 'Order ID'}} :   <b> {{$ordertemp->order_unique_id ?? 'Order ID'}} </b> <br>
                                         
                                        </div>
                                        <div class="col-2">
                                            <span class="badge bg-success" style="font-size: 15px;">{{$item->rating}}&nbsp;<i class="fas fa-star"></i></span>
                                          </div>

                                    </div>
                                   
                                </li>
                            @endif
                        @endforeach
                    
                      </ul>
                </div>
            </div>
            </div>
            
        </div>
    </div>


</div>
@include('restaurants.notification.expired_notification')
@include('restaurants.notification.new_order_notification')
@include('restaurants.notification.call_waiter_notification')


@push('js')
<script>
    $( "#copybtn" ).click(function(e) {
        var textToCopy = document.getElementById("copyMe");
        textToCopy.select();
        document.execCommand("copy");
        e.stopPropagation();
    });
    </script>

@endpush


@endsection
