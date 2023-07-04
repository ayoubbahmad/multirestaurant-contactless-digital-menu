<?php

namespace App\Http\Livewire\Home\Payments;
use App\Category;
use App\Homes;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TranslationService;
use App\Models\Setting;
use App\Models\Store;
use App\Models\Order;
use App\Models\StoreSubscription;
use App\Product;
use App\Slider;
use App\Testimonial;
use App\Translation;
use App\User;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Razorpay\Api\Api;
class Fail extends Component
{
    public $errordata,$view_id,$store,$count,$customcss;
    public function render()
    {
        return view('livewire.home.payments.razor-pay')
        ->extends('layouts.home_layout',['customcss' => $this->customcss])
        ->section('content');
    }

    public function mount($view_id,$data)
    {
        $this->store = Store::all()->where('id','=',$view_id)->first();
        $customcss = Setting::where('key','CustomCss')->first();
        if($customcss)
        {
            $this->customcss = $customcss->value;
        }
        $this->view_id = $this->store->view_id;
        try{
            $data = base64_decode($data);
            $data = json_decode($data,true);
            $this->errordata = $data;
        }
        catch(\Exception $e)
        {
            return redirect('/store/'.$this->store->view_id);
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
