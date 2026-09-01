<div>
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-1 font-weight-bold">Colors List</h4>
        </div>

        @if (auth()->user()->hasPermission('colors.create'))
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
                            @forelse ($colors as $color)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="btn"
                                            style="background-color:{{ $color->color_code }};color: #fff">{{ $color->name }}</span>
                                    </td>

                                    <td>
                                        @if ($color->status)
                                            <span class="badge-success"> Active </span>
                                        @else
                                            <span class="badge-inactive"> Inactive </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (auth()->user()->hasPermission('colors.edit'))
                                            <button wire:click="edit({{ $color->id }})" class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        @endif
                                        @if (auth()->user()->hasPermission('colors.delete'))
                                            <button wire:click="delete({{ $color->id }})"
                                                wire:confirm="Are you sure you want to delete this colors?"
                                                class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                        @if (auth()->user()->hasPermission('colors.status'))
                                            <button wire:click="toggleStatus({{ $color->id }})"
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
                @if ($colors->hasPages())
                    <div class="pagination-area">
                        {{ $colors->links() }}
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
                    <h5 class="modal-title">{{ $colorId ? 'Edit color' : 'Add color' }}</h5>
                    <button class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <form wire:submit.prevent="{{ $colorId ? 'store' : 'store' }}">
                        <div class="form-group">
                            <label>color Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control text-capitalize" name="name" wire:model="name"
                                placeholder="Enter color name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>color Name <span class="text-danger">*</span></label>
                            <input type="color" class="form-control" name="color_code" wire:model="color_code">
                            @error('color_code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="{{ $colorId ? 'd-none' : '' }}">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="status" wire:model="status">
                                <label class="custom-control-label" for="status"> Active </label>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                            @if ($colorId)
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
