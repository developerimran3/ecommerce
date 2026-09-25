<div class="content container">

    <div class="mb-3">
        <h4 class="page-title mb-0">
            Site Settings
        </h4>
    </div>

    <div class="card border-0">
        <div class="card-body">

            <div class="row">

                {{-- Name --}}
                <div class="col-md-6">
                    <div class="form-group">

                        <label>Name</label>

                        <input type="text" class="form-control @error('title') is-invalid @enderror" wire:model="title"
                            placeholder="Name">

                        @error('title')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>
                </div>


                {{-- Sub Title --}}
                <div class="col-md-6">
                    <div class="form-group">

                        <label>Sub Title</label>

                        <input type="text" class="form-control @error('sub_title') is-invalid @enderror"
                            wire:model="sub_title" placeholder="Sub Title">

                        @error('sub_title')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>
                </div>


                {{-- White Logo --}}
                <div class="col-md-4">
                    <div class="form-group">

                        <label>White Logo</label>

                        <input type="file" class="form-control @error('white_logo') is-invalid @enderror"
                            wire:model="white_logo" accept="image/*">

                        @error('white_logo')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror

                        {{-- Preview --}}
                        <div class="mt-3">

                            @if ($white_logo)
                                <div class="border rounded p-2 text-center" style="background:#333;">

                                    <small class="text-white d-block mb-2">
                                        New White Logo
                                    </small>

                                    <img src="{{ $white_logo->temporaryUrl() }}" class="img-thumbnail"
                                        style="max-height:80px; max-width:180px;" alt="New White Logo">

                                </div>
                            @elseif ($oldWhiteLogo)
                                <div class="border rounded p-2 text-center">

                                    <small class="text-muted d-block mb-2">
                                        Current White Logo
                                    </small>

                                    <img src="{{ asset('storage/' . $oldWhiteLogo) }}" class="img-thumbnail"
                                        style="max-height:80px; max-width:180px;" alt="White Logo">

                                </div>
                            @else
                                <div class="text-muted">
                                    No white logo uploaded.
                                </div>
                            @endif

                        </div>

                    </div>
                </div>


                {{-- Dark Logo --}}
                <div class="col-md-4">
                    <div class="form-group">

                        <label>Dark Logo</label>

                        <input type="file" class="form-control @error('dark_logo') is-invalid @enderror"
                            wire:model="dark_logo" accept="image/*">

                        @error('dark_logo')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror

                        {{-- Preview --}}
                        <div class="mt-3">

                            @if ($dark_logo)
                                <div class="border rounded p-2 text-center">

                                    <small class="text-muted d-block mb-2">
                                        New Dark Logo
                                    </small>

                                    <img src="{{ $dark_logo->temporaryUrl() }}" class="img-thumbnail"
                                        style="max-height:80px; max-width:180px;" alt="New Dark Logo">

                                </div>
                            @elseif ($oldDarkLogo)
                                <div class="border rounded p-2 text-center">

                                    <small class="text-muted d-block mb-2">
                                        Current Dark Logo
                                    </small>

                                    <img src="{{ asset('storage/' . $oldDarkLogo) }}" class="img-thumbnail"
                                        style="max-height:80px; max-width:180px;" alt="Dark Logo">

                                </div>
                            @else
                                <div class="text-muted">
                                    No dark logo uploaded.
                                </div>
                            @endif

                        </div>

                    </div>
                </div>


                {{-- Favicon --}}
                <div class="col-md-4">
                    <div class="form-group">

                        <label>Favicon Logo</label>

                        <input type="file" class="form-control @error('favicon') is-invalid @enderror"
                            wire:model="favicon" accept="image/*,.ico">

                        @error('favicon')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror

                        {{-- Preview --}}
                        <div class="mt-3">

                            @if ($favicon)
                                <div class="border rounded p-2 text-center">

                                    <small class="text-muted d-block mb-2">
                                        New Favicon
                                    </small>

                                    <img src="{{ $favicon->temporaryUrl() }}" class="img-thumbnail"
                                        style="width:70px; height:70px; object-fit:contain;" alt="New Favicon">

                                </div>
                            @elseif ($oldFavicon)
                                <div class="border rounded p-2 text-center">

                                    <small class="text-muted d-block mb-2">
                                        Current Favicon
                                    </small>

                                    <img src="{{ asset('storage/' . $oldFavicon) }}" class="img-thumbnail"
                                        style="width:70px; height:70px; object-fit:contain;" alt="Favicon">

                                </div>
                            @else
                                <div class="text-muted">
                                    No favicon uploaded.
                                </div>
                            @endif

                        </div>

                    </div>
                </div>


                {{-- Phone --}}
                <div class="col-md-6">
                    <div class="form-group">

                        <label>Phone</label>

                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                            wire:model="phone" placeholder="Phone">

                        @error('phone')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>
                </div>


                {{-- Email --}}
                <div class="col-md-6">
                    <div class="form-group">

                        <label>Email</label>

                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            wire:model="email" placeholder="noreply@example.com">

                        @error('email')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>
                </div>


                {{-- Address --}}
                <div class="col-md-6">
                    <div class="form-group">

                        <label>Shop Address</label>

                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                            wire:model="address" placeholder="Address">

                        @error('address')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>
                </div>

            </div>


            {{-- Save --}}
            @if (auth()->user()->hasPermission('setting.edit'))
                <div class="mt-2">

                    <button type="button" class="btn btn-purple" wire:click="save" wire:loading.attr="disabled">

                        <span wire:loading.remove wire:target="save">
                            <i class="fas fa-save mr-1"></i>
                            Save Settings
                        </span>

                        <span wire:loading wire:target="save">
                            <i class="fas fa-spinner fa-spin mr-1"></i>
                            Saving...
                        </span>

                    </button>

                </div>
            @endif

        </div>
    </div>

</div>
