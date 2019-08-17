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

Route::get('/home', 'RecipeController@index')->name('home');
Route::get('/create', 'RecipeController@create')->name('create');
Route::post('/createrecipe', 'RecipeController@createRecipe')->name('createrecipe');
Route::post('/editrecipe', 'RecipeController@storeRecipe')->name('editrecipe');
Route::get('/edit', 'RecipeController@editRecipe')->name('create');
Route::get('/view', 'RecipeController@viewRecipe')->name('view');
Route::get('/del', 'RecipeController@delRecipe')->name('del');
Route::get('/ingredients', 'ingridientsController@allIngridients')->name('allingridients');
Route::get('/', 'home@getAllRecipe')->name('allrecipe');

