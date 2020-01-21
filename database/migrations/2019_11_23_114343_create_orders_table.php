<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title');
			$table->string('address');
			$table->string('special_order');
			$table->time('order_time');
			$table->string('delivery');
			$table->integer('quantit');
//			$table->enum('status', array('pending','accepted','rejected','delivered','declined'))->default('pending');
			$table->enum('status', array('refusal','pending', 'acceptance', 'request_complete', 'confirm_delivery', 'contact'));
			$table->float('cost');
			$table->float('commission');
			$table->float('net');
			$table->float('total');
			$table->integer('payment_method_id')->unsigned()->nullable();
			$table->integer('client_id')->unsigned()->nullable();
			$table->integer('restaurant_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}