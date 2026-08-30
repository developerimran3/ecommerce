<div class="content container">
    <div class="mb-3">
        <h4 class="page-title mb-0">
            SMTP Settings
        </h4>
    </div>


    <div class="card border-0">
        <div class="card-body">
            <div class="row">
                {{-- SMTP Name --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>SMTP Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name"
                            placeholder="Gmail SMTP">
                        @error('name')
                            <span class="invalid-feedback"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>

                {{-- SMTP Host --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>SMTP Host</label>
                        <input type="text" class="form-control @error('host') is-invalid @enderror" wire:model="host"
                            placeholder="smtp.gmail.com">
                        @error('host')
                            <span class="invalid-feedback"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>

                {{-- Port --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label>SMTP Port</label>
                        <input type="number" class="form-control @error('port') is-invalid @enderror" wire:model="port"
                            placeholder="587">
                        @error('port')
                            <span class="invalid-feedback"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
                {{-- Encryption --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Encryption</label>
                        <select class="form-control" wire:model="encryption">
                            <option value="tls">TLS</option>
                            <option value="ssl">SSL</option>
                        </select>
                    </div>
                </div>

                {{-- SMTP Username --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label>SMTP Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                            wire:model="username" placeholder="your@email.com">
                        @error('username')
                            <span class="invalid-feedback"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>


                {{-- Password --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label> SMTP Password </label>
                        <input type="text" class="form-control @error('password') is-invalid @enderror"
                            wire:model="password" placeholder="Enter SMTP password">
                        @error('password')
                            <span class="invalid-feedback"> {{ $message }} </span>
                        @enderror
                        <small class="text-muted">
                            Leave blank to keep the existing password.
                        </small>
                    </div>
                </div>

                {{-- From Email --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>From Email</label>
                        <input type="email" class="form-control @error('from_email') is-invalid @enderror"
                            wire:model="from_email" placeholder="noreply@example.com">
                        @error('from_email')
                            <span class="invalid-feedback"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>

                {{-- From Name --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>From Name</label>
                        <input type="text" class="form-control @error('from_name') is-invalid @enderror"
                            wire:model="from_name" placeholder="My Website">
                        @error('from_name')
                            <span class="invalid-feedback"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Save --}}
            <div class="mt-2">
                <button type="button" class="btn btn-purple" wire:click="save" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="save">
                        <i class="fas fa-save mr-1"></i> Save Settings
                    </span>
                    <span wire:loading wire:target="save">
                        Saving...
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
