@extends("restaurants.layouts.restaurants_layout")

@section("restaurant_content")

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box page-title-box-alt">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <a href="{{route('store_admin.addbanner')}}" class="btn btn-sm btn-primary  waves-effect waves-light float-right" data-toggle="tooltip" data-original-title="{{$selected_language->data['store_sidebar_promo_banner_add'] ?? 'Add Promo Banner'}}">
                                <i class="fe-plus"> </i>
                                <span class="btn-inner--text">{{$selected_language->data['store_sidebar_promo_banner_add'] ?? 'Add Promo Banner'}}</span>
                            </a>
                        </ol>
                    </div>
                    <h4 class="page-title">{{$selected_language->data['store_sidebar_promo_banner'] ?? 'Promo Banner'}}</h4>
                </div>
            </div>
        </div>


        <div class="row">
            @foreach($banner as $ban)

                <div class="col-md-2">

                    <div class="card shadow">
                        <img class="card-img-top" src="{{asset($ban->photo_url)}}"
                             alt="{{$ban->name}}">
                        <div class="card-body"
                             style="padding-left: 15px; padding-top: 15px; padding-bottom: 0px">
                            <h5 class="card-title"><b>{{$ban->name}}</b></h5>
                        </div>
                        <div class="card-body" style="padding:15px">
                            <a href="{{route('store_admin.banneredit',$ban->id)}}"
                               class="card-link"><b>{{$selected_language->data['store_panel_common_edit'] ?? 'Edit'}}</b></a>
                            <a class="card-link"
                               onclick="if(confirm('Are you sure you want to delete this item?')){ event.preventDefault();document.getElementById('delete-form-{{$ban->id}}').submit(); }"><b
                                    style="color: red">{{$selected_language->data['store_panel_common_delete'] ?? 'Delete'}}</b></a>

                            <form method="post"
                                  action="{{route('store_admin.delete_slider')}}"
                                  id="delete-form-{{$ban->id}}" style="display: none">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" value="{{$ban->id}}" name="id">
                            </form>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>



    </div>



@endsection
