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

    public $brand_id;

    public $name;

    public $logo;

    public $status = true;

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
        ]);

        $this->status = true;
    }

    public function store()
    {
        $this->validate();

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
        $this->name = $brand->name;
        $this->status = $brand->status;
    }

    public function update()
    {
        $brand = Brand::findOrFail($this->brand_id);

        $data = [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'status' => $this->status,
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

    public function delete($id)
    {
        Brand::findOrFail($id)->delete();

        $this->dispatch(
            'success',
            message: 'Brand deleted successfully.'
        );
    }

    public function render()
    {
        return view('livewire.admin.brand.index', [
            'brands' => Brand::latest()->paginate(3),
        ])->layout('layouts.admin');
    }
}
