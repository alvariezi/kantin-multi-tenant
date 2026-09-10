<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Canteens (Kantin Pusat)
        Schema::create('canteens', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('slug', 100)->unique();
            $table->timestamps(6);
        });

        // 2. Tabel Tenants
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('canteen_id')->constrained()->restrictOnDelete();
            $table->string('code', 30);
            $table->string('slug', 100);
            $table->string('display_name', 120);
            $table->enum('status', ['pending', 'active', 'suspended', 'inactive'])->default('active');
            $table->timestamps(6);
            $table->softDeletes(6);

            $table->unique(['canteen_id', 'code']);
            $table->unique(['canteen_id', 'slug']);
            $table->unique(['id', 'canteen_id']); // Unique composite untuk composite FK child (diperbaiki)
        });

        // 3. Tabel Menus (Katalog per Tenant)
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->restrictOnDelete();
            $table->string('name', 120);
            $table->unsignedBigInteger('price_amount'); // Rupiah simpan dalam BIGINT
            $table->boolean('is_available')->default(true);
            $table->timestamps(6);

            $table->unique(['tenant_id', 'id']); // Composite key
        });

        // 4. Tabel Orders Induk (Tanpa tenant_id)
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('canteen_id')->constrained()->restrictOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('order_number', 50)->unique();
            $table->unsignedBigInteger('total_amount');
            $table->enum('status', ['pending', 'paid', 'cancelled', 'completed'])->default('pending');
            $table->timestamps(6);
        });

        // 5. Tabel Tenant Orders (Sub-order per Tenant)
        Schema::create('tenant_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tenant_id')->constrained()->restrictOnDelete();
            $table->unsignedBigInteger('subtotal_amount');
            $table->enum('status', ['pending', 'cooking', 'ready', 'completed', 'cancelled'])->default('pending');
            $table->timestamps(6);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenant_orders');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('menus');
        Schema::dropIfExists('tenants');
        Schema::dropIfExists('canteens');
    }
};
