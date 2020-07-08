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
    Route::get('users', 'UserController@index')->name('users.index')->middleware('can:users.index');
    Route::get('users/create', 'UserController@create')->name('users.create')->middleware('can:users.create');
    Route::post('users', 'UserController@store')->name('users.store');
    Route::get('users/{id}', 'UserController@show')->name('users.show')->middleware('can:users.show');
    Route::get('users/{id}/edit', 'UserController@edit')->name('users.edit')->middleware('can:users.edit');
    Route::put('users/{id}', 'UserController@update')->name('users.update')->middleware('can:users.edit');
    Route::delete('users/{id}', 'UserController@destroy')->name('users.destroy')->middleware('can:users.destroy');

    /** All towers */
    Route::get('users-all', 'UserController@get');

    /** Datatables */
    Route::get('users_datatables', 'UserController@list');

    // Roles
    Route::get('roles', 'RoleController@index')->name('roles.index')->middleware('can:roles.index');
    Route::get('roles/create', 'RoleController@create')->name('roles.create')->middleware('can:roles.create');
    Route::post('roles', 'RoleController@store')->name('roles.store');
    Route::get('roles/{id}', 'RoleController@show')->name('roles.show')->middleware('can:roles.show');
    Route::get('roles/{id}/edit', 'RoleController@edit')->name('roles.edit')->middleware('can:roles.edit');
    Route::put('roles/{id}', 'RoleController@update')->name('roles.update');
    Route::delete('roles/{id}', 'RoleController@destroy')->name('roles.destroy')->middleware('can:roles.destroy');

    /** All Roles */
    Route::get('roles-all', 'RoleController@get');

    /** Datatables */
    Route::get('roles_datatables', 'RoleController@list');

    // Permissions
    Route::get('permissions', 'PermissionController@index')->name('permissions.index')->middleware('can:permissions.index');
    Route::get('permissions/create', 'PermissionController@create')->name('permissions.create')->middleware('can:permissions.create');
    Route::post('permissions', 'PermissionController@store')->name('permissions.store');
    Route::get('permissions/{id}', 'PermissionController@show')->name('permissions.show')->middleware('can:permissions.show');
    Route::get('permissions/{id}/edit', 'PermissionController@edit')->name('permissions.edit')->middleware('can:permissions.edit');
    Route::put('permissions/{id}', 'PermissionController@update')->name('permissions.update')->middleware('can:permissions.edit');
    Route::delete('permissions/{id}', 'PermissionController@destroy')->name('permissions.destroy')->middleware('can:permissions.destroy');

    /** All Permissions */
    Route::get('permissions-all', 'PermissionController@get');

    /** Datatables */
    Route::get('permissions_datatables', 'PermissionController@list');

    // Employees
    Route::get('employees', 'EmployeeController@index')->name('employees.index')->middleware('can:employees.index');
    Route::get('employees/create', 'EmployeeController@create')->name('employees.create')->middleware('can:employees.create');
    Route::post('employees', 'EmployeeController@store')->name('employees.store');
    Route::get('employees/{id}', 'EmployeeController@show')->name('employees.show')->middleware('can:employees.show');
    Route::get('employees/{id}/edit', 'EmployeeController@edit')->name('employees.edit')->middleware('can:employees.edit');
    Route::patch('employees/{id}', 'EmployeeController@update')->name('employees.update');
    Route::delete('employees/{id}', 'EmployeeController@destroy')->name('employees.destroy')->middleware('can:employees.destroy');

    /** All towers */
    Route::get('employees-all', 'EmployeeController@get');

    /** Datatables */
    Route::get('employees_datatables', 'EmployeeController@list');

    // Providers
    Route::get('providers', 'ProviderController@index')->name('providers.index')->middleware('can:providers.index');
    Route::get('providers/create', 'ProviderController@create')->name('providers.create')->middleware('can:providers.create');
    Route::post('providers', 'ProviderController@store')->name('providers.store');
    Route::get('providers/{id}', 'ProviderController@show')->name('providers.show')->middleware('can:providers.show');
    Route::get('providers/{id}/edit', 'ProviderController@edit')->name('providers.edit')->middleware('can:providers.edit');
    Route::patch('providers/{id}', 'ProviderController@update')->name('providers.update')->middleware('can:providers.edit');
    Route::delete('providers/{id}', 'ProviderController@destroy')->name('providers.destroy')->middleware('can:providers.destroy');

    /** All towers */
    Route::get('providers-all', 'ProviderController@get');

    /** Datatables */
    Route::get('providers_datatables', 'ProviderController@list');

    // Towers
    Route::get('towers', 'TowerController@index')->name('towers.index')->middleware('can:towers.index');
    Route::get('towers/create', 'TowerController@create')->name('towers.create')->middleware('can:towers.create');
    Route::post('towers', 'TowerController@store')->name('towers.store');
    Route::get('towers/{id}', 'TowerController@show')->name('towers.show')->middleware('can:towers.show');
    Route::get('towers/{id}/edit', 'TowerController@edit')->name('towers.edit')->middleware('can:towers.edit');
    Route::patch('towers/{id}', 'TowerController@update')->name('towers.update')->middleware('can:towers.edit');
    Route::delete('towers/{id}', 'TowerController@destroy')->name('towers.destroy')->middleware('can:towers.destroy');

    /** All towers */
    Route::get('towers-all', 'TowerController@get');

    /** Datatables */
    Route::get('towers_datatables', 'TowerController@list');

    // Environments
    Route::get('environments', 'EnvironmentController@index')->name('environments.index')->middleware('can:environments.index');
    Route::get('environments/create', 'EnvironmentController@create')->name('environments.create')->middleware('can:environments.create');
    Route::post('environments', 'EnvironmentController@store')->name('environments.store');
    Route::get('environments/{id}', 'EnvironmentController@show')->name('environments.show')->middleware('can:environments.show');
    Route::get('environments/{id}/edit', 'EnvironmentController@edit')->name('environments.edit')->middleware('can:environments.edit');
    Route::patch('environments/{id}', 'EnvironmentController@update')->name('environments.update')->middleware('can:environments.edit');
    Route::delete('environments/{id}', 'EnvironmentController@destroy')->name('environments.destroy')->middleware('can:environments.destroy');

    /** All environments */
    Route::get('environments-all', 'EnvironmentController@get');

    /** Datatables */
    Route::get('environments_datatables', 'EnvironmentController@list');

    // Servers
    Route::get('servers', 'ServerController@index')->name('servers.index')->middleware('can:servers.index');
    Route::get('servers/create', 'ServerController@create')->name('servers.create')->middleware('can:servers.create');
    Route::post('servers', 'ServerController@store')->name('servers.store');
    Route::get('servers/{id}', 'ServerController@show')->name('servers.show')->middleware('can:servers.show');
    Route::get('servers/{id}/edit', 'ServerController@edit')->name('servers.edit')->middleware('can:servers.edit');
    Route::patch('servers/{id}', 'ServerController@update')->name('servers.update');
    Route::delete('servers/{id}', 'ServerController@destroy')->name('servers.destroy')->middleware('can:servers.destroy');

    /** All towers */
    Route::get('servers-all', 'ServerController@get');

    /** Datatables */
    Route::get('servers_datatables', 'ServerController@list');

    // Databases
    Route::get('databases', 'DatabaseController@index')->name('databases.index')->middleware('can:databases.index');
    Route::get('databases/create', 'DatabaseController@create')->name('databases.create')->middleware('can:databases.create');
    Route::post('databases', 'DatabaseController@store')->name('databases.store');
    Route::get('databases/{id}', 'DatabaseController@show')->name('databases.show')->middleware('can:databases.show');
    Route::get('databases/{id}/edit', 'DatabaseController@edit')->name('databases.edit')->middleware('can:databases.edit');
    Route::patch('databases/{id}', 'DatabaseController@update')->name('databases.update');
    Route::delete('databases/{id}', 'DatabaseController@destroy')->name('databases.destroy')->middleware('can:databases.destroy');

    /** Datatables */
    Route::get('databases_datatables', 'DatabaseController@list');

    // Applications
    Route::get('applications', 'ApplicationController@index')->name('applications.index')->middleware('can:applications.index');
    Route::get('applications/create', 'ApplicationController@create')->name('applications.create')->middleware('can:applications.create');
    Route::post('applications', 'ApplicationController@store')->name('applications.store');
    Route::get('applications/{id}', 'ApplicationController@show')->name('applications.show')->middleware('can:applications.show');
    Route::get('applications/{id}/edit', 'ApplicationController@edit')->name('applications.edit')->middleware('can:applications.edit');
    Route::patch('applications/{id}', 'ApplicationController@update')->name('applications.update');
    Route::delete('applications/{id}', 'ApplicationController@destroy')->name('applications.destroy')->middleware('can:applications.destroy');

    /** All Applications */
    Route::get('applications-all', 'ApplicationController@get');

    /** Datatables */
    Route::get('applications_datatables', 'ApplicationController@list');

    // Services
    Route::get('services', 'ServiceController@index')->name('services.index')->middleware('can:services.index');
    Route::get('services/create', 'ServiceController@create')->name('services.create')->middleware('can:services.create');
    Route::post('services', 'ServiceController@store')->name('services.store');
    Route::get('services/{id}', 'ServiceController@show')->name('services.show')->middleware('can:services.show');
    Route::get('services/{id}/edit', 'ServiceController@edit')->name('services.edit')->middleware('can:services.edit');
    Route::patch('services/{id}', 'ServiceController@update')->name('services.update');
    Route::delete('services/{id}', 'ServiceController@destroy')->name('services.destroy')->middleware('can:services.destroy');

    /** Datatables */
    Route::get('services_datatables', 'ServiceController@list');

    // Integrations
    Route::get('integrations', 'IntegrationController@index')->name('integrations.index')->middleware('can:integrations.index');
    Route::get('integrations/create', 'IntegrationController@create')->name('integrations.create')->middleware('can:integrations.create');
    Route::post('integrations', 'IntegrationController@store')->name('integrations.store');
    Route::get('integrations/{id}', 'IntegrationController@show')->name('integrations.show')->middleware('can:integrations.show');
    Route::get('integrations/{id}/edit', 'IntegrationController@edit')->name('integrations.edit')->middleware('can:integrations.edit');
    Route::patch('integrations/{id}', 'IntegrationController@update')->name('integrations.update');
    Route::delete('integrations/{id}', 'IntegrationController@destroy')->name('integrations.destroy')->middleware('can:integrations.destroy');

    /** Datatables */
    Route::get('integrations_datatables', 'IntegrationController@list');

    // Contacts
    Route::get('contacts', 'ContactController@index')->name('contacts.index')->middleware('can:contacts.index');
    Route::get('contacts/create', 'ContactController@create')->name('contacts.create')->middleware('can:contacts.create');
    Route::post('contacts', 'ContactController@store')->name('contacts.store');
    Route::get('contacts/{id}', 'ContactController@show')->name('contacts.show')->middleware('can:contacts.show');
    Route::get('contacts/{id}/edit', 'ContactController@edit')->name('contacts.edit')->middleware('can:contacts.edit');
    Route::patch('contacts/{id}', 'ContactController@update')->name('contacts.update');
    Route::delete('contacts/{id}', 'ContactController@destroy')->name('contacts.destroy')->middleware('can:contacts.destroy');

    /** Datatables */
    Route::get('contacts_datatables', 'ContactController@list');


    Route::get('/', function () {
        return redirect()->route('home');
    });

    Route::get('my-app/{id}', 'HomeController@myApp');
});
