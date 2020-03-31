<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Database;
use Faker\Generator as Faker;

$factory->define(Database::class, function (Faker $faker) {
    return [
        'name' => $faker->domainWord,
        'sgbd' => $faker->randomElement(['Mysql', 'SQLServer']),
        'version_sgbd' => $faker->randomElement(['v10', 'v7', '2008', '2012']),
        'port' => $faker->randomElement(['3306', '1433']),
    ];
});
