<div>
    <section class="reset password">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="form-content">
                        <p class="auth-login">Create a new password for your account.</p>
                        <form wire:submit.prevent="resetPassword">
                            <!--  Field -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="email" wire:model.defer="email"
                                    placeholder="Enter your email">
                            </div>
                            @error('email')
                                <div class="text-danger small mb-3">{{ $message }}</div>
                            @enderror


                            <!-- Password Field -->
                            <label>Password</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </div>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Enter new password" wire:model.defer="password">
                            </div>
                            @error('password')
                                <div class="text-danger small mb-3">{{ $message }}</div>
                            @enderror

                            <!-- Confirm Password -->
                            <label>Confirm Password</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </div>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Confirm new password" wire:model.defer="password_confirmation">
                            </div>
                            @error('password_confirmation')
                                <div class="text-danger small mb-3">{{ $message }}</div>
                            @enderror

                            <button type="submit" class="btn btn-primary btn-block btn-login"
                                wire:loading.attr="disabled">
                                <span wire:loading.remove>
                                    <i class="fa fa-sign-in"></i> Reset Password
                                </span>
                                <span wire:loading>
                                    <i class="fa fa-spinner fa-spin"></i> Resetting...
                                </span>
                            </button>
                            <div class="register-text mt-2 text-right">
                                Remember your password?
                                <a href="{{ route('admin.login') }}">
                                    Login
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
