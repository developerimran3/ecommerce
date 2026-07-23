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
    protected string $paginationTheme = 'bootstrap';

    public $name;
    public $image;
    public $oldImage;
    public $status = true;
    public $search = '';
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
            'category_id',
            'name',
            'image',
            'oldImage',
        ]);

        $this->status = true;
    }

    public function store()
    {
        $this->validate();

        // Check if slug already exists
        $slug = Str::slug($this->name);

        if (Category::where('slug', $slug)->exists()) {
            $this->addError('name', 'This category name already exists. Please choose a different name.');
            return;
        }

        // image 
        $imageName = null;

        if ($this->image) {
            $imageName = $this->image->store('categories', 'public');
        }

        Category::create([
            'name' => $this->name,
            'slug' => $slug,
            'image' => $imageName,
            'status' => $this->status,
        ]);

        $this->dispatch('success', message: 'Category created successfully.');
        $this->dispatch('close-modal');
        $this->resetInput();
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->oldImage = $category->image;
    }

    public function update()
    {
        $category = Category::findOrFail($this->category_id);

        $data = [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('categories', 'public');
        }

        $category->update($data);

        $this->dispatch('success', message: 'Category updated successfully.');
        $this->dispatch('close-modal');
        $this->resetInput();
    }

    public function delete($id)
    {
        Category::findOrFail($id)->delete();

        $this->dispatch('success', message: 'Category deleted successfully.');
    }


    public function changeStatus($id)
    {
        $category = Category::findOrFail($id);
        $category->update([
            'status' => !$category->status,
        ]);
        $this->dispatch(
            'success',
            message: 'Category status updated successfully.'
        );
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $categories = Category::query()
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
            'livewire.admin.category.index',
            compact('categories')
        )->layout('layouts.admin');
    }
}
