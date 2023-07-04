<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;
use App\Category;
use App\Http\Controllers\TranslationService;
use App\Models\Setting;
use App\Models\Store;
use App\Models\Table;
use App\Product;
use App\Models\StoreSlider;
use App\Translation;

class ShowStore extends Component
{
    public $account_info,$store,$sliders,$recommended,$categories,$products,$quantity = [],$view_id,$search_query,$selected_language,$languages,$variant = [],$extras = [];
    public $selected_product,$count,$tables,$name,$phone_number,$table,$comments,$completed,$favicon,$customcss;
    public function render()
    {
       
        return view('livewire.home.show-store')
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
        $this->languages = $translation->languages();
        if(session()->has('selected_language'))
        {
            $this->selected_language = Translation::where('id',session()->get('selected_language'))->first();
        }
        else{
            $this->selected_language = Translation::where('is_default',1)->where('is_active',1)->first();
        }
        $this->view_id = $view_id;
        $this->account_info = $this->store;
        if(Store::all()->where('view_id','=',$view_id)->count() ==0){
            abort(404);
        }
            $this->store = Store::all()->where('view_id','=',$view_id)->first();
        $this->getCartCount();

        $this->account_info = $this->store;
        $this->sliders = StoreSlider::where('store_id',$this->store->id)->get();
        $this->recommended = Product::all()->where('store_id','=',$this->store->id)
        ->where('is_recommended','=',1)
        ->where('is_active','=',1)->sortBy('name');

        $this->categories = Category::where('store_id','=',$this->store->id)
            ->where('is_active','=',1)->orderby('sort_order','ASC')->get();

        $this->products = Product::all()->where('store_id','=',$this->store->id)
            ->where('is_active','=',1)->sortBy('main_order');
        $cart = session()->get('cart'.$this->store->id);
        if(isset($cart))
        {
            foreach($cart as $key => $value)
            {
                $this->quantity[$key] = $cart[$key]['quantity'];
            }
        }
        $this->tables = \App\Models\Table::where('store_id',$this->store->id)->get();
        if(session()->has('userSelectedTable'))
        {
            
            $tableid = session()->get('userSelectedTable');
            $table = \App\Models\Table::where('id',$tableid)->first();
            if($table)
            {
                $this->table = $table->id;

            }
            $this->order_type = 1;
        }
        
    }
    public function updated($name,$value)
    {
    
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

    public function refresh()
    {
        $this->recommended = Product::all()->where('store_id','=',$this->store->id)
        ->where('is_recommended','=',1)
        ->where('is_active','=',1)->sortBy('name');
    }

    public function changeLanguage($id)
    {
        $language = Translation::where('id',$id)->first();
        session()->put('selected_language',$language->id);
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

    public function getCartCount()
    {
        $cart = session()->get('cart'.$this->store->id);
        if(isset($cart))
        {
            $this->count = count($cart);
        }
    }
    
    protected $rules = [
        'name' => 'required',
        'phone_number' => 'required',
        'table' => 'required'
    ];

    public function callWaiter()
    {
        $this->validate();
        $table = Table::where('id',$this->table)->first();
        if($table)
        {
            $this->completed = \App\Models\WaiterCall::create([
                'customer_name'  => $this->name,
                'customer_phone' => $this->phone_number,
                'table_name'    => $table->table_name,
                'comment'       => $this->comments,
                'store_id'      => $this->store->id,
            ]);
            sendMessageToAllWaiters([
                'title' => 'Waiter Called At '.$table->table_name,
                'body'  => 'Customer Name : '.$this->name, 
                'footer' => $this->comments,
            ],$this->store->id);
        }
        
    }
}
