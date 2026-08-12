<div>
    <style>
        table thead tr th {
            color: white !important;
            background-color: #6d28d9 !important;
            font-weight: bold;
            font-size: 18px;
        }
    </style>
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td width="55%" valign="top">
                <div style="color:#6d28d9;padding:20px;text-align:right;font-size:35px;font-weight:bold;">
                    GENIUS.SHOP
                </div>
                <br>
                <div class="payment" style="margin-top:50px;">
                    <p>
                        <strong>Payment Method:</strong>
                        {{ strtoupper($order->payment_method) }}
                    </p>
                    <br>
                    <br>
                    <br>
                    <p>
                        <strong>Invoice From:</strong>
                    </p>

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
                        <td style="padding:15px;text-align:right;font-size:16px;line-height:20px;">
                            Invoice ID : <strong style="font-weight: bold"> {{ $order->invoice_no }} </strong>
                            <br>
                            Invoice Date : <strong style="font-weight: bold"> {{ $order->created_at->format('d-m-Y') }}
                            </strong>
                        </td>
                    </tr>
                </table>
                <br>
                <p style="text-align:right;font-size:15px;line-height:22px;">
                    <strong style="font-size:16px;">Invoice To:</strong>
                    <br>
                    {{ ucwords($order->name) }}
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
        style="margin-top:30px;font-size:15px; border-collapse:collapse;">
        <thead class="invoice_thead">
            <tr style="background:#6d28d9;color:white;">
                <th style="border:1px solid #ddd;"> SL </th>
                <th style="border:1px solid #ddd;"> Product </th>
                <th style="border:1px solid #ddd;"> Price </th>
                <th style="border:1px solid #ddd;"> Qty </th>
                <th style="border:1px solid #ddd;"> Total </th>
            </tr>

        </thead>
        <tbody>
            @foreach ($order->items as $key => $item)
                <tr>
                    <td style="border:1px solid #ddd;"> {{ $key + 1 }} </td>
                    <td style="border:1px solid #ddd;"> {{ $item->product?->name }} </td>
                    <td style="border:1px solid #ddd;text-align:right;"> ৳ {{ number_format($item->price, 2) }} </td>
                    <td style="border:1px solid #ddd;"> {{ $item->qty }} </td>
                    <td style="border:1px solid #ddd;text-align:right;"> ৳ {{ number_format($item->subtotal, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <table width="300" align="right" cellpadding="8" style="margin-top:30px;border-collapse:collapse;">
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
