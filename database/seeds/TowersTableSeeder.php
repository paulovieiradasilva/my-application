<?php

use Illuminate\Database\Seeder;

class TowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Tower::class, 3)->create();
    }
}
