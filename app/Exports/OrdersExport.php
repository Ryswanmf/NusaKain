<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection, WithHeadings, WithMapping
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $query = Order::with(['items', 'user'])->latest();

        if ($this->startDate) {
            $query->whereDate('created_at', '>=', $this->startDate);
        }
        if ($this->endDate) {
            $query->whereDate('created_at', '<=', $this->endDate);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'No. Pesanan',
            'Tanggal',
            'Pelanggan',
            'Telepon',
            'Status Pesanan',
            'Status Pembayaran',
            'Subtotal (Rp)',
            'Diskon (Rp)',
            'Ongkir (Rp)',
            'Total (Rp)',
            'Item Terjual',
        ];
    }

    public function map($order): array
    {
        $items = $order->items->map(function ($item) {
            $name = $item->product->name;
            if ($item->variant) $name .= " (" . $item->variant->name . ")";
            return $name . " x " . (float)$item->quantity;
        })->implode(', ');

        return [
            $order->order_number,
            $order->created_at->format('d/m/Y H:i'),
            $order->user->name ?? $order->receiver_name,
            $order->receiver_phone,
            strtoupper($order->status),
            strtoupper($order->payment_status),
            $order->total_amount - $order->shipping_cost + $order->discount_amount,
            $order->discount_amount,
            $order->shipping_cost,
            $order->total_amount,
            $items
        ];
    }
}
