<?php

use App\Http\Controllers\InvoiceController;
use App\Livewire\Admin\Brand\Index as BrandIndex;
use App\Livewire\Admin\Category\Index as CategoryIndex;
use App\Livewire\Admin\Coupon\Index as CouponIndex;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Media\Index as MediaIndex;
use App\Livewire\Admin\Order\Index as OrderIndex;
use App\Livewire\Admin\Payment\Index as PaymentIndex;
use App\Livewire\Admin\Product\Index as ProductIndex;
use App\Livewire\Admin\Profile\Index as ProfileIndex;
use App\Livewire\Admin\RolePermission\Index as Permission;
use App\Livewire\Admin\Shipping\ShippingAreaIndex;
use App\Livewire\Admin\User\CustomerManage;
use App\Livewire\Admin\User\CustomerView;
use App\Livewire\Admin\User\Index as UserIndex;
use App\Livewire\Auth\Admin\ForgotPassword as AdminForgotPassword;
use App\Livewire\Auth\Admin\Login as AdminLogin;
use App\Livewire\Auth\Admin\Register as AdminRegister;
use App\Livewire\Auth\Admin\ResetPassword as AdminResetPassword;
use App\Livewire\Auth\Customer\ForgotPassword as CustomerForgotPassword;
use App\Livewire\Auth\Customer\Login as CustomerLogin;
use App\Livewire\Auth\Customer\Register as CustomerRegister;
use App\Livewire\Auth\Customer\ResetPassword as CustomerResetPassword;
use App\Livewire\Customer\Account as MyAccount;
use App\Livewire\Customer\Order as MyOrders;
use App\Livewire\Customer\PasswordChange;
use App\Livewire\Customer\Profile as CustomerProfile;
use App\Livewire\Frontend\CheckoutPage;
use App\Livewire\Frontend\Home;
use App\Livewire\Frontend\OrderSuccess;
use App\Livewire\Frontend\OrderTrack;
use App\Livewire\Frontend\ProductDetails;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


//PUBLIC ROUTE
Route::get('/', Home::class)->name('home');
Route::get('/product/{slug}', ProductDetails::class)
    ->name('product.details');

Route::get('/checkout', CheckoutPage::class)
    ->name('checkout');

Route::get('/order-track', OrderTrack::class)
    ->name('order.track');

Route::middleware('guest')->group(function () {
    //ADMIN GUEST ROUTES
    Route::get('/admin/login', AdminLogin::class)
        ->name('admin.login');

    Route::get('/admin/register', AdminRegister::class)
        ->name('admin.register');

    Route::get('/admin/forgot-password', AdminForgotPassword::class)
        ->name('admin.forgot.password');

    Route::get('/admin/reset-password/{token}', AdminResetPassword::class)
        ->name('admin.reset.password');

    //CUSTOMER GUEST ROUTES
    Route::get('/customer/login', CustomerLogin::class)
        ->name('customer.login');

    Route::get('/customer/register', CustomerRegister::class)
        ->name('customer.register');

    Route::get('/customer/forgot-password', CustomerForgotPassword::class)
        ->name('customer.forgot.password');

    Route::get('/customer/reset-password/{token}', CustomerResetPassword::class)
        ->name('customer.reset.password');
});


/*
|--------------------------------------------------------------------------
| CUSTOMER PROTECTED ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('customer')->middleware(['auth', 'active', 'customer',])->group(function () {

    Route::get('/my-account', MyAccount::class)
        ->name('account');

    Route::get('/my-orders', MyOrders::class)
        ->name('my.orders');

    Route::get('/profile', CustomerProfile::class)
        ->name('customer.profile');

    Route::get('/change-password', PasswordChange::class)
        ->name('customer.password');

    Route::get('/invoice/download/{id}', [InvoiceController::class, 'download'])
        ->name('customer.invoice.download');

    Route::get('/order-success/{order}', OrderSuccess::class)
        ->name('order.success');

    Route::get('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('home');
    })->name('customer.logout');
});


/*
|--------------------------------------------------------------------------
| ADMIN PROTECTED ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth', 'active', 'admin',])->group(function () {

    Route::get('/dashboard', Dashboard::class)
        ->name('admin.dashboard');

    Route::get('users/profile', ProfileIndex::class)
        ->name('users.profile');

    Route::get('/categories', CategoryIndex::class)
        ->middleware('permission:categories.view')
        ->name('admin.categories');

    Route::get('/brands', BrandIndex::class)
        ->middleware('permission:brands.view')
        ->name('admin.brands');

    Route::get('/products', ProductIndex::class)
        ->middleware('permission:products.view')
        ->name('admin.products');

    Route::get('/orders', OrderIndex::class)
        ->middleware('permission:orders.view')
        ->name('admin.orders');

    Route::get('/orders/pending', OrderIndex::class)
        ->middleware('permission:orders.view')
        ->name('admin.orders.pending');

    Route::get('/orders/cancelled', OrderIndex::class)
        ->middleware('permission:orders.view')
        ->name('admin.orders.cancelled');

    Route::get('/orders/completed', OrderIndex::class)
        ->middleware('permission:orders.view')
        ->name('admin.orders.completed');

    Route::get('/shipping-areas', ShippingAreaIndex::class)
        ->middleware('permission:shipping.view')
        ->name('admin.shipping');

    Route::get('/invoice/download/{id}', [InvoiceController::class, 'download'])
        ->middleware('permission:invoices.view')
        ->name('admin.invoice.download');

    Route::get('/users', UserIndex::class)
        ->middleware('permission:users.view')
        ->name('admin.users');

    Route::get('/reviews', UserIndex::class)
        ->middleware('permission:reviews.view')
        ->name('admin.reviews');

    Route::get('/media', MediaIndex::class)
        ->middleware('permission:media.view')
        ->name('admin.media');

    Route::get('/role-permissions', Permission::class)
        ->middleware('role:Administrator')
        ->name('admin.role-permissions');

    Route::get('/coupon', CouponIndex::class)
        ->middleware('permission:coupons.view')
        ->name('admin.coupon');

    Route::get('/payments', PaymentIndex::class)
        ->middleware('permission:payments.view')
        ->name('admin.payment');

    Route::get('/customers/manage', CustomerManage::class)
        ->middleware('permission:customers.view')
        ->name('admin.customers.manage');

    Route::get('/customer/profile/{id}', CustomerView::class)
        ->middleware('permission:customers.view')
        ->name('admin.customer.view');




    Route::get('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('admin.login');
    })->name('admin.logout');
});
