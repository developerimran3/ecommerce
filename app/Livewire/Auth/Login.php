<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'email'     => 'required|email',
        'password'  => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();
        if (! Auth::attempt([
            'email'     => $this->email,
            'password'  => $this->password,
        ], $this->remember)) {
            $this->addError(
                'email',
                'Invalid user email or password.'
            );
            return;
        }

        session()->regenerate();

        // Inactive User Check
        $user = auth()->user();
        if ($user->status == 0) {
            Auth::logout();

            session()->invalidate();
            session()->regenerateToken();

            $this->addError(
                'email',
                'Your account is Inactive. Please contact Administrator.'
            );

            // session()->flash(
            //     'error',
            //     'Your account is inactive. Please contact administrator.'
            // );
            return;
        }

        session()->flash(
            'success',
            'Login successful.'
        );


        if ($user->role === 'Customer') {
            return redirect()->route('home');
        }
        return redirect()->route('admin.dashboard');
    }


    public function render()
    {
        return view(
            'livewire.auth.login'
        )->layout('layouts.guest');
    }
}
