<div>
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-1 font-weight-bold">Brand List</h4>
        </div>

        @if (auth()->user()->hasPermission('brand.create'))
            <button class="btn btn-purple px-3" wire:click="create">
                <i class="fa fa-plus mr-1"></i>
                Add Brand
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
                                <th>SL</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Publish</th>
                                <th>Status</th>
                                <th width="130">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($brands as $brand)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($brand->logo)
                                            <img src="{{ asset('storage/' . $brand->logo) }}" class="category-img" />
                                        @else
                                            <span class="text-muted"> No Image </span>
                                        @endif
                                    </td>

                                    <td>{{ str($brand->name)->limit(30) }}</td>

                                    <td>{{ $brand->slug }}</td>
                                    <td> {{ $brand->created_at->format('d M Y') }}</td>
                                    <td>
                                        @if ($brand->status)
                                            <span class="badge-success"> Active </span>
                                        @else
                                            <span class="badge-inactive"> Inactive </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (auth()->user()->hasPermission('brands.edit'))
                                            <button wire:click="edit({{ $brand->id }})" class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        @endif
                                        @if (auth()->user()->hasPermission('brands.delete'))
                                            <button wire:click="delete({{ $brand->id }})"
                                                wire:confirm="Are you sure you want to delete this Brand?"
                                                class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                        @if (auth()->user()->hasPermission('brands.status'))
                                            <button wire:click="toggleStatus({{ $brand->id }})"
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

                @if ($brands->hasPages())
                    <div class="pagination-area">
                        {{ $brands->links() }}
                    </div>
                @endif

            </div>

        </div>
    </div>

    <!-- Brand Modal -->
    <div wire:ignore.self class="modal fade" id="brandModal" tabindex="-1">
        <div class="modal-dialog modal-m">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $brand_id ? 'Edit Brand' : 'Add Brand' }}</h5>
                    <button class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <form wire:submit.prevent="{{ $brand_id ? 'update' : 'store' }}">
                        <div class="form-group">
                            <label>Brand Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="brand_name" wire:model="name"
                                placeholder="Enter brand name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Logo</label>
                            <input type="file" wire:model="logo" class="form-control">
                        </div>

                        <!-- Logo Preview -->
                        <div class="mt-3">
                            @if ($logo)
                                <img src="{{ $logo->temporaryUrl() }}" width="90" class="img-thumbnail"
                                    alt="New Logo">
                            @elseif ($oldLogo)
                                <img src="{{ asset('storage/' . $oldLogo) }}" width="90" class="img-thumbnail"
                                    alt="Current Logo">
                            @endif
                        </div>

                        <div class="{{ $brand_id ? 'd-none' : '' }}">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="status" wire:model="status">
                                <label class="custom-control-label" for="status"> Active </label>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                            @if ($brand_id)
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
