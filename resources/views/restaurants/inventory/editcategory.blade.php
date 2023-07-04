@extends("restaurants.layouts.restaurants_layout")

@section("restaurant_content")

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box page-title-box-alt">
                <h4 class="page-title">{{$selected_language->data['store_panel_inventory_category_edit'] ?? 'Edit Category'}}</h4>
            </div>
        </div>
    </div>
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

                            <form method="post" action="{{route('store_admin.edit_category',['id'=>$data->id])}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            @method('PATCH')
                            <!-- Form groups used in grid -->
                                <div class="row">

                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example3cols1Input">{{$selected_language->data['store_panel_common_image'] ?? 'Image'}}</label>

                                            <div class="custom-file">
                                                <input name="image_url"  class="file-name dropify mb-2" type="file" readonly="readonly" placeholder="Browses photo" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example3cols2Input">{{$selected_language->data['store_panel_common_name'] ?? 'Name'}}</label>
                                            <input type="text"  name="name" value="{{$data->name}}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="exampleFormControlSelect1">{{$selected_language->data['store_panel_common_isenabled'] ?? 'Is Enabled ?'}}</label>
                                            <select class="form-control" name="is_active" required>
                                                <option value="1" {{$data->is_active == 1 ? "selected":NULL}}>Enabled</option>
                                                <option value="0" {{$data->is_active == 0 ? "selected":NULL}}>Disabled</option>
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
        </div>
    </div>




{{--        --}}

{{--        <div class="row">--}}
{{--        <div class="col-lg-12">--}}
{{--            <div class="card alert">--}}
{{--                <div class="card-header">--}}
{{--                    <h4>Edit Category</h4>--}}
{{--                    @if(session()->has("MSG"))--}}
{{--                        <div class="alert alert-{{session()->get("TYPE")}}">--}}
{{--                            <strong> <a>{{session()->get("MSG")}}</a></strong>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                    @if($errors->any()) @include('admin.admin_layout.form_error') @endif--}}

{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <div class="menu-upload-form">--}}
{{--                        <form class="form-horizontal" method="post" action="{{route('store_admin.edit_category',['id'=>$data->id])}}" enctype="multipart/form-data">--}}
{{--                            {{csrf_field()}}--}}
{{--                            @method('PATCH')--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="col-sm-2 control-label">Photo</label>--}}
{{--                                <div class="col-sm-10">--}}
{{--                                    <div class="form-control file-input dark-browse-input-box">--}}

{{--                                        <input name="image_url"  class="file-name input-flat ui-autocomplete-input" type="file" readonly="readonly" placeholder="Browses photo" autocomplete="off">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="col-sm-2 control-label">Category Name</label>--}}
{{--                                <div class="col-sm-10">--}}
{{--                                    <input type="text" name="name" value="{{$data->name}}" class="form-control" placeholder="Category Name">--}}
{{--                                </div>--}}
{{--                            </div>--}}



{{--                            <div class="form-group">--}}
{{--                                <label class="col-sm-2 control-label">Is Enabled</label>--}}
{{--                                <div class="col-sm-10">--}}
{{--                                    <select class="form-control" name="is_active" required>--}}
{{--                                        <option value="1" {{$data->is_active == 1 ? "selected":NULL}}>Enabled</option>--}}
{{--                                        <option value="0" {{$data->is_active == 0 ? "selected":NULL}}>Disabled</option>--}}


{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}


{{--                            <div class="form-group">--}}
{{--                                <div class="col-sm-offset-2 col-sm-10">--}}
{{--                                    <button type="submit" class="btn btn-lg btn-primary">Upload</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- /# card -->--}}
{{--        </div>--}}
{{--        <!-- /# column -->--}}
{{--    </div>--}}


@endsection
