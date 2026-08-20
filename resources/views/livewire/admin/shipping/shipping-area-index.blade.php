<div>

    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>
            <h4 class="mb-1">
                Shipping Areas
            </h4>

            <small class="text-muted">
                Manage delivery areas and charges
            </small>
        </div>

        <button class="btn btn-primary" data-toggle="modal" data-target="#shippingModal" wire:click="resetInput">
            <i class="fa fa-plus"></i>
            Add Shipping Area
        </button>

    </div>


    <div class="card">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-bordered table-hover mb-0">

                    <thead class="thead-light">

                        <tr>
                            <th width="70">#</th>
                            <th>Area</th>
                            <th>Charge</th>
                            <th>Status</th>
                            <th width="150">Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($shippingAreas as $shipping)
                            <tr>

                                <td>
                                    {{ $shippingAreas->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $shipping->name }}
                                    </strong>
                                </td>

                                <td>
                                    ৳ {{ number_format($shipping->charge, 2) }}
                                </td>

                                <td>

                                    @if ($shipping->status)
                                        <button wire:click="toggleStatus({{ $shipping->id }})"
                                            class="btn btn-success btn-sm">
                                            Active
                                        </button>
                                    @else
                                        <button wire:click="toggleStatus({{ $shipping->id }})"
                                            class="btn btn-secondary btn-sm">
                                            Inactive
                                        </button>
                                    @endif

                                </td>

                                <td>

                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#shippingModal"
                                        wire:click="edit({{ $shipping->id }})">
                                        <i class="fa fa-edit"></i>
                                    </button>


                                    <button class="btn btn-danger btn-sm" wire:click="delete({{ $shipping->id }})"
                                        wire:confirm="Are you sure you want to delete this shipping area?">
                                        <i class="fa fa-trash"></i>
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

    </div>


    <div class="mt-3">
        {{ $shippingAreas->links() }}
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

                        <label>
                            Area Name
                        </label>

                        <input type="text" class="form-control" wire:model="name"
                            placeholder="Example: Inside Dhaka">

                        @error('name')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    <div class="form-group">

                        <label>
                            Shipping Charge
                        </label>

                        <input type="number" class="form-control" wire:model="charge" placeholder="150">

                        @error('charge')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    <div class="form-group">

                        <div class="custom-control custom-switch">

                            <input type="checkbox" class="custom-control-input" id="shippingStatus" wire:model="status">

                            <label class="custom-control-label" for="shippingStatus">
                                Active
                            </label>

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
                        <button type="button" class="btn btn-primary" wire:click="create">
                            <i class="fa fa-save"></i>
                            Save
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
