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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->string('product_name');
            $table->string('product_slug');
            $table->string('product_code');
            $table->string('product_qty');
            $table->string('product_tags')->nullable();
            $table->string('product_size')->nullable();
            $table->string('product_color')->nullable();
            $table->string('selling_price');
            $table->string('discount_price')->nullable();
            $table->text('short_descp');
            $table->text('long_descp');
            $table->string('product_thambnail');
            $table->string('vendor_id')->nullable();
            $table->boolean('hot_deals')->nullable()->default(null);
            $table->boolean('featured')->nullable()->default(null);
            $table->boolean('special_offer')->nullable()->default(null);
            $table->boolean('special_deals')->nullable()->default(null);
            $table->integer('status')->default(0);
            $table->timestamps();
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