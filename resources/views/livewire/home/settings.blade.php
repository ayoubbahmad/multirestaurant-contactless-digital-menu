<div>
    <div>
        <style>
            [x-cloak] {
                display: none !important;
            }

        </style>
        <header>
            <div class="back-links">
                    <a href="{{ url('/store/' . $view_id) }}"><button class="" style="padding: 0;border: none;background: none;"><i class="iconly-Arrow-Left icli"></i></button>
                        <div class="content">
                            <h2>{{$selected_language->data['settings'] ?? 'Settings'}}</h2>
                        </div>
                    </a>
     
            </div>
        </header>
        <div class="cartindex-wrapper" >

    <div class="sidebar-content top-space lg-space px-15 pt-0">
        
        <ul class="link-section">
            @if($store->language_enable == 1)
            <li>
                <a >
                    <img src="{{asset('home_assets_new/images/flag.png')}}" class="img-fluid" alt="">
                    <h4>{{ $selected_language->data['language'] ?? 'Language' }}</h4>
                    
                    <div class="content toggle-sec w-100">
                        <div class="ms-auto">
                        <select  style="height:45px; width:115px;" class="form-select" aria-label="Default select example"
                            wire:model="currentlang">
                            @foreach ($languages as $item)
                                <option @if ($selected_language) @if ($selected_language->id == $item->id) selected @endif @endif value="{{ $item->id }}"
                                    wire:click="changelanguage({{ $item->id }})"> {{ $item->language_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    </div>
                </a>
            </li>
            @endif
            @if($store->is_call_waiter_enable == 1)
            <div class="mx-2" style="    padding: 16px 6px;
            border-bottom: 1px solid rgba(237, 239, 244, 0.6);">
                <div class=""  x-data="{openwaitercall : false}">

                  <div class=" d-flex align-items-center justify-content-between" @click="openwaitercall = !openwaitercall" >
                    
                    <div class="titlez">                
                        <h4>{{ $selected_language->data['store_sidebar_waiter_call'] ?? 'Call Waiter' }}</h4></div>
                    <div class="data-content">
                        <i class="fas fa-chevron-down"></i>
                        
                    </div>
                    
                  </div>
                  <div class="" x-show="openwaitercall" x-collapse x-cloak x-transition>
                      @if(!$completed)
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
                            <option value="">{{$selected_language->data['select_your_table'] ?? 'Select Your Table'}}</option>

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
                    
                        <button type="button" class="btn btn-lg btn-outline-danger " wire:click="callWaiter()" style="width:100%"">{{$selected_language->data['call_waiter'] ?? 'Call Waiter'}}</button>
                        @else 
                    <h6 class="mt-3 text-success">{{$selected_language->data['waiter_called'] ?? 'A waiter has been called'}}</h6>
                    @endif 
                    </div>
                </div>
              </div>
            @endif
        </ul>
        
    </div>
    
    @include('livewire.home.layouts.navbar')
    </div>

