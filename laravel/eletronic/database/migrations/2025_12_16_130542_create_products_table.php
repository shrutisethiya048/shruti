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
        Schema::create('products', function (Blueprint $table) {
            $table->id();                             // Product ID
            $table->string('name');                   // Product Name
            $table->decimal('price', 10, 2);         // Product Price
            $table->text('description')->nullable(); // Product Description (optional)
            $table->boolean('status')->default(1);   // Product Status (1=Active, 0=Inactive)
            $table->timestamps();                     // Created_at & Updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
