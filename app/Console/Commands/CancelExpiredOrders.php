<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;

class CancelExpiredOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:cancel-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Batalkan pesanan yang belum dibayar lebih dari 24 jam';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredTime = now()->subHours(24);

        $orders = Order::whereIn('payment_status', ['unpaid', 'pending'])
            ->where('status', 'pending')
            ->where('created_at', '<=', $expiredTime)
            ->get();

        $count = $orders->count();

        foreach ($orders as $order) {
            $order->update([
                'status' => 'cancelled',
                'payment_status' => 'expired',
                'notes' => ($order->notes ? $order->notes . "\n" : "") . "Otomatis dibatalkan oleh sistem karena melebihi batas waktu pembayaran."
            ]);
        }

        $this->info("Berhasil membatalkan {$count} pesanan yang kedaluwarsa.");
    }
}
