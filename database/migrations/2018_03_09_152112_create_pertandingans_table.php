<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePertandingansTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pertandingans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_team_home')->unsigned();
            $table->integer('id_team_away')->unsigned();
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
           $table->foreign('id_team_home')->references('id')->on('teams');
            $table->foreign('id_team_away')->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pertandingans');
    }
}
