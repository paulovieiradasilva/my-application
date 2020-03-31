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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

    // Users
    Route::get('usuarios', 'UserController@index')->name('users.index')->middleware('can:users.index');
    Route::get('usuarios/create', 'UserController@create')->name('users.create')->middleware('can:users.create');
    Route::post('usuarios', 'UserController@store')->name('users.store');
    Route::get('usuarios/{user}', 'UserController@show')->name('users.show')->middleware('can:users.show');
    Route::get('usuarios/{user}/edit', 'UserController@edit')->name('users.edit')->middleware('can:users.edit');
    Route::patch('usuarios/{user}', 'UserController@update')->name('users.update')->middleware('can:users.edit');
    Route::delete('usuarios/{user}', 'UserController@destroy')->name('users.destroy')->middleware('can:users.destroy');

    /** Datatables */
    Route::get('users_datatables', 'UserController@list');

    // Roles
    Route::get('papeis', 'RoleController@index')->name('roles.index')->middleware('can:roles.index');
    Route::get('papeis/create', 'RoleController@create')->name('roles.create')->middleware('can:roles.create');
    Route::post('papeis', 'RoleController@store')->name('roles.store');
    Route::get('papeis/{role}', 'RoleController@show')->name('roles.show')->middleware('can:roles.show');
    Route::get('papeis/{role}/edit', 'RoleController@edit')->name('roles.edit')->middleware('can:roles.edit');
    Route::put('papeis/{role}', 'RoleController@update')->name('roles.update');
    Route::delete('papeis/{role}', 'RoleController@destroy')->name('roles.destroy')->middleware('can:roles.destroy');

    /** Datatables */
    Route::get('roles_datatables', 'RoleController@list');
    Route::get('roles', 'RoleController@get');

    // Permissions
    Route::get('permissoes', 'PermissionController@index')->name('permissions.index')->middleware('can:permissions.index');
    Route::get('permissoes/create', 'PermissionController@create')->name('permissions.create')->middleware('can:permissions.create');
    Route::post('permissoes', 'PermissionController@store')->name('permissions.store');
    Route::get('permissoes/{permission}', 'PermissionController@show')->name('permissions.show')->middleware('can:permissions.show');
    Route::get('permissoes/{permission}/edit', 'PermissionController@edit')->name('permissions.edit')->middleware('can:permissions.edit');
    Route::put('permissoes/{permission}', 'PermissionController@update')->name('permissions.update')->middleware('can:permissions.edit');
    Route::delete('permissoes/{permission}', 'PermissionController@destroy')->name('permissions.destroy')->middleware('can:permissions.destroy');

    /** Datatables */
    Route::get('permissions_datatables', 'PermissionController@list');
    Route::get('permissions', 'PermissionController@get');

    // Employees
    Route::get('funcionarios', 'EmployeeController@index')->name('employees.index')->middleware('can:employees.index');
    Route::get('funcionarios/create', 'EmployeeController@create')->name('employees.create')->middleware('can:employees.create');
    Route::post('funcionarios', 'EmployeeController@store')->name('employees.store');
    Route::get('funcionarios/{server}', 'EmployeeController@show')->name('employees.show')->middleware('can:employees.show');
    Route::get('funcionarios/{server}/edit', 'EmployeeController@edit')->name('employees.edit')->middleware('can:employees.edit');
    Route::patch('funcionarios/{server}', 'EmployeeController@update')->name('employees.update');
    Route::delete('funcionarios/{server}', 'EmployeeController@destroy')->name('employees.destroy')->middleware('can:employees.destroy');

    /** Datatables */
    Route::get('employees_datatables', 'EmployeeController@list');
    Route::get('towers', 'EmployeeController@get');

    // Providers
    Route::get('fornecedores', 'ProviderController@index')->name('providers.index')->middleware('can:providers.index');
    Route::get('fornecedores/create', 'ProviderController@create')->name('providers.create')->middleware('can:providers.create');
    Route::post('fornecedores', 'ProviderController@store')->name('providers.store');
    Route::get('fornecedores/{provider}', 'ProviderController@show')->name('providers.show')->middleware('can:providers.show');
    Route::get('fornecedores/{provider}/edit', 'ProviderController@edit')->name('providers.edit')->middleware('can:providers.edit');
    Route::patch('fornecedores/{provider}', 'ProviderController@update')->name('providers.update')->middleware('can:providers.edit');
    Route::delete('fornecedores/{provider}', 'ProviderController@destroy')->name('providers.destroy')->middleware('can:providers.destroy');

    /** Datatables */
    Route::get('providers_datatables', 'ProviderController@list');

    // Towers
    Route::get('torres', 'TowerController@index')->name('towers.index')->middleware('can:towers.index');
    Route::get('torres/create', 'TowerController@create')->name('towers.create')->middleware('can:towers.create');
    Route::post('torres', 'TowerController@store')->name('towers.store');
    Route::get('torres/{tower}', 'TowerController@show')->name('towers.show')->middleware('can:towers.show');
    Route::get('torres/{tower}/edit', 'TowerController@edit')->name('towers.edit')->middleware('can:towers.edit');
    Route::patch('torres/{tower}', 'TowerController@update')->name('towers.update')->middleware('can:towers.edit');
    Route::delete('torres/{tower}', 'TowerController@destroy')->name('towers.destroy')->middleware('can:towers.destroy');

    /** Datatables */
    Route::get('towers_datatables', 'TowerController@list');

    // Environments
    Route::get('ambientes', 'EnvironmentController@index')->name('environments.index')->middleware('can:environments.index');
    Route::get('ambientes/create', 'EnvironmentController@create')->name('environments.create')->middleware('can:environments.create');
    Route::post('ambientes', 'EnvironmentController@store')->name('environments.store');
    Route::get('ambientes/{environment}', 'EnvironmentController@show')->name('environments.show')->middleware('can:environments.show');
    Route::get('ambientes/{environment}/edit', 'EnvironmentController@edit')->name('environments.edit')->middleware('can:environments.edit');
    Route::patch('ambientes/{environment}', 'EnvironmentController@update')->name('environments.update')->middleware('can:environments.edit');
    Route::delete('ambientes/{environment}', 'EnvironmentController@destroy')->name('environments.destroy')->middleware('can:environments.destroy');

    /** Datatables */
    Route::get('environments_datatables', 'EnvironmentController@list');

    // Servers
    Route::get('servidores', 'ServerController@index')->name('servers.index')->middleware('can:servers.index');
    Route::get('servidores/create', 'ServerController@create')->name('servers.create')->middleware('can:servers.create');
    Route::post('servidores', 'ServerController@store')->name('servers.store');
    Route::get('servidores/{server}', 'ServerController@show')->name('servers.show')->middleware('can:servers.show');
    Route::get('servidores/{server}/edit', 'ServerController@edit')->name('servers.edit')->middleware('can:servers.edit');
    Route::patch('servidores/{server}', 'ServerController@update')->name('servers.update');
    Route::delete('servidores/{server}', 'ServerController@destroy')->name('servers.destroy')->middleware('can:servers.destroy');

    /** Datatables */
    Route::get('servers_datatables', 'ServerController@list');
    Route::get('environments', 'ServerController@get');
});
