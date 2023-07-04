<?php

namespace App\Http\Livewire\Home\Payments;

use Livewire\Component;
use App\Models\Order;
use App\Models\Setting;

class StripeFail extends Component
{
    public $view_id,$order,$store,$count,$customcss;
    public function render()
    {
        return view('livewire.home.payments.stripe-fail')
        ->extends('layouts.Home_layout',['customcss' => $this->customcss])
        ->section('content');
    }

    public function mount($orderid)
    {
        $orderid = base64_decode($orderid);
        $this->order = Order::where('order_unique_id',$orderid)->first();
        if(!$this->order)
        {
            abort(404);
        }
        $customcss = Setting::where('key','CustomCss')->first();
        if($customcss)
        {
            $this->customcss = $customcss->value;
        }
        $store = \App\Models\Store::where('id',$this->order->store_id)->first();
        $this->store = $store;
        $this->view_id = $store->view_id;
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