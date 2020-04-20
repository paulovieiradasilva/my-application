<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Database;
use Faker\Generator as Faker;

$factory->define(Database::class, function (Faker $faker) {
    return [
        'name' => $faker->domainWord,
        'sgdb' => $faker->randomElement(['Mysql', 'SQLServer']),
        'port' => $faker->randomElement(['3306', '1433'])
    ];
});
