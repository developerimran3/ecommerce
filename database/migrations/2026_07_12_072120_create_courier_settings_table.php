<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courier_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('courier');
            $table->string('courier_name');
            $table->string('base_url')->nullable();
            $table->string('api_url')->nullable();
            $table->string('api_key')->nullable();
            $table->text('secret_key')->nullable();
            $table->string('username')->nullable();
            $table->text('password')->nullable();
            $table->string('account_id')->nullable();
            $table->string('store_id')->nullable();
            $table->boolean('sandbox')->default(false);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courier_settings');
    }
};
