<div>

    <div class="d-flex justify-content-between mb-3">

        <h4>All Users</h4>

        <input type="text" class="form-control w-25" placeholder="Search..." wire:model.live="search">

    </div>

    <div class="card">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered">

                    <thead class="thead-dark">

                        <tr>

                            <th>#</th>

                            <th>Name</th>

                            <th>Email</th>

                            <th>Phone</th>

                            <th>Address</th>

                            <th>Joined</th>

                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse ($users as $user)
                            <tr>

                                <td>

                                    {{ $loop->iteration }}

                                </td>

                                <td>

                                    {{ $user->name }}

                                </td>

                                <td>

                                    {{ $user->email }}

                                </td>

                                <td>

                                    {{ $user->phone }}

                                </td>

                                <td>

                                    {{ $user->address }}

                                </td>

                                <td>

                                    {{ $user->created_at->format('d M Y') }}

                                </td>
                                <td>

                                    <button class="btn btn-warning btn-sm" wire:click="edit({{ $user->id }})"
                                        data-toggle="modal" data-target="#editUserModal">

                                        <i class="fa fa-edit"></i>

                                    </button>

                                    <button class="btn btn-danger btn-sm" wire:click="delete({{ $user->id }})"
                                        wire:confirm="Are you sure?">

                                        <i class="fa fa-trash"></i>

                                    </button>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center">

                                    No users found.

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                {{ $users->links() }}

            </div>

        </div>

    </div>
    <div wire:ignore.self class="modal fade" id="editUserModal">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h5>Edit User</h5>

                    <button type="button" class="close" data-dismiss="modal">

                        <span>&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <div class="form-group">

                        <label>Name</label>

                        <input type="text" class="form-control" wire:model="name">

                    </div>

                    <div class="form-group">

                        <label>Email</label>

                        <input type="email" class="form-control" wire:model="email">

                    </div>

                    <div class="form-group">

                        <label>Phone</label>

                        <input type="text" class="form-control" wire:model="phone">

                    </div>

                    <div class="form-group">

                        <label>Address</label>

                        <textarea class="form-control" wire:model="address"></textarea>

                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-primary" wire:click="update">

                        Update

                    </button>

                </div>

            </div>

        </div>

    </div>

</div>
