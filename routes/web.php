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
    Route::post('usuarios', 'UserController@store')->name('users.store')->middleware('can:users.create');
    Route::get('usuarios/{user}', 'UserController@show')->name('users.show')->middleware('can:users.show');
    Route::get('usuarios/{user}/edit', 'UserController@edit')->name('users.edit')->middleware('can:users.edit');
    Route::put('usuarios/{user}', 'UserController@update')->name('users.update')->middleware('can:users.edit');
    Route::delete('usuarios/{user}', 'UserController@destroy')->name('users.destroy')->middleware('can:users.destroy');

    /** Datatables */
    Route::get('users_datatables', 'UserController@list');

    // Roles
    Route::get('papeis', 'RoleController@index')->name('roles.index')->middleware('can:roles.index');
    Route::get('papeis/create', 'RoleController@create')->name('roles.create')->middleware('can:roles.create');
    Route::post('papeis', 'RoleController@create')->name('roles.create')->middleware('can:roles.create');
    Route::get('papeis/{role}', 'RoleController@show')->name('roles.show')->middleware('can:roles.show');
    Route::get('papeis/{role}/edit', 'RoleController@edit')->name('roles.edit')->middleware('can:roles.edit');
    Route::put('papeis/{role}', 'RoleController@update')->name('roles.update')->middleware('can:roles.edit');
    Route::delete('papeis/{role}', 'RoleController@destroy')->name('roles.destroy')->middleware('can:roles.destroy');

    // Permissions
    Route::get('permissoes', 'PermissionController@index')->name('permissions.index')->middleware('can:permissions.index');
    Route::get('permissoes/create', 'PermissionController@create')->name('permissions.create')->middleware('can:permissions.create');
    Route::post('permissoes', 'PermissionController@create')->name('permissions.create')->middleware('can:permissions.create');
    Route::get('permissoes/{role}', 'PermissionController@show')->name('permissions.show')->middleware('can:permissions.show');
    Route::get('permissoes/{role}/edit', 'PermissionController@edit')->name('permissions.edit')->middleware('can:permissions.edit');
    Route::put('permissoes/{role}', 'PermissionController@update')->name('permissions.update')->middleware('can:permissions.edit');
    Route::delete('permissoes/{role}', 'PermissionController@destroy')->name('permissions.destroy')->middleware('can:permissions.destroy');
});
