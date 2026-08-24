<div>
    <div>

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-1 font-weight-bold">Brand List</h4>
                <small class="text-muted">Manage all your brands</small>
            </div>

            @if (auth()->user()->hasPermission('brand.create'))
                <button class="btn btn-primary px-3" wire:click="create">
                    <i class="fa fa-plus mr-1"></i>
                    Add Brand
                </button>
            @endif
        </div>


        {{-- Table --}}
        {{-- <div class="modern-table">

            <div class="table-responsive">
                <table class="table mb-0">

                    <thead>
                        <tr>
                            <th width="60">#</th>
                            <th width="80">Image</th>
                            <th>Brand</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th width="130">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($brands as $brand)

                            <tr>

                                <td class="text-muted">
                                    {{ $loop->iteration }}
                                </td>


                                <td>
                                    @if ($brand->logo)
                                        <img src="{{ asset('storage/' . $brand->logo) }}" class="brand-image"
                                            alt="{{ $brand->name }}">
                                    @else
                                        <div class="brand-image-placeholder">
                                            <i class="fa fa-image"></i>
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    <span class="brand-name">
                                        {{ $brand->name }}
                                    </span>
                                </td>


                                <td>
                                    <span class="slug">
                                        {{ $brand->slug }}
                                    </span>
                                </td>

                                <td>

                                    @if (auth()->user()->hasPermission('brand.status'))
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input"
                                                id="brandStatus{{ $brand->id }}"
                                                {{ $brand->status ? 'checked' : '' }}
                                                wire:click="changeStatus({{ $brand->id }})">

                                            <label class="custom-control-label" for="brandStatus{{ $brand->id }}">
                                            </label>
                                        </div>
                                    @else
                                        @if ($brand->status)
                                            <span class="status active">
                                                Active
                                            </span>
                                        @else
                                            <span class="status inactive">
                                                Inactive
                                            </span>
                                        @endif
                                    @endif

                                </td>


                                <td class="text-muted">
                                    {{ $brand->created_at->format('d M Y') }}
                                </td>


                                <td>

                                    <div class="action-buttons">

                                        @if (auth()->user()->hasPermission('brand.edit'))
                                            <button type="button" class="action-btn edit"
                                                wire:click="edit({{ $brand->id }})" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        @endif

                                        @if (auth()->user()->hasPermission('brand.delete'))
                                            <button type="button" class="action-btn delete"
                                                wire:click="delete({{ $brand->id }})"
                                                wire:confirm="Are you sure you want to delete this brand?"
                                                title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="empty-data">
                                    <i class="fa fa-folder-open"></i>
                                    <div>No brands found</div>
                                </td>
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

        </div> --}}

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
