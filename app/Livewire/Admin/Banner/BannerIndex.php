<?php

namespace App\Livewire\Admin\Banner;

use App\Models\Banner;
use App\Models\BannerCategory;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class BannerIndex extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public $banner_id = null;

    public $banner_category_id = '';

    public $image;

    public $oldImage = null;

    public $status = true;

    public $search = '';

    public $filterCategory = '';

    public $filterStatus = '';

    /*
    |--------------------------------------------------------------------------
    | Validation Rules
    |--------------------------------------------------------------------------
    */

    protected function rules()
    {
        return [
            'banner_category_id' => 'required|exists:banner_categories,id',

            'image' => $this->banner_id
                ? 'nullable|image|max:4096'
                : 'required|image|max:4096',

            'status' => 'boolean',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $this->resetInput();

        $this->dispatch('open-modal');
    }

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */

    public function store()
    {
        abort_unless(
            auth()->user()->hasPermission('banners.create'),
            403
        );

        $this->validate();

        $image = null;

        if ($this->image) {
            $image = $this->image->store(
                'banners',
                'public'
            );
        }

        Banner::create([
            'banner_category_id' => $this->banner_category_id,
            'image'              => $image,
            'status'             => $this->status,
        ]);

        $this->dispatch(
            'success',
            message: 'Banner created successfully.'
        );

        $this->dispatch('close-modal');

        $this->resetInput();
    }

    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        abort_unless(
            auth()->user()->hasPermission('banners.edit'),
            403
        );

        $banner = Banner::findOrFail($id);

        $this->banner_id = $banner->id;

        $this->banner_category_id =
            $banner->banner_category_id;

        $this->oldImage = $banner->image;

        $this->status = (bool) $banner->status;

        $this->image = null;

        $this->resetValidation();

        $this->dispatch('open-modal');
    }

    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    public function update()
    {
        abort_unless(
            auth()->user()->hasPermission('banners.edit'),
            403
        );

        $this->validate();

        $banner = Banner::findOrFail(
            $this->banner_id
        );

        $image = $banner->image;

        /*
        |--------------------------------------------------------------------------
        | New Image Upload
        |--------------------------------------------------------------------------
        */

        if ($this->image) {

            if (
                $image &&
                Storage::disk('public')->exists($image)
            ) {
                Storage::disk('public')->delete($image);
            }

            $image = $this->image->store(
                'banners',
                'public'
            );
        }

        $banner->update([
            'banner_category_id' => $this->banner_category_id,
            'image'              => $image,
            'status'             => $this->status,
        ]);

        $this->dispatch(
            'success',
            message: 'Banner updated successfully.'
        );

        $this->dispatch('close-modal');

        $this->resetInput();
    }

    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        abort_unless(
            auth()->user()->hasPermission('banners.delete'),
            403
        );

        $banner = Banner::findOrFail($id);

        if (
            $banner->image &&
            Storage::disk('public')->exists(
                $banner->image
            )
        ) {
            Storage::disk('public')->delete(
                $banner->image
            );
        }

        $banner->delete();

        $this->dispatch(
            'success',
            message: 'Banner deleted successfully.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Toggle Status
    |--------------------------------------------------------------------------
    */

    public function toggleStatus($id)
    {
        abort_unless(
            auth()->user()->hasPermission('banners.status'),
            403
        );

        $banner = Banner::findOrFail($id);

        $banner->update([
            'status' => !$banner->status,
        ]);

        $this->dispatch(
            'success',
            message: 'Banner status updated successfully.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Reset
    |--------------------------------------------------------------------------
    */

    public function resetInput()
    {
        $this->banner_id = null;

        $this->banner_category_id = '';

        $this->image = null;

        $this->oldImage = null;

        $this->status = true;

        $this->resetValidation();
    }

    /*
    |--------------------------------------------------------------------------
    | Search Pagination
    |--------------------------------------------------------------------------
    */

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterCategory()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
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
        $this->reset([
            'search',
            'filterCategory',
            'filterStatus',
        ]);

        $this->resetPage();
    }

    /*
    |--------------------------------------------------------------------------
    | Render
    |--------------------------------------------------------------------------
    */

    public function render()
    {
        $bannerindex = Banner::with('category')

            ->when($this->search, function ($query) {

                $query->whereHas(
                    'category',
                    function ($q) {
                        $q->where(
                            'name',
                            'like',
                            '%' . $this->search . '%'
                        );
                    }
                );
            })

            ->when(
                $this->filterCategory,
                function ($query) {
                    $query->where(
                        'banner_category_id',
                        $this->filterCategory
                    );
                }
            )

            ->when(
                $this->filterStatus !== '',
                function ($query) {
                    $query->where(
                        'status',
                        $this->filterStatus
                    );
                }
            )

            ->latest()
            ->paginate(10);

        return view(
            'livewire.admin.banner.banner-index',
            [
                'bannercategories' =>
                BannerCategory::where(
                    'status',
                    true
                )->get(),

                'bannerindex' => $bannerindex,
            ]
        )->layout(
            'layouts.admin',
            [
                'title' => 'Banners & Ads',
            ]
        );
    }
}
