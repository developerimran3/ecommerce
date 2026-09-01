<?php

namespace App\Livewire\Admin\Product;

use App\Models\Color as Colors;
use Livewire\Component;
use Livewire\WithPagination;

class Color extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $colorId;
    public $name = '';
    public $color_code = '';
    public $status = true;

    protected function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:100',
                'unique:colors,name,' . $this->colorId,
            ],

            'color_code' => [
                'nullable',
                'string',
                'max:20',
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
        $color = Colors::findOrFail($id);

        $this->colorId    = $color->id;
        $this->name       = $color->name;
        $this->color_code = $color->color_code;
        $this->status     = $color->status;
        $this->dispatch('open-modal');
    }

    public function store()
    {
        $this->validate();

        Colors::updateOrCreate(
            ['id'            => $this->colorId],
            [
                'name' => ucfirst(strtolower(trim($this->name))),
                'color_code' => $this->color_code,
                'status'     => $this->status,
            ]
        );

        $this->dispatch(
            'success',
            message: $this->colorId
                ? 'Color updated successfully.'
                : 'Color created successfully.'
        );

        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function toggleStatus($id)
    {
        $color = Colors::findOrFail($id);
        $color->update([
            'status' => !$color->status,
        ]);
    }

    public function delete($id)
    {
        Colors::findOrFail($id)->delete();
        $this->dispatch(
            'success',
            message: 'Color deleted successfully.'
        );
    }

    public function resetInput()
    {
        $this->reset([
            'colorId',
            'name',
            'color_code',
        ]);
        $this->status = true;
    }

    public function render()
    {
        $colors = Colors::latest()
            ->paginate(10);

        return view('livewire.admin.product.color', [
            'colors' => $colors,
        ])->layout('layouts.admin', ['title' => 'Product Color']);
    }
}
