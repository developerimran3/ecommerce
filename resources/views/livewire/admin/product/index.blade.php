<div>

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h4>Products</h4>

        <button class="btn btn-primary" data-toggle="modal" data-target="#productModal" wire:click="resetInput">

            <i class="fa fa-plus"></i>

            Add Product

        </button>

    </div>

    <div class="card shadow">

        <div class="card-body">

            <div class="row mb-3">

                <div class="col-md-3">

                    <input type="text" class="form-control" placeholder="Search product..." wire:model.live="search">

                </div>

                <div class="col-md-3">

                    <select class="form-control" wire:model.live="filterCategory">

                        <option value="">
                            All Categories
                        </option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">

                                {{ $category->name }}

                            </option>
                        @endforeach

                    </select>

                </div>

                <div class="col-md-3">

                    <select class="form-control" wire:model.live="filterBrand">

                        <option value="">
                            All Brands
                        </option>

                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">

                                {{ $brand->name }}

                            </option>
                        @endforeach

                    </select>

                </div>

                <div class="col-md-3">

                    <select class="form-control" wire:model.live="filterStatus">

                        <option value="">
                            All Status
                        </option>

                        <option value="1">
                            Active
                        </option>

                        <option value="0">
                            Inactive
                        </option>

                    </select>

                </div>
                <div class="col-md-3 mt-2">
                    <button class="btn btn-secondary" wire:click="clearFilters">
                        Reset Filter
                    </button>
                </div>


            </div>




            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="thead-dark">

                        <tr>

                            <th>#</th>

                            <th>Image</th>

                            <th>Name</th>

                            <th>Category</th>

                            <th>Brand</th>

                            <th>SKU</th>

                            <th>Price</th>

                            <th>Stock</th>

                            <th>Status</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse ($products as $product)
                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>

                                    @if ($product->thumbnail)
                                        <img src="{{ asset('storage/' . $product->thumbnail) }}" width="60"
                                            class="img-thumbnail">
                                    @endif

                                </td>

                                <td>{{ $product->name }}</td>

                                <td>{{ $product->category?->name }}</td>

                                <td>{{ $product->brand?->name }}</td>

                                <td>{{ $product->sku }}</td>

                                <td>৳ {{ number_format($product->price, 2) }}</td>

                                <td>{{ $product->stock }}</td>

                                <td>

                                    @if ($product->status)
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

                                    <button class="btn btn-warning btn-sm" wire:click="edit({{ $product->id }})"
                                        data-toggle="modal" data-target="#productModal">
                                        <i class="fa fa-edit"></i>
                                    </button>

                                    <button class="btn btn-danger btn-sm" wire:click="delete({{ $product->id }})"
                                        onclick="return confirm('Delete this product?')">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="10" class="text-center">

                                    No Product Found

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                {{ $products->links() }}

            </div>

        </div>

    </div>

    <!-- Modal -->

    <div class="modal fade" id="productModal" wire:ignore.self>

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">

                    <h5>Add Product</h5>

                    <button class="close" data-dismiss="modal">

                        <span>&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Category</label>

                                <select class="form-control" wire:model="category_id">

                                    <option value="">
                                        Select Category
                                    </option>

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Brand</label>

                                <select class="form-control" wire:model="brand_id">

                                    <option value="">
                                        Select Brand
                                    </option>

                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <label>Name</label>

                        <input type="text" class="form-control" wire:model.live="name">

                    </div>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>SKU</label>

                                <input type="text" class="form-control" wire:model="sku">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Stock</label>

                                <input type="number" class="form-control" wire:model="stock">

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Price</label>

                                <input type="number" class="form-control" wire:model="price">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Discount Price</label>

                                <input type="number" class="form-control" wire:model="discount_price">

                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <label>Thumbnail</label>

                        <input type="file" class="form-control" wire:model="thumbnail">

                    </div>

                    @if ($thumbnail)
                        <img src="{{ $thumbnail->temporaryUrl() }}" width="120" class="img-thumbnail mb-3">
                    @endif
                    @if ($oldThumbnail && !$thumbnail)
                        <img src="{{ asset('storage/' . $oldThumbnail) }}" width="120"
                            class="img-thumbnail mb-2">
                    @endif
                    <div class="form-group">

                        <label>Gallery</label>

                        <input type="file" multiple class="form-control" wire:model="gallery">

                    </div>

                    <div class="row">

                        @foreach ($gallery as $image)
                            <div class="col-md-3 mb-2">

                                <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail">

                            </div>
                        @endforeach
                        @if ($product_id && count($oldGallery))
                            <div class="mt-4">
                                <div class="row">
                                    @foreach ($oldGallery as $image)
                                        <div class="col-md-3 mb-3">
                                            <div class="card">
                                                <img src="{{ asset('storage/' . $image->image) }}"
                                                    class="card-img-top">
                                                <div class="card-body p-2 text-center">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        wire:click="removeGalleryImage({{ $image->id }})">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    </div>


                    <div class="form-group">
                        <label>Short Description</label>
                        <textarea class="form-control" rows="3" wire:model="short_description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="5" wire:model="description"></textarea>
                    </div>

                    <div class="form-check">

                        <input type="checkbox" class="form-check-input" wire:model="featured">

                        <label class="form-check-label">

                            Featured Product

                        </label>

                    </div>

                    <div class="form-check">

                        <input type="checkbox" class="form-check-input" wire:model="status">

                        <label class="form-check-label">

                            Active

                        </label>

                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-secondary" data-dismiss="modal">

                        Close

                    </button>
                    @if ($product_id)
                        <button class="btn btn-success" wire:click="update">
                            Update Product
                        </button>
                    @else
                        <button class="btn btn-primary" wire:click="store">
                            Save Product
                        </button>
                    @endif
                </div>

            </div>

        </div>

    </div>

</div>
