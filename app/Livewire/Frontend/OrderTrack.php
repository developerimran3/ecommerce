<?php

namespace App\Livewire\Frontend;

use Livewire\Component;

class OrderTrack extends Component
{



    public function render()
    {
        return view('livewire.frontend.order-track')
            ->layout('layouts.frontend');
    }
}
