<div>
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="page-title mb-0">Category List</h4>
        @if (auth()->user()->hasPermission('banners_categories.create'))
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
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Placement</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th width="130">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($brandcategories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        <div class="ml-3">
                                            <h6 class="mb-0 font-weight-bold">
                                                {{ $category->name }}
                                            </h6>
                                        </div>
                                    </td>

                                    <td>
                                        {{ $category->slug }}
                                    </td>

                                    <td>
                                        {{ $category->placement }}
                                    </td>


                                    <td>
                                        {{ $category->created_at->format('d M Y h:i A') }}
                                    </td>

                                    <td>
                                        @if ($category->status)
                                            <span class="badge-success"> Active </span>
                                        @else
                                            <span class="badge-inactive"> Inactive </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (auth()->user()->hasPermission('banners_categories.edit'))
                                            <button wire:click="edit({{ $category->id }})" class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        @endif
                                        @if (auth()->user()->hasPermission('banners_categories.delete'))
                                            <button wire:click="delete({{ $category->id }})"
                                                wire:confirm="Are you sure you want to delete this Category?"
                                                class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                        @if (auth()->user()->hasPermission('banners_categories.status'))
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
                    {{ $brandcategories->links() }}
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="bannerCategoryModal" wire:ignore.self>
            <div class="modal-dialog modal-m">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Add Banners Category</h5>
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

                            {{-- Placement --}}
                            <div class="form-group">
                                <label> Placement <span class="text-danger">*</span> </label>
                                <select class="form-control" wire:model="placement">
                                    <option value=""> -- Select Placement -- </option>
                                    <option value="main_slider"> Main Slider </option>
                                    <option value="promo_banner"> Promo Banner </option>
                                    <option value="footer_banner"> Footer Banner </option>
                                </select>
                                @error('placement')
                                    <small class="text-danger"> {{ $message }} </small>
                                @enderror
                            </div>
                            <div class="{{ $category_id ? 'd-none' : '' }}">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="status"
                                        wire:model="status">
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
    </div>
</div>
