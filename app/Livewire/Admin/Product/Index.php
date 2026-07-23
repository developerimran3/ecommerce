<?php

namespace App\Livewire\Admin\Product;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

use Illuminate\Support\Facades\Storage;

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
    public $colors = [];
    public $sizes = [];
    public $sku;
    public $thumbnail;
    public $gallery = [];
    public $price;
    public $discount_price;
    public $stock = 0;
    public $stock_status;
    public $short_description;
    public $description;
    public $featured = false;
    public $status = true;
    public $oldThumbnail;
    public $oldGallery = [];

    protected function rules()
    {
        return [
            'category_id'       => 'required',
            'brand_id'          => 'nullable',
            'name'              => 'required|min:2',
            'sku'               => 'required|unique:products,sku,' . $this->product_id,
            'thumbnail'         => 'nullable|image|max:2048',
            'gallery.*'         => 'nullable|image|max:2048',
            'price'             => 'required|numeric',
            'discount_price'    => 'nullable|numeric',
            'stock'             => 'required|integer|min:0',
        ];
    }

    public function resetInput()
    {
        $this->reset();
        $this->featured     = false;
        $this->status       = true;
        $this->sizes = '';
        $this->colors = '';
        $this->oldGallery   = [];
    }

    public function updatedSizes($value)
    {
        $this->sizes = $value;
    }

    public function updatedColors($value)
    {
        $this->colors = $value;
    }



    public function mount()
    {
        $this->sizes = [];
        $this->colors = [];
    }

    public function store()
    {
        $this->validate();
        $thumbnail = null;
        if ($this->thumbnail) {
            $thumbnail = $this->thumbnail->store('products', 'public');
        }

        $product = Product::create([
            'category_id'       => $this->category_id,
            'brand_id'          => $this->brand_id,
            'name'              => $this->name,
            'sizes'             => json_encode($this->sizes),
            'colors'            => json_encode($this->colors),
            'slug'              => Str::slug($this->name),
            'sku'               => $this->sku,
            'thumbnail'         => $thumbnail,
            'price'             => $this->price,
            'discount_price'    => $this->discount_price,
            'stock'             => $this->stock,
            'stock_status'      => $this->stock_status,
            'short_description' => $this->short_description,
            'description'       => $this->description,
            'featured'          => $this->featured,
            'status'            => $this->status,
        ]);

        foreach ($this->gallery as $image) {
            ProductImage::create([
                'product_id'    => $product->id,
                'image'         => $image->store('products/gallery', 'public'),
            ]);
        }

        $this->dispatch(
            'success',
            message: 'Product created successfully.'
        );
        $this->dispatch('close-modal');

        $this->resetInput();
    }






    public function edit($id)
    {
        $product = Product::with('images')->findOrFail($id);
        $this->product_id = $product->id;
        $this->category_id = $product->category_id;
        $this->brand_id = $product->brand_id;
        $this->name = $product->name;
        $this->sku = $product->sku;
        $this->sizes = $product->sizes ? json_decode($product->sizes, true) : [];
        $this->colors = $product->colors ? json_decode($product->colors, true) : [];
        $this->price = $product->price;
        $this->discount_price = $product->discount_price;
        $this->stock = $product->stock;
        $this->short_description = $product->short_description;
        $this->description = $product->description;
        $this->featured = $product->featured;
        $this->status = $product->status;
        $this->oldThumbnail = $product->thumbnail;
        $this->oldGallery = $product->images;
    }


    public function update()
    {
        $this->validate([
            'category_id'   => 'required',
            'name'          => 'required|min:2',
            'sku'           => 'required|unique:products,sku,' . $this->product_id,
            'price'         => 'required|numeric',
            'stock'         => 'required|integer',
            'thumbnail'     => 'nullable|image|max:2048',
            'gallery.*'     => 'nullable|image|max:2048',
        ]);

        $product = Product::findOrFail($this->product_id);

        $thumbnail = $product->thumbnail;

        if ($this->thumbnail) {
            if (
                $thumbnail &&
                Storage::disk('public')->exists($thumbnail)
            ) {
                Storage::disk('public')->delete($thumbnail);
            }
            $thumbnail = $this->thumbnail
                ->store('products', 'public');
        }

        $product->update([
            'category_id'       => $this->category_id,
            'brand_id'          => $this->brand_id,
            'name'              => $this->name,
            'sizes'             => json_encode($this->sizes),
            'colors'            => json_encode($this->colors),
            'slug'              => Str::slug($this->name),
            'sku'               => $this->sku,
            'thumbnail'         => $thumbnail,
            'price'             => $this->price,
            'discount_price'    => $this->discount_price,
            'stock'             => $this->stock,
            'stock_status'      => $this->stock_status,
            'short_description' => $this->short_description,
            'description'       => $this->description,
            'featured'          => $this->featured,
            'status'            => $this->status,
        ]);

        foreach ($this->gallery as $image) {
            $path = $image->store(
                'products/gallery',
                'public'
            );
            ProductImage::create([
                'product_id'    => $product->id,
                'image'         => $path,
            ]);
        }
        $this->dispatch('close-modal');
        $this->dispatch(
            'success',
            message: 'Product updated successfully.'
        );

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


    public function delete($id)
    {
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


    public function changeStatus($id)
    {
        $products = Product::findOrFail($id);
        $products->update([
            'status' => !$products->status,
        ]);
        $this->dispatch(
            'success',
            message: 'Products status updated successfully.'
        );
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

            ->paginate(3);

        return view('livewire.admin.product.index', [
            'products' => $products,
            'categories' => Category::all(),
            'brands' => Brand::all(),
        ])
            ->layout('layouts.admin');
    }
}
