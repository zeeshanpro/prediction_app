<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageshistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packageshistory', function (Blueprint $table) {
            $table->id();
			$table->biginteger('userid')->unsigned()->index()->nullable();
            $table->foreign('userid')->references('id')->on('users');
			$table->biginteger('packageid')->unsigned()->index()->nullable();
            $table->foreign('packageid')->references('id')->on('packages');
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
        Schema::dropIfExists('packageshistory');
    }
}
