<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\Hash;



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

        $this->name    = $user->name;
        $this->email   = $user->email;
        $this->phone   = $user->phone;
        $this->address = $user->address;
        $this->image   = $user->image;
    }

    protected $messages = [
        'image.dimensions' => 'Profile image must be exactly 300x300 pixels. |dimensions:max_width=300,max_height=300',
        'image.image' => 'Only image file is allowed.',
        'image.mimes' => 'Only jpg, jpeg, png, webp format allowed.',
    ];

    /** Update Profile */
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
            // পুরাতন ছবি delete করতে চাইলে
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
            $imagePath = $this->image->store('users/admin', 'public');
        }

        $user->update([
            'name'    => $this->name,
            'phone'   => $this->phone,
            'address' => $this->address,
            'image'   => $imagePath,
        ]);
        $this->dispatch('close-modal');
        $this->dispatch(
            'success',
            message: 'Profile updated successfully.'
        );
    }


    /**
     * Change Password
     */
    public $current_password;
    public $password;
    public $password_confirmation;

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        // পুরাতন password check
        if (!Hash::check($this->current_password, $user->password)) {
            $this->addError(
                'current_password',
                'Current password is incorrect.'
            );
            return;
        }
        // নতুন password update
        $user->update([
            'password' => Hash::make($this->password),
        ]);

        $this->reset([
            'current_password',
            'password',
            'password_confirmation'
        ]);
        $this->dispatch(
            'success',
            message: 'Password changed successfully.'
        );
    }


    public function render()
    {
        return view('livewire.admin.profile')
            ->layout('layouts.admin');
    }
}
