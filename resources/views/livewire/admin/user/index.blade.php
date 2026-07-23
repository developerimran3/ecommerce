<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="page-title mb-0">User List</h4>
        <button class="btn btn-purple" data-toggle="modal" data-target="#userModal" wire:click="resetInput">
            <i class="fas fa-user-plus mr-1"></i>
            Add New User
        </button>
    </div>

    <div class="table-card">
        <div class="table-header-purple"> All Users </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th width="60">#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        @if ($user->role != 'Administrator')
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="category-img-wrapper">
                                            @if ($user->image)
                                                <img src="{{ asset('storage/' . $user->image) }}" class="category-img">
                                            @else
                                                <div class="category-placeholder">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="text-capitalize">
                                    {{ $user->name }}
                                </td>
                                <td>
                                    <span class="text-muted">{{ $user->email }}</span>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $user->phone ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    <span class="badge badge-info p-1 px-2">{{ $user->role }}</span>
                                </td>
                                <td>
                                    @if ($user->status)
                                        <span class="badge-status"> Active </span>
                                    @else
                                        <span class="badge-inactive"> Inactive </span>
                                    @endif
                                </td>
                                <td>
                                    {{ $user->created_at->format('d M Y') }}
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <button class="btn btn-sm btn-edit mr-2" data-toggle="modal"
                                            data-target="#userModal" wire:click="edit({{ $user->id }})">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-delete" wire:click="delete({{ $user->id }})"
                                            wire:confirm="Are you sure you want to delete this user?">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">No Data Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">
            {{ $users->links() }}
        </div>
    </div>

    <!-- User Modal -->
    <div wire:ignore.self class="modal fade" id="userModal" tabindex="-1">
        <div class="modal-dialog modal-m">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $user_id ? 'Edit User' : 'Add New User' }}</h5>
                    <button class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <form wire:submit.prevent="{{ $user_id ? 'update' : 'create' }}">
                        <div class="form-group">
                            <label>User Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control text-capitalize" wire:model="name"
                                placeholder="Enter user name" @if ($user_id) readonly @endif>
                            @error('name')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" wire:model="email" placeholder="Enter email"
                                @if ($user_id) readonly @endif>
                            @error('email')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="{{ $user_id ? 'd-none' : '' }}">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" wire:model="phone">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" wire:model="role">
                                <option value="">Select Role</option>
                                <option value="Customer">Customer</option>
                                <option value="Shop Manager">Shop Manager</option>
                                <option value="Contributor">Contributor</option>
                                <option value="Editor">Editor</option>
                            </select>
                        </div>

                        <div class="{{ $user_id ? 'd-none' : '' }}">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="status" wire:model="status">
                                <label class="custom-control-label" for="status"> Active </label>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                            @if ($user_id)
                                <button class="btn btn-success">Update User</button>
                            @else
                                <button class="btn btn-primary">Save User</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
