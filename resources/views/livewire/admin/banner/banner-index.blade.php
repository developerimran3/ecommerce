<div>
    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="page-title mb-0"> Banners & Ads </h4>
        @if (auth()->user()->hasPermission('banners.create'))
            <button type="button" class="btn btn-purple" wire:click="create">
                <i class="fas fa-plus"></i> Add Banner
            </button>
        @endif
    </div>


    {{-- Filter Card --}}
    <div class="table-card p-4 bg-light mb-4">
        <div class="row">
            {{-- Search --}}
            <div class="col-md-4 mb-3">
                <input type="text" class="form-control" placeholder="🔍 Search category..." wire:model.live="search">
            </div>

            {{-- Category --}}
            <div class="col-md-3 mb-3">
                <select class="form-control" wire:model.live="filterCategory">
                    <option value=""> All Categories </option>
                    @foreach ($bannercategories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Status --}}
            <div class="col-md-3 mb-3">
                <select class="form-control" wire:model.live="filterStatus">
                    <option value=""> All Status </option>
                    <option value="1"> Active </option>
                    <option value="0"> Inactive </option>
                </select>
            </div>

            {{-- Clear --}}
            <div class="col-md-2 mb-3">
                <button type="button" class="btn btn-light border w-100" wire:click="clearFilters">
                    <i class="fas fa-sync-alt"></i> Clear
                </button>
            </div>
        </div>
    </div>


    {{-- Table --}}
    <div class="table-card p-4 bg-light">
        <div class="table-responsive">
            <table class="table table-hover table-bordered mb-0">
                <thead>
                    <tr>
                        <th width="60"> SL </th>
                        <th width="150"> Image </th>
                        <th> Category </th>
                        <th> Status </th>
                        <th> Created </th>
                        <th width="150"> Action </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($bannerindex as $banner)
                        <tr>
                            {{-- SL --}}
                            <td>
                                {{ $bannerindex->firstItem() + $loop->index }}
                            </td>


                            {{-- Image --}}
                            <td>
                                @if ($banner->image)
                                    <img src="{{ asset('storage/' . $banner->image) }}"
                                        style="
                                            width:120px;
                                            height:60px;
                                            object-fit:cover;
                                            border-radius:6px;
                                        ">
                                @else
                                    <span class="text-muted"> No Image </span>
                                @endif
                            </td>

                            {{-- Category --}}
                            <td>
                                {{ $banner->category?->name }}
                            </td>

                            {{-- Status --}}
                            <td>
                                @if ($banner->status)
                                    <span class="badge-success"> Active </span>
                                @else
                                    <span class="badge-inactive"> Inactive </span>
                                @endif
                            </td>

                            {{-- Created --}}
                            <td>
                                {{ $banner->created_at?->format('d M Y') }}
                            </td>

                            {{-- Action --}}
                            <td>
                                @if (auth()->user()->hasPermission('banners.edit'))
                                    <button type="button" class="btn btn-sm btn-info"
                                        wire:click="edit({{ $banner->id }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                @endif

                                @if (auth()->user()->hasPermission('banners.status'))
                                    <button type="button" class="btn btn-sm btn-warning"
                                        wire:click="toggleStatus({{ $banner->id }})">
                                        <i class="fas fa-power-off"></i>
                                    </button>
                                @endif

                                @if (auth()->user()->hasPermission('banners.delete'))
                                    <button type="button" class="btn btn-sm btn-danger"
                                        wire:click="delete({{ $banner->id }})"
                                        wire:confirm="Are you sure you want to delete this banner?">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @endif
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

        {{-- Pagination --}}
        <div class="p-3 border-top">
            {{ $bannerindex->links() }}
        </div>
    </div>


    {{-- ========================================================= --}}
    {{-- Banner Modal --}}
    {{-- ========================================================= --}}

    <div wire:ignore.self class="modal fade" id="bannerIndexModal" tabindex="-1" role="dialog">

        <div class="modal-dialog modal-lg" role="document">

            <div class="modal-content">


                {{-- Header --}}
                <div class="modal-header">

                    <h5 class="modal-title">

                        {{ $banner_id ? 'Edit Banner' : 'Add Banner' }}

                    </h5>

                    <button type="button" class="close" data-dismiss="modal">
                        <span>
                            &times;
                        </span>
                    </button>

                </div>


                {{-- Body --}}
                <div class="modal-body">

                    {{-- Category --}}
                    <div class="form-group">

                        <label>
                            Banner Category
                            <span class="text-danger">*</span>
                        </label>

                        <select class="form-control" wire:model="banner_category_id">

                            <option value="">
                                Select Category...
                            </option>

                            @foreach ($bannercategories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('banner_category_id')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    {{-- Image --}}
                    <div class="form-group">

                        <label>
                            Banner Image

                            @if (!$banner_id)
                                <span class="text-danger">
                                    *
                                </span>
                            @endif

                        </label>

                        <input type="file" class="form-control" wire:model="image" accept="image/*">

                        @error('image')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror


                        {{-- Loading --}}
                        <div wire:loading wire:target="image" class="mt-2 text-info">
                            Uploading image...
                        </div>


                        {{-- New Preview --}}
                        @if ($image)
                            <div class="mt-3">

                                <img src="{{ $image->temporaryUrl() }}"
                                    style="
                                        width:100%;
                                        max-height:250px;
                                        object-fit:cover;
                                        border-radius:8px;
                                    ">

                            </div>
                        @endif


                        {{-- Old Preview --}}
                        @if ($oldImage && !$image)
                            <div class="mt-3">

                                <img src="{{ asset('storage/' . $oldImage) }}"
                                    style="
                                        width:100%;
                                        max-height:250px;
                                        object-fit:cover;
                                        border-radius:8px;
                                    ">

                            </div>
                        @endif

                    </div>


                    {{-- Status --}}
                    <div class="form-group">

                        <div class="custom-control custom-switch">

                            <input type="checkbox" class="custom-control-input" id="bannerStatus" wire:model="status">

                            <label class="custom-control-label" for="bannerStatus">
                                Active Banner
                            </label>

                        </div>

                    </div>

                </div>


                {{-- Footer --}}
                <div class="modal-footer">

                    <button type="button" class="btn btn-light" data-dismiss="modal">
                        Cancel
                    </button>


                    @if ($banner_id)
                        <button type="button" class="btn btn-success" wire:click="update"
                            wire:loading.attr="disabled">

                            <span wire:loading wire:target="update">
                                Updating...
                            </span>

                            <span wire:loading.remove wire:target="update">
                                Update
                            </span>

                        </button>
                    @else
                        <button type="button" class="btn btn-purple" wire:click="store"
                            wire:loading.attr="disabled">

                            <span wire:loading wire:target="store">
                                Saving...
                            </span>

                            <span wire:loading.remove wire:target="store">
                                Publish
                            </span>

                        </button>
                    @endif

                </div>

            </div>

        </div>

    </div>

</div>
