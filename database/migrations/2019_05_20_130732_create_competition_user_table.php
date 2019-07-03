<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competition_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('competition_id')->unsigned()->nullable();
            $table->foreign('competition_id')->references('id')->on('competitions')->onDelete('cascade');
            // $table->foreign('event_id')->references('id')->on('events');

            $table->integer('user_one_id')->unsigned();
            $table->foreign('user_one_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('user_two_id')->unsigned();
            $table->foreign('user_two_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('competition_user');
    }
}
