<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $stats = [
            'total_orders' => Order::where('user_id', $user->id)->count(),
            'pending_payments' => Order::where('user_id', $user->id)->where('payment_status', 'unpaid')->count(),
            'wishlist_count' => Wishlist::where('user_id', $user->id)->count(),
            'total_reviews' => ProductReview::where('user_id', $user->id)->count(),
        ];

        $recentOrders = Order::where('user_id', $user->id)->latest()->take(5)->get();

        return view('landing_page.customer.dashboard', compact('stats', 'recentOrders'));
    }
}
