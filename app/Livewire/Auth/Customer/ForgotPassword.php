<?php

namespace App\Livewire\Auth\Customer;


use Illuminate\Support\Facades\Password;
use App\Models\User;
use App\Mail\CustomerPasswordResetMail;
use App\Services\MailConfigService;
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

            $this->dispatch(
                'error',
                message: 'We could not find an admin account with this email.'
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

        app(MailConfigService::class)->send(
            $user->email,
            new CustomerPasswordResetMail($user, $token)
        );


        $this->dispatch(
            'success',
            message: 'If this email is registered, a password reset link has been sent.'
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
