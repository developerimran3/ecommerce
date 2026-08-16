<?php

namespace App\Livewire\Auth\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'email'    => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        if (!Auth::attempt([
            'email'    => $this->email,
            'password' => $this->password,
        ], $this->remember)) {

            $this->addError(
                'email',
                'Invalid user email or password.'
            );
            return;
        }
        session()->regenerate();
        $user = Auth::user();
        $allowedRoles = [
            'Administrator',
            'Editor',
            'Contributor',
            'Shop Manager',
        ];

        if (!in_array($user->role, $allowedRoles)) {
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();
            $this->addError(
                'email',
                'You are not authorized to access the Admin Panel.'
            );
            return;
        }
        if ($user->status == 0) {
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();
            $this->addError(
                'email',
                'Your account is Inactive. Please contact Administrator.'
            );
            return;
        }

        $this->dispatch(
            'success',
            message: 'Login successful..'
        );
        return redirect()->route('admin.dashboard');
    }

    public function render()
    {
        return view('livewire.auth.admin.login')
            ->layout('layouts.guest', ['title' => 'Admin Login']);
    }
}
