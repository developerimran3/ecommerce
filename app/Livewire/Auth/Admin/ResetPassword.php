<?php

namespace App\Livewire\Auth\Admin;

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

        $this->email = request()->email ?? '';
    }

    public function resetPassword()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            [
                'email'   => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token'  => $this->token,
            ],
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {

            $this->dispatch(
                'success',
                message: 'Your password has been reset successfully.'
            );
        }

        $this->dispatch(
            'error',
            message: __($status)
        );

        // $this->addError(
        //     'email',
        //     __($status)
        // );
    }


    public function render()
    {
        return view('livewire.auth.admin.reset-password')
            ->layout('layouts.guest', ['title' => 'Admin Reset Password']);
    }
}
