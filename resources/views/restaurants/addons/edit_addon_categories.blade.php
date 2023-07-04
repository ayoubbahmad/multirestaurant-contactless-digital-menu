@extends("restaurants.layouts.restaurants_layout")

@section("restaurant_content")

<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-12">
            <div class="page-title-box page-title-box-alt">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                      
                    </ol>
                </div>
                <h4 class="page-title">{{$selected_language->data['store_panel_inventory_addon_category_update'] ?? 'Update Addon Category'}}</h4>
            </div>
        </div>
    </div>  
        <div class="layout-px-spacing">

            <div class="row layout-top-spacing layout-spacing">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
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
                            <form  method="post" action="{{route('store_admin.addon_categories_update',['id'=>$data->id])}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            @method('PATCH')
                            <!-- Form groups used in grid -->
                                <div class="row">


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example3cols2Input">{{$selected_language->data['store_panel_common_name'] ?? 'Name'}}</label>
                                            <input type="text" name="name" value="{{$data->name}}" class="form-control" required>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example3cols2Input" style="color: red;">{{$selected_language->data['store_panel_inventory_addon_category_type'] ?? 'Select Category Type'}}</label>
                                            <select name="type" class="form-control" required>
                                                <option value="SNG" {{$data->type == "SNG"? "selected":''}}> @include('layouts.render.translation',["key" => "store_panel_common_addon_category_size_or_variant_label", "default"=> "store_panel_common"])</option>
                                                <option value="EXT" {{$data->type == "EXT"? "selected":''}}> @include('layouts.render.translation',["key" => "store_panel_common_addon_category_extra_label", "default"=> "store_panel_common"])</option>
                                                <option value="MULT" {{$data->type == "MULT"? "selected":''}}>  @include('layouts.render.translation', ["key" => "store_panel_common_addon_category_check_label", "default"=> "store_panel_common"])</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit">{{$selected_language->data['store_panel_common_update'] ?? 'Update'}}</button>
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
