<div>
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="page-title mb-0">Banner List</h4>
        @if (auth()->user()->hasPermission('categories.create'))
            <button class="btn btn-purple" wire:click="create">
                <i class="fas fa-th-list mr-1"></i> Add Banner </button>
        @endif
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="table-card p-4 bg-light">
                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle mb-0">
                        <thead>
                            <tr>
                                <th width="60">#</th>
                                <th>Category Name</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th width="130">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bannerindex as $banner)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        <div class="ml-3">
                                            <h6 class="mb-0 font-weight-bold">
                                                {{ $banner->name }}
                                            </h6>
                                        </div>
                                    </td>

                                    <td>
                                        @if ($banner->image)
                                            <img src="{{ asset('storage/' . $banner->image) }}" class="category-img" />
                                        @else
                                            <span class="text-muted"> No Image </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($banner->status)
                                            <span class="badge-success"> Active </span>
                                        @else
                                            <span class="badge-inactive"> Inactive </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (auth()->user()->hasPermission('categories.edit'))
                                            <button wire:click="edit({{ $banner->id }})" class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        @endif
                                        @if (auth()->user()->hasPermission('categories.delete'))
                                            <button wire:click="delete({{ $banner->id }})"
                                                wire:confirm="Are you sure you want to delete this banner?"
                                                class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                        @if (auth()->user()->hasPermission('categories.status'))
                                            <button wire:click="toggleStatus({{ $banner->id }})"
                                                class="btn btn-sm btn-warning">
                                                <i class="fas fa-power-off"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4"> No Data Found </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-3">
                    {{ $bannercategories->links() }}
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="bannerIndexModal" wire:ignore.self>
            <div class="modal-dialog modal-m">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Add Banners banner</h5>
                        <button class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        <form wire:submit.prevent="{{ $banner_id ? 'update' : 'store' }}">
                            <div class="form-group">
                                <label>banner Name <span class="text-danger">*</span> </label>
                                <input type="text" name="banner_name" wire:model="name" class="form-control"
                                    placeholder="banner Name">
                                @error('name')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="{{ $banner_id ? 'd-none' : '' }}">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="status"
                                        wire:model="status">
                                    <label class="custom-control-label" for="status"> Active </label>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-dismiss="modal"> Close </button>
                                @if ($banner_id)
                                    <button class="btn btn-success"> Update </button>
                                @else
                                    <button class="btn btn-primary"> Save </button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
