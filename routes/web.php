<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TeamMemberController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $setting = \App\Models\LandingSetting::first();
    $testimonials = \App\Models\Testimonial::all();
    $partners = \App\Models\Partner::where('is_active', true)->orderBy('order')->get();
    $featuredProducts = \App\Models\Product::where('is_active', true)->latest()->take(4)->get();
    return view('index', compact('setting', 'testimonials', 'partners', 'featuredProducts'));
});

Route::get('/produk', [ProductController::class, 'index'])->name('produk.index');
Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('produk.show');

Route::get('/portofolio', [PortfolioController::class, 'index'])->name('portofolio.index');
Route::get('/portofolio/{slug}', [PortfolioController::class, 'show'])->name('portofolio.show');

Route::get('/blog', [PostController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('blog.show');

Route::get('/kontak', [ContactController::class, 'index'])->name('kontak.index');
Route::post('/kontak', [ContactController::class, 'store'])->name('kontak.store');

Route::get('/tentang-kami', [TeamMemberController::class, 'index'])->name('tentang.index');

Route::get('/faq', function() {
    $faqs = \App\Models\Faq::where('is_active', true)->orderBy('order')->get();
    return view('landing_page.faqs.index', compact('faqs'));
})->name('faqs.index');

Route::get('/p/{slug}', function($slug) {
    $page = \App\Models\Page::where('slug', $slug)->firstOrFail();
    return view('landing_page.show', compact('page'));
})->name('pages.show');

Route::post('/midtrans/callback', [\App\Http\Controllers\CartController::class, 'callback'])->name('midtrans.callback');

Route::get('/dashboard', function () {
    $stats = [
        'total_orders' => \App\Models\Order::count(),
        'total_revenue' => \App\Models\Order::where('payment_status', 'paid')->sum('total_amount'),
        'total_customers' => \App\Models\User::where('role', 'user')->count(),
        'low_stock' => \App\Models\Product::where('stock', '<', 5)->count(),
    ];

    $recentOrders = \App\Models\Order::with('user')->latest()->take(5)->get();
    
    // Simple Chart Data (Last 7 Days)
    $chartData = [];
    for ($i = 6; $i >= 0; $i--) {
        $date = now()->subDays($i)->format('Y-m-d');
        $chartData['labels'][] = now()->subDays($i)->format('D');
        $chartData['orders'][] = \App\Models\Order::whereDate('created_at', $date)->count();
    }

    $categoryDistribution = \App\Models\Product::select('category', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
        ->groupBy('category')
        ->get();

    return view('dashboard', compact('stats', 'recentOrders', 'chartData', 'categoryDistribution'));
})->middleware(['auth', 'verified', 'admin'])->name('dashboard');

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('produk', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('portofolio', \App\Http\Controllers\Admin\PortfolioController::class);
    Route::resource('blog', \App\Http\Controllers\Admin\PostController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('kontak', \App\Http\Controllers\Admin\ContactController::class)->only(['index', 'show', 'destroy']);
    Route::resource('tentang-kami', \App\Http\Controllers\Admin\TeamMemberController::class);
    Route::resource('pesanan', \App\Http\Controllers\Admin\OrderController::class)->only(['index', 'show', 'destroy']);
    Route::patch('pesanan/{pesanan}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('pesanan.update-status');
    Route::patch('kontak/{kontak}/toggle-read', [\App\Http\Controllers\Admin\ContactController::class, 'toggleRead'])->name('kontak.toggle-read');

    // Landing Page Management
    Route::prefix('landing')->name('landing.')->group(function () {
        Route::get('/hero', [\App\Http\Controllers\Admin\LandingSettingController::class, 'index'])->name('hero');
        Route::patch('/hero', [\App\Http\Controllers\Admin\LandingSettingController::class, 'update'])->name('hero.update');
        Route::resource('testimonials', \App\Http\Controllers\Admin\TestimonialController::class);
        Route::resource('partners', \App\Http\Controllers\Admin\PartnerController::class);
        Route::resource('pages', \App\Http\Controllers\Admin\PageController::class)->only(['index', 'edit', 'update']);
        Route::resource('faqs', \App\Http\Controllers\Admin\FaqController::class);
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart Routes
    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [\App\Http\Controllers\CartController::class, 'store'])->name('cart.store');
    Route::patch('/cart/{cartItem}', [\App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cartItem}', [\App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('/checkout', [\App\Http\Controllers\CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/checkout', [\App\Http\Controllers\CartController::class, 'processCheckout'])->name('cart.processCheckout');

    // Shipping AJAX Routes (Removed)

    // Wishlist Routes
    Route::get('/wishlist', [\App\Http\Controllers\WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle', [\App\Http\Controllers\WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::delete('/wishlist/{wishlist}', [\App\Http\Controllers\WishlistController::class, 'destroy'])->name('wishlist.destroy');

    // Customer Order Routes
    Route::get('/my-orders', [\App\Http\Controllers\CartController::class, 'orders'])->name('customer.orders');
    Route::get('/my-orders/{order_number}', [\App\Http\Controllers\CartController::class, 'showOrder'])->name('customer.orders.show');
    Route::get('/my-orders/{order_number}/invoice', [\App\Http\Controllers\CartController::class, 'downloadInvoice'])->name('customer.orders.invoice');
});

require __DIR__.'/auth.php';
