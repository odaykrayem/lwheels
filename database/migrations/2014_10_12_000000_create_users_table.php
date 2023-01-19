<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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

            $table->id();
            $table->string('f_name');
            $table->string('l_name');
            $table->string('phone')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('ref_code')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('points')->default(0);
            $table->double('balance')->default(0);
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
