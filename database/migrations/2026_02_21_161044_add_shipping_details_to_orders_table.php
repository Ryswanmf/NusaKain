<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('receiver_name')->nullable()->after('total_amount');
            $table->string('receiver_phone')->nullable()->after('receiver_name');
            $table->string('province_id')->nullable()->after('receiver_phone');
            $table->string('city_id')->nullable()->after('province_id');
            $table->text('address_detail')->nullable()->after('city_id');
            $table->string('postal_code')->nullable()->after('address_detail');
            $table->integer('total_weight')->default(0)->after('postal_code');
            $table->decimal('shipping_cost', 15, 2)->default(0)->after('total_weight');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'receiver_name', 
                'receiver_phone', 
                'province_id', 
                'city_id', 
                'address_detail', 
                'postal_code', 
                'total_weight', 
                'shipping_cost'
            ]);
        });
    }
};
