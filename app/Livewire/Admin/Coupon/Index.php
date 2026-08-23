<?php

namespace App\Livewire\Admin\Coupon;

use App\Models\Coupon as CouponModel;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $couponId;
    public $code = '';
    public $type = 'fixed';
    public $value = 0;
    public $minimum_amount = 0;
    public $start_date;
    public $end_date;
    public $limit;
    public $status = true;

    public $search = '';

    protected $rules = [
        'code' => 'required|string|max:50',
        'type' => 'required|in:fixed,percent',
        'value' => 'required|numeric|min:0',
        'minimum_amount' => 'required|numeric|min:0',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'limit' => 'nullable|integer|min:1',
        'status' => 'boolean',
    ];



    public function create()
    {
        $this->resetForm();

        $this->start_date = now()->format('Y-m-d');
        $this->end_date = now()->addDays(30)->format('Y-m-d');
        $this->dispatch('open-modal');
    }

    //
    public function store()
    {
        $this->validate();
        if ($this->type === 'percent' && $this->value > 100) {
            $this->addError(
                'value',
                'Percentage discount cannot exceed 100%.'
            );
            return;
        }
        CouponModel::create([
            'code' => strtoupper(trim($this->code)),
            'type' => $this->type,
            'value' => $this->value,
            'minimum_amount' => $this->minimum_amount,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'limit' => $this->limit,
            'used' => 0,
            'status' => $this->status,
        ]);

        $this->resetForm();
        $this->dispatch('close-modal');
        $this->dispatch(
            'success',
            message: 'Coupon created successfully.'
        );
    }

    public function edit($id)
    {
        $coupon = CouponModel::findOrFail($id);
        $this->couponId = $coupon->id;
        $this->code = $coupon->code;
        $this->type = $coupon->type;
        $this->value = $coupon->value;
        $this->minimum_amount = $coupon->minimum_amount;
        $this->start_date = $coupon->start_date->format('Y-m-d');
        $this->end_date = $coupon->end_date->format('Y-m-d');
        $this->limit = $coupon->limit;
        $this->status = $coupon->status;

        $this->dispatch('open-modal');
    }

    public function update()
    {
        $this->validate([
            'code' => 'required|string|max:50',
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric|min:0',
            'minimum_amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'limit' => 'nullable|integer|min:1',
            'status' => 'boolean',
        ]);

        if ($this->type === 'percent' && $this->value > 100) {
            $this->addError(
                'value',
                'Percentage discount cannot exceed 100%.'
            );
            return;
        }

        $coupon = CouponModel::findOrFail($this->couponId);
        $coupon->update([
            'code' => strtoupper(trim($this->code)),
            'type' => $this->type,
            'value' => $this->value,
            'minimum_amount' => $this->minimum_amount,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'limit' => $this->limit,
            'status' => $this->status,
        ]);
        $this->resetForm();
        $this->dispatch('close-modal');
        $this->dispatch(
            'success',
            message: 'Coupon updated successfully.'
        );
    }

    public function delete($id)
    {
        CouponModel::findOrFail($id)->delete();
        $this->dispatch(
            'success',
            message: 'Coupon deleted successfully.'
        );
    }

    public function toggleStatus($id)
    {
        $coupon = CouponModel::findOrFail($id);
        $coupon->update([
            'status' => !$coupon->status,
        ]);
        $this->dispatch(
            'success',
            message: 'Coupon status updated.'
        );
    }

    public function resetForm()
    {
        $this->reset([
            'couponId',
            'code',
            'value',
            'minimum_amount',
            'limit',
        ]);

        $this->type = 'fixed';
        $this->status = true;
        $this->start_date = null;
        $this->end_date = null;

        $this->resetValidation();
    }


    public function render()
    {
        $coupons = CouponModel::query()
            ->when($this->search, function ($query) {
                $query->where('code', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.coupon.index', [
            'coupons' => $coupons,
        ])->layout('layouts.admin',  ['title' => 'Coupon']);
    }
}
