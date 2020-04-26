<?php

use App\Models\Database;
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
        factory(Database::class, 0)->create();
    }
}
