<div class="container py-5">

    <div class="card shadow">

        <div class="card-header">

            <h4>My Orders</h4>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered">

                    <thead class="thead-dark">

                        <tr>

                            <th>Invoice</th>

                            <th>Date</th>

                            <th>Total</th>

                            <th>Status</th>

                            <th>Items</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($orders as $order)
                            <tr>

                                <td>

                                    {{ $order->invoice_no }}

                                </td>

                                <td>

                                    {{ $order->created_at->format('d M Y') }}

                                </td>

                                <td>

                                    ৳ {{ number_format($order->grand_total, 2) }}

                                </td>

                                <td>

                                    <span class="badge badge-warning">

                                        {{ ucfirst($order->order_status) }}

                                    </span>

                                </td>

                                <td>

                                    {{ $order->items_count }}

                                </td>

                                <td>

                                    <button class="btn btn-info btn-sm" wire:click="showOrder({{ $order->id }})"
                                        data-toggle="modal" data-target="#orderModal">

                                        Details

                                    </button>

                                    <a href="{{ route('invoice', $order->id) }}" class="btn btn-primary btn-sm">

                                        Invoice

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center">

                                    No orders found.

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                {{ $orders->links() }}

            </div>

        </div>

    </div>

    <div wire:ignore.self class="modal fade" id="orderModal">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">

                    <h5>

                        Order Details

                    </h5>

                    <button class="close" data-dismiss="modal">

                        <span>&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    @if ($selectedOrder)

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

                        <hr>

                        <table class="table table-bordered">

                            <thead>

                                <tr>

                                    <th>Product</th>

                                    <th>Qty</th>

                                    <th>Price</th>

                                    <th>Total</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($selectedOrder->items as $item)
                                    <tr>

                                        <td>

                                            {{ $item->product?->name }}

                                        </td>

                                        <td>

                                            {{ $item->qty }}

                                        </td>

                                        <td>

                                            ৳ {{ number_format($item->price, 2) }}

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
