<?php

namespace App\Livewire\Auth\Customer;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Livewire\Component;

class ResetPassword extends Component
{
    public $token;
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    public function mount($token)
    {
        $this->token = $token;

        $this->email = request()->query('email', '');
    }

    

    public function resetPassword()
    {
       $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Reset Password
        |--------------------------------------------------------------------------
        */

        $status = Password::broker()->reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token,
            ],

            function ($user) {

                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

      //success
        if ($status === Password::PASSWORD_RESET) {

            $this->dispatch(
            'success',
            message: 'Your password has been reset successfully. Please login.'
        );

            return redirect()->route('customer.login');
        }

         $this->dispatch(
                'error',
                message: __($status)
            );
    }

    public function render()
    {
        return view('livewire.auth.customer.reset-password')
            ->layout('layouts.frontend', [
                'title' => 'Reset Password'
            ]);
    }
}