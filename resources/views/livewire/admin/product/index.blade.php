<div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="page-title">Products</h4>

        @if (auth()->user()->hasPermission('products.create'))
            <button class="btn btn-purple" wire:click="create"> <i class="fas fa-shopping-cart"></i> Add Product </button>
        @endif
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="table-card p-4 bg-light">
                <!-- Filter Area -->

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <input type="text" class="form-control" placeholder="🔍 Search product..."
                            wire:model.live="search">
                    </div>

                    <div class="col-md-3 mb-3">
                        <select class="form-control" wire:model.live="filterCategory">
                            <option value="">All Categories</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <select class="form-control" wire:model.live="filterBrand">
                            <option value="">All Brands</option>

                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 mb-3">
                        <select class="form-control" wire:model.live="filterStatus">
                            <option value="">Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div class="col-md-1 mb-3">
                        <button class="btn btn-light border w-100" wire:click="clearFilters">
                            <i class="fa fa-refresh"></i>
                        </button>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-hover table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>SKU</th>
                                <th>R.Price</th>
                                <th>Sale Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Publish</th>
                                <th width="130">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($product->thumbnail)
                                            <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                class="product-img" />
                                        @else
                                            <span class="text-muted"> No Image </span>
                                        @endif
                                    </td>

                                    <td>{{ str($product->name)->limit(30) }}</td>
                                    <td>{{ $product->category?->name }}</td>
                                    <td>{{ $product->brand?->name }}</td>
                                    <td>{{ $product->sku }}</td>

                                    <td>৳ {{ number_format($product->price, 2) }}</td>

                                    <td style="font-weight: bold; color: rgba(5, 150, 105, 1)">৳
                                        {{ number_format($product->discount_price, 2) }}</td>

                                    <td>{{ $product->stock }}</td>
                                    <td>
                                        @if ($product->status)
                                            <span class="badge-success"> Active </span>
                                        @else
                                            <span class="badge-inactive"> Inactive </span>
                                        @endif
                                    </td>
                                    <td> {{ $product->created_at->format('d M Y') }}</td>
                                    <td>
                                        <button wire:click="edit({{ $product->id }})" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <button wire:click="delete({{ $product->id }})"
                                            wire:confirm="Are you sure you want to delete this Product?"
                                            class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <button wire:click="toggleStatus({{ $product->id }})"
                                            class="btn btn-sm btn-warning">
                                            <i class="fas fa-power-off"></i>
                                        </button>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center"> No Data Found </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-3 border-top">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="productModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content product-modal">
                <!-- Header -->
                <div class="modal-header border-0">
                    <div>
                        <h4 class="mb-1">
                            {{ $product_id ? 'Edit Product' : 'Add Product' }}
                        </h4>
                    </div>
                    <button class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    <div class="row">
                        <!-- LEFT -->
                        <div class="col-lg-8">
                            <div class="wc-card mb-4">
                                <h5 class="section-title"> Product Information </h5>
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" name="product_name" class="form-control"
                                        wire:model.live="name">
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <label>Product Code (SKU)</label>
                                        <input type="text" name="sku" class="form-control" wire:model="sku">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Stock</label>
                                        <input type="number" name="stock" class="form-control" wire:model="stock">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Stock Status</label>
                                        <select id="stock_status" class="form-control" wire:model="stock_status">
                                            <option value="1">In Stock</option>
                                            <option value="0">Out of Stock</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="wc-card mb-4">
                                <h5 class="section-title"> Pricing </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Regular Price</label>
                                        <input type="number" name="price" class="form-control" wire:model="price">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Sale Price</label>
                                        <input type="number" name="price" class="form-control"
                                            wire:model="discount_price">
                                    </div>
                                </div>
                            </div>
                            <div class="wc-card mb-4">
                                <div class="row">
                                    <div class="col-md-6" wire:ignore>
                                        <label>Size</label>

                                        <select id="sizes" class="form-control" multiple>
                                            <option value="S">S</option>
                                            <option value="M">M</option>
                                            <option value="L">L</option>
                                            <option value="XL">XL</option>
                                            <option value="XXL">XXL</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6" wire:ignore>
                                        <label>Color</label>

                                        <select id="colors" class="form-control" multiple>
                                            <option value="Red">Red</option>
                                            <option value="Blue">Blue</option>
                                            <option value="Black">Black</option>
                                            <option value="White">White</option>
                                            <option value="Green">Green</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="wc-card">
                                <h5 class="section-title">
                                    Description
                                </h5>
                                <div class="form-group">
                                    <label>Short Description</label>
                                    <textarea class="form-control" name="short_description" rows="3" wire:model="short_description"></textarea>
                                </div>
                                <div class="form-group mb-0">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description" rows="8" wire:model="description"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- RIGHT -->
                        <div class="col-lg-4">
                            <div class="wc-card mb-4">
                                <h5 class="section-title"> Product Thumbnail </h5>
                                <input type="file" class="form-control" wire:model="thumbnail">
                                @if ($thumbnail)
                                    <img src="{{ $thumbnail->temporaryUrl() }}" class="preview-image mt-3">
                                @endif
                                @if ($oldThumbnail && !$thumbnail)
                                    <img src="{{ asset('storage/' . $oldThumbnail) }}" class="preview-image mt-3">
                                @endif
                            </div>

                            <div class="wc-card mb-4">
                                <h5 class="section-title"> Gallery </h5>
                                <input type="file" multiple class="form-control" wire:model="gallery">
                                <div class="row mt-3">

                                    {{-- পুরোনো image --}}
                                    @foreach ($oldGallery as $image)
                                        <div class="col-4 mb-2">
                                            <img src="{{ asset('storage/' . $image->image) }}" class="gallery-image">
                                            <button type="button" class="gallery-remove-btn"
                                                wire:click="removeImage({{ $image->id }})">
                                                <i class="fas fa-times"></i>

                                            </button>
                                        </div>
                                    @endforeach

                                    {{-- নতুন upload image --}}
                                    @foreach ($gallery as $image)
                                        <div class="col-4 mb-2">
                                            <img src="{{ $image->temporaryUrl() }}" class="gallery-image">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="wc-card mb-4">
                                <div class="form-group mb-0 ">
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



                                <div class="form-group mb-0">
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

                                <div class="form-group mb-0">
                                    <label> Product Tags</label>
                                    <input type="text" class="form-control" placeholder="Enter tags..."
                                        wire:model="tags">
                                </div>
                            </div>


                            <div class="wc-card">
                                <h5 class="section-title"> Options </h5>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="featured"
                                        wire:model="featured">
                                    <label class="custom-control-label" for="featured"> Featured Product </label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="active"
                                        wire:model="status">
                                    <label class="custom-control-label" for="active"> Active Product </label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="hot_deals"
                                        wire:model="hot_deals">
                                    <label class="custom-control-label" for="hot_deals"> Hot Deals </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer border-0">
                    <button class="btn btn-light" data-dismiss="modal"> Cancel </button>
                    @if ($product_id)
                        <button class="btn btn-success px-4" wire:click="update"> Update </button>
                    @else
                        <button class="btn btn-purple px-4" wire:click="store"> Publish</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
