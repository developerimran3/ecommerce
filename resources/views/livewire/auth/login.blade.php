<div class="login-right-wrap">
    <h1>Login</h1>
    <p class="account-subtitle">
        Access to our dashboard
    </p>

    <!-- Form -->
    <div class="form-group">
        <input class="form-control" type="text" placeholder="Email" wire:model="email" />
        @error('email')
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror
    </div>
    <div class="form-group">
        <input class="form-control" type="password" placeholder="Password" wire:model="password" />
        @error('password')
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror
    </div>

    <div class="form-group">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" wire:model="remember" id="invalidCheck2" required>
            <label class="form-check-label" for="invalidCheck2">
                Agree to terms and conditions
            </label>
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-block" wire:click="login" wire:navigate>
            Login
        </button>
    </div>
    <!-- /Form -->

    <div class="text-center forgotpass">
        <a href="forgot-password.html">Forgot Password?</a>
    </div>
    <div class="login-or">
        <span class="or-line"></span>
        <span class="span-or">or</span>
    </div>

    <!-- Social Login -->
    <div class="social-login">
        <span>Login with</span>
        <a href="#" class="facebook"><i class="fa fa-facebook"></i></a><a href="#" class="google"><i
                class="fa fa-google"></i></a>
    </div>
    <!-- /Social Login -->

    <div class="text-center dont-have">
        Don’t have an account?
        <a href="register.html">Register</a>
    </div>
</div>
