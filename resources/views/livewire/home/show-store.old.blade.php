<div>
    <style>
        .img-custom {
            width: 194px;
            height: 176px;
            object-fit: cover;
            overflow: hidden;
        }

        .img-custom-2 {
            width: 166px;
            height: 111px;
            object-fit: cover;
            overflow: hidden;
        }

    </style>
    <div class="page-content-wrapper pb-3 mt-0" wire:poll.visible.2000ms="refresh">
        <!-- Vendor Details Wrap -->
        <div class="vendor-details-wrap py-4 bg-white" style="border-bottom: 3px solid #F3F5F9">
            <div class="container">

                <div class="d-flex align-items-start">
                    <!-- Vendor Profile-->
                    <div class="vendor-profile shadow me-3 mt-1 p-0">
                        <img @if (file_exists($store->logo_url))
                        src="{{ asset($store->logo_url) }}"
                    @else src="{{ asset('/store_assets/images/empty.png') }}" @endif
                        alt="">
                    </div>
                    <!-- Vendor Info-->
                    <div class="vendor-info">
                        <h5 class="vendor-title">{{ $store->store_name }}</h5>
                        <p class="mb-1">
                            <svg class="bi bi-geo-alt me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z">
                                </path>
                                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
                            </svg>
                            {{ $store->address }}
                        </p>

                    </div>

                </div>
                <!-- Vendor Basic Info-->
                <div class="vendor-basic-info d-flex align-items-center justify-content-between mt-4">
                    <div class="single-basic-info text-danger">
                        <div class="icon">
                            <svg class="bi bi-shield-check" xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z">
                                </path>
                                <path
                                    d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z">
                                </path>
                            </svg>
                        </div>
                        <span>{{ $selected_language->data['trusted_seller'] ?? 'Trusted Seller' }}</span>
                    </div>
                    <div class="single-basic-info text-danger">
                        <div class="icon">
                            <svg class="bi bi-cart2" xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z">
                                </path>
                            </svg>
                        </div>
                        <span>{{ ceil($products->count() / 10) * 10 }}+
                            {{ $selected_language->data['menu_category_items'] ?? 'Items' }}</span>
                    </div>
                    <div class="single-basic-info text-danger">
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#callwaiterModal">Call Waiter</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="bg-transparent">
                <div class="card-body">

                    <div class="faq-search-form" style="margin-left: 0px;margin-right: 0px">
                        <input class="form-control" style="border-radius: 5px; min-height: 50px" name="search"
                            wire:model="search_query"
                            placeholder="{{ $selected_language->data['search_products'] ?? 'Search For Products' }}">
                        <button type="submit" style="padding-top: 11px"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>


        <div class="tab-content pt-3 pb-3" style="background-color: #f3f5f9">
            <div class="tab-pane fade show active">
                <div class="container">
                    <div class="section-heading d-flex align-items-center justify-content-between">
                        <h6 >
                            <svg class="bi bi-lightning me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09zM4.157 8.5H7a.5.5 0 0 1 .478.647L6.11 13.59l5.732-6.09H9a.5.5 0 0 1-.478-.647L9.89 2.41 4.157 8.5z"></path>
                              </svg>{{ $selected_language->data['menu_recommend'] ?? 'Recommended for you' }}
                        </h6>
                    </div>
                    <div class="row g-3">
                        @foreach ($recommended as $row)
                            @php
                                $prodcat = \App\Category::where('id', $row->category_id)->first();
                            @endphp
                            @if ($prodcat && $prodcat->is_active == 1)
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="card product-card">
                                        <span
                                            class="badge rounded-pill badge-danger">{{ $selected_language->data['recommended'] ?? 'Recommended' }}</span>
                                        <a href="{{ url('/store/' . $view_id . '/product/' . $row->id) }}"> <img
                                                class="mb-2 img-custom"
                                                style="width: 100%; border-top-left-radius: .5rem;border-top-right-radius: .5rem"
                                                @if (file_exists($row->image_url))
                                            src="{{ asset($row->image_url) }}"
                                        @else src="{{ asset('/store_assets/images/empty.png') }}"
                            @endif
                            alt="">
                            </a>

                            <div class="card-body p-2">
                                <span class="product-title d-block"
                                    style="margin-bottom: 8px"><b>{{ $row->name ?? 'No Name' }}</b></span>
                                <div class="row">
                                    <div class="col-4">
                                        <p class="sale-price1">
                                            <b>@include('layouts.render.currency',["amount"=>$row->price])</b></p>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex justify-content-center">
                                            <div class="cart-form" action="#" method="">
                                                <div class="order-plus-minus d-flex align-items-center">
                                                    @if (isset($quantity[$row->id]) && $quantity[$row->id] > 0)
                                                        <div class="quantity-button-handler"
                                                            wire:click="decreasequantity({{ $row->id }})"> -</div>
                                                        <input class=" " type="text"
                                                            wire:model="quantity.{{ $row->id }}" style="text-align: center; width:40px" readonly>
                                                    @endif
                                                    <div class="quantity-button-handler"
                                                        wire:click="additem({{ $row->id }})">+</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>

</div>

@foreach ($categories as $row)
    @php
        $catproducts = \App\Product::where('category_id', $row->id)
            ->where('is_active', 1)
            ->get();
    @endphp
    @if (count($catproducts))
        <div class="container p-3">
            <div class="section-heading d-flex align-items-center justify-content-between">
                <h6>{{ $row->name }}</h6>
            </div>
            <div class="row g-3">

                @forelse($catproducts as $item)
                    <div class="col-12 col-md-6">
                        <div class="card horizontal-product-card">
                            <div class="card-body d-flex align-items-center">
                                <div class="product-thumbnail-side">
                                    @if ($item->is_veg == 1)
                                        <span class="badge badge-success"
                                            style="margin-left: 5px; margin-top: 5px">{{ $selected_language->data['home_veg'] ?? 'Veg' }}</span>
                                    @else
                                        <span class="badge badge-danger"
                                            style="margin-left: 5px; margin-top: 5px">{{ $selected_language->data['home_nonveg'] ?? 'Non Veg' }}</span>

                                    @endif
                                    <a class="product-thumbnail d-block"
                                        href="{{ url('/store/' . $view_id . '/product/' . $item->id) }}">
                                        <img class="img-custom-2" @if (file_exists($item->image_url))
                                        src="{{ asset($item->image_url) }}"
                                    @else src="{{ asset('/store_assets/images/empty.png') }}"
                @endif
                alt="">
                </a>
            </div>
            <div class="product-description">
                <a class="product-title d-block mb-2">{{ $item->name }}</a>
                <div class="row">
                    <div class="col-12">
                        <p class="sale-price1"><b>@include('layouts.render.currency',["amount"=>$item->price])</b>
                        </p>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <div class="cart-form" action="#" method="">
                                <div class="order-plus-minus d-flex align-items-center">
                                    @if (isset($quantity[$item->id]) && $quantity[$item->id] > 0)
                                        <div class="quantity-button-handler"
                                            wire:click="decreasequantity({{ $item->id }})"> -</div>
                                        <input class="form-control " type="text"
                                            wire:model="quantity.{{ $item->id }}" readonly>
                                    @endif
                                    <div class="quantity-button-handler" wire:click="additem({{ $item->id }})">+
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    @empty
    @endforelse



    </div>
    </div>
@endif
@endforeach

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
                                    <label for="">{{ $category->name }}</label>
                                    <div class="row">
                                        @foreach ($addons as $row)
                                        <div class="row">
                                            <div class="col-6 mb-2">

                                                <input wire:key="{{ $row->addon_name }}" class="form-check-input"
                                                    type="radio" name="{{ $category->id }}" id="{{ $row->id }}"
                                                    value="{{ $row->id }}"
                                                    wire:model="variant.{{ $category->id }}">
                                                <label for="{{ $row->id }}">{{ $row->addon_name }}</label>
                                            </div>
                                            <div class="col-5" style="margin-left: auto;">
                                                @include('layouts.render.currency',["amount"=>$row->price])
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                @elseif($category->type == 'EXT')
                                    <div class="row">
                                        <label>{{ $category->name }}</label>
                                        @foreach ($addons as $row)
                                        <div class="row">
                                            <div class="col-6 mb-2">
                                                <input type="checkbox" class="form-check-input"
                                                    name="{{ $category->id }}" id="{{ $row->addon_name . $row->id }}"
                                                    value="{{ $row->id }}"
                                                    wire:model="extras.{{ $category->id }}">
                                                <label
                                                    for="{{ $row->addon_name . $row->id }}">{{ $row->addon_name }}</label>
                                            </div>
                                            <div class="col-5" style="margin-left: auto;">
                                                @include('layouts.render.currency',["amount"=>$row->price])
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

<div class="modal fade" id="callwaiterModal" tabindex="-1" aria-labelledby="callwaiterModal" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered px-4">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="callwaiterModal">Call Waiter</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @if (!$completed)
            <div class="form-group mb-2 mt-2">
                <label>{{$selected_language->data['menu_name'] ?? 'Name'}}</label>
                <input type="text" class="form-control" wire:model="name" style="height:40px">
                @error('name') <span class="error text-danger">{{ $message }}</span> @enderror

            </div>
            <div class="form-group mb-2">
                <label>{{$selected_language->data['menu_phone_number'] ?? 'Phone Number'}}</label>
                <input type="number" class="form-control" wire:model="phone_number" style="height:40px">
                @error('phone_number') <span class="error text-danger">{{ $message }}</span> @enderror

            </div>
            <div class="form-group mb-2">
                <label>{{$selected_language->data['select_your_table'] ?? 'Select Your Table'}}</label>
                <select name="test" id="" class="form-select" style="height:40px" wire:model="table">
                    <option value="">Select A Table</option>
                    @foreach ($tables as $row)
                    <option value="{{$row->id}}">{{$row->table_name}}</option>
                    @endforeach
                </select>
                @error('table') <span class="error text-danger">{{ $message }}</span> @enderror

            </div>
            <div class="form-group mb-3">
                <label>{{$selected_language->data['menu_comment'] ?? 'Comments'}}</label>
                <input type="text" class="form-control" wire:model="comments" style="height:40px">
            </div>
            @else
            <p class="text-muted">{{$selected_language->data['waiter_called'] ?? 'A waiter has been called'}}</p>
            @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         @if(!$completed) <button type="button" wire:click="callWaiter()" class="btn btn-danger">Call Waiter</button> @endif
        </div>
      </div>
    </div>
  </div>

<div class="footer-nav-area" id="footerNav">
    <div class="container h-100 px-0">
        <div class="suha-footer-nav h-100">
            <ul class="h-100 d-flex align-items-center justify-content-between ps-0">
                <li class="active"><a href="{{ url('/store/' . $view_id) }}"><i
                            class="lni lni-home"></i>{{ $selected_language->data['user_home'] ?? 'Home' }}</a></li>
                <!--                <li><a href="message.html"><i class="lni lni-life-ring"></i>Support</a></li>-->
                <li><a href="{{ url('/store/cart/' . $view_id) }}" data-turbolinks="false" wire:ignore.self> <i
                            class="lni lni-shopping-basket"></i>{{ $selected_language->data['cart'] ?? 'Cart' }} <span wire:poll="getCartCount()"> {{$this->count}} </span></a>
                </li>
                <li><a href="{{ url('/store/' . $view_id . '/myorder') }}"><i
                            class="lni lni-ticket-alt"></i>{{ $selected_language->data['my_order'] ?? 'My Order' }}</a>
                </li>
                <li><a href="{{ url('/store/' . $view_id . '/settings/') }}"><i
                            class="lni lni-cog"></i>{{ $selected_language->data['settings'] ?? 'Settings' }}</a>
                </li>
            </ul>
        </div>
    </div>
</div>
@push('js')
    <script>
        Livewire.on('openModal', () => {
            $('#addonModal').modal('show')
        })
        Livewire.on('closeModal', () => {
            $('#addonModal').modal('hide')
            $('.modal').modal('hide').data('bs.modal', null);
            $('.modal').remove();
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
            $('body').removeAttr('style');
        });
    </script>
@endpush

</div>
