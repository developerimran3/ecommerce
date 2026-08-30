<div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-1">Customer Details</h4>
        </div>
        <a href="{{ route('admin.customers.manage') }}" wire:navigate class="btn btn-purple">
            <i class="fas fa-arrow-left mr-1"></i> Back Customers </a>
    </div>

    <div class="row">
        {{-- Customer Information --}}
        <div class="col-md-5 mb-4">
            <div class="table-card p-4 bg-light">
                <div class="border p-4">
                    <div class="profile-cover">
                        <div class="profile-avatar">
                            @if ($customer->image)
                                <img src="{{ asset('storage/' . $customer->image) }}" alt="{{ $customer->name }}">
                            @else
                                <i class="fa fa-user"></i>
                            @endif

                        </div>

                        <div class="profile-info">
                            <h3 class="text-uppercase">
                                {{ $customer->name }}
                            </h3>

                            <p>
                                {{ $customer->email }}
                            </p>

                            <span class="role-badge">
                                {{ $customer->role }}
                            </span>
                        </div>
                    </div>
                    <div class="info-list">
                        <div class="info-item">
                            <span>Full Name</span>
                            <strong> {{ $customer->name }} </strong>
                        </div>

                        <div class="info-item">
                            <span>Email</span>
                            <strong> {{ $customer->email }} </strong>
                        </div>

                        <div class="info-item">
                            <span>Phone</span>
                            <strong> {{ $customer->phone ?? 'Not Provided' }} </strong>
                        </div>

                        <div class="info-item">
                            <span>Address</span> <strong> {{ $customer->address ?? 'Not Provided' }}
                            </strong>
                        </div>

                        <div class="info-item">
                            <span>Account Type</span>
                            <strong>
                                <span class="role-badge"> {{ $customer->role }} </span>
                            </strong>
                        </div>

                        <div class="info-item">
                            <span>Account Status</span>
                            <strong>
                                @if ($customer->status)
                                    <span class="badge-success"> Active </span>
                                @else
                                    <span class="badge-inactive"> Inactive </span>
                                @endif
                            </strong>
                        </div>

                        <div class="info-item">
                            <span>Joined</span>
                            <strong>
                                {{ $customer->created_at->format('d M Y') }}
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Customer Orders --}}
        <div class="col-md-7 mb-4">
            <div class="table-card p-4 bg-light">
                <div
                    style="background:#008e74; padding:10px 18px; border:none; border-radius:5px;width:100%; margin-bottom:15px;color:#fff;">
                    <i class="fas fa-shopping-bag mr-2"></i>
                    Customer Orders
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Invoice</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Items</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td> {{ $order->invoice_no }} </td>
                                    <td> {{ $order->created_at->format('d M Y h:i A') }} </td>
                                    <td> ৳ {{ number_format($order->grand_total, 2) }} </td>
                                    <td> {{ $order->items_count }} </td>
                                    <td>
                                        @if ($order->order_status == 'pending')
                                            <span class="badge-status"> Pending </span>
                                        @elseif($order->order_status == 'confirmed')
                                            <span class="badge-info"> Confirmed </span>
                                        @elseif($order->order_status == 'processing')
                                            <span class="badge-warning"> Processing </span>
                                        @elseif($order->order_status == 'shipped')
                                            <span class="badge-primary"> Shipped </span>
                                        @elseif($order->order_status == 'delivered')
                                            <span class="badge-success"> Delivered </span>
                                        @else
                                            <span class="badge-inactive"> Cancelled </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <i class="fas fa-shopping-bag fa-2x text-muted mb-2"></i>
                                        <br>
                                        No orders found for this customer.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
