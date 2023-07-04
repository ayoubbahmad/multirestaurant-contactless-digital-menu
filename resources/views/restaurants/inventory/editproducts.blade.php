@extends("restaurants.layouts.restaurants_layout")

@section("restaurant_content")

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box page-title-box-alt">
                <h4 class="page-title">{{$selected_language->data['store_panel_inventory_products_edit'] ?? 'Edit Products'}}</h4>
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
                            <form method="post" action="{{route('store_admin.edit_products',['id'=>$data->id])}}"
                                  enctype="multipart/form-data">
                            {{csrf_field()}}
                            @method('PATCH')
                            <!-- Form groups used in grid -->
                                <div class="row">

                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example3cols1Input">{{$selected_language->data['store_panel_common_image'] ?? 'Image'}}</label>


                                            <div class="custom-file">
                                                <input name="image_url" class="file-name dropify"
                                                       type="file" readonly="readonly" placeholder="Browses photo"
                                                       autocomplete="off">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example3cols2Input">{{$selected_language->data['store_panel_common_name'] ?? 'Name'}}</label>
                                            <input type="text" value="{{$data->name}}" name="name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example3cols2Input">{{$selected_language->data['store_panel_common_price'] ?? 'Price'}}</label>
                                            <input type="text" value="{{$data->price}}" name="price" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example3cols2Input">{{$selected_language->data['store_panel_inventory_products_cooking_time'] ?? 'Cooking Time'}}</label>
                                            <input type="number" value="{{$data->cooking_time}}" name="cooking_time" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3  mb-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="exampleFormControlSelect1">
                                                {{$selected_language->data['store_panel_inventory_products_select_category'] ?? 'Select Category'}}
                                            </label>
                                            <select class="form-control" name="category_id" required>

                                                @foreach($category as $cat)
                                                    <option value="{{ $cat->id }}" {{$data->category_id ==$cat->id ? "selected":null }}>{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                <div class="col-md-3  mb-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="exampleFormControlSelect1">{{$selected_language->data['store_panel_inventory_products_select_addon_category'] ?? 'Select Addon Category'}}</label>
                                            <select  class="selectpickers "  name="addon_category_id[]" multiple="multiple" data-live-search="true">


                                                @foreach($addon_category as $cat)



                                                    <option {{$addon_category_items->contains('addon_category_id', $cat->id) == 1 ? "selected": null}}  value="{{ $cat->id }}">{{ $cat->name }}</option>


                                                @endforeach
                                            </select>
                                        </div>
                                    </div> 


                                    <div class="col-md-3  mb-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="exampleFormControlSelect1">{{$selected_language->data['store_panel_common_isenabled'] ?? 'Is Enabled ?'}}</label>
                                            <select class="form-control" name="is_active" required>
                                                <option value="1" {{$data->is_active == 1 ? "selected":NULL}}>Yes</option>
                                                <option value="0" {{$data->is_active == 0 ? "selected":NULL}}>No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3  mb-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="exampleFormControlSelect1">{{$selected_language->data['store_panel_inventory_products_is_recommended'] ?? 'Is Recommended'}}</label>
                                            <select class="form-control" name="is_recommended" required>
                                                <option value="1" {{$data->is_recommended == 1 ? "selected":NULL}}>Yes</option>
                                                <option value="0" {{$data->is_recommended == 0 ? "selected":NULL}}>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3  mb-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="exampleFormControlSelect1">{{$selected_language->data['store_panel_common_isveg'] ?? 'is Veg ?'}}</label>
                                            <select class="form-control" name="is_veg" required>
                                                <option value="1" {{$data->is_veg == 1 ? "selected":NULL}}>Yes</option>
                                                <option value="0" {{$data->is_veg == 0 ? "selected":NULL}}>No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12  mb-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="exampleFormControlSelect1">{{$selected_language->data['store_panel_common_description'] ?? 'Description'}}</label>
                                            <textarea class="form-control" name="description" rows="3" required>{{$data->description}}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
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
