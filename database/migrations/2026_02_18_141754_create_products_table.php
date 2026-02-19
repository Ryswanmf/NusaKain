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
        Schema::create('products', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('name');
            $blueprint->string('slug')->unique();
            $blueprint->text('description')->nullable();
            $blueprint->decimal('price', 15, 2);
            $blueprint->integer('stock')->default(0);
            $blueprint->string('image')->nullable();
            $blueprint->string('category')->nullable(); // e.g., Katun, Linen, Denim
            $blueprint->boolean('is_active')->default(true);
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
