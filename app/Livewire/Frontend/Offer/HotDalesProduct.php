<?php

namespace App\Livewire\Frontend\Offer;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class HotDalesProduct extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

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

    public function mount()
    {
        /*
        |--------------------------------------------------------------------------
        | Hot Deals Price Range
        |--------------------------------------------------------------------------
        |
        | hot_deals হলো Product-এর offer/flag।
        | এটা কোনো category নয়।
        |
        */

        $products = Product::query()
            ->where('status', true)
            ->where('hot_deals', true);

        /*
        |--------------------------------------------------------------------------
        | Minimum Price
        |--------------------------------------------------------------------------
        */

        $this->minPrice = (clone $products)
            ->selectRaw(
                'MIN(COALESCE(discount_price)) as min_price'
            )
            ->value('min_price');

        /*
        |--------------------------------------------------------------------------
        | Maximum Price
        |--------------------------------------------------------------------------
        */

        $this->maxPrice = (clone $products)
            ->selectRaw(
                'MAX(COALESCE(price)) as max_price'
            )
            ->value('max_price');

        $this->minPrice = $this->minPrice ?? 0;
        $this->maxPrice = $this->maxPrice ?? 0;

        /*
        |--------------------------------------------------------------------------
        | Default Slider Value
        |--------------------------------------------------------------------------
        */

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
    | Clear Filters
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
        | এখানে তোমার existing Cart logic বসাবে
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
        /*
        |--------------------------------------------------------------------------
        | Base Query
        |--------------------------------------------------------------------------
        |
        | এখানে category_id একদম ব্যবহার করা হচ্ছে না।
        |
        | hot_deals = true হলেই product এখানে আসবে।
        |
        */

        $query = Product::with([
            'category',
            'brand',
        ])
            ->where('status', true)
            ->where('hot_deals', true);

        /*
        |--------------------------------------------------------------------------
        | Religious Filter
        |--------------------------------------------------------------------------
        |
        | তোমার products table-এ যদি `religious` column থাকে,
        | তাহলে এই অংশ কাজ করবে।
        |
        */

        if ($this->religious) {
            $query->where('religious', true);
        }

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
        | Pagination
        |--------------------------------------------------------------------------
        */

        $products = $query->paginate(8);

        return view(
            'livewire.frontend.offer.hot-dales-product',
            [
                'products' => $products,
            ]
        )->layout('layouts.frontend', [
            'title' => 'Hot Deals',
        ]);
    }
}
