<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithFileUploads, WithPagination;

    public $name;
    public $image;
    public $oldImage;
    public $status = true;

    public $category_id;

    protected $rules = [
        'name' => 'required|min:2|max:255',
        'image' => 'nullable|image|max:2048',
    ];

    public function updatedName()
    {
        $this->validateOnly('name');
    }

    public function resetInput()
    {
        $this->reset([
            'name',
            'image',
            'category_id',
        ]);

        $this->status = true;
    }

    public function store()
    {
        $this->validate();

        $imageName = null;

        if ($this->image) {
            $imageName = $this->image->store('categories', 'public');
        }

        Category::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'image' => $imageName,
            'status' => $this->status,
        ]);

        $this->dispatch('success', message: 'Category created successfully.');

        $this->resetInput();
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->status = $category->status;
        $this->oldImage = $category->image;
    }

    public function update()
    {
        $category = Category::findOrFail($this->category_id);

        $data = [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'status' => $this->status,
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('categories', 'public');
        }

        $category->update($data);

        $this->dispatch('success', message: 'Category updated successfully.');

        $this->resetInput();
    }

    public function delete($id)
    {
        Category::findOrFail($id)->delete();

        $this->dispatch('success', message: 'Category deleted successfully.');
    }



    public function render()
    {
        return view('livewire.admin.category.index', [
            'categories' => Category::latest()->paginate(10),
        ])->layout('layouts.admin');
    }
}
