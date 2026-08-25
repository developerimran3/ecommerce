<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class CustomerManage extends Component
{
    public $search = '';


    public function toggleStatus($id)
    {
        abort_unless(
            auth()->user()->hasPermission('customers.status'),
            403
        );

        $customer = User::findOrFail($id);
        // নিজের status নিজে change করতে পারবে না
        if ($customer->id === auth()->id()) {

            $this->dispatch(
                'error',
                message: 'You cannot change your own status.'
            );
            return;
        }
        $customer->update([
            'status' => !$customer->status,
        ]);

        $this->dispatch(
            'success',
            message: 'Customer status updated successfully.'
        );
    }

    public function delete($id)
    {
        abort_unless(
            auth()->user()->hasPermission('customers.delete'),
            403
        );

        $customer = User::findOrFail($id);
        // নিজের account delete করতে পারবে না
        if ($customer->id === auth()->id()) {
            $this->dispatch(
                'error',
                message: 'You cannot delete your own account.'
            );
            return;
        }

        // Profile image delete
        if ($customer->image && Storage::disk('public')->exists($customer->image)) {
            Storage::disk('public')->delete($customer->image);
        }

        // User delete
        $customer->delete();

        $this->dispatch(
            'success',
            message: 'Customer profile deleted successfully.'
        );
    }



    public function render()
    {
        $customers = User::query()
            ->where('role', 'Customer')
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
        return view('livewire.admin.user.customer-manage', compact('customers'))
            ->layout('layouts.admin', ['title' => 'Customers Manage']);
    }
}
