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

    protected function rules()
    {
        return [
            'email' => 'required|email',

            'password' => [
                'required',
                'min:6',
                'confirmed',
            ],
        ];
    }

    public function resetPassword()
    {
        $this->validate();

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

        /*
        |--------------------------------------------------------------------------
        | Success
        |--------------------------------------------------------------------------
        */

        if ($status === Password::PASSWORD_RESET) {

            session()->flash(
                'success',
                'Your password has been reset successfully. Please login.'
            );

            return redirect()->route('customer.login');
        }

        /*
        |--------------------------------------------------------------------------
        | Error
        |--------------------------------------------------------------------------
        */

        $this->addError(
            'email',
            __($status)
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