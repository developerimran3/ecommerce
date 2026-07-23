<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="page-title mb-0">Brand List</h4>
        <button class="btn btn-purple" data-toggle="modal" data-target="#brandModal" wire:click="resetInput">
            <i class="fa fa-plus mr-1"></i> Add Brand </button>
    </div>

    <div class="table-card">

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th width="60">#</th>
                        <th>Image</th>
                        <th>Brand Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($brands as $brand)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="category-img-wrapper">
                                        @if ($brand->logo)
                                            <img src="{{ asset('storage/' . $brand->logo) }}" class="category-img">
                                        @else
                                            <div class="category-placeholder">
                                                <i class="fa fa-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="ml-3">
                                    <h6 class="mb-0 font-weight-bold text-capitalize">
                                        {{ $brand->name }}
                                    </h6>
                                </div>
                            </td>
                            <td>
                                <span class="text-muted font-monospace">
                                    {{ $brand->slug }}
                                </span>
                            </td>
                            <td>
                                @if ($brand->status)
                                    <span class="badge-status"> Active </span>
                                @else
                                    <span class="badge-inactive"> Inactive </span>
                                @endif
                            </td>
                            <td>
                                {{ $brand->created_at->format('d M Y') }}
                            </td>
                            <td>
                                <div class="d-flex">
                                    <button class="btn btn-sm btn-edit mr-2" data-toggle="modal"
                                        data-target="#brandModal" wire:click="edit({{ $brand->id }})">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-delete" wire:click="delete({{ $brand->id }})"
                                        wire:confirm="Are you sure you want to delete this brand?">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">No Data Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">
            {{ $brands->links() }}
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
