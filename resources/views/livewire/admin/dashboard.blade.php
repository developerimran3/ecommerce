<div>

    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
        <div class="col">
            <div class="card radius-10 overflow-hidden">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Total Orders</p>
                            <h5 class="mb-0">{{ $totalOrders }}</h5>
                        </div>
                        <div class="ms-auto"> <i class='bx bx-cart font-30'></i>
                        </div>
                    </div>
                </div>
                <div class="" id="chart1"></div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 overflow-hidden">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Total Income</p>
                            <h5 class="mb-0">৳ {{ $totalSales }}</h5>
                        </div>
                        <div class="ms-auto"> <i class='bx bx-wallet font-30'></i>
                        </div>
                    </div>
                </div>
                <div class="" id="chart2"></div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 overflow-hidden">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Total Customers</p>
                            <h5 class="mb-0">{{ $totalCustomers }}</h5>
                        </div>
                        <div class="ms-auto"> <i class='bx bx-group font-30'></i>
                        </div>
                    </div>
                </div>
                <div class="" id="chart3"></div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 overflow-hidden">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Total Product</p>
                            <h5 class="mb-0">{{ $totalProducts }}</h5>
                        </div>
                        <div class="ms-auto"> <i class='bx bx-chat font-30'></i>
                        </div>
                    </div>
                </div>
                <div class="" id="chart4"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card radius-10 mb-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-1">Recent Orders</h5>
                        </div>
                        <div class="ms-auto">
                            <a href="javscript:;" class="btn btn-primary btn-sm radius-30">View All
                                Products</a>
                        </div>
                    </div>

                    <div class="table-responsive mt-3">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Tracking ID</th>
                                    <th>Products Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#55879</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="recent-product-img">
                                                <img src="assets/images/products/15.png" alt="">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-1 font-14">Light Red T-Shirt</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>22 Jun, 2020</td>
                                    <td class=""><span
                                            class="badge bg-light-success text-success w-100">Completed</span>
                                    </td>
                                    <td>#149.25</td>
                                    <td>
                                        <div class="d-flex order-actions"> <a href="javascript:;"
                                                class="text-danger bg-light-danger border-0"><i
                                                    class='bx bxs-trash'></i></a>
                                            <a href="javascript:;"
                                                class="ms-4 text-primary bg-light-primary border-0"><i
                                                    class='bx bxs-edit'></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#88379</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="recent-product-img">
                                                <img src="assets/images/products/16.png" alt="">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-1 font-14">Grey Headphone</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>22 Jun, 2020</td>
                                    <td class=""><span
                                            class="badge bg-light-danger text-danger w-100">Cancelled</span>
                                    </td>
                                    <td>#149.25</td>
                                    <td>
                                        <div class="d-flex order-actions"> <a href="javascript:;"
                                                class="text-danger bg-light-danger border-0"><i
                                                    class='bx bxs-trash'></i></a>
                                            <a href="javascript:;"
                                                class="ms-4 text-primary bg-light-primary border-0"><i
                                                    class='bx bxs-edit'></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#68823</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="recent-product-img">
                                                <img src="assets/images/products/19.png" alt="">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-1 font-14">Grey Hand Watch</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>22 Jun, 2020</td>
                                    <td class=""><span
                                            class="badge bg-light-warning text-warning w-100">Pending</span>
                                    </td>
                                    <td>#149.25</td>
                                    <td>
                                        <div class="d-flex order-actions"> <a href="javascript:;"
                                                class="text-danger bg-light-danger border-0"><i
                                                    class='bx bxs-trash'></i></a>
                                            <a href="javascript:;"
                                                class="ms-4 text-primary bg-light-primary border-0"><i
                                                    class='bx bxs-edit'></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#54869</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="recent-product-img">
                                                <img src="assets/images/products/07.png" alt="">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-1 font-14">Brown Sofa</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>22 Jun, 2020</td>
                                    <td class=""><span
                                            class="badge bg-light-success text-success w-100">Completed</span>
                                    </td>
                                    <td>#149.25</td>
                                    <td>
                                        <div class="d-flex order-actions"> <a href="javascript:;"
                                                class="text-danger bg-light-danger border-0"><i
                                                    class='bx bxs-trash'></i></a>
                                            <a href="javascript:;"
                                                class="ms-4 text-primary bg-light-primary border-0"><i
                                                    class='bx bxs-edit'></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#22536</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="recent-product-img">
                                                <img src="assets/images/products/17.png" alt="">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-1 font-14">Black iPhone 11</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>22 Jun, 2020</td>
                                    <td class=""><span
                                            class="badge bg-light-success text-success w-100">Completed</span>
                                    </td>
                                    <td>#149.25</td>
                                    <td>
                                        <div class="d-flex order-actions"> <a href="javascript:;"
                                                class="text-danger bg-light-danger border-0"><i
                                                    class='bx bxs-trash'></i></a>
                                            <a href="javascript:;"
                                                class="ms-4 text-primary bg-light-primary border-0"><i
                                                    class='bx bxs-edit'></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#25796</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="recent-product-img">
                                                <img src="assets/images/products/14.png" alt="">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-1 font-14">Men Yellow T-Shirt</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>22 Jun, 2020</td>
                                    <td class=""><span
                                            class="badge bg-light-warning text-warning w-100">Pending</span>
                                    </td>
                                    <td>#149.25</td>
                                    <td>
                                        <div class="d-flex order-actions"> <a href="javascript:;"
                                                class="text-danger bg-light-danger border-0"><i
                                                    class='bx bxs-trash'></i></a>
                                            <a href="javascript:;"
                                                class="ms-4 text-primary bg-light-primary border-0"><i
                                                    class='bx bxs-edit'></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#98754</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="recent-product-img">
                                                <img src="assets/images/products/08.png" alt="">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-1 font-14">Grey Stand Table</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>22 Jun, 2020</td>
                                    <td class=""><span
                                            class="badge bg-light-danger text-danger w-100">Cancelled</span>
                                    </td>
                                    <td>#149.25</td>
                                    <td>
                                        <div class="d-flex order-actions"> <a href="javascript:;"
                                                class="text-danger bg-light-danger border-0"><i
                                                    class='bx bxs-trash'></i></a>
                                            <a href="javascript:;"
                                                class="ms-4 text-primary bg-light-primary border-0"><i
                                                    class='bx bxs-edit'></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--end row-->

</div>
