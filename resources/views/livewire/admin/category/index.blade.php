<div>
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="page-title mb-0">Category List</h4>
        @if (auth()->user()->hasPermission('categories.create'))
            <button class="btn btn-purple" wire:click="create">
                <i class="fas fa-th-list mr-1"></i> Add Category </button>
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
                                <th>Image</th>
                                <th>Category</th>
                                <th>Slug</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th width="130">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="category-img-wrapper">
                                                @if ($category->image)
                                                    <img src="{{ asset('storage/' . $category->image) }}"
                                                        class="category-img">
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
                                            <h6
                                                class="mb-0 font-weight-bold {{ $category->front_view ? 'front-view-active' : '' }}">
                                                {{ $category->name }}
                                            </h6>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="text-muted">
                                            {{ $category->slug }}
                                        </span>
                                    </td>


                                    <td>
                                        {{ $category->created_at->format('d M Y') }}
                                    </td>

                                    <td>
                                        @if ($category->status)
                                            <span class="badge-success"> Active </span>
                                        @else
                                            <span class="badge-inactive"> Inactive </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (auth()->user()->hasPermission('categories.edit'))
                                            <button wire:click="edit({{ $category->id }})" class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        @endif
                                        @if (auth()->user()->hasPermission('categories.delete'))
                                            <button wire:click="delete({{ $category->id }})"
                                                wire:confirm="Are you sure you want to delete this Category?"
                                                class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                        @if (auth()->user()->hasPermission('categories.status'))
                                            <button wire:click="toggleStatus({{ $category->id }})"
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
                    {{ $categories->links() }}
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="categoryModal" wire:ignore.self>
            <div class="modal-dialog modal-m">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Add Category</h5>
                        <button class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        <form wire:submit.prevent="{{ $category_id ? 'update' : 'store' }}">
                            <div class="form-group">
                                <label>Category Name <span class="text-danger">*</span> </label>
                                <input type="text" name="category_name" wire:model="name" class="form-control"
                                    placeholder="Category Name">
                                @error('name')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" wire:model="image" class="form-control">
                            </div>
                            @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" width="90" class="img-thumbnail mb-3">
                            @endif
                            @if ($oldImage && !$image)
                                <img src="{{ asset('storage/' . $oldImage) }}" width="90"
                                    class="img-thumbnail mb-3">
                            @endif
                            <div class="{{ $category_id ? 'd-none' : '' }}">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="status"
                                        wire:model="status">
                                    <label class="custom-control-label" for="status"> Active </label>
                                </div>
                            </div>

                            <div class="custom-control custom-switch">
                                <input style="font-size: 30px" type="checkbox" class="custom-control-input"
                                    id="front_view" wire:model="front_view">
                                <label class="custom-control-label" for="front_view"> Front View </label>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-dismiss="modal"> Close </button>
                                @if ($category_id)
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
