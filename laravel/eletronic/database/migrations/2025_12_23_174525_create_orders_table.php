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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Customer details
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');

            // Order details
            $table->text('products'); // product names / JSON
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2);

            $table->enum('status', ['Pending','Confirmed','Shipped','Delivered','Cancelled'])->default('Pending');
            $table->enum('payment_status', ['Paid','Unpaid'])->default('Unpaid');

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
