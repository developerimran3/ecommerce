<div class="my-account-page">
    <div class="container py-5">
        <div class="row">
            <!-- Sidebar -->
            @include('partials.frontend-sidebar')
            <!-- Content -->
            <div class="col-md-8">

                <div class="account-card">
                    <h5> My All Orders </h5>
                    <table class="table table-bordered table-hover">
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
                                        <a href="{{ route('customer.invoice.download', $order->id) }}" target="_blank"
                                            class="btn btn-primary btn-sm">
                                            <i class="fa fa-eye"> </i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center"> No orders found. </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
