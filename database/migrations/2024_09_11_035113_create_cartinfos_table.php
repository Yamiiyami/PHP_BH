<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartinfos', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity')->default(0);
            $table->decimal('price',10,2);
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('carts_id')->constrained('carts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cartinfos');
    }
}
