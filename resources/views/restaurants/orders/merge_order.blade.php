@extends("restaurants.layouts.restaurants_layout")

@section("restaurant_content")


    <div class="container-fluid">
        <div style="background: linear-gradient(to right, #38414A, #192735); color: #fff; border-radius: 8px; margin-bottom: 15px">
            <div class="d-flex justify-content-between align-items-center" style="padding: 0.7rem; ">
                <div>
                    <h4 class="text-danger">Merge Order Rules *</h4>
                    <p class="mb-0">Dining Orders, same date order and same Table numbers orders only to merge.</p>
                </div>
               
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                <h4>{{$selected_language->data['store_panel_merge_orders'] ?? 'Merge Orders'}}</h4>
                @if(session()->has("MSG"))
                    <div class="alert alert-{{session()->get("TYPE")}}">
                        <strong> <a>{{session()->get("MSG")}}</a></strong>
                    </div>
                @endif
                @if($errors->any()) @include('admin.admin_layout.form_error') @endif
            </div>
        </div>

        

        <div class="row">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{route('store_admin.mergeOrders')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                        <div class="row">
                            @php
                               $order = \App\Models\Order::find($id);
                               $subOrders = \App\Models\Order::where('store_id',$order->store_id)->where('table_no',$order->table_no)->where('payment_type',1)->whereDate('created_at',$order->created_at)->where('id','!=',$order->id)->where('order_type',1)->where('is_merged',0)->get();
                            @endphp
                            <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label class="form-control-label" for="example3cols2Input">{{$selected_language->data['store_panel_merge_primary_id'] ?? 'Primary Order Id'}}</label>
                                    <input type="text" name="unique_id" value="{{$order->order_unique_id}}" class="form-control" readonly>
                                    <input type="hidden" name="id" value="{{$id}}" class="form-control" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="exampleFormControlSelect1">{{$selected_language->data['store_panel_select_orders_to_merge'] ?? 'Select Orders To Merge'}}</label>


                                    <select class="selectpickers" multiple  name="sub_order_id[]" style="height: 200px">
                                        @foreach($subOrders as $row)
                                            <option value="{{ $row->id }}">{{ $row->order_unique_id }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">{{$selected_language->data['store_panel_common_submit'] ?? 'Submit'}}</button>
                                </div>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>



@endsection
