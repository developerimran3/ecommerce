<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">List of Users</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    {{-- <li class="breadcrumb-item"><a href="javascript:(0);">Users</a></li> --}}
                    <li class="breadcrumb-item active">Users</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-md-12">

            <!-- Recent Orders -->
            <div class="card card-table">
                <div class="card-header">
                    <div class="d-flex justify-content-between mb-3">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#userModal"
                            wire:click="resetInput">
                            <i class="fa fa-plus"></i> Add New User </button>
                        <input type="text" class="form-control w-25" placeholder="Search..."
                            wire:model.live="search">
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-center mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Status Change</th>
                                    <th>Role</th>
                                    <th>Joined</th>
                                    <th>Status</th>
                                    <th style="width: 20px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($users as $user)
                                    @if ($user->role != 'Administrator')
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a class="avatar avatar-sm mr-2">

                                                        @if ($user->image)
                                                            <img class="avatar-img rounded-circle"
                                                                src="{{ asset('storage/' . $user->image) }}"
                                                                alt="User Image">
                                                        @else
                                                            <img class="avatar-img rounded-circle"
                                                                src="https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg"
                                                                alt="User Image">
                                                        @endif
                                                    </a>
                                                    <a class="text-capitalize">{{ $user->name }}</a>
                                                </h2>
                                            </td>
                                            <td> {{ $user->email }} </td>
                                            <td> {{ $user->phone }} </td>
                                            <td> {{ $user->address }} </td>

                                            <td>
                                                <div class="status-toggle">
                                                    <input type="checkbox" id="status_{{ $user->id }}"
                                                        class="check" {{ $user->status ? 'checked' : '' }}
                                                        wire:change="changeStatus({{ $user->id }})">

                                                    <label for="status_{{ $user->id }}" class="checktoggle">
                                                    </label>
                                                </div>
                                            </td>

                                            <td> {{ $user->role }} </td>
                                            <td> {{ $user->created_at->format('d M Y') }} </td>

                                            <td>
                                                <span
                                                    class="badge badge-pill {{ $user->status ? 'bg-success' : 'bg-danger' }} inv-badge">
                                                    {{ $user->status ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td class="text-right">
                                                <div class="actions">
                                                    <a href="#" data-toggle="modal" data-target="#userModal"
                                                        wire:click="edit({{ $user->id }})"
                                                        class="btn btn-sm bg-success-light mr-2">
                                                        <i class="fe fe-pencil"></i> Edit
                                                    </a>
                                                    <a class="btn btn-sm bg-danger-light"
                                                        wire:click="delete({{ $user->id }})"
                                                        wire:confirm="Are you sure? Document Delete?">
                                                        <i class="fe fe-trash"></i> Delete
                                                    </a>

                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
            <!-- /Recent Orders -->

        </div>
    </div>

    <!-- Edit User Modal -->
    <div wire:ignore.self class="modal fade" id="userModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ $user_id ? 'Edit User' : 'Add Users' }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{ $user_id ? 'update' : 'create' }}">
                        <div class="row form-row">
                            <div class="col-12 ">
                                <div class="form-group">
                                    <label>User Name</label>
                                    <input type="text" class="form-control text-capitalize" name="name"
                                        wire:model="name" required @if ($user_id) readonly @endif>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="">
                                    <label>Email ID</label>
                                    <input type="text" class="form-control" name="email" wire:model="email"
                                        required @if ($user_id) readonly @endif>
                                </div>
                                @error('email')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="col-12 {{ $user_id ? 'd-none' : '' }}">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" name="phone" wire:model="phone">
                                </div>
                            </div>

                            <div class="col-12 ">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="select form-control" wire:model="role">
                                        <option>Select</option>
                                        <option value="Customer"> Customer</option>
                                        <option value="Shop Manager"> Shop Manager</option>
                                        <option value="Contributor"> Contributor</option>
                                        <option value="Editor"> Editor</option>
                                        <option value="Administrator"> Administrator </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 {{ $user_id ? 'd-none' : '' }}">
                                <div class="form-group">
                                    <label>Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" wire:model="status"
                                            id="invalidCheck">
                                        <label class="form-check-label" for="invalidCheck"> Active </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($user_id)
                            <button type="submit" class="btn btn-success"> Update </button>
                        @else
                            <button type="submit" class="btn btn-primary"> Save </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit User Modal -->



</div>
