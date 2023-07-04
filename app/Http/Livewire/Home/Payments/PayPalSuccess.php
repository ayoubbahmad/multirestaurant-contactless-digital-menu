<?php

namespace App\Http\Livewire\Home\Payments;

use Livewire\Component;

class PayPalSuccess extends Component
{
    public function render()
    {
        return view('livewire.home.payments.pay-pal-success')
        ->extends('layouts.home_layout')
        ->section('content');
    }
    public function mount($data)
    {
        
    }
}
