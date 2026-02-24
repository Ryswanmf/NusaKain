<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
            
        return view('landing_page.wishlist', compact('wishlistItems'));
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'notify_stock' => 'nullable|boolean'
        ]);

        $wishlist = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($wishlist) {
            // If user specifically asked for notify_stock, update it instead of removing
            if ($request->has('notify_stock')) {
                $wishlist->update(['notify_stock' => $request->notify_stock]);
                $msg = $request->notify_stock ? 'Kami akan menginfokan saat stok tersedia.' : 'Notifikasi stok dibatalkan.';
                return response()->json(['status' => 'updated', 'message' => $msg]);
            }
            
            $wishlist->delete();
            return response()->json(['status' => 'removed', 'message' => 'Produk dihapus dari simpanan.']);
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'notify_stock' => $request->notify_stock ?? false,
            ]);
            
            $msg = ($request->notify_stock ?? false) 
                ? 'Berhasil! Kami akan menginfokan saat stok tersedia.' 
                : 'Produk berhasil disimpan.';
                
            return response()->json(['status' => 'added', 'message' => $msg]);
        }
    }

    public function destroy(Wishlist $wishlist)
    {
        if ($wishlist->user_id !== Auth::id()) {
            abort(403);
        }

        $wishlist->delete();

        return redirect()->back()->with('success', 'Produk dihapus dari daftar simpanan.');
    }
}
