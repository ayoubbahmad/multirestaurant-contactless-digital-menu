<?php

namespace App\Http\Livewire\Home;

use App\Models\Setting;
use Livewire\Component;
use App\Models\Store;
use App\Product;

class ProductDetailPage extends Component
{
    public $store,$product,$view_id,$quantity,$account_info,$selected_product,$favicon,$customcss;
    public function render()
    {
        return view('livewire.home.product-detail-page')
        ->extends('layouts.home_layout',['title' => $this->store->store_name,'favicon' => $this->favicon,'customcss' => $this->customcss])
        ->section('content');
    }

    public function mount($view_id,$product_id)
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
        $this->store = Store::where('view_id',$view_id)->first();
        $this->product = Product::where('id',$product_id)->first();
        if(!$this->store || !$this->product || $this->product->store_id != $this->store->id)
        {
            abort(404);
        }
        $this->view_id = $this->store->view_id;
        $cart = session()->get('cart'.$this->store->id);

        if(isset($cart))
        {
            foreach($cart as $key => $value)
            {
                if($key == $this->product->id )
                {
                    $this->quantity = $cart[$key]['quantity'];
                }
            }
            if(!$this->quantity)
            {
                $this->quantity = 0;
            }
        }
        else{
            $this->quantity = 0;
        }
    }

    public function updated($name,$value)
    {
        
        
    }
    public function additem($id)
    { 
        
        $product = Product::where('id',$id)->first();
        if(count($product->addonItems) > 0)
        {
            $this->variant = null;
            $this->extras = [];
            $this->emit('openModal');
            $this->selected_product = $product;
            return 1;
        }
        $cart = session()->get('cart'.$this->store->id);
        if(!$cart) {
            $cart = [
                $id => [
                    "name"          => $product->name,
                    "quantity"      => 1,
                ]
            ];
            session()->put('cart'.$this->store->id, $cart);
            $this->quantity = 1;
            
            //$this->regenitemscount();
            return 1;
        }
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
            $this->quantity = $cart[$id]['quantity'];
            session()->put('cart'.$this->store->id, $cart);
            //$this->regenitemscount();         
            return 1;
        }
        $cart[$id] = [
            "name"          => $product->name,
            "quantity"      => 1
        ];
        $this->quantity = 1;
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
                $this->quantity --;
                session()->put('cart'.$this->store->id, $cart);
                return 1;
            }
            else {
                unset($cart[$id]);
                $this->quantity = 0;
                session()->put('cart'.$this->store->id, $cart);
                return 1;
            }
        }
        
    }

    public function saveAddonChanges()
    {
        $product = $this->selected_product;
        $id = $product->id;
        $cart = session()->get('cart'.$this->store->id);
        if(!$cart) {
            $cart = [
                $id => [
                    "name"          => $product->name,
                    "quantity"      => 1,
                    "variant"       => $this->variant,
                    "extras"        => $this->extras,
                ]
            ];
            session()->put('cart'.$this->store->id, $cart);
            $this->quantity = 1; 
            //$this->regenitemscount();
            $this->emit('closeModal');
            return 1;
        }
        if(!isset($cart[$id]))
        {
            $this->quantity =1;
            $cart[$id] = [
                "name"          => $product->name,
                "quantity"      => $this->quantity,
                "variant"       => $this->variant,
                "extras"        => $this->extras,
            ];
            $this->variant = [];
            $this->extras = [];
            session()->put('cart'.$this->store->id, $cart);
            $this->emit('closeModal');
            return 1;
        }
        $this->quantity = $cart[$id]['quantity'];
        $this->quantity ++;
        $cart[$id] = [
            "name"          => $product->name,
            "quantity"      => $this->quantity,
            "variant"       => $this->variant,
            "extras"        => $this->extras,
        ];
        $this->variant = [];
        $this->extras = [];
        $this->emit('closeModal');
        session()->put('cart'.$this->store->id, $cart);
    }

}
