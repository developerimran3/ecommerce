<div class="my-account-page">
    <div class="container py-5">
        <div class="row">
            {{-- Sidebar --}}
            <div class="col-md-4 mb-4">
                <div class="account-card profile-card">
                    <div class="profile-header">
                        <div class="avatar">
                            @if (Auth::user()->image)
                                <img src="{{ asset('storage/' . Auth::user()->image) }}">
                            @else
                                <i class="fa fa-user"></i>
                            @endif
                        </div>
                        <h4> {{ ucwords(auth()->user()->name) }} </h4>
                        <p> {{ auth()->user()->email }} </p>
                    </div>
                    <ul class="account-menu">
                        <li>
                            <a href="{{ route('account') }}" wire:navigate>
                                <i class="fa fa-dashboard"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('my.orders') }}" wire:navigate>
                                <i class="fa fa-shopping-bag"></i> <span>My Orders</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('customer.profile') }}" wire:navigate>
                                <i class="fa fa-user"></i> <span>Profile</span>
                            </a>
                        </li>

                        <li class="active">
                            <a href="{{ route('customer.password') }}" wire:navigate>
                                <i class="fa fa-lock"></i> <span>Change Password</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('customer.logout') }}" wire:navigate class="logout-btn">
                                <i class="fa fa-sign-out"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Content -->
            <div class="col-md-8">
                <div class="password-page">
                    <!-- Password Card -->
                    <div class="account-card password-card">
                        <form wire:submit.prevent="updatePassword">
                            <!-- Current Password -->
                            <div class="form-group password-group">
                                <label> <i class="fa fa-key"></i> Current Password
                                </label>
                                <div class="password-input">
                                    <input type="password" class="form-control" id="current_password"
                                        placeholder="Enter your current password" wire:model="current_password">
                                    <span class="password-eye" onclick="togglePassword('current_password', this)">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                                @error('current_password')
                                    <small class="text-danger"> {{ $message }} </small>
                                @enderror
                            </div>
                            <!-- New Password -->
                            <div class="form-group password-group">
                                <label> <i class="fa fa-lock"></i> New Password </label>
                                <div class="password-input">
                                    <input type="password" class="form-control" id="password"
                                        placeholder="Enter new password" wire:model="password">
                                    <span class="password-eye" onclick="togglePassword('password', this)">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                                @error('password')
                                    <small class="text-danger"> {{ $message }} </small>
                                @enderror
                            </div>
                            <!-- Confirm Password -->
                            <div class="form-group password-group">
                                <label>
                                    <i class="fa fa-check-circle"></i> Confirm New Password
                                </label>
                                <div class="password-input">
                                    <input type="password" class="form-control" id="password_confirmation"
                                        placeholder="Confirm your new password" wire:model="password_confirmation">
                                    <span class="password-eye" onclick="togglePassword('password_confirmation', this)">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            <!-- Button -->
                            <div class="password-footer">
                                <button type="submit" class="password-submit" wire:loading.attr="disabled">
                                    <span wire:loading.remove>
                                        <i class="fa fa-save"></i> Update Password
                                    </span>
                                    <span wire:loading>
                                        <i class="fa fa-spinner fa-spin"></i> Updating...
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function togglePassword(inputId, element) {

        const input = document.getElementById(inputId);
        const icon = element.querySelector('i');

        if (input.type === 'password') {

            input.type = 'text';

            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');

        } else {

            input.type = 'password';

            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
