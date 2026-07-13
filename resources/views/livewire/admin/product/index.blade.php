<div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Products</h4>
        <button class="btn btn-primary" data-toggle="modal" data-target="#productModal" wire:click="resetInput">
            <i class="fa fa-plus"></i> Add Product </button>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Search product..." wire:model.live="search">
                </div>
                <div class="col-md-3">
                    <select class="form-control" wire:model.live="filterCategory">
                        <option value=""> All Categories </option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-control" wire:model.live="filterBrand">
                        <option value=""> All Brands </option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <select class="form-control" wire:model.live="filterStatus">
                        <option value=""> All Status </option>
                        <option value="1"> Active </option>
                        <option value="0"> Inactive </option>
                    </select>
                </div>
                <div class="col-md-3 mt-2">
                    <button class="btn btn-secondary" wire:click="clearFilters">
                        Reset Filter
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="card radius-10 mb-0">
                        <div class="card-body">
                            <div class="table-responsive mt-3">
                                <table class="table align-middle mb-0 table-bordered">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Brand</th>
                                            <th>SKU</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Status</th>
                                            <th>Publish</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($products as $product)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="recent-product-img-product">
                                                            @if ($product->thumbnail)
                                                                <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                                    class="img-thumbnail" alt="">
                                                            @else
                                                                <span class="text-muted">
                                                                    No Image
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="ms-2">
                                                            <h6 class="mb-1 font-14 text-capitalize">
                                                                {{ $product->name }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $product->category?->name }}</td>
                                                <td>{{ $product->brand?->name }}</td>
                                                <td>{{ $product->sku }}</td>
                                                <td>৳ {{ number_format($product->price, 2) }}</td>
                                                <td>{{ $product->stock }}</td>
                                                <td class="">
                                                    @if ($product->status)
                                                        <span class="badge bg-light-success text-success w-50">
                                                            Active
                                                        </span>
                                                    @else
                                                        <span class="badge bg-light-danger text-danger w-50">
                                                            Inactive
                                                        </span>
                                                    @endif
                                                </td>
                                                <td> {{ $product->created_at->format('d M Y') }}</td>
                                                <td>
                                                    <div class="d-flex order-actions"> <a href="javascript:;"
                                                            wire:click="delete({{ $product->id }})"
                                                            onclick="confirm('Delete this category?')"
                                                            class="text-danger bg-light-danger border-0"><i
                                                                class='bx bxs-trash'></i></a>

                                                        <a href="javascript:;"wire:click="edit({{ $product->id }})"
                                                            data-toggle="modal" data-target="#productModal"
                                                            class="ms-2 text-primary bg-light-primary border-0"><i
                                                                class='bx bxs-edit'></i></a>
                                                    </div>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center">
                                                    No Data Found
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
                </div>
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
                                    <option value=""> Select Category </option>
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
                                    <option value=""> Select Brand </option>
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
                        <label class="form-check-label"> Featured Product </label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" wire:model="status">
                        <label class="form-check-label"> Active </label>
                    </div>
                </div>


                {{-- <div class="card ">
                    <div class="card-body p-4">
                        <h5 class="card-title">Add New Product</h5>
                        <hr />
                        <div class="form-body mt-4">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="mb-3">
                                            <label for="inputProductTitle" class="form-label">Product Title</label>
                                            <input type="email" class="form-control" id="inputProductTitle"
                                                placeholder="Enter product title">
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputProductDescription" class="form-label">Description</label>
                                            <textarea class="form-control" id="inputProductDescription" rows="3"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="inputProductDescription" class="form-label">Product
                                                Images</label>
                                            <input id="image-uploadify" type="file"
                                                accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf"
                                                multiple>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="inputPrice" class="form-label">Price</label>
                                                <input type="email" class="form-control" id="inputPrice"
                                                    placeholder="00.00">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputCompareatprice" class="form-label">Compare at
                                                    Price</label>
                                                <input type="password" class="form-control" id="inputCompareatprice"
                                                    placeholder="00.00">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputCostPerPrice" class="form-label">Cost Per
                                                    Price</label>
                                                <input type="email" class="form-control" id="inputCostPerPrice"
                                                    placeholder="00.00">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputStarPoints" class="form-label">Star Points</label>
                                                <input type="password" class="form-control" id="inputStarPoints"
                                                    placeholder="00.00">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputProductType" class="form-label">Product Type</label>
                                                <select class="form-select" id="inputProductType">
                                                    <option></option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputVendor" class="form-label">Vendor</label>
                                                <select class="form-select" id="inputVendor">
                                                    <option></option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputCollection" class="form-label">Collection</label>
                                                <select class="form-select" id="inputCollection">
                                                    <option></option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputProductTags" class="form-label">Product Tags</label>
                                                <input type="text" class="form-control" id="inputProductTags"
                                                    placeholder="Enter Product Tags">
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="button" class="btn btn-primary">Save
                                                        Product</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!--end row-->
                        </div>
                    </div>
                </div> --}}

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
