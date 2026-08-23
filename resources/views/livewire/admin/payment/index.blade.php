<div>
    <div class="content container">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    Payment Management
                </h5>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Invoice</th>
                            <th>Method</th>
                            <th>Transaction ID</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($payments as $payment)
                            <tr>
                                <td> {{ $payments->firstItem() + $loop->index }} </td>
                                <td> {{ $payment->order?->invoice_no }} </td>
                                <td> {{ strtoupper($payment->method) }} </td>
                                <td> {{ $payment->trx_id ?? '-' }} </td>
                                <td> ৳ {{ number_format($payment->amount, 2) }} </td>
                                <td>
                                    <select class="form-control form-control-sm"
                                        wire:change="updateStatus({{ $payment->id }},$event.target.value)">
                                        <option value="pending" @selected($payment->status === 'pending')> Pending </option>
                                        <option value="paid" @selected($payment->status === 'paid')> Paid </option>
                                        <option value="failed" @selected($payment->status === 'failed')> Failed </option>
                                    </select>
                                </td>
                                <td> {{ $payment->created_at->format('d M Y h:i A') }} </td>
                                <td>
                                    @if ($payment->status == 'pending' || $payment->status == 'failed')
                                        <button class="btn btn-sm btn-delete" wire:click="delete({{ $payment->id }})"
                                            wire:confirm="Are you sure you want to delete this user?">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center"> No payments found. </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $payments->links() }}
        </div>
    </div>
</div>
