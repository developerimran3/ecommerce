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

            // colors
            ['name' => 'colors.view',   'module' => 'colors', 'action' => 'view'],
            ['name' => 'colors.create', 'module' => 'colors', 'action' => 'create'],
            ['name' => 'colors.edit',   'module' => 'colors', 'action' => 'edit'],
            ['name' => 'colors.delete', 'module' => 'colors', 'action' => 'delete'],
            ['name' => 'colors.status', 'module' => 'colors', 'action' => 'status'],

            // sizes
            ['name' => 'sizes.view',   'module' => 'sizes', 'action' => 'view'],
            ['name' => 'sizes.create', 'module' => 'sizes', 'action' => 'create'],
            ['name' => 'sizes.edit',   'module' => 'sizes', 'action' => 'edit'],
            ['name' => 'sizes.delete', 'module' => 'sizes', 'action' => 'delete'],
            ['name' => 'sizes.status', 'module' => 'sizes', 'action' => 'status'],

            // couriers
            ['name' => 'couriers.view',   'module' => 'couriers', 'action' => 'view'],
            ['name' => 'couriers.create', 'module' => 'couriers', 'action' => 'create'],
            ['name' => 'couriers.edit',   'module' => 'couriers', 'action' => 'edit'],
            ['name' => 'couriers.delete', 'module' => 'couriers', 'action' => 'delete'],
            ['name' => 'couriers.status', 'module' => 'couriers', 'action' => 'status'],

            // banners
            ['name' => 'banners.view',   'module' => 'banners', 'action' => 'view'],
            ['name' => 'banners.create', 'module' => 'banners', 'action' => 'create'],
            ['name' => 'banners.edit',   'module' => 'banners', 'action' => 'edit'],
            ['name' => 'banners.delete', 'module' => 'banners', 'action' => 'delete'],
            ['name' => 'banners.status', 'module' => 'banners', 'action' => 'status'],

            // banners_categories
            ['name' => 'banners_categories.view',   'module' => 'banners_categories', 'action' => 'view'],
            ['name' => 'banners_categories.create', 'module' => 'banners_categories', 'action' => 'create'],
            ['name' => 'banners_categories.edit',   'module' => 'banners_categories', 'action' => 'edit'],
            ['name' => 'banners_categories.delete', 'module' => 'banners_categories', 'action' => 'delete'],
            ['name' => 'banners_categories.status', 'module' => 'banners_categories', 'action' => 'status'],

            //smtp
            ['name' => 'smtp.view',   'module' => 'smtp', 'action' => 'view'],
            ['name' => 'smtp.edit',   'module' => 'smtp', 'action' => 'edit'],

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

            // Users
            ['name' => 'users.view',   'module' => 'users', 'action' => 'view'],
            ['name' => 'users.create', 'module' => 'users', 'action' => 'create'],
            ['name' => 'users.edit',   'module' => 'users', 'action' => 'edit'],
            ['name' => 'users.delete', 'module' => 'users', 'action' => 'delete'],
            ['name' => 'users.status', 'module' => 'users', 'action' => 'status'],
            //customers
            ['name' => 'customers.view',   'module' => 'customers', 'action' => 'view'],
            ['name' => 'customers.delete', 'module' => 'customers', 'action' => 'delete'],
            ['name' => 'customers.status', 'module' => 'customers', 'action' => 'status'],

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

            // Payments_gateway
            ['name' => 'payments_gateway.view',   'module' => 'payments_gateway', 'action' => 'view'],
            ['name' => 'payments_gateway.create', 'module' => 'payments_gateway', 'action' => 'create'],
            ['name' => 'payments_gateway.edit',   'module' => 'payments_gateway', 'action' => 'edit'],
            ['name' => 'payments_gateway.delete', 'module' => 'payments_gateway', 'action' => 'delete'],
            ['name' => 'payments_gateway.status', 'module' => 'payments_gateway', 'action' => 'status'],
            // sms_gateway
            ['name' => 'sms_gateway.view',   'module' => 'sms_gateway', 'action' => 'view'],
            ['name' => 'sms_gateway.create', 'module' => 'sms_gateway', 'action' => 'create'],
            ['name' => 'sms_gateway.edit',   'module' => 'sms_gateway', 'action' => 'edit'],
            ['name' => 'sms_gateway.delete', 'module' => 'sms_gateway', 'action' => 'delete'],
            ['name' => 'sms_gateway.status', 'module' => 'sms_gateway', 'action' => 'status'],

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
            ['name' => 'setting.create',  'module' => 'setting', 'action' => 'create'],
            ['name' => 'setting.edit',    'module' => 'setting', 'action' => 'edit'],
            ['name' => 'setting.delete',  'module' => 'setting', 'action' => 'delete'],

            // Page Create
            ['name' => 'page.view',    'module' => 'page', 'action' => 'view'],
            ['name' => 'page.create',  'module' => 'page', 'action' => 'create'],
            ['name' => 'page.edit',    'module' => 'page', 'action' => 'edit'],
            ['name' => 'page.delete',  'module' => 'page', 'action' => 'delete'],

            //stocks_report
            ['name' => 'stocks_report.view',    'module' => 'stocks_report', 'action' => 'view'],
            ['name' => 'stocks_report.create',  'module' => 'stocks_report', 'action' => 'create'],
            ['name' => 'stocks_report.edit',    'module' => 'stocks_report', 'action' => 'edit'],
            ['name' => 'stocks_report.delete',  'module' => 'stocks_report', 'action' => 'delete'],

            //sales_report
            ['name' => 'sales_report.view',    'module' => 'sales_report', 'action' => 'view'],
            ['name' => 'sales_report.create',  'module' => 'sales_report', 'action' => 'create'],
            ['name' => 'sales_report.edit',    'module' => 'sales_report', 'action' => 'edit'],
            ['name' => 'sales_report.delete',  'module' => 'sales_report', 'action' => 'delete'],

            //orders_report
            ['name' => 'orders_report.view',    'module' => 'orders_report', 'action' => 'view'],
            ['name' => 'orders_report.create',  'module' => 'orders_report', 'action' => 'create'],
            ['name' => 'orders_report.edit',    'module' => 'orders_report', 'action' => 'edit'],
            ['name' => 'orders_report.delete',  'module' => 'orders_report', 'action' => 'delete'],

            //ip
            ['name' => 'ip.view',    'module' => 'ip', 'action' => 'view'],
            ['name' => 'ip.create',  'module' => 'ip', 'action' => 'create'],
            ['name' => 'ip.edit',    'module' => 'ip', 'action' => 'edit'],
            ['name' => 'ip.delete',  'module' => 'ip', 'action' => 'delete'],

            //Invoice
            ['name' => 'invoices.view',     'module' => 'invoices', 'action' => 'view'],
            ['name' => 'invoices.download',  'module' => 'invoices', 'action' => 'download'],

            //permission
            ['name' => 'permission.view',  'module' => 'permission', 'action' => 'view'],
        ];

        DB::table('permissions')->insert($permissions);
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
