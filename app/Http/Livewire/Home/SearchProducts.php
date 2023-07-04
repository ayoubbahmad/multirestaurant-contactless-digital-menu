<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;
use App\Http\Controllers\TranslationService;
use App\Translation;
use App\Models\Store;
use App\Product;
use App\Category;
use App\Models\Setting;

class SearchProducts extends Component
{
    public $search_query,$store,$view_id,$selected_lanugage,$categories,$products,$selected_category,$count,$favicon,$quantity = [];
    public $selected_product,$customcss;
    public function render()
    {
        return view('livewire.home.search-products')
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
        $translation = new TranslationService();
        if(session()->has('selected_language'))
        {
            $this->selected_language = Translation::where('id',session()->get('selected_language'))->first();
        }
        else{
            $this->selected_language = Translation::where('is_default',1)->first();
        }
        $this->view_id = $view_id;
        if(Store::all()->where('view_id','=',$view_id)->count() ==0){
            abort(404);
        }
        $this->store = Store::all()->where('view_id','=',$view_id)->first();

        if($this->store->search_enable != 1)
        {
            abort(404);
        }

        $this->account_info = $this->store;
        $this->categories = Category::where('store_id',$this->store->id)->where('is_active',1)->has('productinfos')->get();
        $this->products = Product::where('store_id',$this->store->id)->where('is_active',1)->limit(10)->get();
        $cart = session()->get('cart'.$this->store->id);
        if(isset($cart))
        {
            foreach($cart as $key => $value)
            {
                $this->quantity[$key] = $cart[$key]['quantity'];
            }
        }
    }

    public function updated($name,$value)
    {
        if($name == 'search_query')
        {
            if($this->selected_category)
            {
                $this->products = Product::where('name', 'like', '%' . $value . '%')->where('category_id',$this->selected_category->id)->where('store_id',$this->store->id)->where('is_active',1)->get();
            }
            else{
                $this->products = Product::where('name', 'like', '%' . $value . '%')->where('store_id',$this->store->id)->where('is_active',1)->get();

            }
        }
        if($name == 'search_query' && $value == '')
        {
            if($this->selected_category)
            {
                $this->products = Product::where('category_id',$this->selected_category->id)->where('store_id',$this->store->id)->where('is_active',1)->get();

            }
            else{
                $this->products = Product::where('store_id',$this->store->id)->where('is_active',1)->limit(10)->get();
            }
            
        }
    }

    public function selectCategory($id)
    {
        if($this->selected_category)
        {
            if($this->selected_category->id == $id)
            {
                $this->selected_category = null;
                $this->products = Product::where('store_id',$this->store->id)->where('is_active',1)->limit(10)->get();

            }
            else{
                $this->selected_category = Category::where('id',$id)->first();
                $this->products = Product::where('category_id',$this->selected_category->id)->where('store_id',$this->store->id)->where('is_active',1)->get();

            }
        }
        else{
            $this->selected_category = Category::where('id',$id)->first();
            $this->products = Product::where('category_id',$this->selected_category->id)->where('store_id',$this->store->id)->where('is_active',1)->get();
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
    public function additem($id)
    { 
        $product = Product::where('id',$id)->first();
        $this->selected_product = $product;
        if(count($product->addonItems) > 0)
        {
            $this->variant = null;
            $this->extras = [];
            $this->emit('openModal');
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
            $this->quantity[$id] = 1; 
            //$this->regenitemscount();
            $this->emit('closeModal');
            return 1;
        }
        if(!isset($cart[$id]))
        {
            $this->quantity[$id] =1;
            $cart[$id] = [
                "name"          => $product->name,
                "quantity"      => $this->quantity[$id],
                "variant"       => $this->variant,
                "extras"        => $this->extras,
            ];
            $this->variant = [];
            $this->extras = [];
            session()->put('cart'.$this->store->id, $cart);
            $this->emit('closeModal');
            return 1;
        }
        $this->quantity[$id] = $cart[$id]['quantity'];
        $this->quantity[$id] ++;
        $cart[$id] = [
            "name"          => $product->name,
            "quantity"      => $this->quantity[$id],
            "variant"       => $this->variant,
            "extras"        => $this->extras,
        ];
        $this->variant = [];
        $this->extras = [];
        $this->emit('closeModal');
        session()->put('cart'.$this->store->id, $cart);
    }
}
