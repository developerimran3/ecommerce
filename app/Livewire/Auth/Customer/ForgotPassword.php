<?php

namespace App\Livewire\Auth\Customer;

use App\Mail\CustomerPasswordResetMail;
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

        /*
        |--------------------------------------------------------------------------
        | Find Customer
        |--------------------------------------------------------------------------
        */

        $user = User::where('email', $this->email)
            ->where('role', 'Customer')
            ->first();

        /*
        |--------------------------------------------------------------------------
        | Security
        |--------------------------------------------------------------------------
        | Email exists কিনা সেটা user-কে সরাসরি জানাবো না।
        */

        if (!$user) {

            session()->flash(
                'success',
                'If this email is registered, a password reset link has been sent.'
            );

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Create Reset Token
        |--------------------------------------------------------------------------
        */

        $token = Password::broker()->createToken($user);

        /*
        |--------------------------------------------------------------------------
        | Send Email
        |--------------------------------------------------------------------------
        */

        Mail::to($user->email)->send(
            new CustomerPasswordResetMail($user, $token)
        );

        session()->flash(
            'success',
            'If this email is registered, a password reset link has been sent.'
        );

        $this->reset('email');
    }

    public function render()
    {
        return view('livewire.auth.customer.forgot-password')
            ->layout('layouts.frontend', [
                'title' => 'Forgot Password'
            ]);
    }
}
