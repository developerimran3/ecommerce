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

    public $search = '';



    protected function rules()
    {
        return [

            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email,' . $this->user_id,

            'phone' => 'nullable|string|max:20',

            'address' => 'nullable|string',
        ];
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $this->user_id = $user->id;

        $this->name = $user->name;

        $this->email = $user->email;

        $this->phone = $user->phone;

        $this->address = $user->address;
    }


    public function update()
    {
        $this->validate();

        User::findOrFail($this->user_id)->update([

            'name' => $this->name,

            'email' => $this->email,

            'phone' => $this->phone,

            'address' => $this->address,
        ]);

        $this->dispatch(
            'success',
            message: 'User updated successfully.'
        );

        $this->reset([
            'user_id',
            'name',
            'email',
            'phone',
            'address',
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
