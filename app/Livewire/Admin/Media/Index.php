<?php

namespace App\Livewire\Admin\Media;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.media.index')->layout('layouts.admin');
    }
}
