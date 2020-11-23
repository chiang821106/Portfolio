<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('o_id');
            $table->string('u_id');
            // $table->string('p_id');
            $table->string('od_id');
            $table->bigInteger('o_number');
            $table->string('o_quantity');
            $table->string('o_total');
            $table->string('o_recipient');
            $table->string('o_recipient_phone');
            $table->string('o_recipient_address');
            $table->string('o_note');
            $table->string('o_status');
            $table->rememberToken();
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
        Schema::dropIfExists('orders');
    }
}
