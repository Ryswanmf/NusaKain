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
        Schema::table('landing_settings', function (Blueprint $table) {
            $table->string('site_name')->default('Nusakain')->after('id');
            $table->string('footer_slogan_1')->default('Quality Excellence')->after('contact_facebook');
            $table->string('footer_slogan_2')->default('Sustainable Growth')->after('footer_slogan_1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('landing_settings', function (Blueprint $table) {
            $table->dropColumn(['site_name', 'footer_slogan_1', 'footer_slogan_2']);
        });
    }
};
