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
    public function exportExcel(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        return Excel::download(
            new OrdersExport($startDate, $endDate), 
            'Laporan_Penjualan_Nusakain_' . now()->format('d-m-Y') . '.xlsx'
        );
    }

    public function exportPdf(Request $request)
    {
        $query = Order::with(['items.product', 'user'])->latest();

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $orders = $query->get();
        
        $stats = [
            'total_orders' => $orders->count(),
            'total_revenue' => $orders->where('payment_status', 'paid')->sum('total_amount'),
            'total_items' => $orders->sum(function($order) {
                return $order->items->sum('quantity');
            }),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ];

        $pdf = Pdf::loadView('admin.reports.orders_pdf', compact('orders', 'stats'));
        
        return $pdf->download('Laporan_Penjualan_Nusakain_' . now()->format('d-m-Y') . '.pdf');
    }
}
