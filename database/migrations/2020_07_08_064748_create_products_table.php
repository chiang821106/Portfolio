<?php
 
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
 
class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('p_id');
            $table->string("p_name", 255)->nullable();
            $table->text("p_description")->nullable();
            $table->string("p_photo", 255)->nullable();
            $table->decimal("p_price", 6, 2);
            $table->string("p_color", 255);
            $table->string("p_filename", 255);
            $table->string("p_filename_design", 255);
            $table->boolean("p_filename_private", 255);
            $table->string("p_total", 255);
            $table->string("u_id", 255);
        });
    }
 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}