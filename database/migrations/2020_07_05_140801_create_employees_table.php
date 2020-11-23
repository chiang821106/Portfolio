<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 建立employees表

        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('e_id');
            $table->string('e_account');
            $table->string('e_password');
            $table->integer('e_right');
            $table->date('created_at');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
