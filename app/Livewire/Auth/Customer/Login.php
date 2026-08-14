<?php

namespace App\Livewire\Auth\Customer;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use function Laravel\Prompts\title;

class Login extends Component
{
    public $phone = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'phone'    => 'required|string',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        /*
        |--------------------------------------------------------------------------
        | Customer Credentials
        |--------------------------------------------------------------------------
        */

        $credentials = [
            'phone'    => $this->phone,
            'password' => $this->password,
            'role'     => 'customer',
        ];

        /*
        |--------------------------------------------------------------------------
        | Login Attempt
        |--------------------------------------------------------------------------
        */

        if (!Auth::attempt($credentials, $this->remember)) {

            $this->addError(
                'phone',
                'Invalid phone number or password.'
            );

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Regenerate Session
        |--------------------------------------------------------------------------
        */

        session()->regenerate();

        /*
        |--------------------------------------------------------------------------
        | Logged In User
        |--------------------------------------------------------------------------
        */

        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Active User Check
        |--------------------------------------------------------------------------
        */

        if ($user->status == 0) {

            Auth::logout();

            session()->invalidate();
            session()->regenerateToken();

            $this->addError(
                'phone',
                'Your account is inactive. Please contact Administrator.'
            );

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Login Successful
        |--------------------------------------------------------------------------
        */

        session()->flash(
            'success',
            'Login successful.'
        );

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.auth.customer.login')
            ->layout('layouts.frontend', ['title' => 'Customer Login']);
    }
}
