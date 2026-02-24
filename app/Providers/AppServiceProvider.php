<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \App\Models\Product::observe(\App\Observers\ProductObserver::class);
        \App\Models\ProductVariant::observe(\App\Observers\ProductVariantObserver::class);
        
        // Cek apakah tabel sudah ada untuk mencegah error saat migrasi
        if (!app()->runningInConsole() || \Illuminate\Support\Facades\Schema::hasTable('landing_settings')) {
            $setting = \App\Models\LandingSetting::first();
            view()->share('setting', $setting);
        }

        // Data Notifikasi untuk Admin
        view()->composer('layouts.app', function ($view) {
            if (\Illuminate\Support\Facades\Schema::hasTable('contacts')) {
                $unreadContacts = \App\Models\Contact::where('is_read', false)->latest()->take(5)->get();
                $newOrders = \App\Models\Order::where('status', 'pending')->latest()->take(5)->get();
                $totalNotif = $unreadContacts->count() + $newOrders->count();
                
                $view->with([
                    'unreadContacts' => $unreadContacts,
                    'newOrders' => $newOrders,
                    'totalNotif' => $totalNotif
                ]);
            }
        });
    }
}
