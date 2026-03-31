<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {

          //  $table->integer('quantity')->default(1)->after('customer_phone');
           // $table->decimal('total_price', 10, 2)->default(0)->after('quantity');
           // $table->enum('payment_status', ['Pending','Paid','Failed'])
                  //->default('Pending')
                 // ->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
               'quantity',
                'total_price',
                'payment_status'
            ]);
        });
    }
};
