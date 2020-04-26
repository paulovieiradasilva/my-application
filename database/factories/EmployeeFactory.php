<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'type' => $faker->randomElement(['AO', 'KEY', 'BO']),
        'tower_id' => $faker->numberBetween(1, 3),
    ];
});
