<div class="">
 <style>
     .disp-part {
    position:relative;
    display:inline-block;
}

     .notify-badge-veg{
        position: absolute;
        right: 14px;
    top: 8px;
        background: #0ac353c2;
        text-align: center;
        color: white;
        padding: 1px 10px;
        font-size: 10px;
    }
    .notify-badge-non-veg{
        position: absolute;
        right: 14px;
    top: 8px;
        background: #FF4C3B;
        text-align: center;
        color: white;
        padding: 1px 10px;
        font-size: 10px;
    }


 </style>
<section class="pt-0">
    <div class="profile-detail bg-white">
        <div class="media">
            <img @if (file_exists($store->logo_url))
            src="{{ asset($store->logo_url) }}"
        @else src="{{ asset('/store_assets/images/empty.png') }}" @endif class="img-fluid shadow-lg" alt="">
            <div class="media-body">
                <h1 class="pb-2 blue-main store_title">{{ $store->store_name }}</h1>
                <h6 class="blue-address"><i class="fas fa-map-marked-alt"></i> &nbsp; <b>{{ $store->address }}</b></h6>
               <div class="d-flex justify-content-between">
                   <h6 class="blue-address" style="margin-right: 65px"><i class="fas fa-phone-office"></i> &nbsp; <b>{{ $store->phone }}</b></h6>
                   @if($store->is_call_waiter_enable == 1) <button class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#callwaiterModal"><i class="fas fa-hat-chef"></i></button> @endif
               </div>
            </div>

        </div>
    </div>
</section>

<div class="divider t-12" ></div>



@if(count($sliders) > 0)
  <section class="pt-0 home-section ratio_40" wire:ignore>
    <div class="home-slider slick-default">
        @foreach ($sliders as $item)
        @if(file_exists(public_path($item->photo_url)))
      <div>
        <div class="slider-box">
          <img src="{{asset($item->photo_url)}}" class="img-fluid bg-img"  alt="">
          
        </div>
      </div>
      @endif
      @endforeach
    </div>
  </section>
  <div class="divider t-12" ></div>
@endif  



<section class="pt-0 product-slider-section overflow-hidden">

    <div class="title-section px-15 pt-2" >
        <h2>{{ $selected_language->data['menu_recommend'] ?? 'Recommended for you' }}</h2>
    </div>
    <div class="product-slider slick-default pl-15 pb-3" wire:ignore>
        @foreach ($recommended as $row)
        @php
            $prodcat = \App\Category::where('id', $row->category_id)->first();
        @endphp
        @if ($prodcat && $prodcat->is_active == 1)
        <div class="card p-2" >
            <div class="product-box ratio_square">
                <div class="img-part">
                    <a href="{{ url('/store/' . $view_id . '/product/' . $row->id) }}"><img @if (file_exists($row->image_url))
                        src="{{ asset($row->image_url) }}"
                    @else src="{{ asset('/store_assets/images/empty.png') }}"
        @endif alt="" class="img-fluid bg-img"/></a>
                    <label>{{ $selected_language->data['recommended'] ?? 'Recommended' }}</label>
                </div>
                <div class="product-content">
                    <a href="{{ url('/store/' . $view_id . '/product/' . $row->id) }}">
                        <h4>{{ \Illuminate\Support\Str::limit($row->name, 15, $end='...') ?? 'No Name' }} </h4>
                    </a>
                    <div class="price">
                        <h4>@include('layouts.render.currency',["amount"=>$row->price]) </h4>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach

    </div>
</section>

<div class="divider t-12 b-15"></div>


@php
    $catproducts = [];
@endphp

<section class="pt-0 tab-section">
    <div class="tab-section" x-data="{ quantity : @entangle('quantity') }">
        <ul class="nav nav-tabs theme-tab pl-15" style="    overflow-x: auto;
        overflow-y: hidden;
        white-space: nowrap;">
    <li class="nav-item" wire:ignore>
        <button
                class="nav-link active"
                data-bs-toggle="tab"
                data-bs-target="#allproducts"
                type="button">
               All
        </button>
    </li>
            @php
                $i =0;
            @endphp

        @foreach ($categories as $row)
        @php
            $show =0;

            $catproducts[$loop->index] = \App\Product::where('category_id', $row->id)
                ->where('is_active', 1)
                ->orderBy('sort_order','ASC')
                ->get();

            if(count($catproducts[$loop->index]) > 0)
            {
                $show =1;
                $i++;
            }
            else{

            }
            $catproducts[$loop->index]['catname'] = $row->name;
            $catproducts[$loop->index]['catid'] = $row->id;
        @endphp
            @if($show == 1)
            <li class="nav-item" wire:ignore>
                <button
                        class="nav-link "
                        data-bs-toggle="tab"
                        data-bs-target="#{{ str_replace(' ', '', 'category'.$row->id) }}"
                        type="button">
                        {{ $row->name }}
                </button>
            </li>
            @endif
            @endforeach
        </ul>
        @php
        $i = 0;
        @endphp
        <div class="tab-content px-15" wire:ignore>
            <div class="tab-pane fade active show" id="allproducts">
                <div class="row">
                    <div class="col-12">

                        @foreach ($categories as $row)
                        @php
                            $allproducts = \App\Product::where('category_id', $row->id)
                            ->where('is_active', 1)
                            ->orderBy('sort_order','ASC')
                            ->get();
                        @endphp
                        <h4 class="my-3">{{$row->name}}</h4>
                        @foreach ($allproducts as $item)
                        <div class="product-inline p-0 " style="border-radius: 0px;border-bottom: 2px solid #ffffff">
                            <div class="disp-part">
                            <a href="{{ url('/store/' . $view_id . '/product/' . $item->id) }}" class="p-2 bg-size">
                                <img @if (file_exists($item->image_url)) src="{{ asset($item->image_url) }}" @else src="{{ asset('/store_assets/images/empty.png') }}"  @endif class="img-fluid p-0"  alt=""/>
                            </a>

                            </div>
                            <div class="product-inline-content" style="margin-left: 1rem">
                                <div>
                                    <a href="{{ url('/store/' . $view_id . '/product/' . $item->id) }}">
                                        <h4>
                                            @if($item->is_veg == 1) <img src="{{asset('img/veg.png')}}" alt="" style="width: 15px;height: 15px;margin-right: 3px"> @else <img src="{{asset('img/nonveg.png')}}" alt="" style="width: 15px;height: 15px;margin-right: 3px">@endif
                                            <b>{{ \Illuminate\Support\Str::limit($item->name, 25, $end='...') ?? 'No Name' }}</b></h4>
                                    </a>
                                    <div class="price">
                                        <h4 class="product-price" style="margin-left: 1.5rem">@include('layouts.render.currency',["amount"=>$item->price])</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="" style="margin-right: 15px;">
                            @if($store->is_accept_order == 1)
                            @if (isset($quantity[$item->id]) && $quantity[$item->id] > 0)
                            <div class="d-flex flex-row">
                                <button  wire:click="decreasequantity({{ $item->id }})" class="btn btn-sm btn-dark" style="padding: 4px 2px;" x-show="quantity[{{$item->id}}] > 0"> <span class="badge badge-light"><i class="fas fa-minus"></i> &nbsp; </span></button>
                                
                            <span class="text-dark mt-2 mx-2" x-text="quantity[{{$item->id}}]"></span>
                            <button  wire:click="additem({{ $item->id }})" class="btn btn-sm btn-dark" style="padding: 4px 2px;"> <span class="badge badge-light"><i class="fas fa-plus"></i> &nbsp; </span></button>
                            </div>
                            
                            @endif
                            @if(!isset($quantity[$item->id]))
                            <div class="d-flex flex-row">
                            <button  wire:click="decreasequantity({{ $item->id }})" class="btn btn-sm btn-dark" style="padding: 4px 2px;" x-show="quantity[{{$item->id}}] > 0"> <span class="badge badge-light"><i class="fas fa-minus"></i> &nbsp; </span></button>

                           
                            <span class="text-dark mx-2 mt-2" x-text="quantity[{{$item->id}}]"></span>
                            <button  wire:click="additem({{ $item->id }})" class="btn btn-sm btn-dark" style="padding: 4px 2px;"><span class="badge badge-light"><i class="fas fa-plus"></i>&nbsp; </span></button>
                            </div>
                            @endif
                            @else
{{--                            <button  class="btn btn-sm btn-dark disabled" ><span class="badge badge-light"><i class="fas fa-plus"></i>&nbsp; <span class="text-white" ></span></span></button>--}}
                            @endif

                            </div>

                        </div>
                        @endforeach
                        @endforeach
                    </div>

                </div>
            </div>

            @forelse ($catproducts as $key => $row)

            @if (count($row) >2)
            @php
            $i ++;
            @endphp
            <div class="tab-pane fade" id="{{str_replace(' ', '', 'category'.$row['catid'])}}">
                <div class="row">
                    <div class="col-12" >
                        @foreach($row as $key => $item)
                        @if(is_int($key))
                        <div class="product-inline p-0 " style="border-radius: 0px;border-bottom: 2px solid #ffffff">
                            <div class="disp-part">
                            <a href="{{ url('/store/' . $view_id . '/product/' . $item->id) }}" class="p-2 bg-size">
                                <img @if (file_exists($item->image_url)) src="{{ asset($item->image_url) }}" @else src="{{ asset('/store_assets/images/empty.png') }}"  @endif class="img-fluid p-0"  alt=""/>

                            </a>

                            </div>
                            <div class="product-inline-content" >
                                <div>
                                    <a href="{{ url('/store/' . $view_id . '/product/' . $item->id) }}">
                                        <h4> @if($item->is_veg == 1) <img src="{{asset('img/veg.png')}}" alt="" style="width: 15px;height: 15px;margin-right: 3px"> @else <img src="{{asset('img/nonveg.png')}}" alt="" style="width: 15px;height: 15px;margin-right: 3px">@endif

                                            <b>{{$item->name}}</b></h4>
                                    </a>
                                    <div class="price">
                                        <h4 class="product-price" style="margin-left: 1.5rem">@include('layouts.render.currency',["amount"=>$item->price])</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="" style="margin-right: 15px;" wire:poll>
                                @if($store->is_accept_order == 1)
                                @if (isset($quantity[$item->id]) && $quantity[$item->id] > 0)
                                <div class="d-flex flex-row">
                                <button  wire:click="decreasequantity({{ $item->id }})" class="btn btn-sm btn-dark" style="padding: 4px 2px;" x-show="quantity[{{$item->id}}] > 0"> <span class="badge badge-light"><i class="fas fa-minus"></i> &nbsp; </span></button>
                                <span class="text-dark mt-2 mx-2" x-text="quantity[{{$item->id}}]"></span>
                                <button  wire:click="additem({{ $item->id }})" class="btn btn-sm btn-dark" style="padding: 4px 2px;"> <span class="badge badge-light"><i class="fas fa-plus"></i> &nbsp; </span></button>
                                </div>
                                
                                @endif
                                @if(!isset($quantity[$item->id]))
                                <div class="d-flex flex-row">
                                <button  wire:click="decreasequantity({{ $item->id }})" class="btn btn-sm btn-dark" style="padding: 4px 2px;" x-show="quantity[{{$item->id}}] > 0"> <span class="badge badge-light"><i class="fas fa-minus"></i> &nbsp; </span></button>
                                <span class="text-dark mx-2 mt-2" x-text="quantity[{{$item->id}}]"></span>
                                <button  wire:click="additem({{ $item->id }})" class="btn btn-sm btn-dark" style="padding: 4px 2px;"><span class="badge badge-light"><i class="fas fa-plus"></i>&nbsp; </span></button>
                            </div>
                                @endif
                                @else
    {{--                            <button  class="btn btn-sm btn-dark disabled" ><span class="badge badge-light"><i class="fas fa-plus"></i>&nbsp; <span class="text-white" ></span></span></button>--}}
                                @endif
                            </div>

                        </div>
                        @endif
                        @endforeach
                    </div>

                </div>
            </div>
            @endif

            @empty
            @endforelse
        </div>
    </div>
</section>


<section class="panel-space"></section>


<div class="modal fade" id="callwaiterModal" tabindex="-1" aria-labelledby="callwaiterModal" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered px-4">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="callwaiterModal">{{$selected_language->data['call_waiter'] ?? 'Call Waiter'}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @if (!$completed)
            <div class="form-group mb-2 mt-2">
                <label class="font-size-med">{{$selected_language->data['menu_name'] ?? 'Name'}}</label>
                <input type="text" class="form-control" wire:model="name" style="height:40px">
                @error('name') <span class="error text-danger">{{ $message }}</span> @enderror

            </div>
            <div class="form-group mb-2">
                <label class="font-size-med">{{$selected_language->data['menu_phone_number'] ?? 'Phone Number'}}</label>
                <input type="number" class="form-control" wire:model="phone_number" style="height:40px">
                @error('phone_number') <span class="error text-danger">{{ $message }}</span> @enderror

            </div>
            <div class="form-group mb-2">
                <label class="font-size-med">{{$selected_language->data['select_your_table'] ?? 'Select Your Table'}}</label>
                <select name="test" id="" class="form-select" style="height:40px" wire:model="table">
                    <option value="">{{$selected_language->data['error_select_table'] ?? 'Select A Table'}}</option>
                    @foreach ($tables as $row)
                    <option value="{{$row->id}}">{{$row->table_name}}</option>
                    @endforeach
                </select>
                @error('table') <span class="error text-danger">{{ $message }}</span> @enderror

            </div>
            <div class="form-group mb-3">
                <label class="font-size-med">{{$selected_language->data['menu_comment'] ?? 'Comments'}}</label>
                <input type="text" class="form-control" wire:model="comments" style="height:40px">
            </div>
            @else
            <p class="text-muted">{{$selected_language->data['waiter_called'] ?? 'A waiter has been called'}}</p>
            @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{$selected_language->data['menu_close'] ?? 'Close'}}</button>
         @if(!$completed) <button type="button" wire:click="callWaiter()" class="btn btn-danger">{{$selected_language->data['call_waiter'] ?? 'Call Waiter'}}</button> @endif
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" wire:ignore.self id="addonModal" tabindex="-1" role="dialog" aria-labelledby="addonModal"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered px-4" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">
                  {{ $selected_language->data['store_panel_common_addon_addons'] ?? 'Addons' }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              </button>
          </div>
          <div class="modal-body">
              <div class="row">
                  @if ($selected_product)
                      @foreach ($selected_product->addonItems as $item)
                          @php
                              $addons = \App\Models\Addon::where('addon_category_id', $item->addon_category_id)->get();
                              $category = \App\Models\AddonCategory::where('id', $item->addon_category_id)->first();
                          @endphp

                          <div class="row mb-2">
                              @if ($category->type == 'SNG')
                                  <label class="font-size-med" for="">{{ $category->name }}</label>
                                  <div class="row">
                                      @foreach ($addons as $row)
                                      <div class="row">
                                          <div class="col-6 mb-2">

                                              <input wire:key="{{ $row->addon_name }}" class="form-input"
                                                  type="radio" name="{{ $category->id }}" id="{{ $row->id }}"
                                                  value="{{ $row->id }}"
                                                  wire:model="variant.{{ $category->id }}">
                                              <label class="font-size-med" for="{{ $row->id }}">{{ $row->addon_name }}</label>
                                          </div>
                                          <div class="col-5" style="margin-left: auto;">
                                             <p> @include('layouts.render.currency',["amount"=>$row->price])</p>
                                          </div>
                                      </div>
                                      @endforeach
                                  </div>
                              @elseif($category->type == 'EXT')
                                  <div class="row">
                                      <label class="font-size-med">{{ $category->name }}</label>
                                      @foreach ($addons as $row)
                                      <div class="row">
                                          <div class="col-6 mb-2">

                                              <input type="checkbox" class="form-input"
                                                  name="{{ $category->id }}" id="{{ $row->addon_name . $row->id }}"
                                                  value="{{ $row->id }}"
                                                  wire:model="extras.{{ $row->id }}">
                                              <label class="font-size-med"
                                                  for="{{ $row->addon_name . $row->id }}">{{ $row->addon_name }}</label>
                                          </div>
                                          <div class="col-5" style="margin-left: auto;">
                                            <p>@include('layouts.render.currency',["amount"=>$row->price])</p>

                                          </div>
                                      </div>
                                      @endforeach

                                  </div>
                              @endif
                          </div>

                      @endforeach
                  @endif
              </div>

          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary"
                  data-bs-dismiss="modal">{{ $selected_language->data['menu_close'] ?? 'Close' }}</button>
              <button type="button" class="btn btn-danger"
                  wire:click="saveAddonChanges()">{{ $selected_language->data['menu_save_changes'] ?? 'Save Changes' }}</button>
          </div>
      </div>
  </div>
</div>
    <section class="panel-space"></section>
@include('livewire.home.layouts.navbar')
@push('js')
    <script>
        Livewire.on('openModal', () => {
            $('#addonModal').modal('show')
        })
        Livewire.on('closeModal', () => {
            $('#addonModal').modal('hide')
            $('.modal').modal('hide').data('bs.modal', null);

        });
    </script>
@endpush
</div>
