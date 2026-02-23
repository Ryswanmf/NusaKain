<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::latest()->paginate(10);
        return view('admin.vouchers.index', compact('vouchers'));
    }

    public function create()
    {
        return view('admin.vouchers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:vouchers,code',
            'type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric|min:0',
            'min_order_amount' => 'required|numeric|min:0',
            'limit_per_user' => 'required|integer|min:1',
            'max_uses' => 'nullable|integer|min:1',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        Voucher::create($request->all());

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil dibuat.');
    }

    public function edit(Voucher $voucher)
    {
        return view('admin.vouchers.edit', compact('voucher'));
    }

    public function update(Request $request, Voucher $voucher)
    {
        $request->validate([
            'code' => 'required|unique:vouchers,code,' . $voucher->id,
            'type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric|min:0',
            'min_order_amount' => 'required|numeric|min:0',
            'limit_per_user' => 'required|integer|min:1',
            'max_uses' => 'nullable|integer|min:1',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $voucher->update($request->all());

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil diperbarui.');
    }

    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil dihapus.');
    }

    public function validateVoucher(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'total_amount' => 'required|numeric',
        ]);

        $voucher = Voucher::where('code', strtoupper($request->code))
            ->where('is_active', true)
            ->first();

        if (!$voucher) {
            return response()->json(['success' => false, 'message' => 'Kode voucher tidak valid.'], 404);
        }

        if (!$voucher->isValid($request->total_amount)) {
            $message = 'Voucher tidak dapat digunakan.';
            
            if ($request->total_amount < $voucher->min_order_amount) {
                $message = 'Minimal pembelian untuk voucher ini adalah Rp' . number_format($voucher->min_order_amount, 0, ',', '.');
            } elseif ($voucher->end_date && now()->gt($voucher->end_date)) {
                $message = 'Voucher sudah kedaluwarsa.';
            } elseif ($voucher->max_uses && $voucher->used_count >= $voucher->max_uses) {
                $message = 'Kuota voucher sudah habis.';
            }

            return response()->json(['success' => false, 'message' => $message], 422);
        }

        $discount = $voucher->calculateDiscount($request->total_amount);

        // Store voucher in session
        session(['applied_voucher' => $voucher->code]);

        return response()->json([
            'success' => true,
            'message' => 'Voucher berhasil digunakan!',
            'discount' => $discount,
            'new_total' => $request->total_amount - $discount
        ]);
    }
}
