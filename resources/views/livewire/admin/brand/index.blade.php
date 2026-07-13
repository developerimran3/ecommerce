<div>
    <div class="d-flex justify-content-between mb-3">
        <h4>Brands</h4>
        <button class="btn btn-primary" data-toggle="modal" data-target="#brandModal" wire:click="resetInput">
            <i class="fa fa-plus"></i> Add Brand </button>
    </div>


    <div class="row">
        <div class="col">
            <div class="card radius-10 mb-0">
                <div class="card-body">
                    <div class="table-responsive mt-3">
                        <table class="table align-middle table-bordered mb-0">
                            <thead class="text-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($brands as $brand)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="recent-product-img ">
                                                    @if ($brand->logo)
                                                        <img src="{{ asset('storage/' . $brand->logo) }}"
                                                            class="img-thumbnail" alt="">
                                                    @endif
                                                </div>
                                                <div class="ms-2">
                                                    <h6 class="mb-1 font-14">{{ $brand->name }}</h6>
                                                </div>
                                            </div>
                                        </td>

                                        <td>{{ $brand->slug }}</td>

                                        <td class="">
                                            @if ($brand->status)
                                                <span class="badge bg-light-success text-success w-50">
                                                    Active
                                                </span>
                                            @else
                                                <span class="badge bg-light-danger text-danger w-50">
                                                    Inactive
                                                </span>
                                            @endif
                                        </td>
                                        <td> {{ $brand->created_at->format('d M Y') }}</td>
                                        <td>
                                            <div class="d-flex order-actions"> <a href="javascript:;"
                                                    wire:click="delete({{ $brand->id }})"
                                                    onclick="confirm('Delete this brand?')"
                                                    class="text-danger bg-light-danger border-0"><i
                                                        class='bx bxs-trash'></i></a>

                                                <a href="javascript:;"wire:click="edit({{ $brand->id }})"
                                                    data-toggle="modal" data-target="#brandModal"
                                                    class="ms-4 text-primary bg-light-primary border-0"><i
                                                        class='bx bxs-edit'></i></a>
                                            </div>
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
                        {{ $brands->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div wire:ignore.self class="modal fade" id="brandModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>
                        {{ $brand_id ? 'Edit Brand' : 'Add Brand' }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="card border-top border-0 border-4 border-danger">
                    <div class="card-body p-5">
                        <div class="col-12">
                            <label class="form-label">Brand Name</label>
                            <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                        class='bx bxs-user'></i></span>
                                <input type="text" name="brand_name" wire:model.live="name"
                                    class="form-control border-start-0" id="inputLastName1" placeholder="Brand Name" />
                            </div>
                            @error('name')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="col-12 mt-2">
                            <label class="form-label">Logo</label>
                            <div class="input-group">
                                <input type="file" wire:model="logo" class="form-control border-start-0" />
                            </div>
                        </div>
                        @if ($logo)
                            <div class="mt-3">
                                <img src="{{ $logo->temporaryUrl() }}" width="80" height="80"
                                    class="img-thumbnail">
                            </div>
                        @endif

                        {{-- @if ($oldImage && !$image)
                            <img src="{{ asset('storage/' . $image) }}" width="80" class="img-thumbnail mb-2">
                        @endif --}}

                        <div class="col-12 mt-3 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" wire:model="status" id="gridCheck2">
                                <label class="form-check-label" for="gridCheck2">Active</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-secondary" data-dismiss="modal"> Close </button>
                            @if ($brand_id)
                                <button type="submit" class="btn btn-success" wire:click="update"> Update </button>
                            @else
                                <button type="submit" class="btn btn-primary" wire:click="store"> Save </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
