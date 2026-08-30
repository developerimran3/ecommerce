<?php

namespace App\Livewire\Frontend\Category;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductCategory extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public $category;

    public $sort = 'latest';

    public $price = null;

    public $minPrice = 0;

    public $maxPrice = 0;

    public $religious = false;


    /*
    |--------------------------------------------------------------------------
    | Mount
    |--------------------------------------------------------------------------
    */

    public function mount($slug)
    {
        $this->category = Category::where('slug', $slug)
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Price Range
        |--------------------------------------------------------------------------
        */

        $this->minPrice = Product::where('category_id', $this->category->id)
            ->where('status', true)
            ->min('discount_price');

        $this->maxPrice = Product::where('category_id', $this->category->id)
            ->where('status', true)
            ->max('price');

        $this->minPrice = $this->minPrice ?? 0;
        $this->maxPrice = $this->maxPrice ?? 0;

        $this->price = $this->maxPrice;
    }


    /*
    |--------------------------------------------------------------------------
    | Sorting
    |--------------------------------------------------------------------------
    */

    public function updatedSort()
    {
        $this->resetPage();
    }


    /*
    |--------------------------------------------------------------------------
    | Price Filter
    |--------------------------------------------------------------------------
    */

    public function updatedPrice()
    {
        $this->resetPage();
    }


    /*
    |--------------------------------------------------------------------------
    | Religious Filter
    |--------------------------------------------------------------------------
    */

    public function updatedReligious()
    {
        $this->resetPage();
    }


    /*
    |--------------------------------------------------------------------------
    | Reset Filters
    |--------------------------------------------------------------------------
    */

    public function clearFilters()
    {
        $this->sort = 'latest';
        $this->price = $this->maxPrice;
        $this->religious = false;

        $this->resetPage();
    }


    /*
    |--------------------------------------------------------------------------
    | Add To Cart
    |--------------------------------------------------------------------------
    */

    public function addToCart($productId)
    {
        /*
        |--------------------------------------------------------------------------
        | এখানে তোমার existing Cart logic বসবে
        |--------------------------------------------------------------------------
        */

        $this->dispatch(
            'success',
            message: 'Product added to cart successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Render
    |--------------------------------------------------------------------------
    */

    public function render()
    {
        $query = Product::with([
            'category',
            'brand',
        ])
            ->where('category_id', $this->category->id)
            ->where('status', true);


        /*
        |--------------------------------------------------------------------------
        | Price Filter
        |--------------------------------------------------------------------------
        */

        if ($this->price && $this->price < $this->maxPrice) {

            $query->where(function ($q) {

                $q->where(function ($q2) {
                    $q2->whereNotNull('discount_price')
                        ->where('discount_price', '<=', $this->price);
                })

                    ->orWhere(function ($q2) {
                        $q2->whereNull('discount_price')
                            ->where('price', '<=', $this->price);
                    });
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Sorting
        |--------------------------------------------------------------------------
        */

        switch ($this->sort) {

            case 'oldest':

                $query->oldest();

                break;


            case 'price_low':

                /*
                 * Discount price থাকলে সেটাকে priority
                 */
                $query->orderByRaw(
                    'COALESCE(discount_price, price) ASC'
                );

                break;


            case 'price_high':

                $query->orderByRaw(
                    'COALESCE(discount_price, price) DESC'
                );

                break;


            default:

                $query->latest();

                break;
        }


        /*
        |--------------------------------------------------------------------------
        | Products
        |--------------------------------------------------------------------------
        */

        $products = $query->paginate(8);


        return view(
            'livewire.frontend.category.product-category',
            [
                'products' => $products,
            ]
        )->layout('layouts.frontend', [
            'title' => 'Product Category',
        ]);
    }
}
