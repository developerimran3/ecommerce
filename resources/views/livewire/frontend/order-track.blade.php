<div>


    <section class="order-track">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-5">
                    <div class="form-content">
                        <p class="auth-title">Order Track </p>
                        <form action="">
                            <div class="form-group mb-3">
                                <label for="phone">Phone Number</label>
                                <input type="text" minlength="11" id="number" maxlength="11" pattern="0[0-9]+"
                                    class="form-control" name="phone" wire:model="phone"
                                    placeholder="Enter Phone Number" required>


                            </div>
                            <!-- col-end -->
                            <div class="form-group mb-3">
                                <label for="invoice_id">Invoice ID</label>
                                <input type="number" id="invoice_id" class="form-control" name="invoice_id"
                                    placeholder="Enter Your Invoice ID">
                            </div>
                            <!-- col-end -->
                            <div class="form-group mb-3">
                                <button class="submit-btn">submit</button>
                            </div>
                            <!-- col-end -->
                        </form>
                    </div>
                </div>
            </div>
        </div>

</div>
