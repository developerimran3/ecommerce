<?php

namespace App\Livewire\Admin\Product;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Size;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithFileUploads, WithPagination;
    protected string $paginationTheme = 'bootstrap';

    public $search = '';
    public $filterCategory = '';
    public $filterBrand = '';
    public $filterStatus = '';

    public $product_id;

    public $category_id;
    public $brand_id;

    public $name;

    public $size_id = [];
    public $color_id = [];

    public $sku;
    public $thumbnail;
    public $gallery = [];

    public $price;
    public $discount_price;
    public $stock = 0;

    public $short_description;
    public $description;

    public $hot_deals = false;
    public $status = true;

    public $oldThumbnail;
    public $oldGallery = [];


    protected function rules()
    {
        return [
            'category_id' => 'required|exists:categories,id',

            'brand_id' => 'nullable|exists:brands,id',

            'name' => 'required|string|min:2|max:255',

            'sku' => 'required|string|max:255|unique:products,sku,' . $this->product_id,

            'color_id' => 'nullable|array',
            'color_id.*' => 'exists:colors,id',

            'size_id' => 'nullable|array',
            'size_id.*' => 'exists:sizes,id',

            'thumbnail' => 'nullable|image|max:2048',

            'gallery.*' => 'nullable|image|max:2048',

            'price' => 'required|numeric|min:0',

            'discount_price' => 'nullable|numeric|min:0',

            'stock' => 'required|integer|min:0',
        ];
    }


    public function resetInput()
    {
        $this->reset([
            'product_id',
            'category_id',
            'brand_id',
            'name',
            'size_id',
            'color_id',
            'sku',
            'thumbnail',
            'gallery',
            'price',
            'discount_price',
            'stock',
            'short_description',
            'description',
            'oldThumbnail',
            'oldGallery',
        ]);

        $this->hot_deals = false;
        $this->status = true;

        $this->size_id = [];
        $this->color_id = [];

        $this->gallery = [];
        $this->oldGallery = [];
    }

    public function create()
    {
        $this->resetInput();
        $this->dispatch('open-modal');
    }


    public function store()
    {
        abort_unless(
            auth()->user()->hasPermission('product.create'),
            403
        );

        $this->validate();

        /*
    |--------------------------------------------------------------------------
    | Thumbnail
    |--------------------------------------------------------------------------
    */

        $thumbnail = null;

        if ($this->thumbnail) {
            $thumbnail = $this->thumbnail->store(
                'products',
                'public'
            );
        }

        /*
    |--------------------------------------------------------------------------
    | Product Create
    |--------------------------------------------------------------------------
    */

        $product = Product::create([
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,

            'name' => $this->name,

            'slug' => Str::slug($this->name),

            'sku' => $this->sku,

            'thumbnail' => $thumbnail,

            'price' => $this->price,

            'discount_price' => $this->discount_price,

            'stock' => $this->stock,

            'short_description' => $this->short_description,

            'description' => $this->description,

            'hot_deals' => $this->hot_deals,

            'status' => $this->status,
        ]);

        /*
    |--------------------------------------------------------------------------
    | Product Colors
    |--------------------------------------------------------------------------
    */

        $product->colors()->sync(
            $this->color_id ?? []
        );

        /*
    |--------------------------------------------------------------------------
    | Product Sizes
    |--------------------------------------------------------------------------
    */

        $product->sizes()->sync(
            $this->size_id ?? []
        );

        /*
    |--------------------------------------------------------------------------
    | Gallery
    |--------------------------------------------------------------------------
    */

        foreach ($this->gallery as $image) {

            ProductImage::create([
                'product_id' => $product->id,

                'image' => $image->store(
                    'products/gallery',
                    'public'
                ),
            ]);
        }

        /*
    |--------------------------------------------------------------------------
    | Success
    |--------------------------------------------------------------------------
    */

        $this->dispatch(
            'success',
            message: 'Product created successfully.'
        );

        $this->dispatch('close-modal');

        $this->resetInput();
    }


    public function edit($id)
    {
        $product = Product::with([
            'images',
            'colors',
            'sizes',
        ])->findOrFail($id);
        $this->product_id = $product->id;
        $this->category_id = $product->category_id;
        $this->brand_id = $product->brand_id;
        $this->name = $product->name;
        $this->sku = $product->sku;
        $this->price = $product->price;
        $this->discount_price = $product->discount_price;
        $this->stock = $product->stock;
        $this->short_description = $product->short_description;
        $this->description = $product->description;
        $this->hot_deals = $product->hot_deals;
        $this->status = $product->status;
        $this->oldThumbnail = $product->thumbnail;
        $this->oldGallery = $product->images;

        // Existing colors
        $this->color_id = $product->colors()
            ->pluck('colors.id')
            ->toArray();

        // Existing sizes
        $this->size_id = $product->sizes()
            ->pluck('sizes.id')
            ->toArray();

        $this->gallery = [];
        $this->thumbnail = null;
        $this->dispatch('open-modal');
    }

    public function update()
    {
        abort_unless(
            auth()->user()->hasPermission('product.edit'),
            403
        );

        $this->validate([
            'category_id' => 'required|exists:categories,id',

            'brand_id' => 'nullable|exists:brands,id',

            'name' => 'required|string|min:2|max:255',

            'sku' => 'required|string|max:255|unique:products,sku,' . $this->product_id,

            'color_id' => 'nullable|array',
            'color_id.*' => 'exists:colors,id',

            'size_id' => 'nullable|array',
            'size_id.*' => 'exists:sizes,id',

            'price' => 'required|numeric|min:0',

            'discount_price' => 'nullable|numeric|min:0',

            'stock' => 'required|integer|min:0',

            'thumbnail' => 'nullable|image|max:2048',

            'gallery.*' => 'nullable|image|max:2048',
        ]);

        $product = Product::findOrFail(
            $this->product_id
        );

        /*
    |--------------------------------------------------------------------------
    | Thumbnail
    |--------------------------------------------------------------------------
    */

        $thumbnail = $product->thumbnail;

        if ($this->thumbnail) {

            if (
                $thumbnail &&
                Storage::disk('public')->exists($thumbnail)
            ) {
                Storage::disk('public')->delete(
                    $thumbnail
                );
            }

            $thumbnail = $this->thumbnail->store(
                'products',
                'public'
            );
        }

        /*
    |--------------------------------------------------------------------------
    | Update Product
    |--------------------------------------------------------------------------
    */

        $product->update([

            'category_id' => $this->category_id,

            'brand_id' => $this->brand_id,

            'name' => $this->name,

            'slug' => Str::slug($this->name),

            'sku' => $this->sku,

            'thumbnail' => $thumbnail,

            'price' => $this->price,

            'discount_price' => $this->discount_price,

            'stock' => $this->stock,

            'short_description' => $this->short_description,

            'description' => $this->description,

            'hot_deals' => $this->hot_deals,

            'status' => $this->status,
        ]);


        $product->colors()->sync(
            $this->color_id ?? []
        );

        $product->sizes()->sync(
            $this->size_id ?? []
        );

        /*
    |--------------------------------------------------------------------------
    | New Gallery Images
    |--------------------------------------------------------------------------
    */

        foreach ($this->gallery as $image) {

            ProductImage::create([

                'product_id' => $product->id,

                'image' => $image->store(
                    'products/gallery',
                    'public'
                ),
            ]);
        }

        /*
    |--------------------------------------------------------------------------
    | Success
    |--------------------------------------------------------------------------
    */

        $this->dispatch(
            'success',
            message: 'Product updated successfully.'
        );

        $this->dispatch('close-modal');

        $this->resetInput();
    }



    public function removeImage($id)
    {
        $image = ProductImage::find($id);
        if ($image) {
            Storage::disk('public')->delete($image->image);
            $image->delete();
            $this->oldGallery = ProductImage::where(
                'product_id',
                $this->product_id
            )->get();
        }
    }


    public function toggleStatus($id)
    {
        abort_unless(
            auth()->user()->hasPermission('products.status'),
            403
        );

        $product = Product::findOrFail($id);
        $product->update([
            'status' => !$product->status,
        ]);
        $this->dispatch(
            'success',
            message: 'Product status updated successfully.'
        );
    }


    public function delete($id)
    {
        abort_unless(
            auth()->user()->hasPermission('products.delete'),
            403
        );

        $product = Product::with('images')
            ->findOrFail($id);

        if (
            $product->thumbnail &&
            Storage::disk('public')->exists($product->thumbnail)
        ) {
            Storage::disk('public')
                ->delete($product->thumbnail);
        }

        foreach ($product->images as $image) {

            if (
                Storage::disk('public')
                ->exists($image->image)
            ) {
                Storage::disk('public')
                    ->delete($image->image);
            }
            $image->delete();
        }
        $product->delete();

        $this->dispatch(
            'success',
            message: 'Product deleted successfully.'
        );
    }

    public function removeGalleryImage($imageId)
    {
        $image = ProductImage::find($imageId);

        if (!$image) {
            return;
        }

        if (
            $image->image &&
            Storage::disk('public')->exists($image->image)
        ) {
            Storage::disk('public')->delete($image->image);
        }

        $image->delete();

        $this->oldGallery = ProductImage::where(
            'product_id',
            $this->product_id
        )->get();

        $this->dispatch(
            'success',
            message: 'Image deleted successfully.'
        );
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterCategory()
    {
        $this->resetPage();
    }

    public function updatingFilterBrand()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }


    public function clearFilters()
    {
        $this->reset([
            'search',
            'filterCategory',
            'filterBrand',
            'filterStatus',
        ]);

        $this->resetPage();
    }




    public function render()
    {
        $products = Product::with([
            'category',
            'brand',
        ])
            ->when($this->search, function ($query) {

                $query->where(function ($q) {

                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('sku', 'like', '%' . $this->search . '%');
                });
            })

            ->when($this->filterCategory, function ($query) {
                $query->where(
                    'category_id',
                    $this->filterCategory
                );
            })

            ->when($this->filterBrand, function ($query) {
                $query->where(
                    'brand_id',
                    $this->filterBrand
                );
            })

            ->when($this->filterStatus !== '', function ($query) {
                $query->where(
                    'status',
                    $this->filterStatus
                );
            })

            ->latest()
            ->paginate(10);

        return view('livewire.admin.product.index', [
            'products' => $products,
            'categories' => Category::all(),
            'brands' => Brand::all(),
            'colors' => Color::all(),
            'sizes' => Size::all(),
        ])
            ->layout('layouts.admin', ['title' => 'Product']);
    }
}
