@extends("restaurants.layouts.restaurants_layout")

@section("restaurant_content")

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box page-title-box-alt">
                    <h4 class="page-title">{{$selected_language->data['store_promo_add'] ?? 'Add Promo Banner'}}</h4>
                </div>
            </div>
        </div>
       <div class="row">
            <div class="card ">
            <div class="card-body ">
                <div class="col-lg-12">


            <div class="row layout-top-spacing layout-spacing">
                <div class="col-lg-12">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4 class="mb-0"></h4>
                                    @if(session()->has("MSG"))
                                        <div class="alert alert-{{session()->get("TYPE")}}">
                                            <strong> <a>{{session()->get("MSG")}}</a></strong>
                                        </div>
                                    @endif
                                    @if($errors->any()) @include('admin.admin_layout.form_error') @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form  method="post" action="{{route('store_admin.add_banner')}}" enctype="multipart/form-data">
                            {{csrf_field()}}

                                <div class="row mb-2">

                                    <div class="col-md-12">
                                    
                                        <div class="form-group">
                                            <label class="form-control-label" for="example3cols1Input">{{$selected_language->data['store_promo_bannerimage'] ?? 'Banner Image'}} <small style="color: red">(recommended: 976px x 359px)</small></label>
                                            <div class="custom-file">
                                                <input required name="photo_url"  class="dropify" type="file" readonly="readonly" placeholder="Browses photo" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="example3cols2Input">{{$selected_language->data['store_promo_bannername'] ?? 'Banner Name'}}</label>
                                            <input type="text" name="name" class="form-control" required>
                                        </div>
                                    </div>
                                   
                                </div>
                               
                                 <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <div class="form-check form-switch">
                                                    <input type="checkbox" name="is_visible" class="form-check-input" id="exampleFormControlSelect1">
                                                    <label class="form-check-label"  checked="" for="exampleFormControlSelect1">{{$selected_language->data['store_promo_bannervisibility'] ?? 'Visibility'}}</label>
                                                </div>
                                        </div>
                                    </div>
                                
                                 <div class="row mb-2">
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
