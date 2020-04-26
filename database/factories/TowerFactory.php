<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tower;
use Faker\Generator as Faker;

$factory->define(Tower::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
    ];
});
