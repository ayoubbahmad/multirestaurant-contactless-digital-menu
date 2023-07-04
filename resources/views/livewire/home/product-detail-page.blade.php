<div x-data="{ quantity : @entangle('quantity') }">

    <header class="shadow">
        <div class="back-links">
            <a href="{{url('/store/'.$view_id)}}">
                <i class="iconly-Arrow-Left icli"></i>
            </a>
        </div>

    </header>

    <section class="product-page-section top-space p-0">
        <div class="theme-dots ratio_asos overflow-hidden">
            <div>
                <div class="home-img" style="height: 350px; ">
                    <img @if(file_exists( $product->image_url)) src="{{asset($product->image_url) }}"
                    @else src="{{asset('/store_assets/images/empty.png')}}" @endif class="img-fluid" style="vertical-align: middle;" alt="" />
                </div>
            </div>

        </div>
        <div class="product-detail-box px-15 pt-2">
            <div class="main-detail">
                <h2 class="text-capitalize">{{$product->name}}</h2>

                <div class="price">
                    <h4>{{$selected_language->data['menu_mrp'] ?? 'MRP'}}: @include('layouts.render.currency',["amount"=>$product->price])</h4>
                </div>
                <h4 class="pt-2">{{$selected_language->data['cooking_time'] ?? 'Cooking Time'}}</h4>
                <h6 class="content-color">{{$product->cooking_time}} {{$selected_language->data['minutes'] ?? 'Minutes'}}</h6>
                <div class="divider_cart"></div>
                <h4 class="pt-4">{{$selected_language->data['menu_product_details'] ?? 'Product Details'}}</h4>
                <h6 class="content-color">{{$product->description}}</h6>
            </div>
        </div>



    </section>

<section class="panel-space"></section>

    <div class="fixed-panel">
        <div class="row">
            <div class="col-6">
                <a href="{{url('/store/'.$view_id)}}"><b>{{$selected_language->data['home'] ?? 'Home'}}</b> </a>
            </div>
            <div class="col-6">
                @if($store->is_accept_order == 1)
                <a href="#" class="theme-color" wire:click.prevent="additem({{$product->id}})"><b>{{$selected_language->data['menu_add_to_cart'] ?? 'Add To Cart'}} <span x-text="quantity"></span></b> </a>
                @else
                @endif
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
</div>
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
