<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Administrador',
            'slug' => 'admin',
            'description' => 'Administrador do sistema, possui todas as permissões',
            'special' => 'all-access'
        ]);

        Role::create([
            'name' => 'Users',
            'slug' => 'users',
            'description' => 'Papél default para usuários do sistema'
        ]);
    }
}
