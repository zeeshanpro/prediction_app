<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsToGames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->dropColumn('team1');
			$table->dropColumn('team1Logo');
			$table->dropColumn('team2');
			$table->dropColumn('team2Logo');
			
			$table->biginteger('team1id')->unsigned()->after('type');
            $table->foreign('team1id')->references('id')->on('teams');
			$table->biginteger('team2id')->unsigned()->nullable()->after('team1id');;
            $table->foreign('team2id')->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('games', function (Blueprint $table) {
            //
        });
    }
}
