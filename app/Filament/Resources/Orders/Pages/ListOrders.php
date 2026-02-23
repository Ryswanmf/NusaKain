<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Response;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('export_csv')
                ->label('Export CSV')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->action(function () {
                    $orders = \App\Models\Order::with('user')->latest()->get();
                    $csvFileName = 'laporan-pesanan-' . now()->format('Y-m-d-His') . '.csv';
                    
                    $headers = [
                        "Content-type"        => "text/csv",
                        "Content-Disposition" => "attachment; filename=$csvFileName",
                        "Pragma"              => "no-cache",
                        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                        "Expires"             => "0"
                    ];

                    $columns = ['Order Number', 'Date', 'Customer', 'Phone', 'Total Amount', 'Status', 'Payment Status'];

                    $callback = function() use($orders, $columns) {
                        $file = fopen('php://output', 'w');
                        fputcsv($file, $columns);

                        foreach ($orders as $order) {
                            fputcsv($file, [
                                $order->order_number,
                                $order->created_at->format('Y-m-d H:i:s'),
                                $order->user->name ?? $order->receiver_name,
                                $order->receiver_phone,
                                $order->total_amount,
                                $order->status,
                                $order->payment_status,
                            ]);
                        }

                        fclose($file);
                    };

                    return Response::stream($callback, 200, $headers);
                }),
        ];
    }
}
