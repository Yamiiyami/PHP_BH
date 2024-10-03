<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCartTable extends Migration
{
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
        
            $table->dropColumn('address');
            $table->dropColumn('notes');
            $table->dropColumn('phone');
            $table->enum('status',['pending','completed','canceled'])->default('pending');
        });
    }

    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            //
            $table->dropColumn('status');
            $table->string('address');
            $table->text('notes');
            $table->string('phone');
        });
    }
}
