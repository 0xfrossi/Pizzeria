<?php

use Illuminate\Support\Facades\Route;

Route::get('admin/login','Auth\AdminAuthController@getLogin')->name('adminLogin');
Route::post('admin/login', 'Auth\AdminAuthController@postLogin')->name('adminLoginPost');
Route::get('admin/logout', 'Auth\AdminAuthController@logout')->name('adminLogout');

Route::group(['prefix' => 'admin','middleware' => 'adminauth'], function () {
	// Admin Dashboard
	Route::get('dashboard','AdminController@dashboard')->name('dashboard');	

     //   Route::resource('admin/pizzas', \App\Http\Controllers\PizzaAdminController::class);
     //   Route::resource('admin/ingredients', \App\Http\Controllers\IngredientAdminController::class);
     //   Route::resource('admin/drinks', \App\Http\Controllers\DrinkAdminController::class);
        
});

