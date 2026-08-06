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
                        <h4> {{ auth()->user()->name }} </h4>
                        <p> {{ auth()->user()->email }} </p>
                    </div>
                    <ul class="account-menu">
                        <li>
                            <a href="{{ route('account') }}" wire:navigate>
                                <i class="fa fa-dashboard"></i> Dashboard </a>
                        </li>
                        <li class="active">
                            <a href="{{ route('my.orders') }}" wire:navigate>
                                <i class="fa fa-shopping-bag"></i> My Orders </a>
                        </li>
                        <li>
                            <a href="{{ route('customer.profile') }}" wire:navigate>
                                <i class="fa fa-user"></i> Profile </a>
                        </li>
                        <li>
                            <a href="#"> <i class="fa fa-lock"></i> Change Password </a>
                        </li>
                        <li>
                            <button wire:click="logout" class="logout-btn">
                                <i class="fa fa-sign-out"></i> Logout
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

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
                                            <span class="w-100 badge badge-warning">
                                                Pending
                                            </span>
                                        @elseif($order->order_status == 'processing')
                                            <span class="w-100 badge badge-info">
                                                Processing
                                            </span>
                                        @elseif($order->order_status == 'delivered')
                                            <span class="w-100 badge badge-success">
                                                Delivered
                                            </span>
                                        @elseif($order->order_status == 'cancelled')
                                            <span class="w-100 badge badge-danger">
                                                Cancelled
                                            </span>
                                        @endif
                                    </td>
                                    </td>
                                    <td> {{ $order->items_count }} </td>
                                    <td>
                                        <a href="{{ route('invoice', $order->id) }}" class="btn btn-primary btn-sm">
                                            Invoice
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
