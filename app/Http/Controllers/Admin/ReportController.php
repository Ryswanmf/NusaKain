<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function exportExcel()
    {
        return Excel::download(new OrdersExport, 'Laporan_Penjualan_Nusakain_' . now()->format('d-m-Y') . '.xlsx');
    }

    public function exportPdf()
    {
        $orders = Order::with(['items.product', 'user'])->latest()->get();
        
        $stats = [
            'total_orders' => $orders->count(),
            'total_revenue' => $orders->where('payment_status', 'paid')->sum('total_amount'),
            'total_items' => $orders->sum(function($order) {
                return $order->items->sum('quantity');
            })
        ];

        $pdf = Pdf::loadView('admin.reports.orders_pdf', compact('orders', 'stats'));
        
        return $pdf->download('Laporan_Penjualan_Nusakain_' . now()->format('d-m-Y') . '.pdf');
    }
}
