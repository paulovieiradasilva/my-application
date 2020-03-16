<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** Users */
        Permission::create([
            'name' => 'Listar usuários',
            'slug' => 'users.index',
            'description' => 'Listar todos os usuário do sistema'
        ]);

        Permission::create([
            'name' => 'Visualizar detalhes de usuários',
            'slug' => 'users.show',
            'description' => 'Listar usuário do sistema'
        ]);

        Permission::create([
            'name' => 'Atualizar usuários',
            'slug' => 'users.edit',
            'description' => 'Editar todos os usuário'
        ]);

        Permission::create([
            'name' => 'Eliminar usuários',
            'slug' => 'users.destroy',
            'description' => 'Apagar usuários do sistema'
        ]);

        /** Roles */
        Permission::create([
            'name' => 'Criar novos papéis',
            'slug' => 'roles.create',
            'description' => 'Cadastrar novos papéis para o Sistema'
        ]);

        Permission::create([
            'name' => 'Listar papéis',
            'slug' => 'roles.index',
            'description' => 'Listar todos os papéis'
        ]);

        Permission::create([
            'name' => 'Visualizar detalhes de papéis',
            'slug' => 'roles.show',
            'description' => 'Ver detalhe dos papéis'
        ]);

        Permission::create([
            'name' => 'Atualizar papéis',
            'slug' => 'roles.edit',
            'description' => 'Editar os papéis'
        ]);

        Permission::create([
            'name' => 'Eliminar papéis',
            'slug' => 'roles.destroy',
            'description' => 'Deletar os papéis'
        ]);


        /** Permissions */
        Permission::create([
            'name' => 'Criar novas permissões',
            'slug' => 'permissions.create',
            'description' => 'Cadastrar novos permissões'
        ]);

        Permission::create([
            'name' => 'Listar permissões',
            'slug' => 'permissions.index',
            'description' => 'Listar todos os permissões'
        ]);

        Permission::create([
            'name' => 'Visualizar detalhes de permissões',
            'slug' => 'permissions.show',
            'description' => 'Ver detalhes das permissões'
        ]);

        Permission::create([
            'name' => 'Atualizar permissões',
            'slug' => 'permissions.edit',
            'description' => 'Editar permissões do sistema'
        ]);

        Permission::create([
            'name' => 'Eliminar papéis',
            'slug' => 'permissions.destroy',
            'description' => 'Apagar permissões do sistema'
        ]);

        Permission::create([
            'name' => 'Controle de Acesso',
            'slug' => 'access.control',
            'description' => 'Acesso aos módulos de usuários, papeis e permissões.'
        ]);

        Permission::create([
            'name' => 'Dashboard',
            'slug' => 'users.dashboard',
            'description' => 'Exibir o dashboard padrão para os usuários'
        ]);
    }
}
