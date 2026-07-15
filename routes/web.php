<?php



use App\Livewire\Admin\Brand\Index as BrandIndex;
use App\Livewire\Admin\Category\Index as CategoryIndex;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Order\Index as OrderIndex;
use App\Livewire\Admin\Product\Index as ProductIndex;
use App\Livewire\Admin\User\Index as UserIndex;
use App\Livewire\Admin\Profile;


use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;


use App\Livewire\Frontend\CartPage;
use App\Livewire\Frontend\CheckoutPage;
use App\Livewire\Frontend\Home;
use App\Livewire\Frontend\InvoicePage;
use App\Livewire\Frontend\MyOrders;
use App\Livewire\Frontend\OrderSuccess;
use App\Livewire\Frontend\ProductDetails;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;





Route::get('/', function () {
    return view('welcome');
});




Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get(
            '/dashboard',
            Dashboard::class
        )->name('admin.dashboard');
    });




Route::middleware('auth')->group(function () {

    Route::get('/profile', Profile::class)
        ->name('profile');
});



Route::middleware('guest')->group(function () {

    Route::get('/login', Login::class)
        ->name('login');

    Route::get('/register', Register::class)
        ->name('register');
});

Route::get('/logout', function () {

    Auth::logout();

    request()->session()->invalidate();

    request()->session()->regenerateToken();

    return redirect('/login');
})->name('logout');







Route::prefix('admin')->group(function () {

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

    Route::get('/users', UserIndex::class)
        ->name('admin.users');
});




Route::get('/', Home::class)->name('home');

Route::get('/product/{slug}', ProductDetails::class)
    ->name('product.details');

Route::get('/cart', CartPage::class)
    ->name('cart');

Route::get('/checkout', CheckoutPage::class)
    ->name('checkout');

Route::get('/my-orders', MyOrders::class)
    ->name('my.orders');


Route::get('/invoice/{order}', InvoicePage::class)
    ->name('invoice');



Route::get('/order-success/{order}', OrderSuccess::class)
    ->name('order.success');
