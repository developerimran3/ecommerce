<div>
    <h2 class="font-weight-bold mb-4">Admin Panel</h2>
    <div class="row">
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="stat-card card-purple">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2>{{ $totalOrders }}</h2>
                        <p>Total Orders</p>
                    </div>

                    <div class="icon-box">
                        <i class="fas fa-shopping-cart fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-4">
            <div class="stat-card card-green">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2>{{ $totalPayment }}</h2>
                        <p>Total Sales</p>
                    </div>

                    <div class="icon-box">
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-4">
            <div class="stat-card card-blue">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2>{{ $totalProducts }}</h2>
                        <p>Products</p>
                    </div>

                    <div class="icon-box">
                        <i class="fas fa-box-open fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 mb-4">
            <div class="stat-card card-orange">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2>{{ $totalCustomers }}</h2>
                        <p>Customers</p>
                    </div>

                    <div class="icon-box">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="table-card">
                <div class="table-header-purple">Latest 7 Orders</div>

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Invoice</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>1</td>

                                <td>
                                    <img src="https://picsum.photos/40" class="product-img" />
                                </td>

                                <td>#15664</td>

                                <td>$400</td>

                                <td>
                                    <span class="badge-status"> Paid </span>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>

                                <td>
                                    <img src="https://picsum.photos/40" class="product-img" />
                                </td>

                                <td>#15664</td>

                                <td style="font-weight: bold; color: rgba(5, 150, 105, 1)">
                                    $400
                                </td>

                                <td>
                                    <span class="badge-status"> Paid </span>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>

                                <td>
                                    <img src="https://picsum.photos/40" class="product-img" />
                                </td>

                                <td>#15664</td>

                                <td>$400</td>

                                <td>
                                    <span class="badge-status"> Paid </span>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>

                                <td>
                                    <img src="https://picsum.photos/40" class="product-img" />
                                </td>

                                <td>#15664</td>

                                <td>$400</td>

                                <td>
                                    <span class="badge-status"> Paid </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="table-card">
                <div class="table-header-blue">Latest Customers</div>

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>1</td>

                                <td>Rajib Ahmed</td>

                                <td>01743839801</td>

                                <td>
                                    <span class="badge-status"> Active </span>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>

                                <td>Rajib Ahmed</td>

                                <td>01743839801</td>

                                <td>
                                    <span class="badge-status"> Active </span>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>

                                <td>Rajib Ahmed</td>

                                <td>01743839801</td>

                                <td>
                                    <span class="badge-status"> Active </span>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>

                                <td>Rajib Ahmed</td>

                                <td>01743839801</td>

                                <td>
                                    <span class="badge-status"> Active </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
