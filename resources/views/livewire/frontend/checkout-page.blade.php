<section class="chheckout-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 cus-order-2">
                <div class="checkout-shipping">


                    <div class="card">
                        <div class="card-header">
                            <h6>আপনার অর্ডারটি কনফার্ম করতে তথ্যগুলো পূরণ করে "অর্ডার করুন" বাটন এ ক্লিক করুন </h6>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label for="name">আপনার নাম লিখুন *</label>
                                        <input type="text" id="name" class="form-control" wire:model="name"
                                            name="name">
                                        @error('name')
                                            <small class="text-danger"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label for="email">আপনার ই-মেইল লিখুন *</label>
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
                                        <label for="phone">মোবাইল নাম্বার দিন *</label>
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
                                        <label for="address">ঠিকানা লিখুন *</label>
                                        <input type="address" id="address" class="form-control" name="address"
                                            wire:model="address">
                                        @error('address')
                                            <small class="text-danger"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label for="area">ডেলিভারি এরিয়া নিবার্চন করুন *</label>
                                        <select type="area" id="area" class="form-control" wire:model="area"
                                            name="area">
                                            <option value="2">সারা বাংলাদেশ ১৫০ টাকা ডেলিভারি চার্জ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label for="area">পেমেন্ট মেথড (optional)</label>
                                        <select type="area" id="area" class="form-control"
                                            wire:model="payment_method" name="payment_method">
                                            <option value="2">সারা বাংলাদেশ ১৫০ টাকা ডেলিভারি চার্জ</option>
                                        </select>
                                    </div>
                                </div>

                                <!-------------------->
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
                            <h5>অর্ডারের তথ্য</h5>
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
                                                        <button wire:click="decreaseQty({{ $item->id }})">−</button>
                                                        <input type="text" value="{{ $item->qty }}" readonly>
                                                        <button wire:click="increaseQty({{ $item->id }})">+</button>
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
                                            <strong>{{ number_format($total ?? 0) }}</strong>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th colspan="3" class="text-end px-4">ডেলিভারি চার্জ</th>
                                        <td class="px-4">
                                            <span class="alinur">৳</span>
                                            <strong>00</strong>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th colspan="3" class="text-end px-4">সর্বমোট</th>
                                        <td class="px-4">
                                            <span class="alinur">৳</span>
                                            <strong>{{ number_format($total ?? 0) }}</strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>


                        @if ($cart && $cart->items->count())
                            <div class="card-footer">
                                <form id="coupon_form">
                                    <div class="form-group mb-2">
                                        <label for="coupon_code">Have a coupon?</label>
                                        <input type="text" id="coupon_code" class="form-control"
                                            placeholder="Enter coupon code">
                                    </div>
                                    <button type="button" id="apply_coupon" class="btn btn-primary btn-sm">
                                        Apply Coupon
                                    </button>
                                    <div id="coupon-message" class="mt-2"></div>
                                </form>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
            <!-- col end -->
        </div>
    </div>
</section>
