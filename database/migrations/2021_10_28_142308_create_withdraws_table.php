<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraws', function (Blueprint $table) {
            $table->id();
			$table->biginteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');
			$table->string('email');
			$table->double('amount', 12, 2);
			$table->biginteger('method_id')->unsigned()->index();
            $table->foreign('method_id')->references('id')->on('payment_methods');
			$table->tinyInteger('is_status')->default('0');
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
        Schema::dropIfExists('withdraws');
    }
}
