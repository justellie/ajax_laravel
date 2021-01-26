<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_users', function (Blueprint $table) {
            $table->id();
            $table->string('asunto');
            $table->string('status');
            $table->string('email');
            $table->text('message');
            $table->unsignedBigInteger('user_id')->index();//defino la columna
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');//indico que es foranea

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mail_users');
    }
}
