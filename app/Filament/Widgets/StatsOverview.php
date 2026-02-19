<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\Portfolio;
use App\Models\Post;
use App\Models\Contact;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Produk', Product::count())
                ->description('Produk kain aktif')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('teal'),
            Stat::make('Total Portofolio', Portfolio::count())
                ->description('Proyek kolaborasi')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('cyan'),
            Stat::make('Artikel Blog', Post::count())
                ->description('Inspirasi fashion')
                ->descriptionIcon('heroicon-m-pencil-square')
                ->color('indigo'),
            Stat::make('Pesan Masuk', Contact::where('is_read', false)->count())
                ->description('Belum dibaca')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('amber'),
        ];
    }
}
