<div x-data="{openpaystack:false, open: @entangle('showcart') ,opencheck: @entangle('showcheckout'),opencod : false,openrazor : false,openstripe : false,openpaypal:false}">
    @push('head')
        <meta name="turbolinks-cache-control" content="no-cache">
    @endpush
    <style>
        [x-cloak] {
            display: none !important;
        }

    </style>


    <header>
        <div class="back-links">
            @if ($showcheckout == true)
                <a href=""><button class="" style="padding: 0;border: none;background: none;"
                        @click="opencheck = false, open = true"><i class="iconly-Arrow-Left icli"></i></button>
                    <div class="content">
                        <h2>Cart </h2>
                    </div>
                </a>
            @elseif(!$cartproducts)
                <a href="{{ url('/store/' . $view_id) }}"><button style="padding: 0;border: none;background: none;"><i
                            class="iconly-Arrow-Left icli"></i></button>
                    <div class="content">
                        <h2>Cart </h2>
                    </div>
                </a>
            @else
                <a href="{{ url('/store/' . $view_id) }}"><button style="padding: 0;border: none;background: none;"><i
                            class="iconly-Arrow-Left icli"></i></button>
                    <div class="content">
                        <h2>Cart </h2>
                    </div>
                </a>

            @endif
        </div>
    </header>
@if($cartproducts)
    <div class="cartindex-wrapper" x-show="open" x-transition>
        <section class="cart-section pt-0 top-space xl-space">
            @php
                $total = 0;
                $subtotal = 0;
                $prices = [];
            @endphp
            @if ($cartproducts)
                @forelse($cartproducts as $key => $row)
                    <div class="container">

                        <div class="cart-box px-15 d-flex justify-content-evenly align-items-center">
                            <div class="cart-content">

                                @php
                                    $inlinetotal = 0;
                                    $variantname = null;
                                    $variantprice = 0;
                                    $extras = [];
                                    $product = \App\Product::where('id', $key)->first();
                                    if ($product) {
                                        if (isset($row['variant'])) {
                                            foreach ($row['variant'] as $key => $variant) {
                                                $addon = \App\Models\Addon::where('id', $variant)->first();
                                                $variantname .= ' ' . $addon->addon_name;
                                                $variantprice += $addon->price;
                                            }

                                            $subtotal += $variantprice * $quantity[$product->id];
                                            $inlinetotal = $variantprice * $quantity[$product->id];
                                        } else {
                                            $subtotal += $product->price * $quantity[$product->id];
                                            $inlinetotal = $product->price * $quantity[$product->id];
                                        }
                                        if (isset($row['extras'])) {
                                            foreach ($row['extras'] as $key => $extra) {
                                                $addon = \App\Models\Addon::where('id', $key)->first();
                                                $subtotal = $subtotal + $addon->price;
                                                $inlinetotal = $inlinetotal + $addon->price;
                                                $extras[$key]['name'] = $addon->addon_name;
                                                $extras[$key]['price'] = $addon->price;
                                            }
                                        }
                                        $prices[$product->id] = $inlinetotal;
                                    }
                                @endphp
                                <h4>{{ $product->name }} @if ($variantname) ({{ $variantname }}) @endif </h4>
                                @if ($extras)
                                    @foreach ($extras as $row)
                                        <h5 class="content-color"> {{ $row['name'] }}
                                            @include('layouts.render.currency',["amount"=>$row['price']])</h5>

                                    @endforeach
                                    <h5 class="content-color">
                                        @include('layouts.render.currency',["amount"=>$prices[$product->id]])</h5>
                                @else
                                    <h5 class="content-color">@if ($variantname) @include('layouts.render.currency',["amount"=>$variantprice]) @else @include('layouts.render.currency',["amount"=>$product->price*$quantity[$product->id]]) @endif</h5>
                                @endif
                            </div>
                            <div class="select-size-sec">
                                <div class="qty-counter">
                                    <div class="input-group">
                                        <button type="button" class="btn quantity-left-minus" data-type="minus"
                                            data-field="" wire:click="decreasequantity({{ $product->id }})">
                                            <i class="fas fa-minus text-white"></i>
                                        </button>
                                        <input readonly type="text" name="quantity"
                                            class="form-control form-theme qty-input input-number" value="1"
                                            wire:model="quantity.{{ $product->id }}">
                                        <button type="button" class="btn quantity-right-plus" data-type="plus"
                                            data-field="" wire:click="additem({{ $product->id }})">
                                            <i class="fas fa-plus text-white"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="divider_cart"></div>
                @empty
                @endforelse
            @endif
        </section>

        <section class="px-15 payment-method-section pt-0">
            <div class="card">
                <div class="mb-1">
                    <input style="height: 50px" class="form-control" type="text"
                        placeholder="{{ $selected_language->data['menu_name'] ?? 'Name' }}" wire:model="name">
                    @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-1">
                    <input style="height: 50px" class="form-control" type="number"
                        placeholder="{{ $selected_language->data['menu_phone_number'] ?? 'Phone Number' }}"
                        wire:model="phone_number">
                    @error('phone_number') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-1">
                    <select style="height: 50px" class="form-control" wire:model="order_type">
                        <option disabled value="">{{ $selected_language->data['order_type'] ?? 'Order Type' }}</option>
                        <option value="1" @if($store->dining_enable != 1) disabled @endif    >{{ $selected_language->data['cart_order_type_status_dining'] ?? 'Dining' }}
                        </option>
                        <option value="2" @if($store->takeaway_enable != 1) disabled @endif>
                            {{ $selected_language->data['cart_order_type_status_takeaway'] ?? 'Takeaway' }}</option>
                        <option value="3" @if($store->delivery_enable != 1) disabled @endif>
                            {{ $selected_language->data['cart_order_type_status_delivery'] ?? 'Delivery' }}</option>
                        <option value="4" @if($store->is_room_delivery_enable != 1) disabled @endif>{{ $selected_language->data['cart_order_type_status_room'] ?? 'Room' }}
                        </option>
                    </select>
                    @error('order_type') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
                @if ($order_type == 3)

                    <div class="mb-1">
                        <input style="height: 50px" class="form-control" type="text"
                            placeholder="{{ $selected_language->data['address'] ?? 'Address' }}" wire:model="address">
                        @error('address') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                @endif
                @if ($order_type == 1)
                    @php
                        $tables = \App\Models\Table::where('store_id', $store->id)
                            ->where('is_active', 1)
                            ->get();
                    @endphp
                    <div class="mb-1">
                        <select style="height: 50px" class="form-control" wire:model="table">
                            <option selected value="">
                                {{ $selected_language->data['select_your_table'] ?? 'Select Your Table' }}</option>
                            @forelse ($tables as $row)
                                <option value="{{ $row->table_name }}">{{ $row->table_name }}</option>

                            @empty

                            @endforelse
                        </select>
                        @error('table') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                @endif
                @if ($order_type == 4)

                    <div class="mb-1">
                        <input style="height: 50px" class="form-control" type="text"
                            placeholder="{{ $selected_language->data['enter_room_number'] ?? 'Enter Room Number' }}"
                            wire:model="room">
                        @error('room') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    @if($store->is_room_delivery_dob_enable == 1)
                    <div class="mb-3 mt-1">
                        <label for="">Date Of Birth</label>
                    <input type="date" id="start" class="form-control" name="" value="1999-07-22" wire:model="dob">
                    @error('roomdob') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    @endif
                @endif

                <div class="mb-1">
                    <input style="height: 50px" class="form-control" type="text"
                        placeholder="{{ $selected_language->data['menu_comment'] ?? 'Comments' }}"
                        wire:model="comments">
                </div>
            </div>
        </section>
        <div class="divider_cart"></div>


        <section class="px-15 pt-0 pb-0">
            <h3 class="mb-2">{{ $selected_language->data['have_coupon'] ?? 'Have A Coupon?' }}</h3>
            <div class="coupon-section">
                <input class="form-control form-theme"
                    placeholder="{{ $selected_language->data['enter_coupon_field'] ?? 'Enter Coupon' }}"
                    wire:model="coupon_code" />
                <i class="iconly-Arrow-Right-2 icli icon-right" wire:click.prevent="applycoupon()"></i>

            </div>
            @error('coupon') <span class="error text-danger">{{ $message }}</span> @enderror
            @error('coupon_success') <span class="error text-success">{{ $message }}</span> @enderror
        </section>
        <div class="divider_coupon"></div>
        @php $taxtotal = $subtotal * ($store->tax/100); @endphp

        @php
            $total = $subtotal + $store->service_charge + $taxtotal;
            if($order_type == 3)
            {
                $total = $total + $store->delivery_charge;

            }
            $couponprice = 0;
            if ($coupon) {
                if ($coupon->discount_type == 'AMOUNT') {
                    $couponprice = $coupon->discount;
                    $total = $total - $coupon->discount;
                } elseif ($coupon->discount_type == 'PERCENTAGE') {
                    $couponprice = ($total * $coupon->discount) / 100;
                    $total = $total - ($total * $coupon->discount) / 100;
                }
            }
            if ($total < 0) {
                $total = 0;
            }
        @endphp


        <!-- order details start -->
        <section id="order-details" class="px-15 pt-0">
            <h2 class="title">Order Details: </h2>
            <div class="order-details">
                <ul>
                    <li>
                        <h4>{{ $selected_language->data['sub_total'] ?? 'Sub Total' }}
                            <span>@include('layouts.render.currency',["amount"=>$subtotal])</span></h4>
                    </li>
                    <li>
                        <h4>{{ $selected_language->data['service_charge'] ?? 'Service Charge' }}
                            <span>@include('layouts.render.currency',["amount"=>$store->service_charge]) </span></h4>
                    </li>
                    <li>
                        <h4>{{ $selected_language->data['applied_coupon'] ?? 'Applied Coupon' }}<span
                                class="text-green">-@include('layouts.render.currency',["amount"=>$couponprice])
                            </span></h4>
                    </li>
                    @if($order_type == 3)
                    <li>
                        <h4>{{ $selected_language->data['delivery_charge'] ?? 'Delivery Charge' }}<span
                                >@include('layouts.render.currency',["amount"=>$store->delivery_charge])
                            </span></h4>
                    </li>
                    @endif
                    <li>
                        <h4>{{ $selected_language->data['menu_tax'] ?? 'Tax' }}
                            ({{ $store->tax ?? '0' }}%)<span>@include('layouts.render.currency',["amount"=>$subtotal *
                                ($store->tax/100)])</span></h4>
                    </li>
                </ul>

            </div>
        </section>


        <section class="panel-space"></section>
        <!-- panel space end -->


        <!-- bottom panel start -->
        <div class="cart-bottom">
            <div>
                <div class="left-content">
                    <h4 class="text-success">@include('layouts.render.currency',["amount"=>$total])</h4>
                </div>
                @if($store->is_accept_order == 1)
                <a href="" wire:click.prevent="checkout"
                    class="btn btn-solid">{{ $selected_language->data['checkout'] ?? 'Checkout Now' }}</a>
                @else
                <a href=""
                    class="btn btn-solid disabled" disabled>{{$selected_language->data['not_accepting_orders'] ?? 'Currently We Are Not Accepting Orders'}}</a>
                @endif
            </div>
        </div>

    </div>

    <div class="payment-page top-space lg-space"  x-show="opencheck" x-transition.delay.100ms>

        <section class="px-15 payment-method-section">

            <div class="accordion" id="accordionExample"  wire:ignore>
                @if($isCODEnabled == 1)
                <div class="card">
                    <div class="card-header" id="h_one">
                        <div class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#one">
                            <label for="r_one">
                                <i class="fas fa-money-bill mx-2"></i>{{ $selected_language->data['cash_on_delivery'] ?? 'Cash On Delivery' }}
                                <input type="radio" class="radio_animated" checked="" id="r_one" name="occupation"
                                    value="1" wire:model="payment_type" />
                            </label>
                        </div>
                    </div>
                    <div id="one" class="collapse show" aria-labelledby="h_one" data-bs-parent="#accordionExample">
                        <div class="card-body p-0"></div>
                    </div>
                </div>
                @endif
                @if($razorpayEnabled == 1)

                <div class="card">
                    <div class="card-header" id="h_two">
                        <div class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#two">
                            <label for="r_two">
                                <i class="fas fa-credit-card mx-2"></i>Razor Pay
                                <input type="radio" class="radio_animated" id="r_two"  required="" value="2"   wire:model="payment_type"/>
                            </label>
                        </div>
                    </div>
                    <div id="two" class="collapse" aria-labelledby="h_two" data-bs-parent="#accordionExample">
                        <div class="card-body p-0">

                        </div>
                    </div>
                </div>
                @endif
                @if($isStripeEnabled == 1)
                <div class="card">
                    <div class="card-header" id="h_three">
                        <div class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#three">
                            <label for="r_three">
                                <i class="fab fa-stripe"></i>{{ $selected_language->data['stripe'] ?? 'Stripe Pay' }}
                                <input type="radio" class="radio_animated" id="r_three" name="occupation"
                                 required="" value="3" wire:model="payment_type"/>
                            </label>
                        </div>
                    </div>
                    <div id="three" class="collapse" aria-labelledby="h_three"
                        data-bs-parent="#accordionExample">
                        <div class="card-body p-0">

                        </div>
                    </div>
                </div>
                @endif
                @if($isPaypalEnabled == 1)
                <div class="card">
                    <div class="card-header" id="h_four">
                        <div class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#four">
                            <label for="r_four">
                                <i class="fab fa-paypal mx-2"></i>{{ $selected_language->data['paypal'] ?? 'PayPal' }}
                                <input type="radio" class="radio_animated" id="r_four" name="occupation"
                                     required=""  value="4"
                                     wire:model="payment_type"/>
                            </label>
                        </div>
                    </div>
                    <div id="four" class="collapse" aria-labelledby="h_four" data-bs-parent="#accordionExample">
                        <div class="card-body">

                            <div id="smart-button-container" wire:ignore>
                                <div style="text-align: center;">
                                    <div id="paypal-button-container"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($isPaystackEnabled == 1)
                <div class="card">
                    <div class="card-header" id="h_three">
                        <div class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#five">
                            <label for="r_five">
                                <i class="fas fa-credit-card mx-2"></i>{{ $selected_language->data['pay_stack'] ?? 'Pay Stack' }}
                                <input type="radio" class="radio_animated" id="r_five" name="occupation"
                                 required="" value="5" wire:model="payment_type"/>
                            </label>
                        </div>
                    </div>
                    <div id="five" class="collapse" aria-labelledby="h_five"
                        data-bs-parent="#accordionExample">
                        <div class="card-body">
                            <input class="form-control" type="email" placeholder="Enter Email" id="email">
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </section>

        <div class="card cart-amount-area fixed-bottom">
            <div class="card-body d-flex align-items-center justify-content-between">
                <h5 class="total-price mb-0">{{ $account_info != null ? $account_info->currency_symbol : '₹' }}<span
                        class="counter">{{ $total }}</span></h5><button @if ($payment_type == '' || $payment_type == 0) disabled @endif
                    wire:click.prevent="initiatePayment"
                    class="btn btn-success">{{ $selected_language->data['confirm_payment'] ?? 'Confirm Payment Now' }}</button>
            </div>
        </div>

    </div>
@else
<div class="d-flex pt-5 justify-content-center align-items-center" style="height: 75vh;">
    <div class="container">
    <img src="{{asset('home_assets/img/empty-cart.png')}}" alt="" width="100%">
    </div>
</div>
@include('livewire.home.layouts.navbar')

@endif
    <div class="success-page"  x-data="{ opensuccess: @entangle('showsuccess'),opencod : false }" x-show="opensuccess" x-transition.delay.100ms x-cloak>
        <div class="">
            <div class="d-flex pt-5 justify-content-center align-items-center flex-column" style="height: 75vh;">
                <img src="{{asset('home_assets/img/success.png')}}" alt="" style="height: 40vh;">
                <h3>{{$selected_language->data['your_order_placed'] ?? 'Your Order Has Been Placed'}}</h3>
                <h4 class="text-success">{{$selected_language->data['your_order_number_is'] ?? 'Order Number'}} : {{$order_id}}</h4>
                @if($successmsg)<h5 class="text-success">{{$selected_language->data['payment_id'] ?? 'Payment ID'}} : {{$successmsg}}</h5>@endif
                <div class="mt-5">
                    <a href="{{ url('/store/' . $view_id.'/myorder') }}"><button type="button" class="btn btn-primary ">{{$selected_language->data['view_my_order'] ?? 'View Order'}}</button></a>
                    <a href="{{ url('/store/' . $view_id) }}"><button type="button" class="btn btn-primary ">{{$selected_language->data['home'] ?? 'Home'}}</button></a>
                    @if($final_order && $store->phone && $store->whatsappbutton_enable ==1)
                    @php
                    function myUrlEncode($string) {
                        $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
                        $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
                        return str_replace($entities, $replacements, urlencode($string));
                    }


                    $products = '%0ACustomer Name: *'.$order->customer_name.'*';
                    if($order->order_type == 1)
                    {
                        $products .= '%0AOrder Type: *Dining*';

                    }
                    if($order->order_type == 2)
                    {
                        $products .= '%0AOrder Type: *Takeaway*';

                    }
                    if($order->order_type == 3)
                    {
                        $products .= '%0AOrder Type: *Delivery*';

                    }
                    if($order->order_type == 4)
                    {
                        $products .= '%0AOrder Type: *Room*';

                    }
                    if($order->address != null)
                    {
                        $products .= '%0ACustomer Address : *'.$order->address.'*';
                    }
                    if($order->customer_phone != null)
                    {
                        $products .= '%0ACustomer Phone:  *'.$order->customer_phone.'*';
                    }
                    if($order->table_no)
                    {
                        $products .= '%0ATable No: *'.$order->table_no.'*';
                    }
                    if($order->room_number)
                    {
                        $products .= '%0ARoom No: *'.$order->room_number.'*';
                    }
                    if($order->payment_status == 2)
                    {
                        $products .= '%0A*Order has been paid* ';

                    }

                    $products .= '%0AProduct : ';
                    foreach($final_order as $order_data)
                    {

                        foreach($order_data['order_details'] as $key => $data)
                        {
                            $products .= '%0A*'.$data['name'].'* Quantity : '.$data['quantity'];
                            $products .= '%0AAddons: ';
                            foreach($data['order_details_extra_addon'] as $key => $exra)
                            {
                                $products .= '%0A*'.$exra['addon_name'].'*';
                            }
                        }
                    }
                    $products .= '%0AOrder ID : *'.$order->order_unique_id.'*';
                    $products .= '%0ATotal : *'.$order->total.'*';
                    @endphp
                    <a href="https://wa.me/{{$store->phone}}?text={{myUrlEncode($products)}}">

                        <button type="button" class="btn btn-success ">{{$selected_language->data['send_to_whatsapp'] ?? 'Send Via Whatsapp'}}</button></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="getStoreid" value="{{ $view_id }}">
    <script src="{{ asset('home_assets/js/jquery.min.js') }}" defer wire:ignore.self></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js" wire:ignore.self></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <input type="hidden" id="getStoreid" value="{{ $view_id }}">
    <input type="hidden" id="total" value="{{ $total ?? 0 }}">
    <input type="hidden" id="currency" value="{{ $currency ?? 'USD' }}">
    <input type="hidden" id="paystackkey" value="{{ $paystackkey }}">
    <input type="hidden" id="stripe_details" value="{{$stripekey}}" >
    <input type="hidden" id="payment_details" value="{{$json}}" >
    <script src="https://www.paypal.com/sdk/js?client-id={{ $paypalkey }}&currency={{ $currency ?? 'USD' }}"
    data-sdk-integration-source="button-factory"></script>

    @include('Home.home_layout.stripe')

    @include('Home.home_layout.paypal')




    <script wire:ignore.self>
        // Checkout details as a json

        window.livewire.on('openrazorpay', () => {
            var options = JSON.parse(document.getElementById('payment_details').value);

            options = {
                ...options,
                "modal": {
                    "ondismiss": function() {
                        console.log('Checkout form closed');
                    }
                }


            };
            options.handler = function(response) {
                @this.confirmPayment(response);

            };


            var rzp = new Razorpay(options);
            rzp.open();
            rzp.on('payment.failed', function(response) {
                @this.paymentFail(response);
            });

        });

        window.livewire.on('openpaystack', () => {
            var paymentForm = document.getElementById('paymentForm');
            var handler = PaystackPop.setup({
                key: document.getElementById('paystackkey').value,
                amount: document.getElementById('total').value * 100,
                currency: 'GHS',
                email: document.getElementById('email').value,
                ref: '' + Math.floor((Math.random() * 1000000000) + 1),
                callback: function(response) {
                    @this.confirmPayment(response);
                },
                onClose: function() {},
            });
            handler.openIframe();

        });
    </script>

</div>
