<?php

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


Route::group(['prefix' => 'admin',['middleware' => 'web'],'namespace' => 'Admin'],function ($router)
{
    $router->get('index', 'AdminController@index')->middleware('auth.admin:admin')->name('admin.system');
    $router->get('login', 'LoginController@showLogin')->name('admin.login');
    $router->post('login', 'LoginController@login');
    $router->get('logout', 'LoginController@logout')->name('admin.loginout');
    //内容管理
    Route::get('content','ContentController@index')->name('content');

    //版本管理
    Route::get('version','VersionController@index')->name('version');
    Route::get('addversion','VersionController@create')->name('version.add');
    Route::post('addversion','VersionController@store');
    Route::get('updateversion/{id}','VersionController@edit')->name('version.update');
    Route::post('updateversion/{id}','VersionController@update');

    //用户管理页
    Route::get('system','UserController@white')->name('system');
    //用户
    Route::get('system/user','UserController@index')->name('user');
    Route::get('system/adduser','UserController@create')->name('user.add');
    Route::post('system/storeuser','UserController@store')->name('user.store');
    Route::get('system/edituser/{id}','UserController@edit')->name('user.edit');
    Route::post('system/updateuser/{id}','UserController@update')->name('user.update');
    Route::get('system/deleteuser/{id}','UserController@delete')->name('user.delete');

    //角色
    Route::get('system/role','RoleController@index')->name('role');
    Route::get('system/createrole','RoleController@create')->name('role.create');
    Route::post('system/storerole','RoleController@store')->name('role.store');
    Route::get('system/editrole/{id}','RoleController@edit')->name('role.edit');
    Route::post('system/updaterole/{id}','RoleController@update')->name('role.update');
    Route::get('system/deleterole/{id}','RoleController@delete')->name('role.delete');

});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
