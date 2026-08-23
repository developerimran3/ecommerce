<section class="chheckout-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 cus-order-2">
                <div class="checkout-shipping">
                    <div class="card">
                        <div class="card-header">
                            <h6>আপনার অর্ডারটি কনফার্ম করতে তথ্যগুলো পূরণ করে "অর্ডার করুন" বাটন এ ক্লিক করুন </h6>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-check-label-checkout" for="name">আপনার নাম লিখুন
                                            *</label>
                                        <input type="text" id="name" class="form-control text-capitalize"
                                            wire:model="name" name="name">
                                        @error('name')
                                            <small class="text-danger"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-check-label-checkout" for="email">আপনার ই-মেইল লিখুন
                                            *</label>
                                        <input type="email" id="email" class="form-control" wire:model="email"
                                            name="email">
                                        @error('email')
                                            <small class="text-danger"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col-end -->
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-check-label-checkout" for="phone">মোবাইল নাম্বার দিন
                                            *</label>
                                        <input type="text" minlength="11" id="number" maxlength="11"
                                            pattern="0[0-9]+" class="form-control" name="phone" wire:model="phone">
                                        @error('phone')
                                            <small class="text-danger"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col-end -->
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-check-label-checkout" for="address">ঠিকানা লিখুন *</label>
                                        <input type="address" id="address" class="form-control" name="address"
                                            wire:model="address">
                                        @error('address')
                                            <small class="text-danger"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label class="form-check-label-checkout" for="area"> ডেলিভারি এরিয়া নির্বাচন
                                            করুন </label>
                                        <select id="area" class="form-control" wire:model.live="area">
                                            @foreach ($shippingAreas as $shippingArea)
                                                <option value="{{ $shippingArea->id }}">
                                                    {{ $shippingArea->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="payment-methods">
                                    <div class="mb-3">
                                        <label class="form-check-label-checkout"> পেমেন্ট মেথড </label>
                                    </div>
                                    {{-- COD --}}
                                    <div class="form-check p_cash mb-2">
                                        <input class="form-check-input" type="radio" id="cod"
                                            name="payment_method" value="cod" wire:model.live="payment_method">
                                        <label class="form-check-label" for="cod"> Cash On Delivery </label>
                                    </div>
                                    {{-- bKash --}}
                                    <div class="form-check p_bkash mb-2">
                                        <input class="form-check-input" type="radio" id="bkash"
                                            name="payment_method" value="bkash" wire:model.live="payment_method">
                                        <label class="form-check-label" for="bkash"> bKash </label>
                                    </div>
                                    {{-- Nagad --}}
                                    <div class="form-check p_nagad mb-2">
                                        <input class="form-check-input" type="radio" id="nagad"
                                            name="payment_method" value="nagad" wire:model.live="payment_method">
                                        <label class="form-check-label" for="nagad"> Nagad </label>
                                    </div>
                                    {{-- SSLCommerz --}}
                                    <div class="form-check p_ssl mb-2">

                                        <input class="form-check-input" type="radio" id="sslcommerz"
                                            name="payment_method" value="sslcommerz" wire:model.live="payment_method">

                                        <label class="form-check-label" for="sslcommerz">
                                            Online Payment
                                        </label>

                                    </div>
                                    @if (in_array($payment_method, ['bkash', 'nagad']))
                                        <div class="form-group mt-3">
                                            <label class="form-check-label-checkout"> Transaction ID </label>

                                            <input type="text" class="form-control" wire:model="trx_id"
                                                placeholder="Enter Transaction ID">
                                            @error('trx_id')
                                                <small class="text-danger"> {{ $message }} </small>
                                            @enderror
                                        </div>
                                    @endif
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button class="order_place" wire:click="placeOrder">অর্ডার করুন</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- col end -->
            <div class="col-sm-7 cust-order-1">
                <div class="cart_details table-responsive-sm">
                    <div class="card">
                        <div class="card-header">
                            <h6>অর্ডারের তথ্য</h6>
                        </div>

                        <div class="card-body cartlist">
                            <table class="cart_table table table-bordered table-striped text-center mb-0">
                                <thead>
                                    <tr>
                                        <th style="width:20%;">ডিলিট</th>
                                        <th style="width:40%;">প্রোডাক্ট</th>
                                        <th style="width:20%;">পরিমাণ</th>
                                        <th style="width:20%;">মূল্য</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if ($cart && $cart->items->count())
                                        @foreach ($cart->items as $item)
                                            <tr>
                                                <td>
                                                    <a href="javascript:void(0)"
                                                        wire:click="removeItem({{ $item->id }})"
                                                        class="text-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>

                                                <td class="text-left">
                                                    {{ Str::limit($item->product->name, 20) }}
                                                </td>

                                                <td>
                                                    <div class="quantity-box">
                                                        <button
                                                            wire:click="decreaseQty({{ $item->id }})">−</button>
                                                        <input type="text" value="{{ $item->qty }}" readonly>
                                                        <button
                                                            wire:click="increaseQty({{ $item->id }})">+</button>
                                                    </div>
                                                </td>

                                                <td>৳ {{ number_format($item->subtotal) }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-end px-4">মোট</th>
                                        <td class="px-4">
                                            <span class="alinur">৳</span>
                                            <strong>{{ number_format($subtotal ?? 0) }}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-end px-4"> ডেলিভারি চার্জ </th>
                                        <td class="px-4">
                                            <span class="alinur">৳</span>
                                            <strong>
                                                {{ number_format($shipping ?? 0, 2) }}
                                            </strong>
                                        </td>
                                    </tr>
                                    @if ($discount > 0)
                                        <tr>
                                            <th colspan="3" class="text-right px-4 text-success">
                                                Coupon Discount
                                            </th>
                                            <td class="px-4 text-success">
                                                - ৳ {{ number_format($discount, 2) }}
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th colspan="3" class="text-end px-4"> সর্বমোট </th>
                                        <td class="px-4">
                                            <span class="alinur">৳</span>
                                            <strong>
                                                {{ number_format($grandTotal ?? 0, 2) }}
                                            </strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        @if ($cart && $cart->items->count())
                            <div class="card-footer">
                                @if (!$coupon)
                                    <form id="coupon_form">
                                        <div class="form-group mb-2">
                                            <label for="coupon_code">Have a coupon?</label>
                                            <input type="text" id="coupon_code"
                                                class="form-control"wire:model="coupon_code"
                                                placeholder="Enter coupon code">
                                            @error('coupon_code')
                                                <small class="text-danger"> {{ $message }} </small>
                                            @enderror
                                        </div>
                                        <button type="button" wire:click="applyCoupon"
                                            class="btn btn-primary btn-sm"> Apply Coupon
                                        </button>
                                        <div id="coupon-message" class="mt-2"></div>
                                    </form>
                                @else
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong> {{ $coupon->code }} </strong>
                                            <br>
                                            <small class="text-success"> Coupon applied </small>
                                        </div>
                                        <button type="button" class="btn btn-danger btn-sm"
                                            wire:click="removeCoupon"> Remove
                                        </button>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- col end -->
        </div>
    </div>
</section>
