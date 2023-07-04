<div  x-data="{openpaystack:false, open: @entangle('showcart') ,opencheck: @entangle('showcheckout'),opencod : false,openrazor : false,openstripe : false,openpaypal:false}">

<input type="hidden" id="payment_details" value="{{$json}}" >
<input type="hidden" id="stripe_details" value="{{$stripekey}}" >
@push('head')
    <meta name="turbolinks-cache-control" content="no-cache">
@endpush
    <style>
[x-cloak] { display: none !important; }
        </style>
<div class="header-area" id="headerArea" >
    <div class="container h-100 d-flex align-items-center justify-content-center">
        <div class="page-heading" style="margin-right: auto;">
            @if($showcheckout == true)
            <button class="btn btn-sm text-white"  style="background-color: rgb(255, 0, 76)"  @click="opencheck = false, open = true">{{$selected_language->data['go_back'] ?? 'Back'}}</button>
            @elseif(!$cartproducts)
            <a href="{{url('/store/'.$view_id)}}"><button class="btn btn-sm text-white"  style="background-color: rgb(255, 0, 76)"  >{{$selected_language->data['go_back'] ?? 'Back'}}</button></a>
            @else
            <a href="{{url('/store/'.$view_id)}}"><button class="btn btn-sm text-white"  style="background-color: rgb(255, 0, 76)"  >{{$selected_language->data['go_back'] ?? 'Back'}}</button></a>

            @endif
        </div>
        <div class="page-heading" style="flex: 1; text-align: center;">
            <h6 class="mb-0 text-center" >{{$selected_language->data['my_cart'] ?? 'My Cart'}}</h6>
        </div>
        <div class="page-heading" style="margin-left: auto;">
            <h6 class="mb-0 text-center" >&nbsp;&nbsp;&nbsp;&nbsp;</h6>
        </div>
    </div>
</div>

<div class="page-content-wrapper" > 
    <div class="container">
        <!-- Cart Wrapper-->
        <div class="cart-wrapper-area py-2">
            @if($cartproducts)
            <div class="" x-show="open" x-transition.opacity>
            <div class="cart-table card mb-3">
                <div class="table-responsive card-body">
                    <table class="table mb-0">
                        <tbody>
                        @php
                        $total = 0;
                        $subtotal = 0;
                        $prices = [];
                        @endphp
                        @if($cartproducts)

                        @forelse($cartproducts as $key => $row)
                        @php
                            $inlinetotal = 0;
                            $variantname = null;
                            $variantprice = 0;
                            $extras = [];
                            $product = \App\Product::where('id',$key)->first();
                            if($product)
                            {
                                if(isset($row['variant']))
                                {
                                    foreach($row['variant'] as $key => $variant)
                                    {
                                        $addon = \App\Models\Addon::where('id',$variant)->first();
                                        $variantname .= ' '.$addon->addon_name;
                                        $variantprice += $addon->price;
                                    }
                                   
                                    $subtotal += $variantprice * $quantity[$product->id];
                                    $inlinetotal = $variantprice * $quantity[$product->id];
                                    
                                }
                                else{
                                    $subtotal += $product->price * $quantity[$product->id];
                                    $inlinetotal = $product->price * $quantity[$product->id];
                                }
                                if(isset($row['extras']))
                                {
                                    foreach($row['extras'] as $key => $extra)
                                    {
                                        $addon = \App\Models\Addon::where('id',$key)->first();
                                        $subtotal = $subtotal + $addon->price;
                                        $inlinetotal = $inlinetotal+$addon->price;
                                        $extras[$key]['name'] = $addon->addon_name;
                                        $extras[$key]['price'] = $addon->price; 
                                    }
                                }
                                $prices[$product->id] = $inlinetotal;

                            }
                        @endphp
                        @if($product)
                        <tr class="d-flex justify-content-between">
                            <td><a  class="text-muted">{{$product->name}} &#40; @if($variantname)@if($variantname) {{$variantname}} @endif : @include('layouts.render.currency',["amount"=>$variantprice]) @else @include('layouts.render.currency',["amount"=>$product->price*$quantity[$product->id]]) @endif )  
                            @if($extras)
                                @foreach($extras as $row)
                                  <span class="mt-1 text-success fw-normal" style="font-size : 10px">  {{$row['name']}} @include('layouts.render.currency',["amount"=>$row['price']])</span>
                                   
                                  @endforeach
                                  <span class=" fw-bolder mt-2">@include('layouts.render.currency',["amount"=>$prices[$product->id]])</span>
                            @endif
                            </a></td>
                            <td>
                            <p></p>
                                <div class="quantity">
                                    <div class="cart-form" action="#" method="">
                                        <div class="order-plus-minus d-flex align-items-center">
                                            <div class="quantity-button-handler" wire:click="decreasequantity({{$product->id}})">-</div>
                                            <input class="form-control cart-quantity-input" type="text" step="1"
                                                   name="quantity" readonly  wire:model="quantity.{{$product->id}}">
                                            <div class="quantity-button-handler" wire:click="additem({{$product->id}})">+</div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                         @endif
                        @empty
                        @endforelse
                        @else
                        Empty
                       @endif

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <div class="mb-3">
                        <input class="form-control" type="text" placeholder="{{$selected_language->data['menu_name'] ?? 'Name'}}" wire:model="name">
                        @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="number" placeholder="{{$selected_language->data['menu_phone_number'] ?? 'Phone Number'}}" wire:model="phone_number">
                        @error('phone_number') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <select class="form-control" wire:model="order_type">
                                <option disabled value="">{{$selected_language->data['order_type'] ?? 'Order Type'}}</option>
                                <option value="1">{{$selected_language->data['cart_order_type_status_dining'] ?? 'Dining'}}</option>
                                <option value="2">{{$selected_language->data['cart_order_type_status_takeaway'] ?? 'Takeaway'}}</option>
                                <option value="3">{{$selected_language->data['cart_order_type_status_delivery'] ?? 'Delivery'}}</option>
                                <option value="4">{{$selected_language->data['cart_order_type_status_room'] ?? 'Room'}}</option>
                        </select>
                    </div>
                    @if($order_type == 3)

                        <div class="mb-3">
                            <input class="form-control" type="text" placeholder="{{$selected_language->data['address'] ?? 'Address'}}" wire:model="address">
                            @error('address') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                    @endif
                    @if($order_type ==1)
                        @php
                            $tables = \App\Models\Table::where('store_id',$store->id)->where('is_active',1)->get();
                        @endphp
                    <div class="mb-3">
                        <select class="form-control" wire:model="table">
                            <option  selected value="">{{$selected_language->data['select_your_table'] ?? 'Select Your Table'}}</option>
                            @forelse ($tables as $row)
                            <option value="{{$row->id}}">{{$row->table_name}}</option>

                            @empty

                            @endforelse
                    </select>
                    @error('table') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    @endif
                    @if($order_type == 4)

                    <div class="mb-3">
                        <input class="form-control" type="text" placeholder="{{$selected_language->data['enter_room_number'] ?? 'Enter Room Number'}}" wire:model="room">
                        @error('room') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    @endif

                    <div class="mb-3">
                        <input class="form-control" type="text" placeholder="{{$selected_language->data['menu_comment'] ?? 'Comments'}}" wire:model="comments">
                    </div>

                </div>
            </div>

            <!-- Coupon Area-->
            <div class="card coupon-card mb-3">
                <div class="card-body">
                    <div class="apply-coupon">
                        <h6 class="mb-0">{{$selected_language->data['have_coupon'] ?? 'Have A Coupon?'}}</h6>
                        <p class="mb-2">{{$selected_language->data['enter_coupon_code'] ?? 'Enter Coupon Code Here'}}</p>
                        <div class="coupon-form">
                            <form action="#">
                                <input class="form-control" type="text" placeholder="{{$selected_language->data['enter_coupon_field'] ?? 'Enter Coupon'}}" wire:model="coupon_code">

                                <button class="btn btn-dark" type="submit" wire:click.prevent="applycoupon()">{{$selected_language->data['apply'] ?? 'Apply'}}</button>
                                @error('coupon') <span class="error text-danger">{{ $message }}</span> @enderror
                                @error('coupon_success') <span class="error text-success">{{ $message }}</span> @enderror
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @php $taxtotal = $subtotal * ($store->tax/100); @endphp

            @php
            $total = $subtotal + $store->service_charge + $taxtotal;
            $couponprice = 0;
            if($coupon)
            {
                if($coupon->discount_type == 'AMOUNT')
                {
                    $couponprice = $coupon->discount;
                    $total = $total - $coupon->discount;

                }
                else if($coupon->discount_type == 'PERCENTAGE')
                {
                    $couponprice = $total * $coupon->discount/100;
                    $total = $total - ($total * $coupon->discount/100);


                }
            }
            if($total < 0)
            {
                $total = 0;
            }
        @endphp
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8 text-success">{{$selected_language->data['sub_total'] ?? 'Sub Total'}}</div>
                        <div class="col-4">@include('layouts.render.currency',["amount"=>$subtotal])</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-8 text-success">{{$selected_language->data['applied_coupon'] ?? 'Applied Coupon'}}</div>
                        <div class="col-4">@include('layouts.render.currency',["amount"=>$couponprice])</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-8 text-success">{{$selected_language->data['service_charge'] ?? 'Service Charge'}}</div>
                        <div class="col-4">@include('layouts.render.currency',["amount"=>$store->service_charge])</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-8 text-success">{{$selected_language->data['menu_tax'] ?? 'Tax'}} ({{$store->tax ?? '0'}}%)</div>
                        <div class="col-4">@include('layouts.render.currency',["amount"=>$subtotal * ($store->tax/100)])</div>
                    </div>


                </div>
            </div>
           
            <!-- Cart Amount Area-->
            <div class="card cart-amount-area">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <h5 class="total-price mb-0">@include('layouts.render.currency',["amount"=>$total])</h5><a wire:click.prevent="checkout" class="btn btn-warning"
                                                                                            href="">{{$selected_language->data['checkout'] ?? 'Checkout Now'}}</a>
                </div>
            </div>
        </div>
        <div class="" x-data="" x-show="opencheck" x-transition.delay.100ms x-cloak>
            <div class="card mb-3 bg-transparent">
                <div class="card-body" style="height: 80vh;">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between" @click="opencod = ! opencod,openrazor = false,openstripe = false,$wire.payment_type = opencod == true ? 1 : 0">
                                <span class="text-success">{{$selected_language->data['cash_on_delivery'] ?? 'Cash'}} </span><i class="fa fa-chevron-down mt-1 text-right ml-2"></i>
                            </div>

                            <div class="mt-3" x-show="opencod" x-collapse>
                                <div class="form-check">
                                    <input class="form-check-input"  type="radio" value="1" id="flexCheckDefault" wire:model="payment_type">
                                    <label class="form-check-label" for="flexCheckDefault"> 
                                        {{$selected_language->data['cash'] ?? 'Cash'}}
                                    </label>
                                    <p >{{$selected_language->data['cash_description'] ?? 'Please bring change with you.'}}</p>
                                  </div>
                            </div>
                        </div>
                    </div>
                    @if($razorpayEnabled == 1)
                    <div class="card mt-2">
                        <div class="card-body">
                            <div class="d-flex justify-content-between" @click="openrazor = ! openrazor,openpaypal = false,opencod = false,openstripe = false,$wire.payment_type = openrazor == true ? 2 : 0">
                                <span class="text-success">{{$selected_language->data['razorpay'] ?? 'Razor Pay'}}</span><i class="fa fa-chevron-down mt-1 text-right ml-2"></i>
                            </div>
                            <div class="mt-3" x-show="openrazor" x-collapse wire:ignore>
                                
                                    <div class="form-check">
                                        <input class="form-check-input"  type="radio" value="2" id="flexCheckRazor" wire:model="payment_type">
                                        <label class="form-check-label" for="flexCheckRazor"> 
                                            {{$selected_language->data['razorpay'] ?? 'Razor Pay'}}
                                        </label>
                                      </div>
                                    
                                  
                            </div>
                        </div>
                        
                      </div>
                      @endif
                      @if($isStripeEnabled == 1)
                      <div class="card mt-2">
                        <div class="card-body">
                            <div class="d-flex justify-content-between" @click="openstripe = ! openstripe,openpaypal = false,opencod = false,openrazor = false,$wire.payment_type = openstripe == true ? 3 : 0">
                                <span class="text-success">{{$selected_language->data['stripe'] ?? 'Stripe Pay'}}</span><i class="fa fa-chevron-down mt-1 text-right ml-2"></i>
                            </div>
                            <div class="mt-3" x-show="openstripe" x-collapse wire:ignore>
                                
                                    <div class="form-check">
                                        <input class="form-check-input"  type="radio" value="3" id="flexCheckStripe" wire:model="payment_type">
                                        <label class="form-check-label" for="flexCheckStripe"> 
                                            {{$selected_language->data['stripe'] ?? 'Stripe'}}
                                        </label>
                                      </div>
                            </div>
                        </div>
                        
                      </div>
                      @endif
                      @if($isPaypalEnabled == 1)
                      <div class="card mt-2">
                        <div class="card-body">
                            <div class="d-flex justify-content-between" @click="openpaypal = ! openpaypal,opencod = false,openrazor = false,openstripe = false,$wire.payment_type = openpaypal == true ? 4 : 0">
                                <span class="text-success">{{$selected_language->data['paypal'] ?? 'PayPal'}}</span><i class="fa fa-chevron-down mt-1 text-right ml-2"></i>
                            </div>
                            <div class="mt-3" x-show="openpaypal" x-collapse wire:ignore>
                                
                                <div id="smart-button-container">
                                    <div style="text-align: center;">
                                      <div id="paypal-button-container"></div>
                                    </div>
                                    <input class="form-check-input"  type="radio" value="4" id="flexCheckStripe" hidden wire:model="payment_type">
                                  </div>
                            </div>
                        </div>
                      </div>
                      @endif
                      @if($isPaystackEnabled == 1)
                      <div class="card mt-2">
                        <div class="card-body">
                            <div class="d-flex justify-content-between" @click="openpaystack = ! openpaystack,opencod = false,openrazor = false,openstripe = false,$wire.payment_type = openpaystack == true ? 5 : 0">
                                <span class="text-success">{{$selected_language->data['pay_stack'] ?? 'Pay Stack'}}</span><i class="fa fa-chevron-down mt-1 text-right ml-2"></i>
                            </div>
                            <div class="mt-3" x-show="openpaystack" x-collapse wire:ignore>
                                <input class="form-check-input"  type="radio" value="5" id="flexCheckStripe" hidden wire:model="payment_type">
                                
                                    <input class="form-control"  type="email" placeholder="Enter Email" id="email" >
    

                            </div>
                        </div>
                      </div>
                      @endif
                      
                      
                </div>
            </div>

             <!-- Cart Amount Area-->
             <div class="card cart-amount-area fixed-bottom">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <h5 class="total-price mb-0">{{$account_info != NULL ?$account_info->currency_symbol:"₹"}}<span class="counter">{{$total}}</span></h5><button @if($payment_type == '' || $payment_type == 0) disabled @endif wire:click.prevent="initiatePayment" class="btn btn-success"
                                                                                            >{{$selected_language->data['confirm_payment'] ?? 'Confirm Payment Now'}}</button>
                </div>
            </div>
        </div>
        <div class="" x-data="{ opensuccess: @entangle('showsuccess'),opencod : false }" x-show="opensuccess" x-transition.delay.100ms x-cloak>
            <div class="d-flex pt-5 justify-content-center align-items-center flex-column" style="height: 75vh;">
                <img src="{{asset('home_assets/img/success.png')}}" alt="" style="height: 40vh;">
                <h3>{{$selected_language->data['your_order_placed'] ?? 'Your Order Has Been Placed'}}</h3>
                <h4 class="text-success">{{$selected_language->data['your_order_number_is'] ?? 'Order Number'}} : {{$order_id}}</h4>
                @if($successmsg)<h5 class="text-success">{{$selected_language->data['payment_id'] ?? 'Payment ID'}} : {{$successmsg}}</h5>@endif

            </div>
        </div>
        @else
        <div class="d-flex pt-5 justify-content-center align-items-center" style="height: 75vh;">
            <img src="{{asset('home_assets/img/empty-cart.png')}}" alt="">
        </div>
        @endif
    </div>
        </div>


<!-- Footer Nav-->
<div class="footer-nav-area" id="footerNav">
    <div class="container h-100 px-0">
        <div class="suha-footer-nav h-100">
            <ul class="h-100 d-flex align-items-center justify-content-between ps-0">
                <li ><a href="{{url('/store/'.$view_id)}}"><i class="lni lni-home"></i>{{$selected_language->data['user_home'] ?? 'Home'}}</a></li>
<!--                <li><a href="message.html"><i class="lni lni-life-ring"></i>Support</a></li>-->
                <li class="active"><a href="{{url('/store/cart/'.$view_id)}}" data-turbolinks="false" wire:ignore.self><i class="lni lni-shopping-basket"></i>{{$selected_language->data['cart'] ?? 'Cart'}}</a></li>
                <li><a href="{{url('/store/'.$view_id.'/myorder')}}"><i class="lni lni-ticket-alt"></i>{{$selected_language->data['my_order'] ?? 'My Order'}}</a></li>
                <li><a href="{{url('/store/'.$view_id.'/settings/')}}"><i class="lni lni-cog"></i>{{$selected_language->data['settings'] ?? 'Settings'}}</a></li>
            </ul>
        </div>
    </div>
</div>
<input type="hidden" id="getStoreid" value="{{$view_id}}">
<script src="{{asset('home_assets/js/jquery.min.js')}}" defer wire:ignore.self></script>
<script src="https://checkout.razorpay.com/v1/checkout.js" wire:ignore.self></script>
<script src="https://js.paystack.co/v1/inline.js"></script> 
@include('Home.home_layout.stripe')
<input type="hidden" id="getStoreid" value="{{$view_id}}">
<input type="hidden" id="total" value="{{$total ?? 0}}">
<input type="hidden" id="currency" value="{{$currency ?? 'USD'}}">
<input type="hidden" id="paystackkey" value="{{$paystackkey}}">
@include('Home.home_layout.paypal')

</div>

@push('head')
@if($this->isPaypalEnabled == 1)
<script src="https://www.paypal.com/sdk/js?client-id={{$paypalkey}}&currency={{$currency ?? 'USD'}}" data-sdk-integration-source="button-factory"></script>

@endif
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
        ref: ''+Math.floor((Math.random() * 1000000000) + 1), 
        callback: function(response) {
            @this.confirmPayment(response);
        },
        onClose: function() {
        },
    });
    handler.openIframe();
    
    });
</script>
@endpush