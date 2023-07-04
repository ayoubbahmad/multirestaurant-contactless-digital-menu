@extends("restaurants.layouts.restaurants_layout")

@section("restaurant_content")


    <div class="container-fluid">

        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                <h4>{{$selected_language->data['store_panel_inventory_products_add'] ?? 'Add Products'}}</h4>
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
                    <form method="post" action="{{route('store_admin.addproducts')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-control-label" for="example3cols1Input">{{$selected_language->data['store_panel_common_image'] ?? 'Image'}}</label>

                                    <div class="custom-file">
                                        <input name="image_url"  class="file-name dropify" type="file" readonly="readonly" placeholder="Browses photo" autocomplete="off">


                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label class="form-control-label" for="example3cols2Input">{{$selected_language->data['store_panel_common_name'] ?? 'Name'}}</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label class="form-control-label" for="example3cols2Input">{{$selected_language->data['store_panel_common_price'] ?? 'Price'}}</label>
                                    <input type="text" name="price" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <div class="form-group">
                                    <label class="form-control-label" for="example3cols2Input">{{$selected_language->data['store_panel_inventory_products_cooking_time'] ?? 'Cooking Time'}}</label>
                                    <input type="number" name="cooking_time" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-control-label" for="exampleFormControlSelect1">{{$selected_language->data['store_panel_inventory_products_select_category'] ?? 'Select Category'}}</label>
                                    <select class="form-control" name="category_id" required>
                                        @foreach($category as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="exampleFormControlSelect1">{{$selected_language->data['store_panel_inventory_products_select_addon_category'] ?? 'Select Addon Category'}}</label>


                                    <select class="selectpickers" multiple  name="addon_category_id[]" style="height: 200px">
                                        @foreach($addon_category as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-control-label" for="exampleFormControlSelect1">{{$selected_language->data['store_panel_common_isenabled'] ?? 'Is Enabled ?'}}</label>
                                    <select class="form-control" name="is_active" required>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
 
                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-control-label" for="exampleFormControlSelect1">{{$selected_language->data['store_panel_inventory_products_is_recommended'] ?? 'Is Recommended'}}</label>
                                    <select class="form-control" name="is_recommended" required>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 mb-2">
                                <div class="form-group">
                                    <label class="form-control-label" for="exampleFormControlSelect1">{{$selected_language->data['store_panel_common_isveg'] ?? 'is Veg ?'}}</label>
                                    <select class="form-control" name="is_veg" required>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-control-label" for="exampleFormControlSelect1">{{$selected_language->data['store_panel_common_description'] ?? 'Description'}}</label>
                                    <textarea class="form-control"name="description" rows="3" required></textarea>
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
