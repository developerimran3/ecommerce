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
            // Product
            ['name' => 'product.manage', 'module' => 'product',   'action' => 'manage'],
            ['name' => 'product.create', 'module' => 'product',   'action' => 'create'],
            ['name' => 'product.edit',   'module' => 'product',   'action' => 'edit'],
            ['name' => 'product.delete', 'module' => 'product',   'action' => 'delete'],

            // Category
            ['name' => 'category.manage', 'module' => 'category', 'action' => 'manage'],
            ['name' => 'category.create', 'module' => 'category', 'action' => 'create'],
            ['name' => 'category.edit',   'module' => 'category', 'action' => 'edit'],
            ['name' => 'category.delete', 'module' => 'category', 'action' => 'delete'],
            ['name' => 'category.status', 'module' => 'category', 'action' => 'status'],

            // Brand
            ['name' => 'brand.manage', 'module' => 'brand', 'action' => 'manage'],
            ['name' => 'brand.create', 'module' => 'brand', 'action' => 'create'],
            ['name' => 'brand.edit',   'module' => 'brand', 'action' => 'edit'],
            ['name' => 'brand.delete', 'module' => 'brand', 'action' => 'delete'],
            ['name' => 'brand.status', 'module' => 'brand', 'action' => 'status'],

            // Tag
            ['name' => 'tag.manage', 'module' => 'tag', 'action' => 'manage'],
            ['name' => 'tag.create', 'module' => 'tag', 'action' => 'create'],
            ['name' => 'tag.edit',   'module' => 'tag', 'action' => 'edit'],
            ['name' => 'tag.delete', 'module' => 'tag', 'action' => 'delete'],
            ['name' => 'tag.status', 'module' => 'tag', 'action' => 'status'],

            // order
            ['name' => 'order.manage',   'module' => 'order', 'action' => 'manage'],
            ['name' => 'order.invoice',  'module' => 'order', 'action' => 'invoice'],
            ['name' => 'order.view',     'module' => 'order', 'action' => 'view'],
            ['name' => 'order.delete',   'module' => 'order', 'action' => 'delete'],
            ['name' => 'order.status',   'module' => 'order', 'action' => 'status'],

            // User
            ['name' => 'user.manage', 'module' => 'user', 'action' => 'manage'],
            ['name' => 'user.create', 'module' => 'user', 'action' => 'create'],
            ['name' => 'user.edit',   'module' => 'user', 'action' => 'edit'],
            ['name' => 'user.delete', 'module' => 'user', 'action' => 'delete'],
            ['name' => 'user.status', 'module' => 'user', 'action' => 'status'],

            // site Setting
            ['name' => 'setting.manage',   'module' => 'setting', 'action' => 'manage'],
            //review
            ['name' => 'review.manage',   'module' => 'review', 'action' => 'manage'],

            //permission
            ['name' => 'permission.manage',   'module' => 'permission', 'action' => 'manage'],

        ];

        DB::table('permissions')->insert($permissions);
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
