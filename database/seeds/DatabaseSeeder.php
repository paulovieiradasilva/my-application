<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(TowersTableSeeder::class);
        $this->call(EmployeesTableSeeder::class);
        $this->call(EnvironmentsTableSeeder::class);
        $this->call(ServersTableSeeder::class);
        $this->call(DatabasesTableSeeder::class);
        $this->call(ProvidersTableSeeder::class);
    }
}
