<?php

namespace App\Livewire\Admin\RolePermission;

use App\Models\Permission;
use App\Models\RolePermission;
use Livewire\Component;

class Index extends Component
{

    public $selectedRole = 'Editor';
    public $selectedPermissions = [];

    public function mount()
    {
        abort_unless(
            auth()->user()->hasPermission('permission.view'),
            403
        );
        $this->loadPermissions();
    }

    public function updatedSelectedRole()
    {
        $this->loadPermissions();
    }

    public function loadPermissions()
    {
        $this->selectedPermissions = RolePermission::where(
            'role',
            $this->selectedRole
        )
            ->pluck('permission_id')
            ->map(fn($id) => (string) $id)
            ->toArray();
    }

    public function save()
    {
        abort_unless(
            auth()->user()->hasPermission('permission.edit'),
            403
        );

        if ($this->selectedRole === 'Administrator') {
            $this->dispatch(
                'show-toast',
                type: 'info',
                message: 'Administrator already has all permissions.'
            );
            return;
        }

        RolePermission::where('role', $this->selectedRole)->delete();
        foreach ($this->selectedPermissions as $permissionId) {
            RolePermission::create([
                'role'          => $this->selectedRole,
                'permission_id' => $permissionId,
            ]);
        }

        $this->dispatch(
            'success',
            message: 'Permissions updated successfully.'
        );
    }

    public function selectAll()
    {
        if ($this->selectedRole === 'Administrator') {
            return;
        }
        $this->selectedPermissions = Permission::pluck('id')
            ->map(fn($id) => (string) $id)
            ->toArray();
    }

    public function clearAll()
    {
        if ($this->selectedRole === 'Administrator') {
            return;
        }
        $this->selectedPermissions = [];
    }


    public function render()
    {

        $permissions = Permission::orderBy('module')
            ->orderBy('action')
            ->get()
            ->groupBy('module');
        return view('livewire.admin.role-permission.index', [
            'permissions' => $permissions,
        ])->layout('layouts.admin', ['title' => 'Role Manage']);
    }
}
