<div>
    <section class="Login">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="form-content">
                        <p class="auth-login">Customer Register</p>
                        <form wire:submit.prevent="register">
                            <!--  Name -->
                            <label>Name</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" wire:model="name" placeholder="Enter your Name">
                            </div>
                            @error('name')
                                <div class="text-danger small mb-3">{{ $message }}</div>
                            @enderror
                            <!--  Email -->
                            <label>Email</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    name="email" wire:model="email" placeholder="Enter your Email">
                            </div>
                            @error('email')
                                <div class="text-danger small mb-3">{{ $message }}</div>
                            @enderror
                            <!--  Phone -->
                            <label>Phone No</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" wire:model="phone" placeholder="Enter your phone">
                            </div>
                            @error('phone')
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
                                    placeholder="Enter your password" wire:model.defer="password">
                            </div>
                            @error('password')
                                <div class="text-danger small mb-3">{{ $message }}</div>
                            @enderror


                            {{-- <div class="d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember"
                                        wire:model="remember">
                                    <label class="form-check-label" for="remember">Remember Me</label>
                                </div>

                                <a href="{{ route('customer.forgot.password') }}" class="forgot">Forgot Password?</a>
                            </div> --}}

                            <button type="submit" class="btn btn-primary btn-block btn-login"
                                wire:loading.attr="disabled">
                                <span wire:loading.remove>
                                    <i class="fa fa-sign-in"></i> Register
                                </span>
                                <span wire:loading>
                                    <i class="fa fa-spinner fa-spin"></i> Registering...
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
