<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestaurantsTable extends Migration {

	public function up()
	{
		Schema::create('restaurants', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('email')->unique();
			$table->string('phone');
			$table->string('password');
			$table->string('image');
			$table->boolean('state');
			$table->float('minimum');
			$table->string('delivery_charge');
			$table->string('whats');
            $table->boolean('is_active')->default(0);
			$table->string('api_token')->nullable();
			$table->string('pin_code',60)->unique()->nullable();
			$table->integer('region_id')->unsigned()->nullable();
			$table->integer('rating')->nullable();
			$table->time('opened_at')->nullable();
			$table->time('closed_at')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('restaurants');
	}
}