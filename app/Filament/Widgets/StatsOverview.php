<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\Contact;
use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Pendapatan', 'Rp ' . number_format(Order::where('status', 'completed')->sum('total_amount'), 0, ',', '.'))
                ->description('Dari pesanan selesai')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
            Stat::make('Pesanan Baru', Order::where('status', 'pending')->count())
                ->description('Perlu diproses')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('warning'),
            Stat::make('Total Produk', Product::count())
                ->description('Produk kain aktif')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('teal'),
            Stat::make('Pesan Masuk', Contact::where('is_read', false)->count())
                ->description('Belum dibaca')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('amber'),
        ];
    }
}
