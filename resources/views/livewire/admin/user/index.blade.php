<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="page-title mb-0">User List</h4>
        @if (auth()->user()->hasPermission('users.create'))
            <button class="btn btn-purple" wire:click="create">
                <i class="fas fa-user-plus mr-1"></i> Add New User
            </button>
        @endif
    </div>

    <div class="table-card p-4 bg-light">
        <div class="table-responsive">
            <table class="table table-hover table-bordered mb-0">
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
                                <span class=" badge-primary p-1 px-2">{{ $user->role }}</span>
                            </td>
                            <td>
                                @if ($user->status)
                                    <span class="badge-success"> Active </span>
                                @else
                                    <span class="badge-inactive"> Inactive </span>
                                @endif
                            </td>
                            <td>
                                {{ $user->created_at->format('d M Y') }}
                            </td>
                            <td>
                                @if (auth()->user()->hasPermission('users.edit'))
                                    <button wire:click="edit({{ $user->id }})" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                @endif

                                @if (auth()->user()->hasPermission('users.delete'))
                                    <button wire:click="delete({{ $user->id }})"
                                        wire:confirm="Are you sure you want to delete this user?"
                                        class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @endif
                                @if (auth()->user()->hasPermission('users.delete'))
                                    <button wire:click="toggleStatus({{ $user->id }})"
                                        class="btn btn-sm btn-warning">
                                        <i class="fas fa-power-off"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
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
                    <button class="btn-none close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <form wire:submit.prevent="{{ $user_id ? 'update' : 'store' }}">
                        <div class="form-group">
                            <label>User Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control text-capitalize" name="name" wire:model="name"
                                placeholder="Enter user name" @if ($user_id) readonly @endif>
                            @error('name')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" wire:model="email" name="email"
                                placeholder="Enter email" @if ($user_id) readonly @endif>
                            @error('email')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>
                        <div class="{{ $user_id ? 'd-none' : '' }}">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone" wire:model="phone">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" wire:model="role">
                                <option value="">Select Role</option>
                                <option value="Shop Manager">Shop Manager</option>
                                <option value="Contributor">Contributor</option>
                                <option value="Editor">Editor</option>
                                <option value="Administrator">Administrator</option>
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
