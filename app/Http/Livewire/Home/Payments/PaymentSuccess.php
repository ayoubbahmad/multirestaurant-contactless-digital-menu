<?php

namespace App\Http\Livewire\Home\Payments;

use Livewire\Component;
use App\Models\Order;
use App\Models\Setting;

class PaymentSuccess extends Component
{
    public $view_id,$order,$final_order,$store,$successmsg,$count,$customcss;
    public function render()
    {
        return view('livewire.home.payment-success')
        ->extends('layouts.home_layout',['customcss' => $this->customcss])
        ->section('content');
    }

    public function mount($order_id = null)
    {
        $order_id = base64_decode($order_id);
        if(!$order_id)
        {
            abort(404);
        }
        $customcss = Setting::where('key','CustomCss')->first();
        if($customcss)
        {
            $this->customcss = $customcss->value;
        }
        $this->order = Order::where('order_unique_id',$order_id)->first();
        $this->order->status = 1;
        $this->payment_status = 1; 
        $this->order->save();
        $store = \App\Models\Store::where('id',$this->order->store_id)->first();
        $this->store = $store;
        $this->view_id = $store->view_id;
        $this->final_order = Order::with('orderDetails.OrderDetailsExtraAddon')->where('id',$this->order->id)->get()->toArray();
        session()->forget('cart'.$store->id);
        
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