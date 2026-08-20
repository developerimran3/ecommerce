<?php

use App\Http\Controllers\InvoiceController;
use App\Livewire\Admin\Brand\Index as BrandIndex;
use App\Livewire\Admin\Category\Index as CategoryIndex;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Media\Index as MediaIndex;
use App\Livewire\Admin\Order\Index as OrderIndex;
use App\Livewire\Admin\Product\Index as ProductIndex;
use App\Livewire\Admin\Profile;
use App\Livewire\Admin\RolePermission;
use App\Livewire\Admin\Shipping\ShippingAreaIndex;
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




Route::get('/admin/login', AdminLogin::class)
    ->name('admin.login');

Route::get('/admin/register', AdminRegister::class)
    ->name('admin.register');

Route::get('/admin/forgot-password', AdminForgotPassword::class)
    ->name('admin.forgot.password');

Route::get('/admin/reset-password/{token}', AdminResetPassword::class)
    ->name('admin.reset.password');



Route::middleware(['auth'])->group(function () {

    Route::get('/admin/role-permission', RolePermission::class)
        ->name('admin.role-permission');
});

Route::prefix('admin')->middleware(['auth', 'user.status', 'role:Administrator,Shop Manager,Editor,Contributor'])->group(function () {

    Route::get('users/profile', Profile::class)
        ->name('users.profile');

    Route::get('/dashboard', Dashboard::class)
        ->name('admin.dashboard');

    Route::get('/categories', CategoryIndex::class)
        ->name('admin.categories');

    Route::get('/brands', BrandIndex::class)
        ->name('admin.brands');

    Route::get('/products', ProductIndex::class)
        ->name('admin.products');

    Route::get('/orders', OrderIndex::class)
        ->name('admin.orders');

    Route::get('/orders/pending', OrderIndex::class)
        ->name('admin.orders.pending');

    Route::get('/orders/cancelled', OrderIndex::class)
        ->name('admin.orders.cancelled');

    Route::get('/orders/completed', OrderIndex::class)
        ->name('admin.orders.completed');



    Route::get('/shipping-areas', ShippingAreaIndex::class)
        ->name('admin.shipping');

    // Route::get('/shipping-areas', ShippingAreaIndex::class)
    //     ->name('admin.coupon');

    Route::get('/invoice/download/{id}', [InvoiceController::class, 'download'])
        ->name('admin.invoice.download');

    Route::get('/users', UserIndex::class)
        ->name('admin.users');

    Route::get('/reviews', UserIndex::class)
        ->name('admin.reviews');

    Route::get('/media', MediaIndex::class)
        ->name('admin.media');

    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/admin/login');
    })->name('admin.logout');
});



Route::get('/customer/login', CustomerLogin::class)
    ->name('customer.login');

Route::get('/customer/register', CustomerRegister::class)
    ->name('customer.register');

Route::get('/customer/forgot-password', CustomerForgotPassword::class)
    ->name('customer.forgot.password');

Route::get('/customer/reset-password/{token}', CustomerResetPassword::class)
    ->name('customer.reset.password');


Route::middleware(['user.status'])->group(function () {

    Route::get('/', Home::class)->name('home');

    Route::get('/product/{slug}', ProductDetails::class)
        ->name('product.details');

    Route::get('/checkout', CheckoutPage::class)
        ->name('checkout');

    Route::get('/order-success/{order}', OrderSuccess::class)
        ->name('order.success');

    Route::get('/order-track', OrderTrack::class)
        ->name('order.track');
});




Route::prefix('customer')->middleware(['auth', 'user.status', 'role:Customer'])->group(function () {

    Route::get('/invoice/download/{id}', [InvoiceController::class, 'download'])
        ->name('customer.invoice.download');

    Route::get('/my-account', MyAccount::class)
        ->name('account');

    Route::get('/my-orders', MyOrders::class)
        ->name('my.orders');

    Route::get('/profile', CustomerProfile::class)
        ->name('customer.profile');

    Route::get('/change-password', PasswordChange::class)
        ->name('customer.password');



    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('customer.logout');
});
