<div class="container py-5">

    <div class="card shadow">

        <div class="card-body">

            <div class="d-flex justify-content-between">

                <div>

                    <h3>E-Commerce</h3>

                    <p>Invoice: {{ $order->invoice_no }}</p>

                    <p>Date: {{ $order->created_at->format('d M Y') }}</p>

                </div>

                <button onclick="window.print()" class="btn btn-primary">

                    Print

                </button>

            </div>

            <hr>

            <h5>{{ $order->name }}</h5>

            <p>{{ $order->phone }}</p>

            <p>{{ $order->address }}</p>

            <table class="table table-bordered mt-4">

                <thead class="thead-dark">

                    <tr>

                        <th>Product</th>

                        <th>Qty</th>

                        <th>Price</th>

                        <th>Total</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach ($order->items as $item)
                        <tr>

                            <td>{{ $item->product?->name }}</td>

                            <td>{{ $item->qty }}</td>

                            <td>৳ {{ number_format($item->price, 2) }}</td>

                            <td>৳ {{ number_format($item->subtotal, 2) }}</td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

            <div class="text-right">

                <h4>

                    Grand Total:

                    ৳ {{ number_format($order->grand_total, 2) }}

                </h4>

            </div>

        </div>

    </div>

</div>
