<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Provider;
use Faker\Generator as Faker;

$factory->define(Provider::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'opening_hours' => $faker->randomElement(['Seg. à Sex das 08hs as 17hs', 'Seg. à Sex das 09hs as 18hs']),
        'on_duty' => $faker->randomElement(['-', '12/7', '24/7']),
    ];
});
