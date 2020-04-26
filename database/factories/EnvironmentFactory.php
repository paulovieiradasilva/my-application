<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Environment;
use Faker\Generator as Faker;

$factory->define(Environment::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
    ];
});
