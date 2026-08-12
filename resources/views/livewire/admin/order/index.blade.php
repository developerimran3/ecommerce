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
                                    <td> {{ $order->name }} </td>
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
                                            <a href="{{ route('admin.invoice.download', $order->id) }}"
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
                                    <p> <b>Name:</b> {{ $selectedOrder->name }}
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

    {{-- Invoice --}}
    <div wire:ignore.self class="modal fade" id="invoiceModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content order-modal">
                <!-- Header -->
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa fa-shopping-cart"></i> Order Invoice
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <style>
                        table thead tr th {
                            color: white !important;
                            background-color: #6d28d9 !important;
                            font-weight: bold;
                            font-size: 18px;
                        }

                        thead.invoice_thead tr th {
                            padding: 5px;
                        }

                        tbody.invoice_thead tr td {
                            padding: 5px;
                        }
                    </style>
                    <div class="col-sm-12 mt-3">
                        <div class="invoice-innter"
                            style="width:760px;margin: 0 auto;background: #fff;overflow:hidden; padding: 30px;padding-top: 0;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="55%" valign="top">
                                        <div style="color:#6d28d9;padding:20px 0;font-size:35px;font-weight:bold;">
                                            GENIUS.SHOP
                                        </div>
                                        <div class="payment">
                                            <p>
                                                <strong>Payment Method:</strong>
                                                {{ strtoupper($order->payment_method) }}
                                            </p>
                                            <br>
                                            <strong>Invoice From:</strong>
                                            <p>
                                                GENIUS.SHOP<br>
                                                +8801756041512<br>
                                                geniusfashion.ptk@gmail.com<br>
                                                Chittagong, Bangladesh
                                            </p>
                                        </div>
                                    </td>
                                    <td width="45%" valign="top" align="right">
                                        <!-- Invoice Title -->
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td
                                                    style="background:#6d28d9; color:#ffffff; padding:10px; text-align:right;font-size:25px;font-weight:bold;">
                                                    INVOICE
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding:15px;text-align:right;line-height:18px;">
                                                    Invoice ID : <strong style="font-weight: bold">
                                                        {{ $order->invoice_no }} </strong>
                                                    <br>
                                                    Invoice Date : <strong style="font-weight: bold">
                                                        {{ $order->created_at->format('d-m-Y') }}
                                                    </strong>
                                                </td>
                                            </tr>
                                        </table>
                                        <br>
                                        <p style="text-align:right;line-height:22px;">
                                            <strong>Invoice To:</strong>
                                            <br>
                                            {{ $order->name }}
                                            <br>
                                            {{ $order->phone }}
                                            <br>
                                            {{ ucwords($order->address) }}
                                            <br>
                                            সারা বাংলাদেশ ১৫০ টাকা ডেলিভারি চার্জ ।
                                        </p>
                                    </td>
                                </tr>
                            </table>
                            <table width="100%" cellpadding="8" cellspacing="0"
                                style="margin-top:20px;font-size:15px;border-collapse:collapse;">
                                <thead class="invoice_thead">
                                    <tr style="background:#6d28d9;color:white;padding:20px;">
                                        <th style="border:1px solid #ddd;"> SL </th>
                                        <th style="border:1px solid #ddd;"> Product </th>
                                        <th style="border:1px solid #ddd;"> Price </th>
                                        <th style="border:1px solid #ddd;"> Qty </th>
                                        <th style="border:1px solid #ddd;"> Total </th>
                                    </tr>

                                </thead>
                                <tbody class="invoice_thead">
                                    @foreach ($order->items as $key => $item)
                                        <tr>
                                            <td style="border:1px solid #ddd;"> {{ $key + 1 }} </td>
                                            <td style="border:1px solid #ddd;"> {{ $item->product?->name }} </td>
                                            <td style="border:1px solid #ddd;"> ৳
                                                {{ number_format($item->price, 2) }} </td>
                                            <td style="border:1px solid #ddd;"> {{ $item->qty }} </td>
                                            <td style="border:1px solid #ddd;text-align:right;"> ৳
                                                {{ number_format($item->subtotal, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <table width="300" align="right" cellpadding="8"
                                style="margin-top:30px;border-collapse:collapse;">
                                <tr>
                                    <td> <strong>SubTotal</strong> </td>
                                    <td align="right"> ৳ {{ number_format($order->subtotal, 2) }} </td>
                                </tr>
                                <tr>
                                    <td> <strong>Shipping(+)</strong> </td>
                                    <td align="right"> ৳ {{ number_format($order->shipping, 2) }} </td>
                                </tr>
                                <tr>
                                    <td> <strong>Discount(-)</strong> </td>
                                    <td align="right"> ৳ {{ number_format($order->discount, 2) }} </td>
                                </tr>
                                <tr style="background:#6d28d9;">
                                    <td style="color:#ffffff !important;">
                                        <strong style="color:#ffffff !important;font-weight:bold;">
                                            Final Total
                                        </strong>
                                    </td>

                                    <td align="right" style="color:#ffffff !important;">
                                        <strong style="color:#ffffff !important;">
                                            ৳ {{ number_format($order->grand_total, 2) }}
                                        </strong>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
