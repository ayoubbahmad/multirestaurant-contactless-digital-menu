@extends("restaurants.layouts.restaurants_layout")

@section("restaurant_content")

 <div class="container-fluid">
       <div class="row">
        <div class="col-12">
            <div class="page-title-box page-title-box-alt">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                    
                </div>

            </div>
        </div>
    </div>     

            <div class="row ">
            <div class="card ">
            <div class="card-body ">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>{{$selected_language->data['store_panel_table_report'] ?? 'Table Reports'}}</h4>
                                </div>
                            </div>
                        <div class="table-responsive">
                            @if(session()->has("MSG"))
                                <div class="alert alert-{{session()->get("TYPE")}}">
                                    <strong> <a>{{session()->get("MSG")}}</a></strong>
                                </div>
                            @endif
                            <table id="datatable" class="table table-hover" style="width:100%">
                                <thead>
                                <tr>
                                    <th>{{$selected_language->data['store_panel_common_no'] ?? 'No'}}</th>
                                    <th>{{$selected_language->data['store_panel_table_name_number'] ?? 'Table Name/Number'}}</th>
                                    <th>{{$selected_language->data['store_panel_table_report_total_orders'] ?? 'Total Orders'}}</th>
                                    <th class="no-content">{{$selected_language->data['store_panel_table_report_total_price'] ?? 'Total Price'}}</th>
                                </tr>
                                </thead>
                                <tbody>

                                @php $i=1 @endphp
                                @foreach($tables as $data)

                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$data->table_name}}</td>
                                        <td>{{$data->total_order_count($data->table_name)}} </td>
                                        <td>
                                            {{$data->total_order_sum($data->table_name)}}
                                        </td>
            {{--                            <td>--}}
            {{--                                {{$data->created_at->diffForHumans()}}--}}
            {{--                            </td>--}}
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
