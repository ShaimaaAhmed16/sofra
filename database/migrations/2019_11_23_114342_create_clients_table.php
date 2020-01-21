<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('email')->unique();
			$table->string('phone');
			$table->string('password');
			$table->string('image');
			$table->string('pin_code')->nullable();
			$table->boolean('is_active')->default(0);
            $table->string('api_token',60)->unique()->nullable();
			$table->integer('region_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}