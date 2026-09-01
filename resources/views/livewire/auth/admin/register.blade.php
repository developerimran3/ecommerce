<div>
    <section class="Login">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="form-content">
                        <p class="auth-login">Admin Register</p>
                        <form wire:submit.prevent="register">
                            <!--  Name -->
                            <label>Name</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                </div>
                                <input type="text"
                                    class="form-control text-capitalize @error('name') is-invalid @enderror"
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
                            <!--  Role -->
                            <label>Role</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                </div>
                                <select wire:model="role" class="form-control @error('role') is-invalid @enderror">
                                    <option value=""> -- select -- </option>
                                    <option value="Administrator"> Administrator </option>
                                </select>
                            </div>
                            @error('role')
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
                            <!-- Confirmation Password Field -->
                            <label>Confirmed Password</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </div>
                                <input type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    placeholder="Enter your password" wire:model.defer="password_confirmation">
                            </div>

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
