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
            ['name' => 'product.view',   'module' => 'product',   'action' => 'view'],
            ['name' => 'product.create', 'module' => 'product',   'action' => 'create'],
            ['name' => 'product.edit',   'module' => 'product',   'action' => 'edit'],
            ['name' => 'product.delete', 'module' => 'product',   'action' => 'delete'],

            // Category
            ['name' => 'category.view',   'module' => 'category', 'action' => 'view'],
            ['name' => 'category.create', 'module' => 'category', 'action' => 'create'],
            ['name' => 'category.edit',   'module' => 'category', 'action' => 'edit'],
            ['name' => 'category.delete', 'module' => 'category', 'action' => 'delete'],

            // Brand
            ['name' => 'brand.view',   'module' => 'brand', 'action' => 'view'],
            ['name' => 'brand.create', 'module' => 'brand', 'action' => 'create'],
            ['name' => 'brand.edit',   'module' => 'brand', 'action' => 'edit'],
            ['name' => 'brand.delete', 'module' => 'brand', 'action' => 'delete'],

            // Tag
            ['name' => 'tag.view',   'module' => 'tag', 'action' => 'view'],
            ['name' => 'tag.create', 'module' => 'tag', 'action' => 'create'],
            ['name' => 'tag.edit',   'module' => 'tag', 'action' => 'edit'],
            ['name' => 'tag.delete', 'module' => 'tag', 'action' => 'delete'],

            // order
            ['name' => 'order.view',   'module' => 'order', 'action' => 'view'],
            ['name' => 'order.create', 'module' => 'order', 'action' => 'create'],
            ['name' => 'order.edit',   'module' => 'order', 'action' => 'edit'],
            ['name' => 'order.delete', 'module' => 'order', 'action' => 'delete'],


            //permission
            ['name' => 'permission.manage',   'module' => 'permission', 'action' => 'manage'],


            // User
            ['name' => 'user.view',   'module' => 'user', 'action' => 'view'],
            ['name' => 'user.create', 'module' => 'user', 'action' => 'create'],
            ['name' => 'user.edit',   'module' => 'user', 'action' => 'edit'],
            ['name' => 'user.delete', 'module' => 'user', 'action' => 'delete'],
        ];

        DB::table('permissions')->insert($permissions);
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
