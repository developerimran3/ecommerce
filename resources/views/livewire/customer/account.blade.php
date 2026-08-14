<div class="my-account-page">
    <div class="container py-5">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-4">
                <div class="account-card profile-card">
                    <div class="profile-header">
                        <div class="avatar">
                            @if (Auth::user()->image)
                                <img src="{{ asset('storage/' . Auth::user()->image) }}">
                            @else
                                <i class="fa fa-user"></i>
                            @endif
                        </div>
                        <h4> {{ ucwords(auth()->user()->name) }} </h4>
                        <p> {{ auth()->user()->email }} </p>
                    </div>
                    <ul class="account-menu">
                        <li class="active">
                            <a href="{{ route('account') }}" wire:navigate>
                                <i class="fa fa-dashboard"></i> Dashboard </a>
                        </li>
                        <li>
                            <a href="{{ route('my.orders') }}" wire:navigate>
                                <i class="fa fa-shopping-bag"></i> My Orders </a>
                        </li>
                        <li>
                            <a href="{{ route('customer.profile') }}" wire:navigate>
                                <i class="fa fa-user"></i> Profile </a>
                        </li>
                        <li>
                            <a href="{{ route('customer.password') }}" wire:navigate>
                                <i class="fa fa-lock"></i> Change Password </a>
                        </li>
                        <li>
                            <a href="{{ route('customer.logout') }}" wire:navigate class="logout-btn">
                                <i class="fa fa-sign-out"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

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
