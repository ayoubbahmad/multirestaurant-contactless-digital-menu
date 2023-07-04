<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;
use App\Models\Table;

class HomeQRredirect extends Component
{
    public function render()
    {
        return view('livewire.home.home-q-rredirect');
    }

    public function mount($view_id,$table_id)
    {
        $table = Table::where('id',$table_id)->first();
        if(!$table)
        {
            return redirect('/store/'.$view_id);
        }
        else
        {
            session()->put('userSelectedTable',$table_id);
        }
        return redirect('/store/'.$view_id);
    }
}