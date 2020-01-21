<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffersTable extends Migration {

	public function up()
	{
		Schema::create('offers', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('image');
			$table->string('content');
			$table->decimal('price');
			$table->date('start_date');
			$table->date('end_date');
            $table->integer('restaurant_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('offers');
	}
}