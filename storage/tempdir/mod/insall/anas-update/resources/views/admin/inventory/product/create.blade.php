@extends('layouts.admin-layout')
@section('title','Inventory Product')
@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="font-weight-bold"> Add Product</h4>
                        </div>
                        <div class="create-workform">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <div class="modal-product-search d-flex">
                                    <a href="{{ url('admin/inventory/products/') }}"
                                       class="btn btn-primary btn-sm d-flex align-items-center justify-content-between ml-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20"
                                             fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                        <span class="ml-2"> Back </span>
                                    </a>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <form class="date-icon-set-modal"
                                          action="{{ isset($product) ? url('admin/inventory/products/update/' . $product->id) : url('admin/inventory/products/create') }}"
                                          method="post" id="MyProductForm" enctype='multipart/form-data'>
                                        {{ @csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <div class="card-body rounded bg-light">
                                                    <div class="d-flex justify-content-center mt-5">
                                                        <input type="file" class="form-control dropify" id="image"
                                                               accept=".png,.jpg,.jpeg,.PNG,.JPG,.JPEG"
                                                               data-height="150"
                                                               name="image"
                                                               data-default-file="{{(isset($product) && !empty($product->image) && File::exists('uploads/products/'.$product->image)) ? asset('uploads/products/'.$product->image):asset('uploads/products/default.jpg') }}"
                                                               data-show-remove="{{isset($product) ? 'false':'true'}}">

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label
                                                            class="form-label font-weight-bold text-muted text-uppercase"> Product Name
                                                            <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" required autofocus
                                                               placeholder="Enter Product Name" name="name" id="name"
                                                               value="{{ (isset($product)?$product->name:'') }}">
                                                    </div>
                                                            <div class="col-md-6 mb-3">
                                                        <label
                                                            class="form-label font-weight-bold text-muted text-uppercase"> Article Number
                                                            <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" required autofocus
                                                               placeholder="Enter Article Number" name="article_number" id="article_number"
                                                               value="{{ (isset($product)?$product->article_number:'') }}">
                                                    </div>
                                                    @php
                                                        $categories = App\Category::where('is_active',1)->get();
                                                        $brands = App\Brand::where('is_active',1)->get();
                                                        $add_on_categories = App\AddOnCategory::get();
                                                    @endphp
                                                    <div class="col-md-6 mb-3">
                                                        <label for="inputState"
                                                               class="form-label font-weight-bold text-muted text-uppercase">Product
                                                            Category<span class="text-danger">*</span></label>
                                                        <select name="category_id" id="category_id"
                                                                class="form-select form-control">
                                                            <option value=""> select category</option>
                                                            @foreach($categories as $row)
                                                                <option
                                                                    value="{{$row->id}}" {{ (isset($product)  ? ($product->category_id== $row->id ?"selected":'') :"") }}> {{ $row->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="inputState"
                                                               class="form-label font-weight-bold text-muted text-uppercase">Product
                                                            Brand<span class="text-danger">*</span></label>
                                                        <select name="brand_id" id="brand_id"
                                                                class="form-select form-control">
                                                            <option value=""> select Brand</option>
                                                            @foreach($brands as $row)
                                                                <option
                                                                    value="{{$row->id}}" {{ (isset($product)  ? ($product->brand_id== $row->id ?"selected":'') :"") }}> {{ $row->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="inputState"
                                                               class="form-label font-weight-bold text-muted text-uppercase">Product
                                                            Addon Category</label>

                                                        <select id="add_on_category_id" name="add_on_category_id[]"
                                                                class="form-select form-control choicesjs" multiple>
                                                            @foreach($add_on_categories as $row)
                                                                <option value="{{$row->id}}" {{isset($product) &&  in_array($product->id, $row->items()->pluck('product_id')->toArray()) ? 'selected' : '' }}> {{ $row->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label
                                                            class="form-label font-weight-bold text-muted text-uppercase">Price<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="price" name="price"
                                                               value="{{ (isset($product)?$product->price:'') }}">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label
                                                            class="form-label font-weight-bold text-muted text-uppercase">Discount Price </label>
                                                        <input type="text" class="form-control" id="discount_price"
                                                               name="discount_price"
                                                               value="{{ (isset($product)?$product->discount_price:'') }}">
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label for="Text9"
                                                               class="form-label font-weight-bold text-muted text-uppercase">Description</label>
                                                        <textarea class="form-control" id="description"
                                                                  name="description"
                                                                  rows="1"> {{ (isset($product)?$product->description:'') }} </textarea>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label
                                                            class="form-label font-weight-bold text-muted text-uppercase mb-3">Others</label><br>
                                                        <div
                                                            class="custom-control custom-switch custom-switch-color custom-control-inline">
                                                            <input type="checkbox"
                                                                   class="custom-control-input bg-danger"
                                                                   name="is_featured"
                                                                   id="featured" {{ (isset($product) && $product->is_featured==1) ? 'checked=""':''}}>
                                                            <label class="custom-control-label" for="featured">is
                                                                featured</label>
                                                        </div>
                                                        <div
                                                            class="custom-control custom-switch custom-switch-color custom-control-inline">
                                                            <input type="checkbox"
                                                                   class="custom-control-input bg-primary"
                                                                   name="is_active"
                                                                   id="active" {{ (isset($product) ? (($product->is_active==1) ? 'checked=""':'') : 'checked=""')}}>
                                                            <label class="custom-control-label" for="active">is
                                                                active</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <div class="d-flex justify-content-end mt-3">
                                                            
                                                            <button type="submit" class="btn btn-primary">
                                                                Save
                                                            </button>
                                                        </div>
                                                    </div>
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
        </div>
    </div>
@endsection
