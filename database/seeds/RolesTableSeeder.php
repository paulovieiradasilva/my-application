<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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

        /** */
        DB::table('role_user')->insert(['role_id' => 1, 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()]);
    }
}
