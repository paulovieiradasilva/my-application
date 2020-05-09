<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Auth::routes();

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/home', 'HomeController@index')->name('home');

    // Users
    Route::get('usuarios', 'UserController@index')->name('users.index')->middleware('can:users.index');
    Route::get('usuarios/create', 'UserController@create')->name('users.create')->middleware('can:users.create');
    Route::post('usuarios', 'UserController@store')->name('users.store');
    Route::get('usuarios/{id}', 'UserController@show')->name('users.show')->middleware('can:users.show');
    Route::get('usuarios/{id}/edit', 'UserController@edit')->name('users.edit')->middleware('can:users.edit');
    Route::put('usuarios/{id}', 'UserController@update')->name('users.update')->middleware('can:users.edit');
    Route::delete('usuarios/{id}', 'UserController@destroy')->name('users.destroy')->middleware('can:users.destroy');

    /** All towers */
    Route::get('users', 'UserController@get');

    /** Datatables */
    Route::get('users_datatables', 'UserController@list');

    // Roles
    Route::get('papeis', 'RoleController@index')->name('roles.index')->middleware('can:roles.index');
    Route::get('papeis/create', 'RoleController@create')->name('roles.create')->middleware('can:roles.create');
    Route::post('papeis', 'RoleController@store')->name('roles.store');
    Route::get('papeis/{id}', 'RoleController@show')->name('roles.show')->middleware('can:roles.show');
    Route::get('papeis/{id}/edit', 'RoleController@edit')->name('roles.edit')->middleware('can:roles.edit');
    Route::put('papeis/{id}', 'RoleController@update')->name('roles.update');
    Route::delete('papeis/{id}', 'RoleController@destroy')->name('roles.destroy')->middleware('can:roles.destroy');

    /** All Roles */
    Route::get('roles', 'RoleController@get');

    /** Datatables */
    Route::get('roles_datatables', 'RoleController@list');

    // Permissions
    Route::get('permissoes', 'PermissionController@index')->name('permissions.index')->middleware('can:permissions.index');
    Route::get('permissoes/create', 'PermissionController@create')->name('permissions.create')->middleware('can:permissions.create');
    Route::post('permissoes', 'PermissionController@store')->name('permissions.store');
    Route::get('permissoes/{id}', 'PermissionController@show')->name('permissions.show')->middleware('can:permissions.show');
    Route::get('permissoes/{id}/edit', 'PermissionController@edit')->name('permissions.edit')->middleware('can:permissions.edit');
    Route::put('permissoes/{id}', 'PermissionController@update')->name('permissions.update')->middleware('can:permissions.edit');
    Route::delete('permissoes/{id}', 'PermissionController@destroy')->name('permissions.destroy')->middleware('can:permissions.destroy');

    /** All Permissions */
    Route::get('permissions', 'PermissionController@get');

    /** Datatables */
    Route::get('permissions_datatables', 'PermissionController@list');

    // Employees
    Route::get('funcionarios', 'EmployeeController@index')->name('employees.index')->middleware('can:employees.index');
    Route::get('funcionarios/create', 'EmployeeController@create')->name('employees.create')->middleware('can:employees.create');
    Route::post('funcionarios', 'EmployeeController@store')->name('employees.store');
    Route::get('funcionarios/{id}', 'EmployeeController@show')->name('employees.show')->middleware('can:employees.show');
    Route::get('funcionarios/{id}/edit', 'EmployeeController@edit')->name('employees.edit')->middleware('can:employees.edit');
    Route::patch('funcionarios/{id}', 'EmployeeController@update')->name('employees.update');
    Route::delete('funcionarios/{id}', 'EmployeeController@destroy')->name('employees.destroy')->middleware('can:employees.destroy');

    /** Datatables */
    Route::get('employees_datatables', 'EmployeeController@list');

    // Providers
    Route::get('fornecedores', 'ProviderController@index')->name('providers.index')->middleware('can:providers.index');
    Route::get('fornecedores/create', 'ProviderController@create')->name('providers.create')->middleware('can:providers.create');
    Route::post('fornecedores', 'ProviderController@store')->name('providers.store');
    Route::get('fornecedores/{id}', 'ProviderController@show')->name('providers.show')->middleware('can:providers.show');
    Route::get('fornecedores/{id}/edit', 'ProviderController@edit')->name('providers.edit')->middleware('can:providers.edit');
    Route::patch('fornecedores/{id}', 'ProviderController@update')->name('providers.update')->middleware('can:providers.edit');
    Route::delete('fornecedores/{id}', 'ProviderController@destroy')->name('providers.destroy')->middleware('can:providers.destroy');

    /** All towers */
    Route::get('providers', 'ProviderController@get');

    /** Datatables */
    Route::get('providers_datatables', 'ProviderController@list');

    // Towers
    Route::get('torres', 'TowerController@index')->name('towers.index')->middleware('can:towers.index');
    Route::get('torres/create', 'TowerController@create')->name('towers.create')->middleware('can:towers.create');
    Route::post('torres', 'TowerController@store')->name('towers.store');
    Route::get('torres/{id}', 'TowerController@show')->name('towers.show')->middleware('can:towers.show');
    Route::get('torres/{id}/edit', 'TowerController@edit')->name('towers.edit')->middleware('can:towers.edit');
    Route::patch('torres/{id}', 'TowerController@update')->name('towers.update')->middleware('can:towers.edit');
    Route::delete('torres/{id}', 'TowerController@destroy')->name('towers.destroy')->middleware('can:towers.destroy');

    /** All towers */
    Route::get('towers', 'TowerController@get');

    /** Datatables */
    Route::get('towers_datatables', 'TowerController@list');

    // Environments
    Route::get('ambientes', 'EnvironmentController@index')->name('environments.index')->middleware('can:environments.index');
    Route::get('ambientes/create', 'EnvironmentController@create')->name('environments.create')->middleware('can:environments.create');
    Route::post('ambientes', 'EnvironmentController@store')->name('environments.store');
    Route::get('ambientes/{id}', 'EnvironmentController@show')->name('environments.show')->middleware('can:environments.show');
    Route::get('ambientes/{id}/edit', 'EnvironmentController@edit')->name('environments.edit')->middleware('can:environments.edit');
    Route::patch('ambientes/{id}', 'EnvironmentController@update')->name('environments.update')->middleware('can:environments.edit');
    Route::delete('ambientes/{id}', 'EnvironmentController@destroy')->name('environments.destroy')->middleware('can:environments.destroy');

    /** All environments */
    Route::get('environments', 'EnvironmentController@get');

    /** Datatables */
    Route::get('environments_datatables', 'EnvironmentController@list');

    // Servers
    Route::get('servidores', 'ServerController@index')->name('servers.index')->middleware('can:servers.index');
    Route::get('servidores/create', 'ServerController@create')->name('servers.create')->middleware('can:servers.create');
    Route::post('servidores', 'ServerController@store')->name('servers.store');
    Route::get('servidores/{id}', 'ServerController@show')->name('servers.show')->middleware('can:servers.show');
    Route::get('servidores/{id}/edit', 'ServerController@edit')->name('servers.edit')->middleware('can:servers.edit');
    Route::patch('servidores/{id}', 'ServerController@update')->name('servers.update');
    Route::delete('servidores/{id}', 'ServerController@destroy')->name('servers.destroy')->middleware('can:servers.destroy');

    /** All towers */
    Route::get('servers', 'ServerController@get');

    /** Datatables */
    Route::get('servers_datatables', 'ServerController@list');

    // Databases
    Route::post('database', 'DatabaseController@store')->name('database.store');
    Route::delete('database/{id}', 'DatabaseController@destroy')->name('database.destroy');
    Route::patch('database/{id}', 'DatabaseController@update')->name('database.update');

    // Applications
    Route::get('aplicacoes', 'ApplicationController@index')->name('applications.index')->middleware('can:applications.index');
    Route::get('aplicacoes/create', 'ApplicationController@create')->name('applications.create')->middleware('can:applications.create');
    Route::post('aplicacoes', 'ApplicationController@store')->name('applications.store');
    Route::get('aplicacoes/{id}', 'ApplicationController@show')->name('applications.show')->middleware('can:applications.show');
    Route::get('aplicacoes/{id}/edit', 'ApplicationController@edit')->name('applications.edit')->middleware('can:applications.edit');
    Route::patch('aplicacoes/{id}', 'ApplicationController@update')->name('applications.update');
    Route::delete('aplicacoes/{id}', 'ApplicationController@destroy')->name('applications.destroy')->middleware('can:applications.destroy');

    /** All Applications */
    Route::get('applications', 'ApplicationController@get');

    /** Datatables */
    Route::get('applications_datatables', 'ApplicationController@list');

    // Services
    Route::get('servicos', 'ServiceController@index')->name('services.index')->middleware('can:services.index');
    Route::get('servicos/create', 'ServiceController@create')->name('services.create')->middleware('can:services.create');
    Route::post('servicos', 'ServiceController@store')->name('services.store');
    Route::get('servicos/{id}', 'ServiceController@show')->name('services.show')->middleware('can:services.show');
    Route::get('servicos/{id}/edit', 'ServiceController@edit')->name('services.edit')->middleware('can:services.edit');
    Route::patch('servicos/{id}', 'ServiceController@update')->name('services.update');
    Route::delete('servicos/{id}', 'ServiceController@destroy')->name('services.destroy')->middleware('can:services.destroy');

    /** Datatables */
    Route::get('services_datatables', 'ServiceController@list');

    // Integrations
    Route::get('integracoes', 'IntegrationController@index')->name('integrations.index')->middleware('can:integrations.index');
    Route::get('integracoes/create', 'IntegrationController@create')->name('integrations.create')->middleware('can:integrations.create');
    Route::post('integracoes', 'IntegrationController@store')->name('integrations.store');
    Route::get('integracoes/{id}', 'IntegrationController@show')->name('integrations.show')->middleware('can:integrations.show');
    Route::get('integracoes/{id}/edit', 'IntegrationController@edit')->name('integrations.edit')->middleware('can:integrations.edit');
    Route::patch('integracoes/{id}', 'IntegrationController@update')->name('integrations.update');
    Route::delete('integracoes/{id}', 'IntegrationController@destroy')->name('integrations.destroy')->middleware('can:integrations.destroy');

    /** Datatables */
    Route::get('integrations_datatables', 'IntegrationController@list');


    Route::get('/', function () {
        return redirect()->route('home');
    });

    Route::get('my-app/{id}', 'HomeController@myApp');
});
