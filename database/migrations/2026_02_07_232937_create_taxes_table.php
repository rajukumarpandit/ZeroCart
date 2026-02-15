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
        Schema::create('taxes', function (Blueprint $table) {
            $table->id();

            $table->string('name');                  // GST 18%, VAT, No Tax
            $table->decimal('rate', 5, 2);            // 18.00
            $table->enum('type', ['inclusive', 'exclusive'])
                ->default('exclusive');            // price includes tax or not

            $table->enum('applies_to', ['product', 'shipping'])
                ->default('product');              // future ready

            $table->boolean('is_default')->default(false);
            $table->boolean('status')->default(true);

            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxes');
    }
};