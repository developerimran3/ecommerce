<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="page-title mb-0">Category List</h4>
        @if (auth()->user()->hasPermission('category.create'))
            <button class="btn btn-purple" data-toggle="modal" data-target="#categoryModal" wire:click="resetInput">
                <i class="fas fa-th-list mr-1"></i> Add Category </button>
        @endif
    </div>

    <div class="table-card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th width="60">#</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Slug</th>
                        <th>Status Change</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
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
                                            <img src="{{ asset('storage/' . $category->image) }}" class="category-img">
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
                                    <h6 class="mb-0 font-weight-bold">
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
                                @if (auth()->user()->hasPermission('category.status'))
                                    <div class="custom-control custom-switch d-inline-block"
                                        style="transform: scale(1.4); transform-origin: left center;">
                                        <input type="checkbox" class="custom-control-input"
                                            id="status{{ $category->id }}" {{ $category->status ? 'checked' : '' }}
                                            wire:click="changeStatus({{ $category->id }})">

                                        <label class="custom-control-label" for="status{{ $category->id }}"></label>
                                    </div>
                                @endif
                            </td>

                            <td>
                                {{ $category->created_at->format('d M Y') }}
                            </td>

                            <td>
                                @if ($category->status)
                                    <span class="badge-status"> Active </span>
                                @else
                                    <span class="badge-inactive"> Inactive </span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex">
                                    @if (auth()->user()->hasPermission('category.edit'))
                                        <button class="btn btn-sm btn-edit mr-2" wire:click="edit({{ $category->id }})"
                                            data-toggle="modal" data-target="#categoryModal"> <i class="fa fa-edit"></i>
                                        </button>
                                    @endif
                                    @if (auth()->user()->hasPermission('category.delete'))
                                        <button class="btn btn-sm btn-delete" wire:click="delete({{ $category->id }})"
                                            wire:confirm="Delete this category?"> <i class="fa fa-trash"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4"> No Data Found </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">
            {{ $categories->links() }}
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
                            <img src="{{ asset('storage/' . $oldImage) }}" width="90" class="img-thumbnail mb-3">
                        @endif
                        <div class="{{ $category_id ? 'd-none' : '' }}">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="status" wire:model="status">
                                <label class="custom-control-label" for="status"> Active </label>
                            </div>
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
