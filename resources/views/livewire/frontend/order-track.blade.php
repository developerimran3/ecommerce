<div>
    <section class="order-track">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="form-content">
                        <p class="auth-title">Order Track</p>
                        <form wire:submit.prevent="trackOrder">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" class="form-control" wire:model.defer="phone" maxlength="11"
                                    placeholder="01XXXXXXXXX">
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Invoice ID</label>
                                <input type="text" class="form-control" wire:model.defer="invoice_no"
                                    placeholder="Invoice ID">
                                @error('invoice_no')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="submit-btn">
                                Track Order
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            @if ($orders)
                @foreach ($orders as $order)
                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <div class="form-content">
                                <p class="auth-title">Order Track Result</p>
                                <div class="track_info">
                                    <ul>
                                        <li><span>Invoice ID:</span> {{ $order->invoice_no }} </li>
                                        <li><span>Date:</span> {{ $order->created_at->format('Y-m-d H:i:s') }} </li>
                                        <li><span>Status:</span> {{ ucwords($order->order_status) }} </li>
                                    </ul>
                                </div>
                                <table class="table table-bordered tracktable">
                                    <thead class="bg-green text-white">
                                        <tr>
                                            <th>Product Name</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-right">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->items as $item)
                                            <tr>
                                                <td>
                                                    {{ Str::limit($item->product?->name ?? 'Product', 30) }}
                                                </td>
                                                <td class="text-center"> {{ $item->qty }} </td>
                                                <td class="text-right">
                                                    ৳ {{ number_format($item->subtotal, 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                    <tfoot>
                                        {{-- Subtotal --}}
                                        <tr>
                                            <td colspan="2"></td>
                                            <td class="tfoot_bg text-right">
                                                <strong>Subtotal :</strong>
                                                <span style="color: #008e74"> ৳
                                                    {{ number_format($order->subtotal ?? 0, 2) }}</span>
                                            </td>
                                        </tr>

                                        {{-- Delivery Charge --}}
                                        <tr>
                                            <td colspan="2"></td>
                                            <td class="tfoot_bg text-right">
                                                <strong>Delivery Charge :</strong>
                                                ৳ {{ number_format($order->shipping ?? 0, 2) }}
                                            </td>
                                        </tr>
                                        {{-- Discount --}}
                                        @if ($order->discount > 0)
                                            <tr>
                                                <td colspan="2"></td>
                                                <td class="tfoot_bg text-right">
                                                    <strong>Discount :</strong>
                                                    ৳ {{ number_format($order->discount ?? 0, 2) }}
                                                </td>
                                            </tr>
                                        @endif
                                        {{-- Grand Total --}}
                                        <tr>
                                            <td colspan="2"></td>
                                            <td class="tfoot_bg text-right" style="color:#008e74">
                                                <strong>Total :</strong>
                                                <b> ৳ {{ number_format($order->grand_total ?? 0, 2) }}</b>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>
</div>
