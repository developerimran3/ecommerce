{{-- <div class="container py-5">

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

</div> --}}

<div>
    <style>
        .customer-invoice {
            margin: 25px 0;
        }

        .invoice_btn {
            margin-bottom: 15px;
        }

        p {
            margin: 0;
        }

        td {
            font-size: 14px;
        }

        th {
            font-size: 15px;
        }

        /* 2nd Table er Thead Color Change */
        .table thead th {
            background: #10b981 !important;
            /* Green color */
            color: white !important;
        }

        @page {
            margin: 0px;
        }

        @media print {
            .invoice-innter {
                margin-left: -120px !important;
            }

            .invoice_btn {
                margin-bottom: 0 !important;
            }

            td {
                font-size: 14px;
            }

            p {
                margin: 0;
                font-size: 14px;
            }

            header,
            footer,
            .no-print,
            .left-side-menu,
            .navbar-custom {
                display: none !important;
            }
        }
    </style>

    <div class="col-sm-12 mt-3">
        <div class="invoice-innter"
            style="width:760px;margin: 0 auto;background: #fff;overflow:hidden; padding: 30px;padding-top: 0;">
            <table style="width:100%">
                <tr>
                    <td style="width: 40%; float: left; padding-top: 15px;">
                        <img src="https://v3.nexlifyo.com/public/uploads/settings/1750754465-025b4b.webp" width="190px"
                            style="margin-top:25px !important" alt="">
                        <p style="font-size: 14px; color: #222; margin: 20px 0;"><strong>Payment Method:</strong> <span
                                style="text-transform: uppercase;">Cash On Delivery</span></p>
                        <div class="invoice_form">
                            <p style="font-size:14px;line-height:1.8;color:#222"><strong>Invoice From:</strong></p>
                            <p style="font-size:14px;line-height:1.8;color:#222">PHPX.SHOP</p>
                            <p style="font-size:14px;line-height:1.8;color:#222">+8809638365975</p>
                            <p style="font-size:14px;line-height:1.8;color:#222">support@khaleditsolution.com</p>
                            <p style="font-size:14px;line-height:1.8;color:#222">8050 Goshairhat , Shariatpur , Dhaka
                            </p>
                        </div>
                    </td>
                    <td style="width:60%;float: left;">

                        <div class="invoice-bar"
                            style=" background: #10b981; transform: skew(38deg); width: 100%; margin-left: 65px; padding: 20px 60px; ">
                            <p
                                style="font-size: 30px; color: #fff; transform: skew(-38deg); text-transform: uppercase; text-align: right; font-weight: bold;">
                                Invoice</p>
                        </div>
                        <div class="invoice-bar"
                            style="background: #fff; transform: skew(36deg); width: 72%; margin-left: 182px; padding: 12px 32px; margin-top: 6px;">
                            <p
                                style="font-size: 15px; color: #222;font-weight:bold; transform: skew(-36deg); text-align: right; padding-right: 18px">
                                Invoice ID : <strong>{{ $order->invoice_no }}</strong></p>
                            <p
                                style="font-size: 15px; color: #222;font-weight:bold; transform: skew(-36deg); text-align: right; padding-right: 32px">
                                Invoice Date: <strong>{{ $order->created_at->format('d-m-y') }}</strong></span></p>
                        </div>
                        <div class="invoice_to" style="padding-top: 20px;">
                            <p style="font-size:14px;line-height:1.8;color:#222;text-align: right;"><strong>Invoice
                                    To:</strong></p>
                            <p style="font-size:14px;line-height:1.8;color:#222;text-align: right;">{{ $order->name }}
                            </p>
                            <p style="font-size:14px;line-height:1.8;color:#222;text-align: right;">{{ $order->phone }}
                            </p>
                            <p style="font-size:14px;line-height:1.8;color:#222;text-align: right;">
                                {{ $order->address }}</p>
                            <p style="font-size:14px;line-height:1.8;color:#222;text-align: right;">সারা বাংলাদেশ ১৫০
                                টাকা
                                ডেলিভারি চার্জ</p>
                        </div>
                    </td>
                </tr>
            </table>
            <table class="table" style="margin-top: 30px;margin-bottom: 0;">
                <thead style="background: #10b981; color: #fff;">
                    <tr>
                        <th>SL</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td>1</td>
                            <td>{{ $item->product?->name }}</td>
                            <td>৳ {{ number_format($item->price, 2) }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>৳ {{ number_format($item->subtotal, 2) }}</td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="invoice-bottom">

                <table class="table" style="width: 300px; float: right;    margin-bottom: 30px;">
                    <tbody style="background:#f1f9f8">
                        <tr>
                            <td><strong>SubTotal</strong></td>
                            <td><strong>৳ {{ number_format($order->grand_total, 2) }}</strong></td>
                        </tr>
                        <tr>
                            <td><strong>Shipping(+)</strong></td>
                            <td><strong>৳ {{ number_format($order->shipping_cost, 2) }}</strong></td>
                        </tr>
                        <tr>
                            <td><strong>Discount(-)</strong></td>
                            <td><strong>৳{{ $order->discount }}</strong></td>
                        </tr>
                        <tr style="background:#10b981;color:#fff">
                            <td><strong>Final Total</strong></td>
                            <td><strong> ৳ {{ number_format($order->grand_total, 2) }}</strong></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>
