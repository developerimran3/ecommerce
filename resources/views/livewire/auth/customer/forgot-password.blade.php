<div>
    <section class="Login">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="form-content">
                        <p class="auth-login">Forgot Password</p>
                        <form wire:submit.prevent="sendResetLink">
                            <!-- Email Field -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" wire:model="email"
                                    placeholder="Enter your email or phone">
                            </div>
                            @error('email')
                                <div class="text-danger small mb-3">{{ $message }}</div>
                            @enderror
                            <button type="submit" class="btn btn-primary btn-block btn-login"
                                wire:loading.attr="disabled">
                                <span wire:loading.remove>
                                    <i class="fa fa-sign-in"></i> Reset
                                </span>
                                <span wire:loading>
                                    <i class="fa fa-spinner fa-spin"></i> Reseteing...
                                </span>
                            </button>
                            <div class="register-text mt-2 text-right">
                                have an account?
                                <a href="{{ route('customer.login') }}">
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
