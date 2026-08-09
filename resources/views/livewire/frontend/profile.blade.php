<div class="my-account-page">
    <div class="container py-5">
        <div class="row">
            {{-- Sidebar --}}
            <div class="col-md-4">
                <div class="account-card profile-card">
                    <div class="profile-header">
                        <div class="avatar">
                            @if (Auth::user()->image)
                                <img src="{{ asset('storage/' . Auth::user()->image) }}">
                            @else
                                <i class="fa fa-user"></i>
                            @endif
                        </div>
                        <h4>
                            {{ auth()->user()->name }}
                        </h4>
                        <p>
                            {{ auth()->user()->email }}
                        </p>
                    </div>

                    <ul class="account-menu">
                        <li>
                            <a href="{{ route('account') }}" wire:navigate>
                                <i class="fa fa-dashboard"></i> Dashboard </a>
                        </li>

                        <li>
                            <a href="{{ route('my.orders') }}" wire:navigate>
                                <i class="fa fa-shopping-bag"> </i> My Orders
                            </a>
                        </li>

                        <li class="active">
                            <a href="{{ route('customer.profile') }}" wire:navigate>
                                <i class="fa fa-user"></i> Profile
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-lock"></i> Change Password
                            </a>
                        </li>
                        <li>
                            <button wire:click="logout" class="logout-btn">
                                <i class="fa fa-sign-out"></i> Logout
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Profile Content --}}

            <div class="col-md-8">
                <div class="account-card">
                    <div class="profile-title">
                        <h4> My Profile </h4>
                        <p> Update your account information </p>
                    </div>

                    <form wire:submit.prevent="updateProfile">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Full Name </label>
                                    <input type="text" class="form-control" wire:model="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Email Address </label>
                                    <input type="email" class="form-control" wire:model="email" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Phone Number </label>
                                    <input type="text" class="form-control" wire:model="phone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Profile Picture</label>
                                    <input type="file" class="form-control" wire:model="image">
                                    @error('image')
                                        <small class="text-danger"> {{ $message }} </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        Address
                                    </label>
                                    <textarea class="form-control" wire:model="address" rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <button class="profile-save-btn">
                            <i class="fa fa-save"></i>
                            Save Changes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
