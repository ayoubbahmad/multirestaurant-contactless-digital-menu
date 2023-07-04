
<!-- bottom panel start -->
<div class="bottom-panel shadow">
    <ul>
        <li class="">
            <a href="{{ url('/store/' . $view_id) }}" wire:ignore>
                <div class="icon">
                    <i class="fas fa-home {{ Request::is('store/'.$view_id)  ? 'new-color' : '' }}"></i>
                </div>
                <span>{{$selected_language->data['home'] ?? 'Home'}} </span>
            </a>
        </li>
        @if($store->search_enable)
        @if($store->search_enable == 1)
        <li >
            <a href="{{ url('/store/' . $view_id.'/search') }}">
                <div class="icon">
                    <i class="fas fa-search {{ Request::is('store/'.$view_id.'/search')  ? 'new-color' : '' }}"></i>
                </div>
                <span>{{$selected_language->data['search'] ?? 'Search'}} </span>
            </a>
        </li>
        @endif
        @endif
        <li  href="{{ Request::is('store/cart/*') ? 'active' : '' }}">
            <a href="{{ url('/store/cart/' . $view_id) }}" data-turbolinks="false">
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="newbadge lblCartCount" wire:poll="getCartCount()">{{$this->count ?? 0}}</span>
                </div>
                <span>{{$selected_language->data['cart'] ?? 'Cart'}} </span>
            </a>
        </li>
        <li  href="">
            <a href="{{ url('/store/' . $view_id . '/myorder') }}" wire:ignore>
                <div class="icon">
                    <i class="fa-solid fa-file-invoice {{ Request::is('store/'.$view_id.'/myorder') ? 'new-color' : '' }}"></i>
                </div>
                <span>{{$selected_language->data['view_my_orders'] ?? 'My Orders'}} </span>
            </a>
        </li>
        <li>
            <a href="{{ url('/store/' . $view_id . '/settings/') }}" wire:ignore>
                <div class="icon">
                    <i class="fa-solid fa-cog {{ Request::is('store/'.$view_id.'/settings') ? 'new-color' : '' }}"></i>
                </div>
                <span>{{$selected_language->data['settings'] ?? 'Settings'}}  </span>
            </a>
        </li>
    </ul>
</div>