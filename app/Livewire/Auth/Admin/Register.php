<?php

namespace App\Livewire\Auth\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $name = '';
    public $email = '';
    public $phone = '';
    public $password = '';
    public $password_confirmation = '';
    public $role = '';

    protected $rules = [
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|max:255|unique:users,email',
        'phone'    => 'required|string|max:20',
        'password' => 'required|min:8|confirmed',
        'role'     => 'required|in:Administrator,Editor,Shop Manager,Contributor',
    ];

    public function register()
    {
        $this->validate();

        // Only one Administrator
        if ($this->role === 'Administrator') {

            $adminExists = User::where('role', 'Administrator')->exists();
            if ($adminExists) {
                $this->dispatch(
                    'error',
                    message: 'Administrator account already exists. Only one Administrator is allowed.'
                );

                return;
            }
        }

        User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'phone'    => $this->phone,
            'password' => Hash::make($this->password),
            'role'     => $this->role,
        ]);

        $roleName = $this->name . ' New account created successfully.';

        $this->reset();

        // Toastr event
        $this->dispatch(
            'success',
            message: $roleName
        );
    }

    public function render()
    {
        return view('livewire.auth.admin.register')
            ->layout('layouts.guest', [
                'title' => 'Admin Register'
            ]);
    }
}
