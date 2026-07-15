<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class Profile extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $phone;
    public $address;
    public $image;

    public function mount()
    {
        $user = Auth::user();

        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->address = $user->address;
    }

    public function updateProfile()
    {
        $user = Auth::user();

        $data = [
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
        ];

        if ($this->image) {

            $data['image'] = $this->image
                ->store('users', 'public');
        }

        $user->update($data);

        $this->dispatch(
            'success',
            message: 'Profile updated successfully.'
        );
    }

    public function render()
    {
        return view(
            'livewire.admin.profile'
        )->layout('layouts.admin');
    }
}
