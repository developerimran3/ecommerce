<div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Category List</h4>

        <button class="btn btn-primary" data-toggle="modal" data-target="#categoryModal" wire:click="resetInput">
            <i class="fa fa-plus"></i> Add Category
        </button>
    </div>

    <div class="card shadow">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="thead-dark">

                        <tr>
                            <th width="80">#</th>
                            <th width="100">Image</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th width="180">Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse ($categories as $category)
                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>

                                    @if ($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" width="60"
                                            class="img-thumbnail">
                                    @else
                                        <span class="text-muted">
                                            No Image
                                        </span>
                                    @endif

                                </td>

                                <td>{{ $category->name }}</td>

                                <td>{{ $category->slug }}</td>

                                <td>

                                    @if ($category->status)
                                        <span class="badge badge-success">
                                            Active
                                        </span>
                                    @else
                                        <span class="badge badge-danger">
                                            Inactive
                                        </span>
                                    @endif

                                </td>

                                <td>

                                    <button class="btn btn-sm btn-warning" wire:click="edit({{ $category->id }})"
                                        data-toggle="modal" data-target="#categoryModal">

                                        <i class="fa fa-edit"></i>

                                    </button>

                                    <button class="btn btn-sm btn-danger" wire:click="delete({{ $category->id }})"
                                        onclick="return confirm('Delete this category?')">

                                        <i class="fa fa-trash"></i>

                                    </button>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center">
                                    No Data Found
                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                {{ $categories->links() }}

            </div>

        </div>

    </div>

    <!-- Modal -->

    <div wire:ignore.self class="modal fade" id="categoryModal" tabindex="-1">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">

                        {{ $category_id ? 'Edit Category' : 'Add Category' }}

                    </h5>

                    <button type="button" class="close" data-dismiss="modal">

                        <span>&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <div class="form-group">

                        <label>Name</label>

                        <input type="text" class="form-control" wire:model.live="name">

                        @error('name')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                    <div class="form-group">

                        <label>Image</label>

                        <input type="file" class="form-control" wire:model="image">

                        @error('image')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                    @if ($image)
                        <div class="mb-3">

                            <img src="{{ $image->temporaryUrl() }}" width="120" class="img-thumbnail">

                        </div>
                    @endif

                    <div class="form-group">

                        <label>

                            <input type="checkbox" wire:model="status">

                            Active

                        </label>

                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-secondary" data-dismiss="modal">

                        Close

                    </button>

                    @if ($category_id)
                        <button class="btn btn-success" wire:click="update">

                            Update

                        </button>
                    @else
                        <button class="btn btn-primary" wire:click="store">

                            Save

                        </button>
                    @endif

                </div>

            </div>

        </div>

    </div>

</div>
