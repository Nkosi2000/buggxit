<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dresses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku_prefix'); // SLMK, ZMBN, etc.
            $table->string('custom_sku')->nullable(); // For "Other" category
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->string('turnaround_time'); // e.g., "2-3 weeks"
            $table->string('expected_delivery'); // e.g., "To the nearest Courier"
            $table->string('status')->default('draft'); // draft, active, out_of_stock
            $table->boolean('is_featured')->default(false);
            $table->json('sizes')->nullable(); // Store array of sizes [32, 34, 36...]
            $table->json('colors')->nullable(); // Store array of colors
            $table->string('main_image_url')->nullable();
            $table->json('gallery_images')->nullable(); // Array of image URLs
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dresses');
    }
};