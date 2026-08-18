<div class="order-success-page">

    <div class="success-card">
        <!-- Logo -->
        <div class="success-logo">
            <img src="{{ asset('assets/img/order-success.png') }}" alt="Congratulations">
        </div>
        <!-- Message -->
        <h3>
            আপনার অর্ডারটি আমাদের কাছে সফলভাবে পৌঁছেছে,
            <br>
            কিছুক্ষণের মধ্যে আমাদের একজন প্রতিনিধি আপনার নম্বরে কল করবেন।
        </h3>
        <!-- Order Details -->

        <h5 class="my-2">Your Order Details</h5>
        <div class="box">
            <table class="table table-bordered table-sm">
                <tr>
                    <td> Invoice ID <br>
                        <b> {{ $order->invoice_no }}</b>
                    </td>

                    <td> Date <br>
                        <b> {{ $order->created_at->format('d-m-y') }}</b>
                    </td>

                    <td> Phone <br>
                        <b> {{ $order->phone }}</b>
                    </td>

                    <td> Total <br>
                        <b>৳ {{ number_format($order->grand_total, 2) }}</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="4"> Payment Method <br>
                        <b> {{ ucfirst($order->payment_method) }}</b>
                    </td>
                </tr>
            </table>
        </div>

        <p class="mt-3"> Pay with cash upon delivery </p>
        <!-- Product -->
        <div class="box">
            <h6> Order Delivery </h6>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            Product
                        </th>
                        <th>
                            Total
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td>
                                {{ $item->product->name }}
                                × {{ $item->qty }}
                            </td>
                            <td>
                                ৳ {{ number_format($item->subtotal, 2) }}
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="text-right">
                            Net Total
                        </td>
                        <td>
                            ৳ {{ number_format($order->grand_total, 2) }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">
                            Discount
                        </td>
                        <td>
                            ৳200
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">
                            Shipping Cost
                        </td>
                        <td>
                            ৳150
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">
                            <b>Grand Total</b>
                        </td>
                        <td>
                            <b>৳ {{ number_format($order->grand_total, 2) }}</b>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered table-sm">
                <tr>
                    <td>
                        <h5 class="my-3">Billing Address</h5>
                        {{ $order->name }} <br>
                        {{ $order->phone }} <br>
                        {{ $order->address }}
                    </td>
                </tr>
            </table>
        </div>

        <!-- Button -->
        <div class="action-btn">
            <a href="{{ route('home') }}" class="btn btn-primary btn-sm"> Go To Home </a>
            <a target="_blank" href="{{ route('customer.invoice.download', $order->id) }}"
                class="btn btn-success btn-sm"> <i class="fa fa-save"></i>
                Save PDF </a>
        </div>
    </div>
</div>
