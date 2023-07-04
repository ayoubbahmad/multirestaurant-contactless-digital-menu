<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;
use App\Translation;
use App\Models\Table;
use App\Models\Store;
use App\Models\WaiterCall;
use App\Http\Controllers\TranslationService;
use App\Models\Setting;

class Settings extends Component
{
    public $languages,$slug,$view_id,$currentlang,$selected_language,$name,$phone_number,$table,$comments,$tables,$completed,$count;
    public $store,$favicon,$customcss;
    public function render()
    {
        return view('livewire.home.settings')
        ->extends('layouts.home_layout',['title' => $this->store->store_name,'favicon' => $this->favicon,'customcss' => $this->customcss])
        ->section('content');
    }

    protected $rules = [
        'name' => 'required',
        'phone_number' => 'required',
        'table' => 'required'
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
        $this->view_id = $view_id;
        if(Store::all()->where('view_id','=',$view_id)->count() ==0){
            abort(404);
        }
        $this->store = Store::all()->where('view_id','=',$view_id)->first();
        $this->tables = \App\Models\Table::where('store_id',$this->store->id)->where('is_active',1)->get();
        $translation = new TranslationService();
        $this->languages = $translation->languages();
        if(session()->has('selected_language'))
        {
            $this->selected_language = Translation::where('id',session()->get('selected_language'))->first();
            $this->currentlang = $this->selected_language->id;            
        }
        else{
            $this->selected_language = Translation::where('is_default',1)->first();
        }
        if(session()->has('userSelectedTable'))
        {
            
            $tableid = session()->get('userSelectedTable');
            $table = \App\Models\Table::where('id',$tableid)->first();
            if($table)
            {
                $this->table = $table->id;

            }
        }
    }

    public function changeLanguage($id)
    {
        $language = Translation::where('id',$id)->first();
        session()->put('selected_language',$language->id);
        return redirect('/store/'.$this->view_id.'/settings/');
    }

    public function updatedCurrentlang($id)
    {
        $language = Translation::where('id',$id)->first();
        session()->put('selected_language',$language->id);
        return redirect('/store/'.$this->view_id.'/settings/');
    }

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
