<?php

namespace App\Livewire\Admin\Shipping;

use App\Models\ShippingArea;
use Livewire\Component;
use Livewire\WithPagination;

class ShippingAreaIndex extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $name = '';
    public $charge = '';
    public $status = true;
    public $editId = null;
    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'charge' => 'required|numeric|min:0',
            'status' => 'boolean',
        ];
    }

    public function resetInput()
    {
        $this->reset([
            'name',
            'charge',
            'editId',
        ]);

        $this->status = true;

        $this->resetValidation();
    }


    public function create()
    {
        $this->resetInput();
        $this->dispatch('open-modal');
    }

    public function store()
    {
        $this->validate();

        ShippingArea::create([
            'name' => $this->name,
            'charge' => $this->charge,
            'status' => $this->status,
        ]);

        $this->resetInput();

        $this->dispatch(
            'success',
            message: 'Shipping area added successfully.'
        );
    }

    public function edit($id)
    {
        $shipping = ShippingArea::findOrFail($id);

        $this->editId = $shipping->id;
        $this->name = $shipping->name;
        $this->charge = $shipping->charge;
        $this->status = $shipping->status;

        $this->dispatch('open-modal');
    }

    public function update()
    {
        $this->validate();
        $shipping = ShippingArea::findOrFail($this->editId);
        $shipping->update([
            'name' => $this->name,
            'charge' => $this->charge,
            'status' => $this->status,
        ]);

        $this->resetInput();
        $this->dispatch('close-modal');

        $this->dispatch(
            'success',
            message: 'Shipping area updated successfully.'
        );
    }

    public function delete($id)
    {
        ShippingArea::findOrFail($id)->delete();

        $this->dispatch(
            'success',
            message: 'Shipping area deleted successfully.'
        );
    }

    public function toggleStatus($id)
    {
        $shipping = ShippingArea::findOrFail($id);

        $shipping->update([
            'status' => !$shipping->status,
        ]);
    }

    public function render()
    {
        return view('livewire.admin.shipping.shipping-area-index', [
            'shippingAreas' => ShippingArea::latest()->paginate(10),
        ])->layout('layouts.admin', ['title' => 'Shipping Area']);
    }
}
