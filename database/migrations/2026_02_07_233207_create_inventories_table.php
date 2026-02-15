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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_variant_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();

            $table->string('sku')->unique();              // SKU / Barcode
            $table->integer('stock')->default(0);         // Available stock
            $table->integer('reserved_stock')->default(0); // Order placed but not confirmed
            $table->integer('low_stock_qty')->default(5);

            $table->boolean('manage_stock')->default(true);

            $table->enum('stock_status', [
                'in_stock',
                'out_of_stock',
                'backorder'
            ])->default('in_stock');

            $table->timestamps();
            $table->softDeletes();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};