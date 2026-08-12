<div>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="table-card">
                <!-- Filter Area -->
                <div class="p-4 border-bottom">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" placeholder="🔍 Search invoice, name, phone..."
                                wire:model.live="search">
                        </div>
                        <div class="col-md-3 mb-3">
                            <select class="form-control" wire:model.live="status">
                                <option value=""> All Status </option>
                                <option value="pending"> Pending </option>
                                <option value="confirmed"> Confirmed </option>
                                <option value="processing"> Processing </option>
                                <option value="shipped"> Shipped </option>
                                <option value="delivered"> Delivered </option>
                                <option value="cancelled"> Cancelled </option>
                            </select>
                        </div>
                        <div class="col-md-1 mb-3">
                            <button class="btn btn-light border w-100" wire:click="clearFilters">
                                <i class="fa fa-refresh"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th> SL </th>
                                <th> Invoice </th>
                                <th> Customer </th>
                                <th> Phone </th>
                                <th> Total </th>
                                <th> Status </th>
                                <th> Date </th>
                                <th> Update Status </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td>
                                        <strong> {{ $order->invoice_no }} </strong>
                                    </td>
                                    <td> {{ ucwords($order->name) }} </td>
                                    <td> {{ $order->phone }} </td>

                                    <td style="font-weight:bold;color:rgba(5,150,105,1)">
                                        ৳ {{ number_format($order->grand_total, 2) }}
                                    </td>
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
                                    <td>
                                        {{ $order->created_at->format('d M Y') }}
                                    </td>
                                    <td>
                                        <select class="form-control form-control-sm d-inline" style="width:120px"
                                            wire:change="updateStatus({{ $order->id }}, $event.target.value)">
                                            <option value="pending" @selected($order->order_status == 'pending')>
                                                Pending
                                            </option>
                                            <option value="confirmed" @selected($order->order_status == 'confirmed')>
                                                Confirmed
                                            </option>
                                            <option value="processing" @selected($order->order_status == 'processing')>
                                                Processing
                                            </option>
                                            <option value="shipped" @selected($order->order_status == 'shipped')>
                                                Shipped
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
                                        <div class="d-flex">
                                            <a href="{{ route('admin.invoice.download', $order->id) }}" target="_blank"
                                                class="btn btn-view btn-sm mr-2">
                                                <i class="fa-solid fa-download"></i>
                                            </a>
                                            <button class="btn btn-sm btn-edit mr-2" data-toggle="modal"
                                                data-target="#orderModal" wire:click="showOrder({{ $order->id }})">
                                                <i class="fa fa-eye"></i>
                                            </button>

                                            <button class="btn btn-sm btn-delete"
                                                wire:click="delete({{ $order->id }})"
                                                wire:confirm="Are you sure you want to delete this user?">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center"> No Data Found </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-3 border-top">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Order Detailes --}}
    <div wire:ignore.self class="modal fade" id="orderModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content order-modal">
                <!-- Header -->
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa fa-shopping-cart"></i> Order Details
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($selectedOrder)
                        <!-- Customer Info -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="info-card">
                                    <h6> Customer Information </h6>
                                    <p> <b>Invoice:</b> {{ $selectedOrder->invoice_no }}
                                    </p>
                                    <p> <b>Name:</b> {{ ucwords($selectedOrder->name) }}
                                    </p>
                                    <p> <b>Phone:</b> {{ $selectedOrder->phone }}
                                    </p>
                                    <p> <b>Email:</b> {{ $selectedOrder->email }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-card">
                                    <h6> Order Information </h6>
                                    <p> <b>Payment:</b> {{ ucfirst($selectedOrder->payment_method) }}
                                    </p>
                                    <p> <b>Payment Status:</b>
                                        @if ($selectedOrder->payment_status == 'pending')
                                            <span class="badge-warning"> Pending </span>
                                        @else
                                            <span class="badge-success"> Paid </span>
                                        @endif
                                    </p>
                                    <p> <b>Order Status:</b>
                                        <span class="badge-status">
                                            {{ ucfirst($selectedOrder->order_status) }}
                                        </span>
                                    </p>
                                    <p> <b>Date:</b>
                                        {{ $selectedOrder->created_at->format('d M Y h:i A') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Address -->

                        <div class="address-box mb-4">
                            <h6>
                                <i class="fa fa-map-marker"></i> Delivery Address
                            </h6>
                            <p> {{ $selectedOrder->address }} </p>
                        </div>
                        <!-- Product Table -->
                        <div class="table-responsive">
                            <table class="table table-hover order-table">
                                <thead>
                                    <tr>
                                        <th> Image </th>
                                        <th> Product </th>
                                        <th> Price </th>
                                        <th> Qty </th>
                                        <th> Subtotal </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($selectedOrder->items as $item)
                                        <tr>
                                            <td>
                                                @if ($item->product?->thumbnail)
                                                    <img src="{{ asset('storage/' . $item->product->thumbnail) }}"
                                                        class="order-product-img">
                                                @else
                                                    <span> No Image </span>
                                                @endif
                                            </td>
                                            <td>
                                                <strong> {{ $item->product?->name }} </strong>
                                            </td>
                                            <td>
                                                ৳ {{ number_format($item->price, 2) }}
                                            </td>
                                            <td>
                                                {{ $item->qty }}
                                            </td>
                                            <td>
                                                <b> ৳ {{ number_format($item->subtotal, 2) }} </b>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Total -->
                        <div class="order-total">
                            <h4> Grand Total :
                                <span> ৳ {{ number_format($selectedOrder->grand_total, 2) }} </span>
                            </h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
