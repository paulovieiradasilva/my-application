<?php

use Illuminate\Database\Seeder;

class DatabasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Database::class, 40)->create();
    }
}
