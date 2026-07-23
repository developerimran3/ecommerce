<div>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">My Profile</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- Profile Header -->
                <div class="card profile-header mb-4">
                    <div class="profile-cover">
                        <div class="row align-items-center">
                            <div class="col-auto profile-image">
                                <div class="avatar-upload">
                                    @if (Auth::user()->image)
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                            class="rounded-circle profile-avatar" alt="Profile">
                                    @else
                                        <img src="https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg"
                                            class="rounded-circle profile-avatar" alt="Profile">
                                    @endif
                                </div>
                            </div>
                            <div class="col profile-user-info">
                                <h4 class="user-name mb-1">{{ Auth::user()->name }}</h4>
                                <p class="text-muted mb-1">{{ Auth::user()->email }}</p>
                                <p class="user-location mb-0">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ Auth::user()->address ?? 'No address added' }}
                                </p>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal">
                                    <i class="fas fa-edit"></i> Edit Profile
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="profile-menu mb-4">
                    <ul class="nav nav-tabs nav-tabs-solid">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#per_details_tab">Personal Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#password_tab">Change Password</a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content">
                    <!-- Personal Details -->
                    <div class="tab-pane fade show active" id="per_details_tab">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Personal Information</h5>
                                <div class="row">
                                    <div class="col-sm-3 col-4 text-muted">Full Name</div>
                                    <div class="col-sm-9 col-8">{{ Auth::user()->name }}</div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3 col-4 text-muted">Email</div>
                                    <div class="col-sm-9 col-8">{{ Auth::user()->email }}</div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3 col-4 text-muted">Phone</div>
                                    <div class="col-sm-9 col-8">{{ Auth::user()->phone ?? 'Not provided' }}</div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3 col-4 text-muted">Role</div>
                                    <div class="col-sm-9 col-8">
                                        <span class="badge badge-primary">{{ Auth::user()->role }}</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3 col-4 text-muted">Address</div>
                                    <div class="col-sm-9 col-8">{{ Auth::user()->address ?? 'Not provided' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Change Password -->
                    <div class="tab-pane fade" id="password_tab">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Change Password</h5>
                                <div class="row">
                                    <div class="col-md-8">
                                        <form wire:submit.prevent="updatePassword">
                                            <div class="form-group">
                                                <label>Current Password</label>
                                                <input type="password" class="form-control"
                                                    wire:model="current_password">
                                            </div>
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input type="password" class="form-control" wire:model="new_password">
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm New Password</label>
                                                <input type="password" class="form-control"
                                                    wire:model="new_password_confirmation">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update Password</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateProfile">
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
                            <textarea class="form-control" wire:model="address" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Profile Picture</label>
                            <input type="file" class="form-control" wire:model="image">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
