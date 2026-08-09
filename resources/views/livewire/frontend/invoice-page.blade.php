<div>
    <style>
        @font-face {

            font-family: 'nirmala';
            src: url("{{ public_path('assets/fonts/Nirmala.ttf') }}") format('truetype');

        }
    </style>

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td width="55%" valign="top">
                {{-- <img src="{{ public_path('assets/logo.png') }}" width="170"> --}}
                <p style="margin-top:20px;">
                    <strong>Payment Method:</strong>
                    {{ strtoupper($order->payment_method) }}
                </p>

                <p style="margin-top:15px;">
                    <strong>Invoice From:</strong>
                </p>
                <p>
                    PHPX.SHOP<br>
                    +8809638365975<br>
                    support@khaleditsolution.com<br>
                    Dhaka, Bangladesh
                </p>
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
                        <td style="padding:15px;text-align:right;font-size:14px;line-height:18px;">
                            Invoice ID : <strong style="font-weight: bold"> {{ $order->invoice_no }} </strong>
                            <br>
                            Invoice Date : <strong style="font-weight: bold"> {{ $order->created_at->format('d-m-Y') }}
                            </strong>
                        </td>
                    </tr>
                </table>
                <br>
                <p style="text-align:right;font-size:14px;line-height:22px;">
                    <strong>Invoice To:</strong>
                    <br>
                    {{ $order->name }}
                    <br>
                    {{ $order->phone }}
                    <br>
                    {{ $order->address }}
                    <br>
                    সারা বাংলাদেশ ১৫০ টাকা ডেলিভারি চার্জ ধার্য করা হলো।
                </p>
            </td>
        </tr>
    </table>
    <table width="100%" cellpadding="8" cellspacing="0" style="margin-top:30px;border-collapse:collapse;">
        <thead>
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
                    <td style="border:1px solid #ddd;"> ৳ {{ number_format($item->price, 2) }} </td>
                    <td style="border:1px solid #ddd;"> {{ $item->qty }} </td>
                    <td style="border:1px solid #ddd;"> ৳ {{ number_format($item->subtotal, 2) }} </td>
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
        <tr style="background:#6d28d9;color:white;">
            <td>
                <strong> Final Total </strong>
            </td>
            <td align="right">
                <strong> ৳ {{ number_format($order->grand_total, 2) }} </strong>
            </td>
        </tr>
    </table>
</div>
