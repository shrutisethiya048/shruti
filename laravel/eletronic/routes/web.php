<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\EnquiryController;
/*
|--------------------------------------------------------------------------
| WEBSITE (FRONTEND) ROUTES
|--------------------------------------------------------------------------
*/
// Home
Route::get('/', fn () => view('website.index'))->name('home');

// Auth
Route::get('/login', [CustomerController::class, 'login'])->name('login');
Route::post('/login_auth',[CustomerController::class,'login_auth']);
// forget password
Route::get('/forgot-password', [CustomerController::class,'forgotPassword']);
Route::post('/forgot-password', [CustomerController::class,'sendResetLink']);
//otp 
Route::get('/otp-verification',[CustomerController::class,'otpPage']);
Route::post('/verify-otp',[CustomerController::class,'verifyOtp']);

Route::get('/reset-password',[CustomerController::class,'resetPassword']);
Route::post('/update-password',[CustomerController::class,'updatePassword']);

Route::get('/profile', [CustomerController::class, 'profile'])->name('profile');
Route::get('/profile/edit/{id}', [CustomerController::class, 'editProfile'])->name('profile.edit');
Route::post('/profile/update/{id}', [CustomerController::class, 'updateProfile'])->name('profile.update');

Route::get('/signup', [CustomerController::class, 'create']);
Route::post('/signup', [CustomerController::class, 'store']);

Route::get('/logout', [CustomerController::class, 'logout'])->name('logout');

// Website Pages
Route::get('/shop', fn () => view('website.shop'))->name('shop');
Route::get('/cart', fn () => view('website.cart'))->name('cart');
Route::get('/checkout', [OrderController::class,'checkout'])->name('checkout');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::get('/cart/remove/{id}', [CartController::class, 'removeItem'])->name('cart.remove');

// Website Contact Page
Route::get('/contact', fn () => view('website.contact'))->name('website.contact');

// Website Contact Form Submit
Route::post('/contact-submit', [ContactController::class, 'store'])
    ->name('website.contact.submit');

// Place Order (Website)
Route::post('/place-order',[OrderController::class,'store'])->name('place.order');
/*
|--------------------------------------------------------------------------
| ADMIN AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AdminController::class, 'index'])->name('admin.login.form');
Route::post('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');

Route::get('/admin/logout', function () {
    session()->forget('admin_id');
    return redirect('/admin/login');
})->name('admin.logout');


/*
|--------------------------------------------------------------------------
| ADMIN PROTECTED ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        if (!session()->has('admin_id')) {
            return redirect('/admin/login');
        }
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Categories
    Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::post('categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('categories/status/{id}', [CategoryController::class, 'changeStatus'])
        ->name('admin.categories.status');
    Route::get('categories/delete/{id}', [CategoryController::class, 'delete'])
        ->name('admin.categories.delete');

// List products
Route::get('products', [ProductController::class, 'index'])->name('product.index');
// Add product
Route::post('products', [ProductController::class, 'store'])->name('product.store');
// Edit product page
Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
// Update product
Route::put('products/{id}', [ProductController::class, 'update'])->name('product.update');
// Delete product
Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
// Toggle product status
Route::get('products/status/{id}', [ProductController::class, 'changeStatus'])->name('product.status');

    // Orders
    Route::get('orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::get('orders/status/{id}/{status}', [OrderController::class, 'changeStatus'])
        ->name('admin.orders.status');
    Route::delete('orders/{id}', [OrderController::class, 'destroy'])
        ->name('admin.orders.delete');
        Route::get('/order-success',function(){
    return view('website.order_success');
})->name('order.success');

    // Customers
    Route::get('customer', [CustomerController::class, 'index'])
        ->name('admin.customers');
     Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');
     Route::delete('customer/{id}', [CustomerController::class, 'destroy'])
        ->name('customer.destroy');
        Route::put('/customer/update/{id}', [CustomerController::class, 'update'])
     ->name('customer.update');


    // Admin Contact List
    Route::get('contact', [ContactController::class, 'index'])
        ->name('contact.index');
    Route::delete('contact/{id}', [ContactController::class, 'destroy'])
        ->name('contact.destroy');
//Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');
});
 Route::put('/contact/update/{id}', [ContactController::class, 'update'])
     ->name('contact.update');
Route::get('/enquiry', function () {
    return view('website.Enquiry');
});
Route::post('/enquiry',[EnquiryController::class,'store'])->name('enquiry.store');