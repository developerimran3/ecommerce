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
        Schema::create('order_items', function (Blueprint $table) {

            $table->id();

            // Order
            $table->foreignId('order_id')
                ->constrained()
                ->cascadeOnDelete();

            // Product
            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnDelete();

            // Product Size
            $table->foreignId('size_id')
                ->nullable()
                ->constrained('sizes')
                ->nullOnDelete();

            // Product Color
            $table->foreignId('color_id')
                ->nullable()
                ->constrained('colors')
                ->nullOnDelete();

            // Quantity
            $table->integer('qty');

            // Price
            $table->decimal('price');

            // Subtotal
            $table->decimal('subtotal');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
