<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('module');
            $table->string('action');
            $table->timestamps();
            $table->index(['module', 'action']);
        });

        $permissions = [

            // categories
            ['name' => 'categories.view',   'module' => 'categories', 'action' => 'view'],
            ['name' => 'categories.create', 'module' => 'categories', 'action' => 'create'],
            ['name' => 'categories.edit',   'module' => 'categories', 'action' => 'edit'],
            ['name' => 'categories.delete', 'module' => 'categories', 'action' => 'delete'],
            ['name' => 'categories.status', 'module' => 'categories', 'action' => 'status'],

            // Brand
            ['name' => 'brands.view',   'module' => 'brands', 'action' => 'view'],
            ['name' => 'brands.create', 'module' => 'brands', 'action' => 'create'],
            ['name' => 'brands.edit',   'module' => 'brands', 'action' => 'edit'],
            ['name' => 'brands.delete', 'module' => 'brands', 'action' => 'delete'],
            ['name' => 'brands.status', 'module' => 'brands', 'action' => 'status'],

            // products
            ['name' => 'products.view',   'module' => 'products',   'action' => 'view'],
            ['name' => 'products.create', 'module' => 'products',   'action' => 'create'],
            ['name' => 'products.edit',   'module' => 'products',   'action' => 'edit'],
            ['name' => 'products.delete', 'module' => 'products',   'action' => 'delete'],

            // tags
            ['name' => 'tags.view',   'module' => 'tags', 'action' => 'view'],
            ['name' => 'tags.create', 'module' => 'tags', 'action' => 'create'],
            ['name' => 'tags.edit',   'module' => 'tags', 'action' => 'edit'],
            ['name' => 'tags.delete', 'module' => 'tags', 'action' => 'delete'],
            ['name' => 'tags.status', 'module' => 'tags', 'action' => 'status'],

            // orders
            ['name' => 'orders.create',   'module' => 'orders', 'action' => 'create'],
            ['name' => 'orders.view',     'module' => 'orders', 'action' => 'view'],
            ['name' => 'orders.edit',     'module' => 'orders', 'action' => 'edit'],
            ['name' => 'orders.delete',   'module' => 'orders', 'action' => 'delete'],
            ['name' => 'orders.status',   'module' => 'orders', 'action' => 'status'],

            // Shipping
            ['name' => 'shipping.view',   'module' => 'shipping', 'action' => 'view'],
            ['name' => 'shipping.create', 'module' => 'shipping', 'action' => 'create'],
            ['name' => 'shipping.edit',   'module' => 'shipping', 'action' => 'edit'],
            ['name' => 'shipping.delete', 'module' => 'shipping', 'action' => 'delete'],
            ['name' => 'shipping.status', 'module' => 'shipping', 'action' => 'status'],

            // User
            ['name' => 'user.view',   'module' => 'user', 'action' => 'view'],
            ['name' => 'user.create', 'module' => 'user', 'action' => 'create'],
            ['name' => 'user.edit',   'module' => 'user', 'action' => 'edit'],
            ['name' => 'user.delete', 'module' => 'user', 'action' => 'delete'],
            ['name' => 'user.status', 'module' => 'user', 'action' => 'status'],

            // Coupons
            ['name' => 'coupons.view',   'module' => 'coupons', 'action' => 'view'],
            ['name' => 'coupons.create', 'module' => 'coupons', 'action' => 'create'],
            ['name' => 'coupons.edit',   'module' => 'coupons', 'action' => 'edit'],
            ['name' => 'coupons.delete', 'module' => 'coupons', 'action' => 'delete'],
            ['name' => 'coupons.status', 'module' => 'coupons', 'action' => 'status'],

            // Payments
            ['name' => 'payments.view',   'module' => 'payments', 'action' => 'view'],
            ['name' => 'payments.create', 'module' => 'payments', 'action' => 'create'],
            ['name' => 'payments.edit',   'module' => 'payments', 'action' => 'edit'],
            ['name' => 'payments.delete', 'module' => 'payments', 'action' => 'delete'],
            ['name' => 'payments.status', 'module' => 'payments', 'action' => 'status'],

            // reviews
            ['name' => 'reviews.view',   'module' => 'reviews', 'action' => 'view'],
            ['name' => 'reviews.create', 'module' => 'reviews', 'action' => 'create'],
            ['name' => 'reviews.edit',   'module' => 'reviews', 'action' => 'edit'],
            ['name' => 'reviews.delete', 'module' => 'reviews', 'action' => 'delete'],
            ['name' => 'reviews.status', 'module' => 'reviews', 'action' => 'status'],

            // Media
            ['name' => 'media.view',   'module' => 'media', 'action' => 'view'],
            ['name' => 'media.create', 'module' => 'media', 'action' => 'create'],
            ['name' => 'media.edit',   'module' => 'media', 'action' => 'edit'],
            ['name' => 'media.delete', 'module' => 'media', 'action' => 'delete'],

            // site Setting
            ['name' => 'setting.view',    'module' => 'setting', 'action' => 'view'],

            //Invoice
            ['name' => 'invoices.view',    'module' => 'invoices', 'action' => 'view'],
            ['name' => 'invoices.download', 'module' => 'invoices', 'action' => 'download'],

            //permission
            ['name' => 'permission.view',     'module' => 'permission', 'action' => 'view'],

        ];

        DB::table('permissions')->insert($permissions);
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
