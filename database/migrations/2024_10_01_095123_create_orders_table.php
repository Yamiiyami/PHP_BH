<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('cart_id');
            $table->decimal('total_amount',10,2);
            $table->text('address');
            $table->string('recipient_name');
            $table->string('recipient_phone',20);
            $table->text('notes')->nullable();
            $table->enum('order_status',['pending','completed','canceled'])->default('pending');
            $table->foreign('user_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
