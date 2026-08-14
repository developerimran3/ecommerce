<div>

    <div class="content container">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="page-title">User Profile</h4>
        </div>

        <div class="profile-wrapper">
            <!-- Profile Header -->

            <div class="profile-cover">
                <div class="profile-avatar">
                    @if (Auth::user()->image)
                        <img src="{{ asset('storage/' . Auth::user()->image) }}">
                    @else
                        <i class="fa fa-user"></i>
                    @endif
                </div>

                <div class="profile-info">
                    <h3 class="text-uppercase"> {{ Auth::user()->name }} </h3>

                    <p> {{ Auth::user()->email }} </p>

                    <span class="role-badge">
                        {{ Auth::user()->role }}
                    </span>
                </div>
            </div>
            <!-- Tabs -->
            <div class="profile-tabs">
                <ul class="nav nav-tabs custom-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#personal">
                            <i class="fa fa-user"></i> Personal
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#password" id="password-tab">
                            <i class="fa fa-lock"></i> Password
                        </a>
                    </li>
                </ul>
            </div>

            <div class="tab-content">
                <!-- Personal -->
                <div class="tab-pane fade show active" id="personal">
                    <div class="profile-card">
                        <div class="card-title-area">
                            <h5> Personal Information </h5>
                            <button class="btn edit-btn" data-toggle="modal" data-target="#editProfileModal">
                                <i class="fa fa-edit"></i> Edit Profile
                            </button>
                        </div>

                        <div class="info-list">
                            <div class="info-item">
                                <span> Full Name </span>
                                <strong> {{ Auth::user()->name }} </strong>
                            </div>
                            <div class="info-item">
                                <span> Email </span>
                                <strong> {{ Auth::user()->email }} </strong>
                            </div>
                            <div class="info-item">
                                <span> Phone </span>
                                <strong> {{ Auth::user()->phone ?? 'Not Provided' }} </strong>
                            </div>

                            <div class="info-item">
                                <span> Address </span>
                                <strong> {{ Auth::user()->address ?? 'Not Provided' }} </strong>
                            </div>
                            <div class="info-item">
                                <span> Account Type </span>
                                <strong>
                                    <span class="role-badge">
                                        {{ Auth::user()->role }}
                                    </span>
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Password -->
                <div class="tab-pane fade" id="password">
                    <div class="profile-card">
                        <h5 class="mb-4"> Change Password </h5>
                        <div class="form-group">
                            <label> Current Password </label>
                            <input type="password" class="form-control" wire:model="current_password">
                            @error('current_password')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label> New Password </label>
                            <input type="password" class="form-control" wire:model="password">
                            @error('password')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label> Confirm Password </label>
                            <input type="password" class="form-control" wire:model="password_confirmation">
                        </div>
                        <button type="button" class="password-btn" wire:click="updatePassword"><i
                                class="fa fa-save"></i> Update Password </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->

    <div class="modal fade" id="editProfileModal" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Profile</h5>
                    <button type="button" class="btn-none close" data-dismiss="modal">&times;</button>
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
                            <input type="file" class="form-control" wire:model="image"
                                accept=".jpg,.jpeg,.png,.webp">
                            @error('image')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Save
                            Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
