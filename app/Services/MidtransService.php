<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');
    }

    public function getSnapToken($order)
    {
        $itemDetails = $this->prepareItemDetails($order);
        $totalFromItems = array_sum(array_column($itemDetails, 'price'));

        $params = [
            'transaction_details' => [
                'order_id' => $order->order_number,
                'gross_amount' => $totalFromItems,
            ],
            'customer_details' => [
                'first_name' => $order->user->name,
                'email' => $order->user->email,
                'phone' => $order->user->phone ?? $order->receiver_phone,
            ],
            'item_details' => $itemDetails,
        ];

        return Snap::getSnapToken($params);
    }

    public function status($orderId)
    {
        try {
            return \Midtrans\Transaction::status($orderId);
        } catch (\Exception $e) {
            return null;
        }
    }

    protected function prepareItemDetails($order)
    {
        $items = [];
        foreach ($order->items as $item) {
            $subtotal = (int) ($item->unit_price * $item->quantity);
            $items[] = [
                'id' => $item->product_id . ($item->product_variant_id ? '-' . $item->product_variant_id : ''),
                'price' => $subtotal,
                'quantity' => 1,
                'name' => \Illuminate\Support\Str::limit($item->product->name . ' (' . (float)$item->quantity . 'm)', 50),
            ];
        }

        // Add shipping cost if exists
        if ($order->shipping_cost > 0) {
            $items[] = [
                'id' => 'shipping',
                'price' => (int) $order->shipping_cost,
                'quantity' => 1,
                'name' => 'Biaya Pengiriman',
            ];
        }

        return $items;
    }
}
