<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\User;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
               $table->bigIncrements('u_id');
               $table->string('u_account');
               $table->string('password');
            
               $table->string('role')->default(User::ROLE_USER); // 加入角色欄位
               $table->string('u_right');
               $table->string('u_name');
               $table->string('email')->unique();
               $table->mediumText('u_image')->unllable();
               $table->string('u_address');
               $table->string('u_phone');
               $table->string('u_author');
               $table->string('u_bonus');
               $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
