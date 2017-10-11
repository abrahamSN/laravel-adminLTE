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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    //ini adalah route buat user
    Route::get('/user', ['uses' => 'UserController@index', 'middleware' => ['permission:user-view']]);
    Route::get('/user/tambah', ['uses' => 'UserController@create', 'middleware' => ['permission:user-create']]);
    Route::post('/user/store', ['uses' => 'UserController@store', 'middleware' => ['permission:user-create']]);
    Route::get('/user/edit/{id}', ['uses' => 'UserController@edit', 'middleware' => ['permission:user-edit']]);
    Route::post('/user/update/{id}', ['uses' => 'UserController@update', 'middleware' => ['permission:user-edit']]);
    Route::get('/user/hapus/{id}', ['uses' => 'UserController@destroy', 'middleware' => ['permission:user-delete']]);
    Route::get('/user/makeuserrole/{user}/{role}', ['uses' => 'UserController@makeUserRole', 'middleware' => ['permission:user-edit']]);
    Route::get('/user/deleuserrole/{user}/{role}', ['uses' => 'UserController@deleUserRole', 'middleware' => ['permission:user-edit']]);

    //ini adalah route buat permission
    Route::get('/permission', ['uses' => 'PermissionController@index', 'middleware' => ['permission:permission-view']]);
    Route::get('/permission/tambah', ['uses' => 'PermissionController@create', 'middleware' => ['permission:permission-create']]);
    Route::post('/permission/store', ['uses' => 'PermissionController@store', 'middleware' => ['permission:permission-create']]);
    Route::get('/permission/edit/{id}', ['uses' => 'PermissionController@edit', 'middleware' => ['permission:permission-edit']]);
    Route::post('/permission/update/{id}', ['uses' => 'PermissionController@update', 'middleware' => ['permission:permission-edit']]);
    Route::get('/permission/hapus/{id}', ['uses' => 'PermissionController@destroy', 'middleware' => ['permission:permission-delete']]);
    Route::get('/permission/makepermirole/{perm}/{role}', ['uses' => 'PermissionController@makePermiRole', 'middleware' => ['permission:permission-edit']]);
    Route::get('/permission/delepermirole/{perm}/{role}', ['uses' => 'PermissionController@delePermiRole', 'middleware' => ['permission:permission-edit']]);

    //ini adalah route buat role
    Route::get('/role', ['uses' => 'RoleController@index', 'middleware' => ['permission:role-view']]);
    Route::get('/role/tambah', ['uses' => 'RoleController@create', 'middleware' => ['permission:role-create']]);
    Route::post('/role/store', ['uses' => 'RoleController@store', 'middleware' => ['permission:role-create']]);
    Route::get('/role/edit/{id}', ['uses' => 'RoleController@edit', 'middleware' => ['permission:role-edit']]);
    Route::post('/role/update/{id}', ['uses' => 'RoleController@update', 'middleware' => ['permission:role-edit']]);
    Route::get('/role/hapus/{id}', ['uses' => 'RoleController@destroy', 'middleware' => ['permission:role-delete']]);

    //ini adalah route buat product
    Route::get('/product', ['uses' => 'ProductController@index', 'middleware' => ['permission:product-view']]);
    Route::get('/product/tambah', ['uses' => 'ProductController@create', 'middleware' => ['permission:product-create']]);
    Route::post('/product/store', ['uses' => 'ProductController@store', 'middleware' => ['permission:product-create']]);
    Route::get('/product/edit/{id}', ['uses' => 'ProductController@edit', 'middleware' => ['permission:product-edit']]);
    Route::post('/product/update/{id}', ['uses' => 'ProductController@update', 'middleware' => ['permission:product-edit']]);
    Route::get('/product/hapus/{id}', ['uses' => 'ProductController@destroy', 'middleware' => ['permission:product-delete']]);

    //ini adalah route buat keluhan
    Route::get('/keluhan', ['uses' => 'KeluhanController@index', 'middleware' => ['permission:keluhan-view']]);
    Route::get('/keluhan/tambah', ['uses' => 'KeluhanController@create', 'middleware' => ['permission:keluhan-create']]);
    Route::post('/keluhan/store', ['uses' => 'KeluhanController@store', 'middleware' => ['permission:keluhan-create']]);
    Route::get('/keluhan/edit/{id}', ['uses' => 'KeluhanController@edit', 'middleware' => ['permission:keluhan-edit']]);
    Route::post('/keluhan/update/{id}', ['uses' => 'KeluhanController@update', 'middleware' => ['permission:keluhan-edit']]);
    Route::get('/keluhan/hapus/{id}', ['uses' => 'KeluhanController@destroy', 'middleware' => ['permission:keluhan-delete']]);
    Route::get('/keluhan/kerjakan/{id}', ['uses' => 'KeluhanController@kerja', 'middleware' => ['permission:keluhan-kerjakan']]);
    Route::get('/keluhan/dislike/{id}', ['uses' => 'KeluhanController@dislike', 'middleware' => ['permission:keluhan-rate']]);
    Route::get('/keluhan/like/{id}', ['uses' => 'KeluhanController@like', 'middleware' => ['permission:keluhan-rate']]);
    Route::get('/keluhan/pdf/{id}', ['uses' => 'KeluhanController@pdf', 'middleware' => ['permission:keluhan-view']]);

});