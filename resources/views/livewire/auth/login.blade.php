<div class="login-card">

    <div class="login-logo">
        <i class="fas fa-user"></i>
    </div>

    <h3>Welcome Back</h3>
    <p class="subtitle">Please login to your account</p>

    <form wire:submit.prevent="login">

        <!-- Email Field -->
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-envelope"></i>
                </span>
            </div>
            <input type="email" class="form-control @error('email') is-invalid @enderror"
                placeholder="Enter your email" wire:model.defer="email">
        </div>
        @error('email')
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


        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember" wire:model="remember">
                <label class="form-check-label" for="remember">Remember Me</label>
            </div>

            <a href="#" class="forgot">Forgot Password?</a>
        </div>

        <button type="submit" class="btn btn-primary btn-block btn-login" wire:loading.attr="disabled">
            <span wire:loading.remove>
                <i class="fa fa-sign-in"></i> Login
            </span>
            <span wire:loading>
                <i class="fa fa-spinner fa-spin"></i> Logging in...
            </span>
        </button>

    </form>

    <a href="{{ route('home') }}" class="btn btn-sm btn-primary my-3">Home</a>
</div>
