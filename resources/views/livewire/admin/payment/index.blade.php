<div>
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-1 font-weight-bold">Payment Manage</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="table-card p-4 bg-light">
                <div class="row">
                    {{-- Search --}}
                    <div class="col-md-10 mb-3">
                    </div>
                    <div class="col-md-2 mb-3">
                        <input type="text" class="form-control" placeholder="🔍 Search coupon..."
                            wire:model.live="search">
                    </div>
                </div>
                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-hover table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Invoice</th>
                                <th>Customer Name</th>
                                <th>Phone</th>
                                <th>Method</th>
                                <th>Transaction ID</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th width="100">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($payments as $payment)
                                <tr>
                                    <td> {{ $payments->firstItem() + $loop->index }} </td>
                                    <td> <b> {{ $payment->order?->invoice_no }}</b> </td>
                                    <td> {{ $payment->order?->name }} </td>
                                    <td> {{ $payment->order?->phone }} </td>
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
                                        @if (auth()->user()->hasPermission('payments.delete'))
                                            <button wire:click="delete({{ $payment->id }})"
                                                wire:confirm="Are you sure you want to delete this Order?"
                                                class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center"> No payments found. </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $payments->links() }}
            </div>
        </div>
    </div>
