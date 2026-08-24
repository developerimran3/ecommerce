<div class="my-account-page">
    <div class="container py-5">
        <div class="row">
            <!-- Sidebar -->
            @include('partials.frontend-sidebar')
            <!-- Content -->
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-4">
                        <div class="dashboard-box">
                            <i class="fa fa-shopping-cart"></i>
                            <h3> {{ $orders->count() }} </h3>
                            <p> Total Orders </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dashboard-box">
                            <i class="fa fa-clock"></i>
                            <h3> {{ $pendingOrders }} </h3>
                            <p> Pending </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dashboard-box">
                            <i class="fa fa-check"></i>
                            <h3> {{ $completedOrders }} </h3>
                            <p> Completed </p>
                        </div>
                    </div>
                </div>
                <div class="account-card mt-4">
                    <h5> Recent Orders </h5>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th> Invoice </th>
                                <th> Date </th>
                                <th> Status </th>
                                <th class="text-center"> Total </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td> {{ $order->invoice_no }} </td>
                                    <td> {{ $order->created_at->format('d-m-Y H:i:s') }} </td>
                                    <td class="align-center">
                                        @if ($order->order_status == 'pending')
                                            <span class="badge-status">
                                                Pending
                                            </span>
                                        @elseif($order->order_status == 'confirmed')
                                            <span class="badge-info">
                                                Confirmed
                                            </span>
                                        @elseif($order->order_status == 'processing')
                                            <span class="badge-warning">
                                                Processing
                                            </span>
                                        @elseif($order->order_status == 'shipped')
                                            <span class="badge-primary">
                                                Shipped
                                            </span>
                                        @elseif($order->order_status == 'delivered')
                                            <span class="badge-success">
                                                Delivered
                                            </span>
                                        @else
                                            <span class="badge-inactive">
                                                Cancelled
                                            </span>
                                        @endif
                                    </td>

                                    <td class="text-right">
                                        ৳ {{ number_format($order->grand_total, 2) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">
                                        No Order Found
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
