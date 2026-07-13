<div>

    <h4 class="mb-4">

        Order Management

    </h4>

    <div class="card">

        <div class="card-body">

            <div class="row mb-3">

                <div class="col-md-6">

                    <input type="text" class="form-control" placeholder="Search invoice, name, phone..."
                        wire:model.live="search">

                </div>

                <div class="col-md-3">

                    <select class="form-control" wire:model.live="status">

                        <option value="">
                            All Status
                        </option>

                        <option value="pending">
                            Pending
                        </option>

                        <option value="processing">
                            Processing
                        </option>

                        <option value="delivered">
                            Delivered
                        </option>

                        <option value="cancelled">
                            Cancelled
                        </option>

                    </select>

                </div>

            </div>

            <table class="table table-bordered">

                <thead class="thead-dark">

                    <tr>

                        <th>Invoice</th>

                        <th>Customer</th>

                        <th>Phone</th>

                        <th>Total</th>

                        <th>Status</th>

                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach ($orders as $order)
                        <tr>

                            <td>{{ $order->invoice_no }}</td>

                            <td>{{ $order->name }}</td>

                            <td>{{ $order->phone }}</td>

                            <td>
                                ৳ {{ number_format($order->grand_total, 2) }}
                            </td>

                            <td>

                                <select class="form-control form-control-sm"
                                    wire:change="updateStatus(
                                            {{ $order->id }},
                                            $event.target.value
                                        )">

                                    <option value="pending" @selected($order->order_status == 'pending')>

                                        Pending

                                    </option>

                                    <option value="processing" @selected($order->order_status == 'processing')>

                                        Processing

                                    </option>

                                    <option value="delivered" @selected($order->order_status == 'delivered')>

                                        Delivered

                                    </option>

                                    <option value="cancelled" @selected($order->order_status == 'cancelled')>

                                        Cancelled

                                    </option>

                                </select>

                            </td>

                            <td>

                                <button class="btn btn-info btn-sm" wire:click="showOrder({{ $order->id }})"
                                    data-toggle="modal" data-target="#orderModal">

                                    View

                                </button>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

            {{ $orders->links() }}

        </div>

    </div>
    <div wire:ignore.self class="modal fade" id="orderModal" tabindex="-1">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">

                        Order Details

                    </h5>

                    <button type="button" class="close" data-dismiss="modal">

                        <span>&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    @if ($selectedOrder)

                        <div class="row mb-3">

                            <div class="col-md-6">

                                <h6>
                                    Invoice:
                                    {{ $selectedOrder->invoice_no }}
                                </h6>

                                <h6>
                                    Customer:
                                    {{ $selectedOrder->name }}
                                </h6>

                                <h6>
                                    Phone:
                                    {{ $selectedOrder->phone }}
                                </h6>

                                <h6>
                                    Email:
                                    {{ $selectedOrder->email }}
                                </h6>

                            </div>

                            <div class="col-md-6">

                                <h6>
                                    Payment:
                                    {{ ucfirst($selectedOrder->payment_method) }}
                                </h6>

                                <h6>
                                    Payment Status:
                                    {{ ucfirst($selectedOrder->payment_status) }}
                                </h6>

                                <h6>
                                    Order Status:
                                    {{ ucfirst($selectedOrder->order_status) }}
                                </h6>

                                <h6>
                                    Date:
                                    {{ $selectedOrder->created_at->format('d M Y h:i A') }}
                                </h6>

                            </div>

                        </div>

                        <div class="mb-3">

                            <strong>Address:</strong>

                            <p class="mb-0">

                                {{ $selectedOrder->address }}

                            </p>

                        </div>

                        <table class="table table-bordered">

                            <thead class="thead-dark">

                                <tr>

                                    <th>Image</th>

                                    <th>Product</th>

                                    <th>Price</th>

                                    <th>Qty</th>

                                    <th>Subtotal</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($selectedOrder->items as $item)
                                    <tr>

                                        <td>

                                            @if ($item->product?->thumbnail)
                                                <img src="{{ asset('storage/' . $item->product->thumbnail) }}"
                                                    width="60">
                                            @endif

                                        </td>

                                        <td>

                                            {{ $item->product?->name }}

                                        </td>

                                        <td>

                                            ৳ {{ number_format($item->price, 2) }}

                                        </td>

                                        <td>

                                            {{ $item->qty }}

                                        </td>

                                        <td>

                                            ৳ {{ number_format($item->subtotal, 2) }}

                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                        <div class="text-right">

                            <h5>

                                Grand Total:

                                ৳ {{ number_format($selectedOrder->grand_total, 2) }}

                            </h5>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>
