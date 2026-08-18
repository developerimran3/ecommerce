<?php

namespace App\Livewire\Auth\Admin;

use App\Mail\AdminPasswordResetMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPassword extends Component
{

    public $email = '';

    protected $rules = [
        'email' => 'required|email',
    ];

    public function sendResetLink()
    {
        $this->validate();
        // Find Customer
        $user = User::where('email', $this->email)
            ->whereIn('role', [
                'Administrator',
                'Shop Manager',
                'Editor',
                'Contributor',
            ])
            ->first();


        if (!$user) {

            $this->dispatch(
                'error',
                message: 'We could not find an admin account with this email.'
            );

            return;
        }
        // Create Reset Token
        $token = Password::broker()->createToken($user);
        // Send Email
        Mail::to($user->email)->send(
            new AdminPasswordResetMail($user, $token)
        );

        $this->dispatch(
            'success',
            message: 'If this email is registered, a password reset link has been sent.'
        );

        $this->reset('email');
    }


    public function render()
    {
        return view('livewire.auth.admin.forgot-password')
            ->layout('layouts.guest', ['title' => 'Admin Forgot Password']);
    }
}
