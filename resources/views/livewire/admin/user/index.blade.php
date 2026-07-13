<div>
    <div class="d-flex justify-content-between mb-3">
        <h4>All Users</h4>
        <input type="text" class="form-control w-25" placeholder="Search..." wire:model.live="search">
    </div>

    <div class="row">
        <div class="col">
            <div class="card radius-10 mb-0">
                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <table class="table align-middle table-bordered mb-0 ">
                            <thead class="text-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Role</th>
                                    <th>Joined</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="recent-product-img">
                                                    @if ($user->image)
                                                        <img src="{{ asset('storage/' . $user->image) }}"
                                                            class="img-thumbnail" alt="">
                                                    @else
                                                        <span class="text-muted">
                                                            No Image
                                                        </span>
                                                    @endif
                                                </div>

                                            </div>
                                        </td>
                                        <td> {{ $user->name }} </td>
                                        <td> {{ $user->email }} </td>
                                        <td> {{ $user->phone }} </td>
                                        <td> {{ $user->address }} </td>
                                        <td>
                                            @if ($user->status)
                                                <span class="badge bg-light-success text-success w-80">
                                                    Active
                                                </span>
                                            @else
                                                <span class="badge bg-light-danger text-danger w-80">
                                                    Inactive
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-capitalize"> {{ $user->role }} </td>
                                        <td> {{ $user->created_at->format('d M Y') }} </td>
                                        <td>
                                            <div class="d-flex order-actions"> <a href="javascript:;"
                                                    wire:click="delete({{ $user->id }})"
                                                    onclick="confirm('Delete this user?')"
                                                    class="text-danger bg-light-danger border-0"><i
                                                        class='bx bxs-trash'></i></a>

                                                <a href="javascript:;"wire:click="edit({{ $user->id }})"
                                                    data-toggle="modal" data-target="#editUserModal"
                                                    class="ms-2 text-primary bg-light-primary border-0"><i
                                                        class='bx bxs-edit'></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            No Data Found
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

                <div class="col">

                    <div class="card border-top border-0 border-4 border-danger">
                        <div class="card-body p-5">

                            <div class="col-12">
                                <label for="inputLastName1" class="form-label">Name</label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                            class='bx bxs-user'></i></span>
                                    <input type="text" name="name" wire:model="name"
                                        class="form-control border-start-0" id="inputLastName1" placeholder="Your Name"
                                        readonly />
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="inputPhoneNo" class="form-label">Phone No</label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                            class='bx bxs-microphone'></i></span>
                                    <input type="text" name="phone" wire:model="phone"
                                        class="form-control border-start-0" id="inputPhoneNo" placeholder="Phone No"
                                        readonly />
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="inputEmailAddress" class="form-label">Email Address</label>
                                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                            class='bx bxs-message'></i></span>
                                    <input type="text" name="email" wire:model="email"
                                        class="form-control border-start-0" id="inputEmailAddress"
                                        placeholder="Email Address" readonly />
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="inputAddress3" class="form-label">Address</label>
                                <textarea class="form-control" name="address" wire:model="address" id="inputAddress3" placeholder="Enter Address"
                                    rows="3" readonly></textarea>
                            </div>
                            <div class="col-12 mt-3 mb-2">
                                <label for="inputAddress3" class="form-label">Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" wire:model="status" id="gridCheck2">
                                    <label class="form-check-label" for="gridCheck2">Active</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="inputVendor" class="form-label">Role Change</label>
                                <select class="form-select" wire:model="role">
                                    <option></option>
                                    <option value="Customer">Customer</option>
                                    <option value="Contributor">Contributor</option>
                                    <option value="Shop Manager">Shop Manager</option>
                                    <option value="Editor">Editor</option>
                                    <option value="Administrator">Administrator</option>

                                </select>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" wire:click="update"> Update </button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
