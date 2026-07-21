<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">List of Brands</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Brands</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-table">
                <div class="card-header">
                    <div class="d-flex justify-content-between mb-3">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#brandModal"
                            wire:click="resetInput">
                            <i class="fa fa-plus"></i> Add New Brand </button>
                        <input type="text" class="form-control w-25" placeholder="Search..."
                            wire:model.live="search">
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-center mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Status change</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th style="width: 20px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $brand)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a class="avatar avatar-sm mr-2">


                                                    @if ($brand->logo)
                                                        <img class="avatar-img rounded-circle"
                                                            src="{{ asset('storage/' . $brand->logo) }}"
                                                            alt="User Image">
                                                    @else
                                                        <img class="avatar-img rounded-circle"
                                                            src="https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg"
                                                            alt="User Image">
                                                    @endif
                                                </a>
                                                <a class="text-capitalize">{{ $brand->name }}</a>
                                            </h2>
                                        </td>
                                        <td> {{ $brand->slug }} </td>

                                        <td>
                                            <div class="status-toggle">
                                                <input type="checkbox" id="status_{{ $brand->id }}" class="check"
                                                    {{ $brand->status ? 'checked' : '' }}
                                                    wire:change="changeStatus({{ $brand->id }})">

                                                <label for="status_{{ $brand->id }}" class="checktoggle">
                                                </label>
                                            </div>
                                        </td>

                                        <td> {{ $brand->created_at->format('d M Y') }}</td>

                                        <td>
                                            <span
                                                class="badge badge-pill {{ $brand->status ? 'bg-success' : 'bg-danger' }} inv-badge">
                                                {{ $brand->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="text-right">
                                            <div class="actions">
                                                <a href="#" data-toggle="modal" data-target="#brandModal"
                                                    wire:click="edit({{ $brand->id }})"
                                                    class="btn btn-sm bg-success-light mr-2">
                                                    <i class="fe fe-pencil"></i> Edit
                                                </a>
                                                <a class="btn btn-sm bg-danger-light"
                                                    wire:click="delete({{ $brand->id }})"
                                                    wire:confirm="Are you sure? Brand Delete?">
                                                    <i class="fe fe-trash"></i> Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div>
                        {{ $brands->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Brand Modal -->
    <div wire:ignore.self class="modal fade" id="brandModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ $brand_id ? 'Edit Brand' : 'Add Brand' }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{ $brand_id ? 'update' : 'store' }}">
                        <div class="row form-row">
                            <div class="col-12 ">
                                <div class="form-group">
                                    <label>Brand Name</label>
                                    <input type="text" class="form-control text-capitalize" name="brand_name"
                                        wire:model="name">
                                </div>
                            </div>
                            <div class="col-12 ">
                                <div class="form-group">
                                    <label>Logo</label>
                                    <input type="file" class="form-control text-capitalize" wire:model="logo">
                                </div>
                                @if ($logo)
                                    <img src="{{ $logo->temporaryUrl() }}" width="80" height="80"
                                        class="img-thumbnail mb-2">
                                @endif
                            </div>


                            <div class="col-12 {{ $brand_id ? 'd-none' : '' }}">
                                <div class="form-group">
                                    <label>Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" wire:model="status"
                                            id="invalidCheck">
                                        <label class="form-check-label" for="invalidCheck"> Active </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($brand_id)
                            <button type="submit" class="btn btn-success"> Update </button>
                        @else
                            <button type="submit" class="btn btn-primary"> Save </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Brand Modal -->



</div>
