<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Modles\Region;
use Faker\Generator as Faker;

$factory->define(App\Models\Region::class, function (Faker $faker) {
    return [
        'name'=>$faker->state(),

    ];
});
