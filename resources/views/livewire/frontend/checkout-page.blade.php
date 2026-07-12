<div class="container py-5">

    <div class="row">

        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-header">

                    <h4>Billing Details</h4>

                </div>

                <div class="card-body">

                    <div class="form-group">

                        <label>Name</label>

                        <input type="text" class="form-control" wire:model="name">

                    </div>

                    <div class="form-group">

                        <label>Phone</label>

                        <input type="text" class="form-control" wire:model="phone">

                    </div>

                    <div class="form-group">

                        <label>Email</label>

                        <input type="email" class="form-control" wire:model="email">

                    </div>

                    <div class="form-group">

                        <label>Address</label>

                        <textarea class="form-control" rows="4" wire:model="address"></textarea>

                    </div>

                    <div class="form-group">

                        <label>Payment Method</label>

                        <select class="form-control" wire:model="payment_method">

                            <option value="cod">
                                Cash On Delivery
                            </option>

                            <option value="bkash">
                                bKash
                            </option>

                            <option value="nagad">
                                Nagad
                            </option>

                        </select>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card shadow">

                <div class="card-header">

                    <h4>Order Summary</h4>

                </div>

                <div class="card-body">

                    @foreach ($cart?->items ?? [] as $item)
                        <div class="d-flex justify-content-between mb-2">

                            <span>
                                {{ $item->product->name }}

                                × {{ $item->qty }}
                            </span>

                            <span>
                                ৳ {{ number_format($item->subtotal, 2) }}
                            </span>

                        </div>
                    @endforeach

                    <hr>

                    <h5>

                        Total:

                        ৳ {{ number_format($total, 2) }}

                    </h5>

                    <button class="btn btn-success btn-block mt-3" wire:click="placeOrder" wire:navigate>

                        Place Order

                    </button>

                </div>

            </div>

        </div>

    </div>

</div>
