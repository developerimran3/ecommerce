<?php

namespace App\Livewire\Customer;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

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
        $this->validate([
            'name'  => 'required',
            'phone' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = Auth::user();
        $imagePath = $user->image;

        if ($this->image) {
            // পুরাতন ছবি ডিলিট করা
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            // এক লাইনে নাম ও ফোন যুক্ত করে কাস্টম নামে আপলোড
            $fileName = strtolower(str_replace(' ', '', $this->name)) . "_{$this->phone}." . $this->image->extension();
            $imagePath = $this->image->storeAs('users/customers', $fileName, 'public');
        }


        $user->update([
            'name'    => $this->name,
            'phone'   => $this->phone,
            'address' => $this->address,
            'image'   => $imagePath,
        ]);

        $this->dispatch(
            'success',
            message: 'Profile updated successfully.'
        );
    }

    public function render()
    {
        return view('livewire.customer.profile')
            ->layout('layouts.frontend', ['title' => 'Customer Profile']);
    }
}
