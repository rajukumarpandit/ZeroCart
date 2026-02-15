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
        Schema::create('product_prices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_variant_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();

            $table->decimal('mrp',10,2);
            $table->decimal('selling_price',10,2);

            $table->foreignId('tax_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('currency',10)->default('INR');

            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_prices');
    }
};