<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillPaysTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bill_pays', function(Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->date('date_due');
            $table->float('value');
            $table->boolean('done')->default(0);
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->om('categories');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->om('users');
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
		Schema::drop('bill_pays');
	}

}
