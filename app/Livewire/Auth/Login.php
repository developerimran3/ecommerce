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

        'email' => 'required|email',

        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        if (! Auth::attempt([
            'email' => $this->email,
            'password' => $this->password,
        ], $this->remember)) {

            $this->addError(
                'email',
                'Invalid email or password.'
            );

            return;
        }

        session()->regenerate();

        $user = auth()->user();

        if ($user->role === 'Administrator') {

            return redirect()->route('admin.dashboard');
        }



        return redirect()->route('home');
    }

    public function render()
    {
        return view(
            'livewire.auth.login'
        )->layout('layouts.guest');
    }
}
