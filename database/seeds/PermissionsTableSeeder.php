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

        /** Servers */
        Permission::create([
            'name' => 'Criar novos servidores',
            'slug' => 'servers.create',
            'description' => 'Cadastrar novos servidores'
        ]);

        Permission::create([
            'name' => 'Listar servidores',
            'slug' => 'servers.index',
            'description' => 'Listar todos os servidores'
        ]);

        Permission::create([
            'name' => 'Visualizar detalhes de servidores',
            'slug' => 'servers.show',
            'description' => 'Ver detalhe dos servidores'
        ]);

        Permission::create([
            'name' => 'Atualizar servidores',
            'slug' => 'servers.edit',
            'description' => 'Editar os servidores'
        ]);

        Permission::create([
            'name' => 'Eliminar servidores',
            'slug' => 'servers.destroy',
            'description' => 'Deletar os servidores'
        ]);

        /** Employee */
        Permission::create([
            'name' => 'Criar novos funcionários',
            'slug' => 'employees.create',
            'description' => 'Cadastrar novos funcionários'
        ]);

        Permission::create([
            'name' => 'Listar funcionários',
            'slug' => 'employees.index',
            'description' => 'Listar todos os funcionários'
        ]);

        Permission::create([
            'name' => 'Visualizar detalhes de funcionários',
            'slug' => 'employees.show',
            'description' => 'Ver detalhe dos funcionários'
        ]);

        Permission::create([
            'name' => 'Atualizar funcionários',
            'slug' => 'employees.edit',
            'description' => 'Editar os funcionários'
        ]);

        Permission::create([
            'name' => 'Eliminar funcionários',
            'slug' => 'employees.destroy',
            'description' => 'Deletar os funcionários'
        ]);

        /** Providers */
        Permission::create([
            'name' => 'Criar novos fornecedores',
            'slug' => 'providers.create',
            'description' => 'Cadastrar novos fornecedores'
        ]);

        Permission::create([
            'name' => 'Listar fornecedores',
            'slug' => 'providers.index',
            'description' => 'Listar todos os fornecedores'
        ]);

        Permission::create([
            'name' => 'Visualizar detalhes de fornecedores',
            'slug' => 'providers.show',
            'description' => 'Ver detalhe dos fornecedores'
        ]);

        Permission::create([
            'name' => 'Atualizar fornecedores',
            'slug' => 'providers.edit',
            'description' => 'Editar os fornecedores'
        ]);

        Permission::create([
            'name' => 'Eliminar fornecedores',
            'slug' => 'providers.destroy',
            'description' => 'Deletar os fornecedores'
        ]);

        /** Towers */
        Permission::create([
            'name' => 'Criar novos torres',
            'slug' => 'towers.create',
            'description' => 'Cadastrar novas torres'
        ]);

        Permission::create([
            'name' => 'Listar torres',
            'slug' => 'towers.index',
            'description' => 'Listar todas as torres'
        ]);

        Permission::create([
            'name' => 'Visualizar detalhes de torres',
            'slug' => 'towers.show',
            'description' => 'Ver detalhe das torres'
        ]);

        Permission::create([
            'name' => 'Atualizar torres',
            'slug' => 'towers.edit',
            'description' => 'Editar torres'
        ]);

        Permission::create([
            'name' => 'Eliminar torres',
            'slug' => 'towers.destroy',
            'description' => 'Deletar torres'
        ]);

        /** Environments */
        Permission::create([
            'name' => 'Criar novos ambientes',
            'slug' => 'environments.create',
            'description' => 'Cadastrar novas ambientes'
        ]);

        Permission::create([
            'name' => 'Listar ambientes',
            'slug' => 'environments.index',
            'description' => 'Listar todos os ambientes'
        ]);

        Permission::create([
            'name' => 'Visualizar detalhes de ambientes',
            'slug' => 'environments.show',
            'description' => 'Ver detalhe dos ambientes'
        ]);

        Permission::create([
            'name' => 'Atualizar ambientes',
            'slug' => 'environments.edit',
            'description' => 'Editar ambientes'
        ]);

        Permission::create([
            'name' => 'Eliminar ambientes',
            'slug' => 'environments.destroy',
            'description' => 'Deletar ambientes'
        ]);
    }
}
