<?php

use App\Models\Tower;
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
        factory(Tower::class, 3)->create();
    }
}
