<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Server;
use Faker\Generator as Faker;

$factory->define(Server::class, function (Faker $faker) {
    return [
        'name' => $faker->domainWord,
        'ip' => $faker->ipv4,
        'os' => $faker->randomElement(['Windows Server 2008', 'Linux Debian', 'Ubuntu Server 18.04 LTS']),
        'type' => $faker->randomElement(['Aplicação', 'Banco de Dados']),
        'environment_id' => $faker->numberBetween(1, 3),
    ];
});
