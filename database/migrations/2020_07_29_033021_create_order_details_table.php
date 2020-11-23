<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('od_id');
            $table->string('o_id');
            $table->unsignedBigInteger('p_id');
            $table->string('od_size');
            $table->string('od_color');
            $table->string('od_price');
            $table->string('od_quantity');
            $table->string('od_total');
            $table->mediumText('od_filename')->nullable();
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
        Schema::dropIfExists('order_details');
    }
}
