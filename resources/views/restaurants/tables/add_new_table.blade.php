@extends("restaurants.layouts.restaurants_layout")

@section("restaurant_content")


<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box page-title-box-alt">
                <h4 class="page-title">{{$selected_language->data['store_panel_table_new_table'] ?? 'Add New Table'}}</h4>
            </div>
        </div>
    </div>
 

    <div class="row ">
        <div class="card ">
        <div class="card-body ">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4></h4>
                                    @if(session()->has("MSG"))
                                        <div class="alert alert-{{session()->get("TYPE")}}">
                                            <strong> <a>{{session()->get("MSG")}}</a></strong>
                                        </div>
                                    @endif
                                    @if($errors->any()) @include('admin.admin_layout.form_error') @endif
                                </div>
                            </div>
                        </div>

                            <form  method="post" action="{{route('store_admin.add_new_table')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <!-- Form groups used in grid -->
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example3cols2Input">{{$selected_language->data['store_panel_table_name_number'] ?? 'Table Name/Number'}}</label>
                                            <input type="text" name="table_name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group ">
                                            {{-- <label class="form-control-label" for="example3cols2Input">{{$selected_language->data['store_panel_table_code'] ?? 'Table Code'}}</label> --}}
                                            <input type="hidden" name="table_code" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <div class="form-check form-switch">
                                                    <input type="checkbox" name="is_active" checked="" class="form-check-input" id="customSwitch1">
                                                    <label class="form-check-label" for="customSwitch1">{{$selected_language->data['store_panel_table_visibility'] ?? 'Visibility'}}</label>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
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
        </div>
    </div>

@endsection
