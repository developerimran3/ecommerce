<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('invoice_no')->unique();

            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->text('address');

            // Shipping Area
            $table->foreignId('shipping_area_id')
                ->nullable()
                ->constrained('shipping_areas')
                ->nullOnDelete();

            $table->decimal('subtotal', 12, 2);

            $table->decimal('shipping', 12, 2)
                ->default(0);

            $table->decimal('discount', 12, 2)
                ->default(0);

            $table->decimal('grand_total', 12, 2);

            $table->enum('payment_method', [
                'cod',
                'bkash',
                'nagad',
                'sslcommerz'
            ]);

            $table->enum('payment_status', [
                'pending',
                'paid',
                'failed'
            ])->default('pending');

            $table->enum('order_status', [
                'pending',
                'confirmed',
                'processing',
                'shipped',
                'delivered',
                'cancelled'
            ])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
