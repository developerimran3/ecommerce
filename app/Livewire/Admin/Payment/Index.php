<?php

namespace App\Livewire\Admin\Payment;

use App\Models\Payment;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function updateStatus($id, $status)
    {
        $payment = Payment::findOrFail($id);

        $payment->update([
            'status' => $status,
        ]);

        $payment->order->update([
            'payment_status' => $status,
        ]);

        $this->dispatch(
            'success',
            message: 'Payment status updated successfully.'
        );
    }


    public function delete($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();
        $this->dispatch(
            'success',
            message: 'Payment deleted successfully.'
        );
    }


    public function render()
    {
        return view('livewire.admin.payment.index', [
            'payments' => Payment::with('order')
                ->latest()
                ->paginate(15),
        ])->layout('layouts.admin', ['title' => 'Payment']);
    }
}
