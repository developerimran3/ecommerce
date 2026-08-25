<div>
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-1"> Customer Details </h4>
        </div>
        <a href="{{ route('admin.customers.manage') }}" class="btn btn-purple">
            Back Customers </a>
    </div>

    <div class="row d-flex justify-content-between">
        <div class="col-md-5 mb-4">
            <div class="table-card p-4 bg-light">
                <div class="border p-4">
                    <div class="profile-cover">
                        <div class="profile-avatar">
                            @if (Auth::user()->image)
                                <img src="{{ asset('storage/' . Auth::user()->image) }}">
                            @else
                                <i class="fa fa-user"></i>
                            @endif
                        </div>

                        <div class="profile-info">
                            <h3 class="text-uppercase"> {{ Auth::user()->name }} </h3>

                            <p> {{ $user->email }} </p>

                            <span class="role-badge">
                                {{ Auth::user()->role }}
                            </span>
                        </div>
                    </div>
                    <div class="info-list">
                        <div class="info-item">
                            <span> Full Name </span>
                            <strong> {{ Auth::user()->name }} </strong>
                        </div>
                        <div class="info-item">
                            <span> Email </span>
                            <strong> {{ Auth::user()->email }} </strong>
                        </div>
                        <div class="info-item">
                            <span> Phone </span>
                            <strong> {{ Auth::user()->phone ?? 'Not Provided' }} </strong>
                        </div>

                        <div class="info-item">
                            <span> Address </span>
                            <strong> {{ Auth::user()->address ?? 'Not Provided' }} </strong>
                        </div>
                        <div class="info-item">
                            <span> Account Type </span>
                            <strong>
                                <span class="role-badge">
                                    {{ Auth::user()->role }}
                                </span>
                            </strong>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 mb-4">
            <div class="table-card p-4 bg-light">
                <button
                    style="background: #008e74;padding: 10px 18px; border:none;border-radius:5px;width:100%;margin-bottom:15px; color:#fff;">
                    Order</button>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Invoice</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Items</th>
                                <th>Status</th>

                            </tr>
                        </thead>

                        {{-- <tbody>
                                    @forelse($orders as $order)
                                        <tr>
                                            <td> {{ $order->invoice_no }} </td>
                                            <td> {{ $order->created_at->format('d M Y') }} </td>
                                            <td> ৳ {{ number_format($order->grand_total, 2) }} </td>
                                            <td class="align-center">
                                                @if ($order->order_status == 'pending')
                                                    <span class="w-100 badge-status">
                                                        Pending
                                                    </span>
                                                @elseif($order->order_status == 'confirmed')
                                                    <span class="w-100 badge-info">
                                                        Confirmed
                                                    </span>
                                                @elseif($order->order_status == 'processing')
                                                    <span class="w-100 badge-warning">
                                                        Processing
                                                    </span>
                                                @elseif($order->order_status == 'shipped')
                                                    <span class="w-100 badge-primary">
                                                        Shipped
                                                    </span>
                                                @elseif($order->order_status == 'delivered')
                                                    <span class="w-100 badge-success">
                                                        Delivered
                                                    </span>
                                                @else
                                                    <span class="w-100 badge-inactive">
                                                        Cancelled
                                                    </span>
                                                @endif
                                            </td>
                                            </td>
                                            <td> {{ $order->items_count }} </td>
                                            <td>
                                                <a href="{{ route('customer.invoice.download', $order->id) }}"
                                                    target="_blank" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-eye"> </i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center"> No orders found. </td>
                                        </tr>
                                    @endforelse
                                </tbody> --}}
                    </table>
                    <div class="mt-3">
                        {{-- {{ $orders->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
