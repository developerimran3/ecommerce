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
        Schema::create('cart_items', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->id();

            $table->unsignedBigInteger('cart_id');
            $table->unsignedBigInteger('product_id');

            // Product Options
            $table->unsignedBigInteger('size_id')->nullable();
            $table->unsignedBigInteger('color_id')->nullable();

            $table->integer('qty')->default(1);

            $table->decimal('price');
            $table->decimal('subtotal');

            $table->timestamps();

            $table->foreign('cart_id')
                ->references('id')
                ->on('carts')
                ->onDelete('cascade');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');

            $table->foreign('size_id')
                ->references('id')
                ->on('sizes')
                ->onDelete('set null');

            $table->foreign('color_id')
                ->references('id')
                ->on('colors')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('cart_items');
    }
};
