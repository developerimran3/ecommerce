<?php

namespace App\Livewire\Admin\Brand;

use App\Models\Brand;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithFileUploads, WithPagination;
    protected string $paginationTheme = 'bootstrap';

    public $brand_id;
    public $name;
    public $logo;
    public $oldLogo;
    public $status = false;
    public $search = '';

    protected function rules()
    {
        return [
            'name' => 'required|min:2|max:255',
            'logo' => 'nullable|image|max:2048',
        ];
    }

    public function resetInput()
    {
        $this->reset([
            'brand_id',
            'name',
            'logo',
            'oldLogo',
        ]);

        $this->status = true;
    }

    public function store()
    {
        $this->validate();

        // Check if slug already exists
        $slug = Str::slug($this->name);

        if (Brand::where('slug', $slug)->exists()) {
            $this->addError('name', 'This Brand name already exists. Please choose a different name.');
            return;
        }

        // image 
        $logo = null;
        if ($this->logo) {
            $logo = $this->logo->store('brands', 'public');
        }
        Brand::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'logo' => $logo,
            'status' => $this->status,
        ]);

        $this->dispatch(
            'success',
            message: 'Brand created successfully.'
        );
        $this->dispatch('close-modal');
        $this->resetInput();
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        $this->brand_id = $brand->id;
        $this->oldLogo = $brand->logo;
        $this->name = $brand->name;
    }

    public function update()
    {
        $brand = Brand::findOrFail($this->brand_id);
        $data = [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
        ];

        if ($this->logo) {
            $data['logo'] = $this->logo->store('brands', 'public');
        }
        $brand->update($data);
        $this->dispatch(
            'success',
            message: 'Brand updated successfully.'
        );
        $this->dispatch('close-modal');
        $this->resetInput();
    }



    public function changeStatus($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->update([
            'status' => !$brand->status,
        ]);
        $this->dispatch(
            'success',
            message: 'Brand status updated successfully.'
        );
    }


    public function delete($id)
    {
        Brand::findOrFail($id)->delete();
        $this->dispatch(
            'success',
            message: 'Brand deleted successfully.'
        );
    }


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $brands = Brand::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where(
                        'name',
                        'like',
                        '%' . $this->search . '%'
                    )
                        ->orWhere(
                            'slug',
                            'like',
                            '%' . $this->search . '%'
                        );
                });
            })
            ->latest()
            ->paginate(5);

        return view(
            'livewire.admin.brand.index',
            compact('brands')
        )->layout('layouts.admin');
    }
}
