<div>
    <section class="Login">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="form-content">
                        <p class="auth-login">Login</p>
                        <form wire:submit.prevent="login">
                            <!--  Field -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control @error('auth') is-invalid @enderror"
                                    name="phone" wire:model="auth" placeholder="Enter your phone or email">
                            </div>
                            @error('auth')
                                <div class="text-danger small mb-3">{{ $message }}</div>
                            @enderror

                            <!-- Password Field -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </div>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Enter your password" wire:model.defer="password">
                            </div>
                            @error('password')
                                <div class="text-danger small mb-3">{{ $message }}</div>
                            @enderror


                            <div class="d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember"
                                        wire:model="remember">
                                    <label class="form-check-label" for="remember">Remember Me</label>
                                </div>

                                <a href="{{ route('customer.forgot.password') }}" class="forgot">Forgot Password?</a>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block btn-login"
                                wire:loading.attr="disabled">
                                <span wire:loading.remove>
                                    <i class="fa fa-sign-in"></i> Login
                                </span>
                                <span wire:loading>
                                    <i class="fa fa-spinner fa-spin"></i> Logging in...
                                </span>
                            </button>
                            <div class="register-text mt-2 text-right">
                                Don't have an account?
                                <a href="{{ route('customer.register') }}">
                                    Create Account
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
