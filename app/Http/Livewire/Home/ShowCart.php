<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;
use App\Http\Controllers\TranslationService;
use App\Models\Store;
use App\Models\Order;
use App\Product;
use App\Translation;
use App\User;
use App\Models\OrderDetails;
use App\Models\Setting;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use Stripe\Stripe;
class ShowCart extends Component
{

    public $store,$selected_language,$cartproducts,$account_info,$quantity = [],$view_id,$name,$phone_number,$order_type="",$comments,$coupon_code,$address,$payment_type;
    public $showcheckout = false,$showcart = true,$showsuccess = false;
    public $sub_total =0,$order_id = 0,$table,$room,$isRazorpayenabled,$razorpay_key_id,$isStripeEnabled,$stripekey;
    private $api;
    public $json = 1,$success = true,$error = '',$successmsg = '',$counter = 0,$order_uid,$payment_fail = false;
    public $coupon,$stripeerror,$count,$favicon,$dob,$final_order,$order,$customcss;
    public $stripe_name,$stripe_cardno,$stripe_cvc,$stripe_expmonth,$stripe_expyear,$isPaypalEnabled,$paypalkey,$currency,$isPaystackEnabled,$paystackkey;
    public function render()
    {
        return view('livewire.home.show-cart')
        ->extends('layouts.home_layout',['title' => $this->store->store_name,'favicon' => $this->favicon,'customcss' => $this->customcss])
        ->section('content');
    }
    protected $rules = [
        'name' => 'required|min:3',
        'phone_number' => 'required|numeric',
    ];
    public function mount($view_id)
    {
        $appsettings = \App\Application::all()->first();
        if($appsettings)
        {
            if(file_exists($appsettings->fav_icon))
            {
                $this->favicon = $appsettings->fav_icon;
            }
        }
        $customcss = Setting::where('key','CustomCss')->first();
        if($customcss)
        {
            $this->customcss = $customcss->value;
        }
        $translation = new TranslationService();
        if(session()->has('selected_language'))
        {
            $this->selected_language = Translation::where('id',session()->get('selected_language'))->first();
        }
        else{
            $this->selected_language = Translation::where('is_default',1)->where('is_active',1)->first();
        }
        $this->view_id = $view_id;
        if(Store::all()->where('view_id','=',$view_id)->count() ==0){
            abort(404);
        }
        $this->store = Store::all()->where('view_id','=',$view_id)->first();
        $this->account_info = $this->store;

        $cart = session()->get('cart'.$this->store->id);
        if(isset($cart))
        {
            foreach($cart as $key => $value)
            {
                $this->quantity[$key] = $cart[$key]['quantity'];
            }
            $this->cartproducts = $cart;
        }
        
        $storesettings = \App\StoreSetting::where('store_id',$this->store->id)->first();
        if($storesettings)
        {
            $this->currency = $storesettings->StoreCurrency;
            $this->razorpayEnabled =  $storesettings->IsRazorpayEnabled;
            $this->isStripeEnabled = $storesettings->IsStripeEnabled;
            $this->isPaypalEnabled = $storesettings->IsPaypalEnabled;
            $this->isPaystackEnabled = $storesettings->IsPayStackEnabled;
            $this->isCODEnabled = $storesettings->IsCodEnabled;
            if($this->razorpayEnabled == 1)
            {
            $this->razorpay_key_id = $storesettings->RazorpayKeyId;
            $keysecret = $storesettings->RazorpayKeySecret;
            }
            if($this->isStripeEnabled == 1)
            {
                $this->stripekey = $storesettings->StripePublishableKey;
            }
            if($this->isPaypalEnabled == 1)
            {
                $this->paypalkey = $storesettings->PaypalKeyId;
            }
            if($this->isPaystackEnabled == 1)
            {
                $this->paystackkey = $storesettings->PayStackPublishableKey;
            }
            
        }
        else{
            $this->razorpayEnabled = 0;
            $this->isStripeEnabled = 0;
            $this->isPaypalEnabled = 0;
            $this->isPaystackEnabled = 0;
            $this->currency = 'USD';
            $this->isCODEnabled = 0;

        }
        if(session()->has('userSelectedTable'))
        {
            
            $tableid = session()->get('userSelectedTable');
            $table = \App\Models\Table::where('id',$tableid)->first();
            if($table)
            {
                $this->table = $table->table_name;

            }
            $this->order_type = 1;
        }
    }

    public function additem($id)
    { 
        $product = Product::where('id',$id)->first();
        $cart = session()->get('cart'.$this->store->id);
        if(!$cart) {
            $cart = [
                $id => [
                    "name"          => $product->name,
                    "quantity"      => 1,
                ]
            ];
            session()->put('cart'.$this->store->id, $cart);
            $this->quantity[$id] = 1;
            
            //$this->regenitemscount();
            return 1;
        }
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
            $this->quantity[$id] = $cart[$id]['quantity'];
            session()->put('cart'.$this->store->id, $cart);
            //$this->regenitemscount();         
            return 1;
        }
        $cart[$id] = [
            "name"          => $product->name,
            "quantity"      => 1
        ];
        $this->quantity[$id] = 1;
        session()->put('cart'.$this->store->id, $cart);
        //$this->regenitemscount();
        
    }

    public function decreasequantity($id)
    {
        $cart = session()->get('cart'.$this->store->id);
        if(isset($cart[$id])) {
            if($cart[$id]['quantity'] > 1)
            {
                $cart[$id]['quantity']--;
                $this->quantity[$id] --;
                session()->put('cart'.$this->store->id, $cart);
                return 1;
            }
            else {
                unset($cart[$id]);
                unset($this->quantity[$id]);
                session()->put('cart'.$this->store->id, $cart);
                $this->regenlist();
                return 1;
            }
        }
        
    }

    public function regenlist()
    {
        $cart = session()->get('cart'.$this->store->id);
        foreach($cart as $key => $value)
        {
            $this->quantity[$key] = $cart[$key]['quantity'];
        }
        $this->cartproducts = $cart;
    }

    public function checkout()
    {
        $this->validate();
        if($this->order_type == "")
        {
            $this->addError('order_type', $this->selected_language->data['error_select_order_type'] ?? 'Select an order type');
            return 1;
        }
        if($this->order_type == 3 && $this->address == '' ||$this->order_type == 3 && $this->address == null)
        {   
            $this->addError('address', $this->selected_language->data['error_message_field_required'] ?? 'Enter An Address');
            return 1;
        }
        if($this->order_type == 1 && $this->table == '' ||$this->order_type == 1 && $this->table == null)
        {   
            $this->addError('table', $this->selected_language->data['error_select_table'] ?? 'Please Select A Table');
            return 1;
        }
        if($this->order_type == 4 && $this->room == '' ||$this->order_type == 4 && $this->room == null)
        {   
            $this->addError('room', $this->selected_language->data['error_select_room'] ?? 'Please Enter A Room Number');
            return 1;
        }
        elseif($this->order_type == 4 && $this->store->is_room_delivery_dob_enable == 1)
        {
            if($this->order_type == 4 && $this->dob == '' || $this->order_type == 4 && \Carbon\Carbon::parse($this->dob)->age < 18)
            {
                $this->addError('roomdob', $this->selected_language->data['error_select_room_dob'] ?? 'You must be older than 18');
                return 1;
            }
        }
        
        $this->showcart = false;
        $this->showcheckout = true;
    }
    public function initiatePayment()
    {
        $storesettings = \App\StoreSetting::where('store_id',$this->store->id)->first();
        
        if($this->payment_type == '')
        {
            return redirect()->back();
        }
        else if($this->payment_type == 1)
        {
            $this->confirmPayment();
        }
        else if($this->payment_type == 2)
        {
            if($this->razorpayEnabled == 1)
            {
            $this->razorpay_key_id = $storesettings->RazorpayKeyId;
            $keysecret = $storesettings->RazorpayKeySecret;
            }
            else{
                abort(404);
            }
            $this->user = auth()->user();
            $this->order_uid = $this->createOrderUID();
            $cart = session()->get('cart'.$this->store->id);
            $varianttotal = 0;
            if($cart)
            {
            foreach($cart as $key => $row)
            {
                $product = Product::where('id',$key)->where('is_active',1)->first();
                if($product)
                {
                    if(isset($row['variant']))
                    {
                        foreach($row['variant'] as $key => $variant)
                        {
                            $addon = \App\Models\Addon::where('id',$variant)->first();
                            $varianttotal += $addon->price;
                        }
                        $this->sub_total += $varianttotal * $row['quantity'];
                    }
                    else{
                        $this->sub_total += $product->price*$row['quantity'];
                    }
                    if(isset($row['extras']))
                    {
                        foreach($row['extras'] as $key => $extra)
                        {
                            $addon = \App\Models\Addon::where('id',$key)->first();
                            $this->sub_total = $this->sub_total + $addon->price;
                        }
                    }
                    
                }
            }

        }
            $this->total = 0;
            $this->total = $this->sub_total * ($this->store->tax/100);
            $this->total = $this->total + $this->sub_total;
            $this->total = $this->total + $this->store->service_charge;
            $delivery_charge = 0;
            if($this->order_type == 3 && $this->store->delivery_charge)
            {
                $this->total = $this->total + $this->store->delivery_charge;
                $delivery_charge = $this->store->delivery_charge;
            }
            $couponprice = 0;
            if($this->coupon)
            {
                if($this->coupon->discount_type == 'AMOUNT')
                {
                    $couponprice =$this->coupon->discount;
                    $this->total = $this->total - $this->coupon->discount;

                }
                else if($this->coupon->discount_type == 'PERCENTAGE')
                {
                    $couponprice = $this->total * $this->coupon->discount/100;
                    $this->total = $this->total - ($this->total * $this->coupon->discount/100);
                }
            }
            if($this->total < 0)
            {
                $this->total = 0;
            }
            $api = new Api($this->razorpay_key_id, $keysecret);
            $orderData = [
                'receipt'         => "RCPT-" . time(),
                'amount'          =>  $this->total*100, // 39900 rupees in paise
                'currency'        => $this->currency,
            ];
            $order = $api->order->create($orderData);
            $data = [
                "key"               => $this->razorpay_key_id,
                "amount"            => $this->total*100,
                "name"              => $this->store->name,
                "image"             => "https://thumbs.dreamstime.com/b/convenience-store-interior-variety-good-shelves-display-57214846.jpg",
                "prefill"           => [
                "name"              => $this->name,
                "contact"           => $this->phone_number,
                ],
                "notes"             => [
                "address"           => $this->store->address,
                "merchant_order_id" => $this->order_uid,
                ],
                "theme"             => [
                "color"             => "#240000"
                ],
                "retry"             => [
                    "enabled"           => false
                ],
                ];
                
                $this->json = json_encode($data);
                $this->emit('openrazorpay');
        }
        elseif($this->payment_type == 3)
        {
            $this->total = 0;
            $this->sub_total = 0;
            
        $cart = session()->get('cart'.$this->store->id);
        $varianttotal = 0;
        if($cart)
        {
            foreach($cart as $key => $row)
            {
                $product = Product::where('id',$key)->where('is_active',1)->first();
                if($product)
                {
                    if(isset($row['variant']))
                    {
                        foreach($row['variant'] as $key => $extra)
                        {
                            $addon = \App\Models\Addon::where('id',$extra)->first();
                            $varianttotal = $varianttotal + $addon->price;
                        }
                        $this->sub_total += $varianttotal * $row['quantity'];

                    }
                    else{
                        $this->sub_total += $product->price*$row['quantity'];
                    }
                    if(isset($row['extras']))
                    {
                        foreach($row['extras'] as $key => $extra)
                        {
                            $addon = \App\Models\Addon::where('id',$key)->first();
                            $this->sub_total = $this->sub_total + $addon->price;
                        }
                    }
                    
                }
            }

        }
        
        $this->total = $this->sub_total * ($this->store->tax/100);
        $this->total = $this->total + $this->sub_total;
        $this->total = $this->total + $this->store->service_charge;
        $delivery_charge = 0;
        if($this->order_type == 3 && $this->store->delivery_charge)
        {
            $this->total = $this->total + $this->store->delivery_charge;
            $delivery_charge = $this->store->delivery_charge;
        }
        $couponprice = 0;
        if($this->coupon)
        {
            if($this->coupon->discount_type == 'AMOUNT')
            {
                $couponprice =$this->total * $couponprice/100;
                $this->total  = $this->total - $this->coupon->discount;

            }
            else if($this->coupon->discount_type == 'PERCENTAGE')
            {
                $couponprice = $this->total * $this->coupon->discount/100;
                $this->total  = $this->total - ($this->total * $this->coupon->discount/100);
            }
        }
       
        if($this->total < 0)
        {
            $this->total = 0;
        }
        if($this->order_type != 1)
        {
            $this->table = null;
        }
        if($this->order_type != 3)
        {
            $this->address = null;
        }
        if($this->order_type != 4)
        {
            $this->room = null;
        }
        $varianttotal = 0;
        $variantname = '';
            $order = Order::create([
                'order_unique_id' => $this->order_uid ?? $this->createOrderUID(),
                'store_id' => $this->store->id,
                'table_no' => $this->table ?? '',
                'customer_name' => $this->name,
                'sub_total' => $this->sub_total,
                'tax' => $this->sub_total * ($this->store->tax/100),
                'store_charge' => $this->store->store_charge,
                'total' => $this->total,
                'comments' => $this->comments,
                'payment_status' => 1,
                'order_type' => $this->order_type,
                'payment_type' => $this->payment_type,
                'address' => $this->address ?? null,
                'customer_phone' => $this->phone_number,
                'room_number' => $this->room,
                'discount' => $this->coupon->discount ?? 0,
                'dob_customer'  => $this->dob,
                'status' => 0,
                'delivery_charge'   => $delivery_charge ?? null,
            ]);
            foreach($cart as $key => $row)
            {
                $product = Product::where('id',$key)->where('is_active',1)->first();
                if($product)
                {
                    if(isset($row['variant']))
                    {
                        foreach($row['variant'] as $key => $variant)
                        {
                            $addon = \App\Models\Addon::where('id',$variant)->first();
                            $varianttotal += $addon->price;
                            $variantname =  $variantname.' '.$addon->addon_name;
                        }
                        $orderdetail = OrderDetails::create([
                            'order_id' => $order->id,
                            'price' => $varianttotal*$row['quantity'],
                            'quantity' => $row['quantity'],
                            'name' => $product->name.' ('.$variantname.') ',
                        ]);
                    }
                    else{
                        $orderdetail = OrderDetails::create([
                            'order_id' => $order->id,
                            'price' => $product->price*$row['quantity'],
                            'quantity' => $row['quantity'],
                            'name' => $product->name
                        ]);
                    }
                    if(isset($row['extras']))
                    {
                        foreach($row['extras'] as $key => $extra)
                        {
                            $addon = \App\Models\Addon::where('id',$key)->first();
                            $addonsave = new \App\Models\OrderDetailAddon;
                            $addonsave->addon_name = $addon->addon_name;
                            $addonsave->addon_price = $addon->price;
                            $addonsave->order_detail_id = $orderdetail->id;
                            $addonsave->addon_count = 1;
                            $addonsave->save();
                            
                        }
                    }                   
                }              
            }
            $this->emit('openstripepay', $order->id,$this->view_id);
            $this->final_order = Order::with('orderDetails.OrderDetailsExtraAddon')->where('id',$order->id)->get()->toArray();
            $this->order = $order;
            return 0;
        }
        elseif($this->payment_type == 5)
        {
            $this->emit('openpaystack');
        }
    }
    public function confirmPayment($payment_data = null)
    {
        $storesettings = \App\StoreSetting::where('store_id',$this->store->id)->first();
        if($this->isRazorpayenabled == 1)
        {
            $this->razorpay_key_id = $storesettings->RazorpayKeyId;
            $keysecret = $storesettings->RazorpayKeySecret;
        }
       
        $this->total = 0;
        $this->sub_total = 0;
        $payment_status = 1;
        if($this->payment_type == 2)
        {
            if (empty($_POST['razorpay_payment_id']) === false)
            {
            $api =  new Api($this->razorpay_key_id, $keysecret);
            try
            {
                $attributes = array(
                    'razorpay_order_id' => $payment_data['razorpay_order_id'],
                    'razorpay_payment_id' => $payment_data['razorpay_payment_id'],
                    'razorpay_signature' => $payment_data['razorpay_signature']
                );
    
                $api->utility->verifyPaymentSignature($attributes);
            }
                catch(SignatureVerificationError $e)
                    {
                        $this->success = false;
                        $this->error = 'Razorpay Error : ' . $e->getMessage();
                        return 1;
                    }
                }
    
                if ($this->success === true)
                {
                $this->successmsg = $payment_data['razorpay_payment_id'];
                $payment_status = 2;
                }
                else
                {
                
                }    
        }
        $this->user = auth()->user();
        $data = [];
        $varianttotal = 0;
        $cart = session()->get('cart'.$this->store->id);
        if($cart)
        {
            foreach($cart as $key => $row)
            {
                $product = Product::where('id',$key)->where('is_active',1)->first();
                if($product)
                {
                    if(isset($row['variant']))
                    {
                        foreach($row['variant'] as $key => $extra)
                        {
                            $addon = \App\Models\Addon::where('id',$extra)->first();
                            $varianttotal = $varianttotal + $addon->price;
                        }
                        $this->sub_total += $varianttotal * $row['quantity'];
                    }
                    else{
                        $this->sub_total += $product->price*$row['quantity'];
                    }
                    if(isset($row['extras']))
                    {
                        foreach($row['extras'] as $key => $extra)
                        {
                            $addon = \App\Models\Addon::where('id',$extra)->first();
                            $this->sub_total = $this->sub_total + $addon->price;
                        }
                    }
                    
                }
            }

        }
        $this->total = $this->sub_total * ($this->store->tax/100);
        $this->total = $this->total + $this->sub_total;
        $this->total = $this->total + $this->store->service_charge;
        $delivery_charge = 0;
            if($this->order_type == 3 && $this->store->delivery_charge)
            {
                $this->total = $this->total + $this->store->delivery_charge;
                $delivery_charge = $this->store->delivery_charge;
            }
        $couponprice = 0;
        if($this->coupon)
        {
            if($this->coupon->discount_type == 'AMOUNT')
            {
                $couponprice =$this->total * $couponprice/100;
                $this->total  = $this->total - $this->coupon->discount;

            }
            else if($this->coupon->discount_type == 'PERCENTAGE')
            {
                $couponprice = $this->total * $this->coupon->discount/100;
                $this->total  = $this->total - ($this->total * $this->coupon->discount/100);
            }
        }
       
        if($this->total < 0)
        {
            $this->total = 0;
        }
        if($this->order_type != 1)
        {
            $this->table = null;
        }
        if($this->order_type != 3)
        {
            $this->address = null;
        }
        if($this->order_type != 4)
        {
            $this->room = null;
        }
        if($this->payment_type == 4)
        {
            $payment_status = 2;
        }
        if($this->payment_type == 5)
        {
            $payment_status = 2;
            $this->successmsg = $payment_data['reference'];
        }
        $order = Order::create([
            'order_unique_id' => $this->order_uid ?? $this->createOrderUID(),
            'store_id' => $this->store->id,
            'table_no' => $this->table ?? '',
            'customer_name' => $this->name,
            'sub_total' => $this->sub_total,
            'tax' => $this->sub_total * ($this->store->tax/100),
            'store_charge' => $this->store->store_charge,
            'total' => $this->total,
            'comments' => $this->comments,
            'order_type' => $this->order_type,
            'payment_type' => $this->payment_type,
            'address' => $this->address ?? null,
            'customer_phone' => $this->phone_number,
            'room_number' => $this->room,
            'discount' => $this->coupon->discount ?? 0,
            'dob_customer'  => $this->dob,
            'payment_status' => $payment_status,
            'delivery_charge'   => $delivery_charge ?? null,
        ]);
        $varianttotal =0;
        $variantname = '';
        foreach($cart as $key => $row)
        {
            $product = Product::where('id',$key)->where('is_active',1)->first();
            if($product)
                {
                    if(isset($row['variant']))
                    {
                        foreach($row['variant'] as $key => $variant)
                        {
                            $addon = \App\Models\Addon::where('id',$variant)->first();
                            $varianttotal += $addon->price;
                            $variantname =  $variantname.' '.$addon->addon_name;
                        }
                        $orderdetail = OrderDetails::create([
                            'order_id' => $order->id,
                            'price' => $varianttotal*$row['quantity'],
                            'quantity' => $row['quantity'],
                            'name' => $product->name.'('.$variantname.')',
                        ]);
                    }
                    else{
                        $orderdetail = OrderDetails::create([
                            'order_id' => $order->id,
                            'price' => $product->price*$row['quantity'],
                            'quantity' => $row['quantity'],
                            'name' => $product->name
                        ]);
                    }
                    if(isset($row['extras']))
                    {
                        foreach($row['extras'] as $key => $extra)
                        {
                            $addon = \App\Models\Addon::where('id',$key)->first();
                            $addonsave = new \App\Models\OrderDetailAddon;
                            $addonsave->addon_name = $addon->addon_name;
                            $addonsave->addon_price = $addon->price;
                            $addonsave->order_detail_id = $orderdetail->id;
                            $addonsave->addon_count = 1;
                            $addonsave->save();
                            
                        }
                    }
                   
                }
            session()->forget('cart'.$this->store->id);
        }
        $this->showcheckout = false;
        $this->showsuccess = true;
        session()->put('mobile_number',$this->phone_number);
        $this->order_id = $order->order_unique_id;
        $this->final_order = Order::with('orderDetails.OrderDetailsExtraAddon')->where('id',$order->id)->get()->toArray();
        $this->order = $order;
    }

    public function updated($name,$value)
    {
        $this->resetErrorBag();

    }

    public function createOrderUID()
    {
        return "ODR-" . time();
    }

    public function paymentFail($data)
    {
        $data = json_encode($data);
        return redirect('/store/payment/fail/'.$this->store->id.'/'.base64_encode($data));
    }

    public function applycoupon()
    {
        $coupon = \App\Models\Coupon::where('store_id',$this->store->id)->where('code',$this->coupon_code)->first();
        if(!$coupon)
        {
            $this->addError('coupon', $this->selected_language->data['error_coupon_not_valid'] ?? 'Entered Coupon is not valid');
        }
        else {
            $this->addError('coupon_success', $this->selected_language->data['success_coupon'] ?? 'Coupon has been applied');
            $this->coupon = $coupon;
        }
    }
    public function stripeError($data)
    {
        $this->stripeerror = 'xD';
    }

    public function paypal($data)
    {
        if($data['status'] == 'COMPLETED')
        {
            $this->successmsg = $data['id'];
            $this->confirmPayment();
        }
        else{
            $this->payment_fail == true;
        }
    }

    public function getCartCount()
    {
        $cart = session()->get('cart'.$this->store->id);
        if(isset($cart))
        {
            $this->count = count($cart);
        }
    }
}