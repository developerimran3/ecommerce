<?php

namespace App\Livewire\Admin\Banner;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\BannerCategory as BannerCategories;

class BannerCategory extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $category_id = null;
    public $name = '';
    public $placement;
    public $status = true;

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
        $this->validate([
            'name'      => 'required|string|max:255|unique:banner_categories,name',
            'placement' => 'required|in:main_slider,promo_banner,footer_banner',
        ]);

        BannerCategories::create([
            'name'      => $this->name,
            'placement' => $this->placement,
            'status'    => $this->status ? 1 : 0,
        ]);

        $this->resetInput();
        $this->dispatch('close-modal');
        session()->flash(
            'success',
            'Banner category created successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $category = BannerCategories::findOrFail($id);
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->placement = $category->placement;
        $this->status = (bool) $category->status;
        $this->dispatch('open-modal');
    }


    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    public function update()
    {
        $this->validate(
            [
                'name' => 'required|string|max:255|unique:banner_categories,name,' . $this->category_id,
            ],
            [
                'name.required' => 'Category name is required.',
                'name.unique' => 'This category already exists.',
            ],

            ['placement' => 'required|in:main_slider,promo_banner,footer_banner']
        );

        $category = BannerCategories::findOrFail(
            $this->category_id
        );

        $category->update([
            'name'      => $this->name,
            'placement' => $this->placement,
            'status'    => $this->status,

        ]);

        $this->resetInput();
        $this->dispatch('close-modal');
        session()->flash(
            'success',
            'Banner category updated successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $category = BannerCategories::findOrFail($id);
        $category->delete();
        session()->flash(
            'success',
            'Banner category deleted successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Toggle Status
    |--------------------------------------------------------------------------
    */

    public function toggleStatus($id)
    {
        $category = BannerCategories::findOrFail($id);
        $category->update([
            'status' => !$category->status,
        ]);

        session()->flash(
            'success',
            'Category status updated successfully.'
        );
    }

    public function resetInput()
    {
        $this->category_id = null;
        $this->name = '';
        $this->placement = '';
        $this->status = true;
        $this->resetValidation();
    }


    public function updatingPage()
    {
        $this->resetInput();
    }

    public function render()
    {
        $brandcategories = BannerCategories::latest()
            ->paginate(10);

        return view('livewire.admin.banner.banner-category', [
            'brandcategories' => $brandcategories,
        ])->layout('layouts.admin');
    }
}
