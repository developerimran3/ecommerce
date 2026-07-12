<div>

    <div class="d-flex justify-content-between mb-3">

        <h4>Brands</h4>

        <button class="btn btn-primary" data-toggle="modal" data-target="#brandModal" wire:click="resetInput">

            <i class="fa fa-plus"></i>

            Add Brand

        </button>

    </div>

    <div class="card">

        <div class="card-body">

            <table class="table table-bordered">

                <thead class="thead-dark">

                    <tr>

                        <th>#</th>
                        <th>Logo</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach ($brands as $brand)
                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>

                                @if ($brand->logo)
                                    <img src="{{ asset('storage/' . $brand->logo) }}" width="50">
                                @endif

                            </td>

                            <td>{{ $brand->name }}</td>

                            <td>{{ $brand->slug }}</td>

                            <td>

                                @if ($brand->status)
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

                                <button class="btn btn-warning btn-sm" wire:click="edit({{ $brand->id }})"
                                    data-toggle="modal" data-target="#brandModal">

                                    <i class="fa fa-edit"></i>

                                </button>

                                <button class="btn btn-danger btn-sm" wire:click="delete({{ $brand->id }})">

                                    <i class="fa fa-trash"></i>

                                </button>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

            {{ $brands->links() }}

        </div>

    </div>

    <div wire:ignore.self class="modal fade" id="brandModal">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h5>

                        {{ $brand_id ? 'Edit Brand' : 'Add Brand' }}

                    </h5>

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

                        <label>Logo</label>

                        <input type="file" class="form-control" wire:model="logo">

                    </div>

                    @if ($logo)
                        <img src="{{ $logo->temporaryUrl() }}" width="120">
                    @endif

                    <div class="mt-3">

                        <input type="checkbox" wire:model="status">

                        Active

                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-secondary" data-dismiss="modal">

                        Close

                    </button>

                    @if ($brand_id)
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
