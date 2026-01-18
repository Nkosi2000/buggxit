<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Add SKU (unique for each product)
            $table->string('sku')->unique()->nullable()->after('category');
            
            // Add turnaround time in days
            $table->integer('turnaround_time')->default(5)->after('base_price');
            // Default 5 days, can be changed per product
            
            // Optional: Add index for faster SKU lookups
            $table->index('sku');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['sku', 'turnaround_time']);
        });
    }
};