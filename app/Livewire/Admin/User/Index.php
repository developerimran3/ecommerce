<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;




class Index extends Component
{
    use WithPagination;
    protected string $paginationTheme = 'bootstrap';

    public $user_id;
    public $name;
    public $email;
    public $phone;
    public $address;
    public $status;
    public $role;

    public $search = '';


    public function resetInput()
    {
        $this->reset([
            'user_id',
            'name',
            'email',
            'phone',
            'role',
            'address',
        ]);

        $this->status = true;
    }

    public function create()
    {
        // Only Administrator can create user
        if (auth()->user()->role !== 'Administrator') {
            $this->dispatch(
                'error',
                message: 'Only Administrator can create new user.'
            );
            return;
        }
        $this->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role'  => 'required',
        ]);

        User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'status'   => $this->status,
            'role'     => $this->role,
            'password' => Hash::make('12345678'),
        ]);

        $this->dispatch(
            'success',
            message: 'New user created successfully.'
        );

        $this->dispatch('close-modal');
        $this->reset();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
    }

    public function update()
    {
        $currentUser = auth()->user();
        // Only Administrator and Editor can access
        if (!in_array($currentUser->role, ['Administrator', 'Editor'])) {
            $this->dispatch(
                'error',
                message: 'You do not have permission to change user role.'
            );
            return;
        }

        $user = User::findOrFail($this->user_id);

        // নিজের role নিজে change করতে পারবে না
        if ($user->id === $currentUser->id) {
            $this->dispatch(
                'error',
                message: 'You cannot change your own role.'
            );
            return;
        }
        // Editor Administrator এর role change করতে পারবে না
        if ($currentUser->role === 'Editor' && $user->role === 'Administrator') {
            $this->dispatch(
                'error',
                message: 'Editor cannot change Administrator role.'
            );
            return;
        }

        $user->update([
            'role' => $this->role,
        ]);

        $this->dispatch(
            'success',
            message: 'User role updated successfully.'
        );

        $this->dispatch('close-modal');
        $this->reset();
    }

    public function changeStatus($id)
    {
        // Only Administrator can change status
        if (auth()->user()->role !== 'Administrator' && auth()->user()->role !== 'Editor') {

            $this->dispatch(
                'error',
                message: 'You do not have permission to change user status.'
            );
            return;
        }
        $user = User::findOrFail($id);
        // নিজের status নিজে change করতে পারবে না
        if ($user->id === auth()->id()) {

            $this->dispatch(
                'error',
                message: 'You cannot change your own status.'
            );

            return;
        }
        $user->update([
            'status' => !$user->status,
        ]);

        $this->dispatch(
            'success',
            message: 'User status updated successfully.'
        );
    }

    public function delete($id)
    {
        // Only Administrator can change status
        if (auth()->user()->role !== 'Administrator') {

            $this->dispatch(
                'error',
                message: 'You do not have permission to change user status.'
            );
            return;
        }
        $user = User::findOrFail($id);

        // নিজের account delete করতে পারবে না
        if ($user->id === auth()->id()) {
            $this->dispatch(
                'error',
                message: 'You cannot delete your own account.'
            );
            return;
        }

        // Profile image delete
        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }

        // User delete
        $user->delete();

        $this->dispatch(
            'success',
            message: 'User and profile photo deleted successfully.'
        );
    }



    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where(
                        'name',
                        'like',
                        '%' . $this->search . '%'
                    )
                        ->orWhere(
                            'email',
                            'like',
                            '%' . $this->search . '%'
                        )
                        ->orWhere(
                            'phone',
                            'like',
                            '%' . $this->search . '%'
                        );
                });
            })
            ->latest()
            ->paginate(10);

        return view(
            'livewire.admin.user.index',
            compact('users')
        )->layout('layouts.admin', ['title' => 'Users']);
    }
}
