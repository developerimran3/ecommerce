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



    public function edit($id)
    {
        Auth::user($id);
        $this->dispatch('open-modal');
    }
    /** Update Profile */
    public function updateProfile()
    {
        $this->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'address' => 'nullable|string',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = Auth::user();
        $imagePath = $user->image;

        if ($this->image) {
            // old image delete
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            // $user->role use folder create
            $roleName = $user->role ?? 'customer';
            $folder = 'users/' . strtolower($roleName);

            // file name create
            $fileName = strtolower(str_replace(' ', '', $this->name)) . "_{$this->phone}." . $this->image->extension();

            // upload file name
            $imagePath = $this->image->storeAs($folder, $fileName, 'public');
        }

        $user->update([
            'name'    => $this->name,
            'phone'   => $this->phone,
            'address' => $this->address,
            'image'   => $imagePath,
        ]);

        $this->reset('image');
        $this->dispatch('close-modal');
        $this->dispatch('success', message: 'Your Profile updated successfully.');
    }


    /*
    |--------------------------------------------------------------------------
    | Change Password
    |--------------------------------------------------------------------------
    */

    public $current_password;
    public $password;
    public $password_confirmation;

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();
        // Current password check
        if (!Hash::check($this->current_password, $user->password)) {
            $this->addError(
                'current_password',
                'Current password is incorrect.'
            );
            return;
        }
        // New password update
        $user->update([
            'password' => Hash::make($this->password),
        ]);
        $this->reset([
            'current_password',
            'password',
            'password_confirmation',
        ]);
        $this->dispatch(
            'success',
            message: 'Password changed successfully.'
        );
    }


    public function mount()
    {
        $user = Auth::user();

        $this->name    = $user->name;
        $this->email   = $user->email;
        $this->phone   = $user->phone;
        $this->address = $user->address;
        $this->image   = null;
    }

    public function render()
    {
        return view('livewire.admin.profile')
            ->layout('layouts.admin', ['title' => 'Profile']);
    }
}
