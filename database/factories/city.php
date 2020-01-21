<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\City;
use Faker\Generator as Faker;

$factory->define(App\Models\City::class, function (Faker $faker) {
    return [
       'name'=>$faker->city()
    ];
});