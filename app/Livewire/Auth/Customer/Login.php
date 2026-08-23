<?php

namespace App\Livewire\Auth\Customer;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $auth = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'auth'      => 'required|string',
        'password'  => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();
        // Determine Email or Phone
        $loginField = filter_var($this->auth, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'phone';

        //Customer Credentials
        $credentials = [
            $loginField => $this->auth,
            'password'  => $this->password,
            'role'      => 'Customer',
        ];

        //Login Attempt
        if (!Auth::attempt($credentials, $this->remember)) {
            $this->dispatch(
                'error',
                message: 'Invalid email/phone or password.'
            );
            return;
        }

        //Regenerate Session
        session()->regenerate();
        $user = Auth::user();

        // Active User Check
        if ($user->status == 0) {
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();
            $this->dispatch(
                'error',
                message: 'Your account is inactive. Please contact Administrator.'
            );
            return;
        }

        //Login Successful
        $this->dispatch(
            'success',
            message: 'Login successful.'
        );
        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.auth.customer.login')
            ->layout('layouts.frontend', [
                'title' => 'Customer Login'
            ]);
    }
}
