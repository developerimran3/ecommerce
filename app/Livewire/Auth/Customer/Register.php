<?php

namespace App\Livewire\Auth\Customer;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{


    public $name = '';
    public $email = '';
    public $phone = '';
    public $password = '';
    // public $password_confirmation = '';

    protected $rules = [
        'name'      => 'required|string|max:255',
        'email'     => 'required|email|max:255|unique:users,email',
        'phone'     => 'required|string|unique:users,phone',
        'password'  => 'required|min:8',
    ];

    public function register()
    {
        $this->validate();
        User::create([
            'name'      => $this->name,
            'email'     => $this->email,
            'phone'     => $this->phone,
            'password'  => Hash::make($this->password),
            'role'      => 'Customer',

        ]);
        session()->flash('success', 'Registration successful. Please login.');
        return redirect()->route('customer.login');
    }

    public function render()
    {
        return view('livewire.auth.customer.register')
            ->layout('layouts.frontend', [
                'title' => 'Customer Register'
            ]);
    }
}
