<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderProductTable extends Migration {

	public function up()
	{
		Schema::create('order_product', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->float('price');
			$table->integer('quantity');
			$table->string('note');
			$table->integer('order_id');
			$table->integer('product_id');
		});
	}

	public function down()
	{
		Schema::drop('order_product');
	}
}