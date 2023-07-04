<div>


    <!-- search panel start -->
    <div class="search-panel w-back pt-3 px-15">
       
        <div class="search-bar">
            <input class="form-control form-theme" placeholder="{{$selected_language->data['search_products'] ?? 'Search'}}" wire:model="search_query">
            <i class="iconly-Search icli search-icon"></i>
        </div>
    </div>
    <!-- search panel end -->


  <!-- deals section start -->
  <section class="deals-section px-15 pt-0" x-data="{ quantity : @entangle('quantity') }">
    <ul class="nav nav-tabs theme-tab pl-15">
        @foreach ($categories as $row)       
        <li class="nav-item">
          <button wire:click="selectCategory({{$row->id}})" class="nav-link @if($selected_category) @if($selected_category->id == $row->id) active @endif @endif" type="button">{{$row->name}}</button>
        </li>
        @endforeach
        
      </ul>
    <div class="title-part">
      <h2>{{$selected_language->data['search_results'] ?? 'Search Results'}}</h2>
    </div>
    <div class="product-section">
      <div class="row gy-3">
        @foreach ($products as $row)
       
        <div class="col-12">
          <div class="product-inline">
            <a href="{{ url('/store/' . $view_id . '/product/' . $row->id) }}">
              <img @if(file_exists($row->image_url))
              src="{{ asset($row->image_url) }}"
          @else src="{{ asset('/store_assets/images/empty.png') }}"
@endif class="img-fluid" alt="">
            </a>
            <div class="product-inline-content">
              <div>
                <a href="{{ url('/store/' . $view_id . '/product/' . $row->id) }}">
                  <h4>{{$row->name}}</h4>
                </a>
                <div class="price">
                  <h4>@include('layouts.render.currency',["amount"=>$row->price])</h4>
                </div>
              </div>
              
            </div>
            <div class="">
              @if($store->is_accept_order == 1)
                  @if (isset($quantity[$row->id]) && $quantity[$row->id] > 0)
                  <button  wire:click="additem({{ $row->id }})" class="btn btn-sm btn-dark"> <span class="badge badge-light"><i class="fas fa-plus"></i> &nbsp;<span class="text-white" x-text="quantity[{{$row->id}}]"></span> </span></button>
                          
                  @endif
                  @if(!isset($quantity[$row->id]))
                  <button  wire:click="additem({{ $row->id }})" class="btn btn-sm btn-dark" ><span class="badge badge-light"><i class="fas fa-plus"></i>&nbsp; <span class="text-white" x-text="quantity[{{$row->id}}]"></span></span></button>
                  @endif 
                  
                  @endif
            </div>
          </div>
        </div>
             
        @endforeach
      </div>
    </div>
  </section>

  
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
  <div class="divider"></div>

    <!-- panel space start -->
    <section class="panel-space"></section>
@include('livewire.home.layouts.navbar')

</div>
