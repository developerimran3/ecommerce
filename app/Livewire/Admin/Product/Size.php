<?php

namespace App\Livewire\Admin\Product;

use App\Models\Size as Sizes;
use Livewire\Component;
use Livewire\WithPagination;

class Size extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $sizeId;
    public $name = '';
    public $status = true;
    public $search = '';

    protected function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:100',
                'unique:sizes,name,' . $this->sizeId,
            ],
            'status' => 'boolean',
        ];
    }

    public function create()
    {
        $this->resetInput();
        $this->dispatch('open-modal');
    }

    public function edit($id)
    {
        $size = Sizes::findOrFail($id);

        $this->sizeId = $size->id;
        $this->name = $size->name;
        $this->status = $size->status;
        $this->dispatch('open-modal');
    }

    public function store()
    {
        $this->validate();
        Sizes::updateOrCreate(
            ['id'        => $this->sizeId],
            [
                'name'   => $this->name,
                'status' => $this->status,
            ]
        );

        $this->dispatch(
            'success',
            message: $this->sizeId
                ? 'Size updated successfully.'
                : 'Size created successfully.'
        );
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function toggleStatus($id)
    {
        $size = Sizes::findOrFail($id);
        $size->update([
            'status' => !$size->status,
        ]);

        $this->dispatch(
            'success',
            message: 'Size status updated.'
        );
    }

    public function delete($id)
    {
        $size = Sizes::findOrFail($id);
        $size->delete();
        $this->dispatch(
            'success',
            message: 'Size deleted successfully.'
        );
    }

    public function resetInput()
    {
        $this->reset(['sizeId', 'name',]);
        $this->status = true;
    }

    public function render()
    {
        $sizes = Sizes::query()
            ->when($this->search, function ($query) {
                $query->where(
                    'name',
                    'like',
                    '%' . $this->search . '%'
                );
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.product.size', [
            'sizes' => $sizes,
        ])->layout('layouts.admin', ['title' => 'Product Size']);
    }
}
