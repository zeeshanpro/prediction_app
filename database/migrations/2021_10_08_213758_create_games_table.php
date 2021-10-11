<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->integer('sport_id')->unsigned()->index();
            $table->foreign('sport_id')->references('id')->on('sports');
            $table->integer('championship_id')->unsigned()->index();
            $table->foreign('championship_id')->references('id')->on('championships');
			$table->tinyInteger('type');
			$table->string('team1');
			$table->string('team1Logo');
			$table->string('team2')->nullable();
			$table->string('team2Logo')->nullable();
			$table->dateTime('start_time');
			$table->dateTime('end_time');
			$table->integer('created_by');
			$table->integer('updated_by');
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
        Schema::dropIfExists('games');
    }
}
