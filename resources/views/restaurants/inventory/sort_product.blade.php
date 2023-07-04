@extends("restaurants.layouts.restaurants_layout")

@section("restaurant_content")


    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box page-title-box-alt">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">

                            <a  class="btn btn-sm btn-primary btn-round btn-icon" onclick="document.getElementById('product_sort_save').submit();">
                                &nbsp;<span class="btn-inner--text">{{$selected_language->data['store_panel_category_sorting_save_button_label'] ?? 'Save Changes'}}</span>
                            </a>
                        </ol>
                    </div>
                    <h4 class="page-title">{{$selected_language->data['store_panel_product_sorting'] ?? 'Product Sorting'}}</h4>
                </div>
            </div>
        </div>

        <div class="layout-px-spacing">

            <div class="row layout-top-spacing layout-spacing">
                <div class="col-lg-2">
                
                    @foreach($categories as $item)
                   <a href="{{route('store_admin.product_sort', ['cat_id' => $item->id])}}"> <button class="btn btn-lg font-16  @if($selected_cat->id == $item->id) btn-success @else btn-dark  @endif w-100 mb-2" id="btn-new-event">{{$item->name}}</button></a>
                   @endforeach
                   

                </div>
                <div class="col-lg-10">
                    
                        <!-- Card body -->
                        <div class="card card-body jus">


                            <div class="parent ex-1 ">
                                <div class="">
                                    <form method="post" action="{{route('store_admin.product_sort_save')}}" id="product_sort_save">
                                        @csrf
                                        <div id="left-defaults" class="dragula">
                                            @foreach($data as $product)
                                                <div class="media  d-md-flex d-block text-sm-left text-center">
                                                    <img alt="avatar" src="{{asset($product->image_url !=NULL ? $product->image_url:'themes/default/images/all-img/empty.png')}}" class="img-fluid">
                                                    <div class="media-body" >
                                                        <div class="d-xl-flex d-block justify-content-between">
                                                            <div class="">
                                                                <h6 class="">{{ucfirst($product->name)}} (@include('layouts.render.currency',["amount"=>$product->price]))</h6>
                                                                <p class=""> <span class="badge badge-{{$product->is_active == 1 ? "success" : "danger"}}">
                                                                    {{$product->is_active == 1 ? $selected_language->data['store_panel_common_active'] ?? 'Active' : $selected_language->data['store_panel_common_inactive'] ?? 'In Active'}}
                                                                </span></p>
                                                                <input type="hidden" name="product[]" value={{$product->id}} />
                                                                
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

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
