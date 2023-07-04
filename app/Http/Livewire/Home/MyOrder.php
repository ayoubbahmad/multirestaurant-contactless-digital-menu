<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;
use App\Models\Store;
use App\Models\Order;
use App\Translation;
use App\Http\Controllers\TranslationService;
use App\Models\WaiterCall;
use App\Models\OrderRating;
use App\Models\Setting;

class MyOrder extends Component
{
    public $view_id,$mobile_number,$store,$openinput=true,$openlist=false,$orders,$selected_language,$account_info,$calledWaiter = false,$order,$comments,$count;
    public $favicon,$editorder,$staramount,$mystaramount,$ratingcomments,$customcss;
    protected $rules = [
        'mobile_number' => 'required|numeric',
    ];
    public function render()
    {
        return view('livewire.home.my-order')
        ->extends('layouts.home_layout',['title' => $this->store->store_name,'favicon' => $this->favicon,'customcss' => $this->customcss])
        ->section('content');
    }
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
        if(!$view_id)
        {
            abort(404);
        }
        if(Store::all()->where('view_id','=',$view_id)->count() ==0){
            abort(404);
        }
        $this->store = Store::all()->where('view_id','=',$view_id)->first();
        $translation = new TranslationService();
        
        if(session()->has('selected_language'))
        {
            $this->selected_language = Translation::where('id',session()->get('selected_language'))->first();
        }
        else{
            $this->selected_language = Translation::where('is_default',1)->first();
        }
        if(session()->has('mobile_number'))
        {
            $this->openinput = false;
            $this->openlist = true;
            $this->mobile_number = session()->get('mobile_number');
            $this->orders = Order::where('customer_phone',$this->mobile_number)->where('store_id',$this->store->id)->get();
        }
        $this->view_id = $view_id;
        $this->account_info = $this->store;
    }

    public function viewOrders()
    {
        $this->validate();
        $this->orders = Order::where('customer_phone',$this->mobile_number)->where('store_id',$this->store->id)->orderBy('created_at','DESC')->get();
        if(count($this->orders) <= 0)
        {
            $this->addError('mobile_number',$this->selected_language->data['no_orders_found'] ?? 'No Orders were found');
            return 0;
        }
        session()->put('mobile_number',$this->mobile_number);
        $this->openinput = false;
        $this->openlist = true;
    }

    public function callWaiter($id)
    {
        $this->order = Order::where('id',$id)->first();
        
        $this->emit('openModal');
    }
    public function confirmWaiterCall()
    {
        if($this->order)
        {
            $this->order->call_waiter_enabled = 0;
            $this->order->save();
            if(session()->has('mobile_number'))
            {
                $mobno = session()->get('mobile_number');
            }

            $completed = WaiterCall::create([
                'customer_name'  => $this->order->customer_name,
                'customer_phone' => $this->order->customer_phone,
                'table_name'    => $this->order->table_no,
                'store_id'      => $this->store->id,
                'order_id'      => $this->order->id,
                'comment'      => $this->comments,
            ]);
            $this->calledWaiter = true;
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

    public function rateOrder($id)
    {
        $this->mystaramount = 0;
        $this->editoder = null;
        $this->ratingcomments = '';
        if($id)
        {
            $this->editorder = Order::where('id',$id)->first();
            if($this->editorder)
            {
                $rating = OrderRating::where('order_id',$id)->first();
                if($rating)
                {
                    $this->mystaramount = $rating->rating;
                    $this->ratingcomments = $rating->comments;
                }
            }
        }
    }

    public function saveRating()
    {
        if($this->editorder)
        {
            $rating = OrderRating::where('order_id',$this->editorder->id)->first();
            if($rating)
            {
                if($this->mystaramount == 0 || $this->mystaramount == null)
                {
                    $this->addError('ratingerror','Please select a rating');
                }
                $rating->rating = $this->mystaramount;
                $rating->comments = $this->ratingcomments;
                $rating->save();
                $this->emit('hidemodal');
                return 1;
            }
            if($this->mystaramount == 0 || $this->mystaramount == null)
            {
                $this->addError('ratingerror','Please select a rating');
            }
            else{
                $rating = OrderRating::create([
                    'store_id' => $this->store->id,
                    'order_id'  => $this->editorder->id,
                    'comments'  => $this->ratingcomments,
                    'rating'    => $this->mystaramount,
                ]);
                $this->mystaramount = 0;
                $this->ratingcomments = '';
                $this->emit('hidemodal');
            }
        }
       
    }
}