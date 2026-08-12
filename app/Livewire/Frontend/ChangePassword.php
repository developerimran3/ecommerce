<?php

namespace App\Livewire\Frontend;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{
    // Password fields
    public $current_password = '';
    public $password = '';
    public $password_confirmation = '';

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($this->current_password, $user->password)) {

            $this->addError(
                'current_password',
                'Current password is incorrect.'
            );

            return;
        }

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
            message: 'Password updated successfully.'
        );
    }


    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.frontend.change-password')
            ->layout('layouts.frontend');
    }
}
