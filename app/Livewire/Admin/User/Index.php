<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;




class Index extends Component
{
    use WithPagination;

    public $user_id;
    public $name;
    public $email;
    public $phone;
    public $address;
    public $status;
    public $role;

    public $search = '';




    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->status = $user->status;
        $this->role = $user->role;
        $this->address = $user->address;
    }


    public function update()
    {

        User::findOrFail($this->user_id)->update([
            'status' => $this->status,
            'role' => $this->role,

        ]);

        $this->dispatch(
            'success',
            message: 'User updated successfully.'
        );

        $this->reset([
            'status',
            'role',
        ]);
    }



    public function delete($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {

            $this->dispatch(
                'error',
                message: 'You cannot delete your own account.'
            );

            return;
        }

        $user->delete();

        $this->dispatch(
            'success',
            message: 'User deleted successfully.'
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
        )->layout('layouts.admin');
    }
}
