@extends("restaurants.layouts.restaurants_layout")

@section("restaurant_content")

    <div class="container-fluid">

        <div class="row mb-2">
            <div class="col-12">
                <div class="page-title-box page-title-box-alt">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">

                            <button onclick="event.preventDefault(); document.getElementById('add_new').submit();"
                                    class="btn btn-md btn-primary btn-round mx-2" data-toggle="tooltip"
                                    data-original-title="{{$selected_language->data['store_panel_add_tables'] ?? 'Add Tables'}}">
                                {{--                                    <span class="btn-inner--icon"><i class="fas fa-chair"></i></span>--}}
                                <span
                                    class="btn-inner--text">{{$selected_language->data['store_panel_add_tables'] ?? 'Add Tables'}}</span>
                            </button>
                            <button onclick="event.preventDefault(); document.getElementById('table_report').submit();"
                                    class="btn btn-md btn-warning btn-round ml-2" data-toggle="tooltip"
                                    data-original-title="Table Report">
                                {{--                                    <span class="btn-inner--icon"><i class="fas fa-receipt"></i></span>--}}
                                <span
                                    class="btn-inner--text text-white">{{$selected_language->data['store_panel_table_report'] ?? 'Table Reports'}}</span>
                            </button>
                            <form action="{{route('store_admin.add_tables')}}" method="get" id="add_new"></form>
                            <form action="{{route('store_admin.table_report')}}" method="get" id="table_report"></form>
                        </ol>
                    </div>
                    <h4 class="page-title">Tables</h4>
                </div>
            </div>
        </div>
        <div class="row">


            @php $i=1 @endphp
            @foreach($tables as $data)


                <div class="col-md-3">
                    <div class="card card-body shadow-lg ">
                        <div class="row">
                            <div class="col">
                                <div class="acc-total-info " style="padding: 5px">
                                    <h5 class="">{{$selected_language->data['store_dashboard_table_no'] ?? 'Table No'}}
                                        : {{ $data->table_name }}</h5>
                                </div>
                            </div>

                            <div class="col-auto text-right mt-2">

                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input table_status"
                                            {{$data->is_active ==1?"checked":NULL}} data-id={{$data->id}}>
                                    <label class="form-check-label" for="customSwitch1"></label>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row" style="margin-top: -18px;">
                            <div class="col">
                                <a href="{{route('store_admin.edit_table',$data->id)}}">
                                    <b>{{$selected_language->data['store_panel_common_edit'] ?? 'Edit'}}</b>
                                </a>
                            </div>
                            <div class="col">
                                <a href="{{route('download_table_qr',[Auth::user()->view_id,$data->id])}}">
                                    <b style="color: red;">{{$selected_language->data['store_panel_qr_code'] ?? 'QR Code'}}</b>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

@endsection

@push('js')

<script>
    $(".table_status").on('change', function() {
        'use strict';
        var id = $(this).data('id');
               /* get stripe status */
        if ($(this).is(':checked')) {
            var status = 1;
        }
        else {
            var status = 0;
        }
        
        if (id) {
            $.ajax({
                url: "{{ url('/admin/store/alltables/updateStatus') }}",
                data: {
                    id: id,
                    status: status
                },
                type: "GET",
                success: function (data) {
                }
            });
        }
    });
</script>

@endpush