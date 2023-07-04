@extends("restaurants.layouts.restaurants_layout")

@section("restaurant_content")


     <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box page-title-box-alt">
                    <h4 class="page-title">{{$selected_language->data['store_panel_coupons_add'] ?? 'Add Coupons'}}</h4>
                </div>
            </div>
        </div>
        <div class="layout-px-spacing">

            <div class="row ">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    @if(session()->has("MSG"))
                                        <div class="alert alert-{{session()->get("TYPE")}}">
                                            <strong> <a>{{session()->get("MSG")}}</a></strong>
                                        </div>
                                    @endif
                                    @if($errors->any()) @include('admin.admin_layout.form_error') @endif
                                    <h4></h4>
                                </div>
                            </div>
                            <form  method="post" action="{{route('store_admin.create_coupons')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <!-- Form groups used in grid -->
                                <div class="row">


                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example3cols2Input">{{$selected_language->data['store_panel_common_name'] ?? 'Name'}}</label>  <span class="text-danger">*</span>
                                            <input type="text" name="name" class="form-control" placeholder="Coupon Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example3cols2Input">{{$selected_language->data['store_panel_common_description'] ?? 'Description'}}</label> <span class="text-danger">*</span>
                                            <input type="text" name="description" placeholder="Coupon Description" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example3cols2Input">{{$selected_language->data['store_panel_coupons_code'] ?? 'Code'}}</label> <span class="text-danger">*</span>
                                            <input type="text" name="code" placeholder="Coupon Code" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example3cols2Input">{{$selected_language->data['store_panel_common_type'] ?? 'Type'}}</label> <span class="text-danger">*</span>
                                            <select name="discount_type" class="form-control" required>
                                                <option value="AMOUNT">Fixed Amount Discount</option>
                                                <option value="PERCENTAGE">Percentage Discount</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example3cols2Input">{{$selected_language->data['store_panel_coupons_discount'] ?? 'Discount'}}</label> <span class="text-danger">*</span>
                                            <input type="number" name="discount" placeholder="Coupon Discount" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-2 mt-4">
                                        <div class="form-group">
                                            <div class="form-check form-switch">
                                                    <input type="checkbox" name="is_active" checked="" class="form-check-input" id="customSwitch1">
                                                    <label class="form-check-label" for="customSwitch1">Is Active</label>
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

@endsection
