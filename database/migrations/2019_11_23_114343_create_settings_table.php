<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->float('commission');
			$table->string('name');
			$table->text('about');
			$table->string('bank_account');
			$table->string('app_commission');
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}