<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow border-0">

                <div class="card-body text-center p-5">

                    <i class="fa fa-check-circle text-success" style="font-size: 80px;"></i>

                    <h2 class="mt-4">

                        Order Placed Successfully!

                    </h2>

                    <p class="text-muted">

                        Thank you for your order.

                    </p>

                    <hr>

                    <div class="row text-left">

                        <div class="col-md-6">

                            <p>

                                <strong>Invoice:</strong>

                                {{ $order->invoice_no }}

                            </p>

                            <p>

                                <strong>Customer:</strong>

                                {{ $order->name }}

                            </p>

                            <p>

                                <strong>Phone:</strong>

                                {{ $order->phone }}

                            </p>

                        </div>

                        <div class="col-md-6">

                            <p>

                                <strong>Payment:</strong>

                                {{ ucfirst($order->payment_method) }}

                            </p>

                            <p>

                                <strong>Status:</strong>

                                {{ ucfirst($order->order_status) }}

                            </p>

                            <p>

                                <strong>Total:</strong>

                                ৳ {{ number_format($order->grand_total, 2) }}

                            </p>

                        </div>

                    </div>

                    <div class="mt-4">

                        <a href="{{ route('home') }}" class="btn btn-primary">

                            Continue Shopping

                        </a>

                        <a href="{{ route('invoice', $order->id) }}" class="btn btn-success">

                            View Invoice

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
