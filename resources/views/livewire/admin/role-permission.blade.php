<div>

    <div class="card shadow-sm border-0">

        {{-- Header --}}
        <div class="card-header bg-white border-0 py-3">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <h5 class="mb-1 font-weight-bold">
                        Role & Permission
                    </h5>

                    <small class="text-muted">
                        Manage permissions for each user role
                    </small>
                </div>

                <div class="d-flex">

                    <button type="button" wire:click="selectAll" class="btn btn-sm btn-outline-primary mr-2">
                        Select All
                    </button>

                    <button type="button" wire:click="clearAll" class="btn btn-sm btn-outline-danger">
                        Clear All
                    </button>

                </div>

            </div>

        </div>


        {{-- Body --}}
        <div class="card-body">

            {{-- Role --}}
            <div class="form-group">

                <label class="font-weight-bold">
                    Select Role
                </label>

                <select wire:model.live="selectedRole" class="form-control">

                    <option value="Administrator">
                        Administrator
                    </option>

                    <option value="Editor">
                        Editor
                    </option>

                    <option value="Contributor">
                        Contributor
                    </option>

                    <option value="Shop Manager">
                        Shop Manager
                    </option>

                    <option value="Customer">
                        Customer
                    </option>

                </select>

            </div>


            {{-- Administrator Notice --}}
            @if ($selectedRole === 'Administrator')
                <div class="alert alert-info">

                    <i class="fas fa-shield-alt mr-2"></i>

                    <strong>Administrator</strong> has full access
                    to all modules and permissions.

                </div>
            @endif


            {{-- Permissions --}}
            <div class="row">

                @foreach ($permissions as $module => $modulePermissions)
                    <div class="col-md-6 col-lg-4 mb-4">

                        <div class="card border shadow-sm h-100">

                            {{-- Module Header --}}
                            <div class="card-header bg-light">

                                <div class="d-flex justify-content-between">

                                    <strong class="text-capitalize">
                                        {{ $module }}
                                    </strong>

                                    <span class="badge badge-primary">
                                        {{ $modulePermissions->count() }}
                                    </span>

                                </div>

                            </div>


                            {{-- Permission List --}}
                            <div class="card-body">

                                @foreach ($modulePermissions as $permission)
                                    <div class="custom-control custom-checkbox mb-3">

                                        <input type="checkbox" class="custom-control-input"
                                            id="permission_{{ $permission->id }}" value="{{ $permission->id }}"
                                            wire:model.live="selectedPermissions" @disabled($selectedRole === 'Administrator')>

                                        <label class="custom-control-label" for="permission_{{ $permission->id }}">

                                            <span class="text-capitalize">
                                                {{ $permission->action }}
                                            </span>

                                        </label>

                                    </div>
                                @endforeach

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>


            {{-- Save --}}
            <div class="text-right mt-3">

                <button type="button" wire:click="save" wire:loading.attr="disabled" class="btn btn-primary px-4"
                    @disabled($selectedRole === 'Administrator')>

                    <span wire:loading.remove wire:target="save">
                        <i class="fas fa-save mr-1"></i>
                        Save Permissions
                    </span>

                    <span wire:loading wire:target="save">
                        <i class="fas fa-spinner fa-spin mr-1"></i>
                        Saving...
                    </span>

                </button>

            </div>

        </div>

    </div>

</div>
