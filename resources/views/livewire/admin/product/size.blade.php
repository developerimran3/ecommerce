<div>
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-1 font-weight-bold">sizes List</h4>
        </div>

        @if (auth()->user()->hasPermission('sizes.create'))
            <button class="btn btn-purple px-3" wire:click="create">
                <i class="fa fa-plus mr-1"></i>
                Add Size
            </button>
        @endif
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="table-card p-4 bg-light">
                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-hover table-bordered mb-0">
                        <thead>
                            <tr>
                                <th width="80">SL</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th width="130">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($sizes as $size)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ str($size->name) }}</td>
                                    <td>
                                        @if ($size->status)
                                            <span class="badge-success"> Active </span>
                                        @else
                                            <span class="badge-inactive"> Inactive </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (auth()->user()->hasPermission('sizes.edit'))
                                            <button wire:click="edit({{ $size->id }})" class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        @endif
                                        @if (auth()->user()->hasPermission('sizes.delete'))
                                            <button wire:click="delete({{ $size->id }})"
                                                wire:confirm="Are you sure you want to delete this sizes?"
                                                class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                        @if (auth()->user()->hasPermission('sizes.status'))
                                            <button wire:click="toggleStatus({{ $size->id }})"
                                                class="btn btn-sm btn-warning">
                                                <i class="fas fa-power-off"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center"> No Data Found </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($sizes->hasPages())
                    <div class="pagination-area">
                        {{ $sizes->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- size Modal -->
    <div wire:ignore.self class="modal fade" id="sizeModal" tabindex="-1">
        <div class="modal-dialog modal-m">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $sizeId ? 'Edit Size' : 'Add Size' }}</h5>
                    <button class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <form wire:submit.prevent="{{ $sizeId ? 'store' : 'store' }}">
                        <div class="form-group">
                            <label>Size Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" wire:model="name"
                                placeholder="Enter size name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="{{ $sizeId ? 'd-none' : '' }}">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="status" wire:model="status">
                                <label class="custom-control-label" for="status"> Active </label>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                            @if ($sizeId)
                                <button class="btn btn-success">Update</button>
                            @else
                                <button class="btn btn-primary">Save</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
