<div>
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-1"> Coupons </h4>
        </div>
        <button wire:click="create" class="btn btn-purple">
            <i class="fas fa-plus"></i> Add Courier </button>
    </div>


    {{-- Table --}}
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="table-card p-4 bg-light">
                <!-- Filter Area -->
                <div class="row">
                    {{-- Search --}}
                    <div class="col-md-10 mb-3">
                    </div>
                    <div class="col-md-2 mb-3">
                        <input type="text" class="form-control" placeholder="🔍 Search coupon..."
                            wire:model.live="search">
                    </div>
                </div>
                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Courier Name</th>
                                <th>API Key</th>
                                <th>Secret Key</th>
                                <th>URL</th>
                                <th>Status</th>
                                <th width="130"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($couriers as $courier)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <strong>
                                            {{ $courier->courier_name }}
                                        </strong>
                                    </td>

                                    <td>
                                        <span class="text-muted">
                                            {{ $courier->api_key ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-muted">
                                            {{ $courier->secret_key ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-muted">
                                            {{ $courier->api_url ?? 'N/A' }}
                                        </span>
                                    </td>

                                    <td>
                                        @if ($courier->status)
                                            <span class="badge-success"> Active </span>
                                        @else
                                            <span class="badge-inactive"> Inactive </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (auth()->user()->hasPermission('couriers.edit'))
                                            <button wire:click="edit({{ $courier->id }})" class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        @endif

                                        @if (auth()->user()->hasPermission('couriers.delete'))
                                            <button wire:click="delete({{ $courier->id }})"
                                                wire:confirm="Are you sure you want to delete this courier?"
                                                class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                        @if (auth()->user()->hasPermission('couriers.status'))
                                            <button wire:click="toggleStatus({{ $courier->id }})"
                                                class="btn btn-sm btn-warning">
                                                <i class="fas fa-power-off"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4">
                                        No couriers found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{-- <div class="mt-3">
                    {{ $couriers->links() }}
                </div> --}}
            </div>
        </div>

        {{-- Modal --}}
        <div wire:ignore.self class="modal fade" id="courierModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ $courierId ? 'Edit courier' : 'Add courier' }}
                        </h5>

                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    {{-- Modal Body --}}
                    <div class="modal-body">
                        <form wire:submit.prevent="save">
                            <div class="row">
                                {{-- Courier Name --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            Courier Name
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="text"
                                            class="form-control @error('courier_name') is-invalid @enderror"
                                            wire:model="courier_name" placeholder="e.g. Steadfast">
                                        @error('courier_name')
                                            <div class="invalid-feedback"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Base URL --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Base URL </label>
                                        <input type="url"
                                            class="form-control @error('base_url') is-invalid @enderror"
                                            wire:model="base_url" placeholder="https://api.example.com">

                                        @error('base_url')
                                            <div class="invalid-feedback"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- API URL --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label> API URL </label>
                                        <input type="url"
                                            class="form-control @error('api_url') is-invalid @enderror"
                                            wire:model="api_url" placeholder="https://api.example.com/v1">

                                        @error('api_url')
                                            <div class="invalid-feedback"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- API Key --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> API Key </label>
                                        <input type="text" class="form-control" wire:model="api_key"
                                            placeholder="Enter API key">
                                    </div>
                                </div>

                                {{-- Secret Key --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Secret Key </label>
                                        <input type="text" class="form-control" wire:model="secret_key"
                                            placeholder="Enter secret key">
                                    </div>
                                </div>

                                {{-- Username --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Username </label>
                                        <input type="text" class="form-control" wire:model="username"
                                            placeholder="Username">
                                    </div>
                                </div>

                                {{-- Password --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Password </label>
                                        <input type="password" class="form-control" wire:model="password"
                                            placeholder="Password">
                                    </div>
                                </div>

                                {{-- Account ID --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Account ID </label>
                                        <input type="text" class="form-control" wire:model="account_id"
                                            placeholder="Account ID">
                                    </div>
                                </div>

                                {{-- Store ID --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Store ID </label>
                                        <input type="text" class="form-control" wire:model="store_id"
                                            placeholder="Store ID">
                                    </div>
                                </div>

                                {{-- Sandbox --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Environment </label>
                                        <select class="form-control" wire:model="sandbox">
                                            <option value="0"> Live </option>
                                            <option value="1"> Sandbox </option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Status --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Status </label>
                                        <select class="form-control" wire:model="status">
                                            <option value="1"> Active </option>
                                            <option value="0"> Inactive </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- Modal Footer --}}
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-light mr-2" wire:click="closeModal">
                                    Cancel
                                </button>
                                <button type="submit" class="btn btn-purple" wire:loading.attr="disabled">
                                    <span wire:loading.remove>
                                        <i class="fas fa-save mr-1"></i>
                                        @if ($courierId)
                                            Update Courier
                                        @else
                                            Save Courier
                                        @endif
                                    </span>
                                    <span wire:loading> Saving... </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
