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
                    <h4 class="page-title">{{$selected_language->data['store_panel_inventory_addon_update'] ?? 'Update Addon'}}</h4>
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
                        <!-- Card body -->
                            <form  method="post" action="{{route('store_admin.update_addon',['id'=>$addon->id])}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            @method('PATCH')
                            <!-- Form groups used in grid -->
                                <div class="row">


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example3cols2Input">{{$selected_language->data['store_panel_common_name'] ?? 'Name'}}</label>
                                            <input type="text" name="addon_name" value="{{$addon->addon_name}}" class="form-control" required>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example3cols2Input" style="color: red;">{{$selected_language->data['store_panel_inventory_products_select_category'] ?? 'Select Category'}}</label>
                                            <select name="addon_category_id" class="form-control" required>
                                                @foreach( $addons_category as $category)
                                                    <option value="{{$category->id}}" {{$category->id == $addon->addon_category_id ? "selected":null}}>{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example3cols2Input">{{$selected_language->data['store_panel_common_price'] ?? 'Price'}}</label>
                                            <input type="number" name="price" value="{{$addon->price}}" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button class="btn btn-primary mt-2" type="submit">{{$selected_language->data['store_panel_common_update'] ?? 'Update'}}</button>
                                        </div>
                                    </div>


                                </div>

                            </form>
                        </div>



                    </div>
            </div>
        </div>
    </div>




@endsection
