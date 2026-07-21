<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Profile</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-md-12">
            <div class="profile-header">
                <div class="row align-items-center">
                    <div class="col-auto profile-image">
                        <a href="#">
                            @if (Auth::user()->image)
                                <img src="{{ asset('storage/' . Auth::user()->image) }}" class="rounded-circle"
                                    alt="User Image">
                            @else
                                <span class="text-muted">
                                    <img src="https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg"
                                        class="rounded-circle"alt="User Image">
                                </span>
                            @endif

                        </a>
                    </div>
                    <div class="col ml-md-n2 profile-user-info">
                        <h4 class="user-name mb-0">{{ Auth::user()->name }}</h4>
                        <h6 class="text-muted">{{ Auth::user()->email }}</h6>
                        <div class="user-Location"><i class="fa fa-map-marker"></i> {{ Auth::user()->address }}</div>
                        <div class="about-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua.</div>
                    </div>
                    <div class="col-auto profile-btn">

                        <a href="#" class="btn btn-primary">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
            <div class="profile-menu">
                <ul class="nav nav-tabs nav-tabs-solid">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#per_details_tab">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#password_tab">Password</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content profile-tab-cont">

                <!-- Personal Details Tab -->
                <div class="tab-pane fade show active" id="per_details_tab">

                    <!-- Personal Details -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title d-flex justify-content-between">
                                        <span>Personal Details</span>
                                        <a class="edit-link" data-toggle="modal" href="#edit_personal_details"><i
                                                class="fa fa-edit mr-1"></i>Edit</a>
                                    </h5>
                                    <div class="row">
                                        <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Name</p>
                                        <p class="col-sm-10">{{ Auth::user()->name }}</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Role</p>
                                        <p class="col-sm-10"> {{ Auth::user()->role }}</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Email ID</p>
                                        <p class="col-sm-10">{{ Auth::user()->email }}</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Mobile</p>
                                        <p class="col-sm-10">{{ Auth::user()->phone }}</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-sm-2 text-muted text-sm-right mb-0">Address</p>
                                        <p class="col-sm-10 mb-0">{{ Auth::user()->address }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Details Modal -->
                            <div class="modal fade" id="edit_personal_details" aria-hidden="true" role="dialog">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Personal Details</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row form-row">
                                                <div class="col-12 ">
                                                    <div class="form-group">
                                                        <label> Name</label>
                                                        <input type="text" class="form-control" wire:model='name'>
                                                    </div>
                                                    @error('name')
                                                        <small class="text-danger">
                                                            {{ $message }}
                                                        </small>
                                                    @enderror
                                                </div>

                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Email ID</label>
                                                        <input type="email" class="form-control" wire:model='email'>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Mobile</label>
                                                        <input type="text" wire:model='phone' class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <h5 class="form-title"><span>Address</span></h5>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input type="text" class="form-control"
                                                            wire:model='address'>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input type="file" class="form-control"
                                                            wire:model='image'>
                                                    </div>
                                                </div>

                                            </div>
                                            <button wire:click="updateProfile" type="submit"
                                                class="btn btn-primary btn-block">Save
                                                Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Edit Details Modal -->
                        </div>
                    </div>
                    <!-- /personal Details -->
                </div>
                <!-- /Personal Details Tab -->
                <!-- Change Password Tab -->
                <div id="password_tab" class="tab-pane fade">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Change Password</h5>
                            <div class="row">
                                <div class="col-md-10 col-lg-6">
                                    <form>
                                        <div class="form-group">
                                            <label>Old Password</label>
                                            <input type="password" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input type="password" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="password" class="form-control">
                                        </div>
                                        <button class="btn btn-primary" type="submit">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Change Password Tab -->
            </div>
        </div>
    </div>
</div>
