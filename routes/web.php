<?php

use App\Http\Controllers\InvoiceController;
use App\Livewire\Admin\Brand\Index as BrandIndex;
use App\Livewire\Admin\Category\Index as CategoryIndex;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Media\Index as MediaIndex;
use App\Livewire\Admin\Order\Index as OrderIndex;

use App\Livewire\Admin\Product\Index as ProductIndex;
use App\Livewire\Admin\Profile;
use App\Livewire\Admin\User\Index as UserIndex;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;


use App\Livewire\Frontend\ChangePassword;
use App\Livewire\Frontend\CheckoutPage;
use App\Livewire\Frontend\Home;

use App\Livewire\Frontend\MyAccount;
use App\Livewire\Frontend\MyOrders;
use App\Livewire\Frontend\OrderSuccess;
use App\Livewire\Frontend\OrderTrack;
use App\Livewire\Frontend\ProductDetails;
use App\Livewire\Frontend\Profile as CustomerProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', Home::class)->name('home');


Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)
        ->name('login');

    Route::get('/register', Register::class)
        ->name('register');
});


Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');




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

    Route::get('/invoice/download/{id}', [InvoiceController::class, 'download'])
        ->name('admin.invoice.download');

    Route::get('/users', UserIndex::class)
        ->name('admin.users');

    Route::get('/reviews', UserIndex::class)
        ->name('admin.reviews');

    Route::get('/media', MediaIndex::class)
        ->name('admin.media');
});


Route::get('/product/{slug}', ProductDetails::class)
    ->name('product.details');

Route::get('/checkout', CheckoutPage::class)
    ->name('checkout');

Route::get('/my-orders', MyOrders::class)
    ->name('my.orders');

Route::get('/order-success/{order}', OrderSuccess::class)
    ->name('order.success');

Route::get('/order-track', OrderTrack::class)
    ->name('order.track');



Route::prefix('customer')->middleware(['auth', 'user.status', 'role:Customer'])->group(function () {

    Route::get('/invoice/download/{id}', [InvoiceController::class, 'download'])
        ->name('customer.invoice.download');

    Route::get('/my-account', MyAccount::class)
        ->name('account');

    Route::get('/profile', CustomerProfile::class)
        ->name('customer.profile');

    Route::get('/change-password', ChangePassword::class)
        ->name('customer.password');
});
