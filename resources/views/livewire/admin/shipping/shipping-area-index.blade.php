<div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-1"> Shipping Areas </h4>
        </div>
        <button class="btn btn-purple" wire:click="create">
            <i class="fa fa-plus"></i> Add Shipping Area </button>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="table-card p-4 bg-light">
                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-hover table-bordered mb-0">
                        <thead>
                            <th width="70">#</th>
                            <th>Area</th>
                            <th>Charge</th>
                            <th>Status</th>
                            <th width="130">Action</th>
                            </>
                        </thead>
                        <tbody>
                            @forelse($shippingAreas as $shipping)
                                <tr>
                                    <td>
                                        {{ $shippingAreas->firstItem() + $loop->index }}
                                    </td>

                                    <td>
                                        <strong> {{ $shipping->name }} </strong>
                                    </td>
                                    <td>
                                        ৳ {{ number_format($shipping->charge, 2) }}
                                    </td>
                                    <td>
                                        @if ($shipping->status)
                                            <button class="btn btn-success btn-sm">
                                                Active </button>
                                        @else
                                            <button class="btn btn-secondary btn-sm">
                                                Inactive </button>
                                        @endif
                                    </td>
                                    <td>
                                        <button wire:click="edit({{ $shipping->id }})" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <button wire:click="delete({{ $shipping->id }})"
                                            wire:confirm="Are you sure you want to delete this shipping?"
                                            class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <button wire:click="toggleStatus({{ $shipping->id }})"
                                            class="btn btn-sm btn-warning">
                                            <i class="fas fa-power-off"></i>
                                        </button>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        No shipping area found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-3">
                {{ $shippingAreas->links() }}
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div wire:ignore.self class="modal fade" id="shippingModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ $editId ? 'Edit Shipping Area' : 'Add Shipping Area' }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label> Area Name </label>
                        <input type="text" class="form-control" wire:model="name"
                            placeholder="Example: Inside Dhaka">
                        @error('name')
                            <small class="text-danger"> {{ $message }} </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label> Shipping Charge </label>
                        <input type="number" class="form-control" wire:model="charge" placeholder="150">
                        @error('charge')
                            <small class="text-danger"> {{ $message }} </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="shippingStatus" wire:model="status">
                            <label class="custom-control-label" for="shippingStatus"> Active </label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    @if ($editId)
                        <button type="button" class="btn btn-primary" wire:click="update">
                            <i class="fa fa-save"></i>
                            Update
                        </button>
                    @else
                        <button type="button" class="btn btn-primary" wire:click="store">
                            <i class="fa fa-save"></i>
                            Save
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
