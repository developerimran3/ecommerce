<div class="my-account-page">
    <div class="container py-5">
        <div class="row">
            {{-- Sidebar --}}
            @include('partials.frontend-sidebar')
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
