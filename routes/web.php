<?php

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



// paypal: sb-pbd43x11810507@personal.example.com     pass: qwerty1234
//pass: admin1234
// francesco@gmail.com pass: francesco

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['lang']], function () {
Route::get('/', 'App\Http\Controllers\frontController@getHome')->name('home');
Route::get('/Le-nostre-pizze',  'App\Http\Controllers\PizzaController@getPizze')->name('pizza.index');
Route::get('/Contatti',  'App\Http\Controllers\frontController@getContatti')->name('contatti');
Route::get('/lang/{lang}', ['as' => 'setLang','uses' => 'App\Http\Controllers\LangController@changeLanguage']);
Auth::routes();
 
});

Route::group(['middleware' => ['lang', 'auth']], function () {
    
    Route::post('/Add-to-cart',  'App\Http\Controllers\cartController@addToCartPizza');
    Route::post('/remove-from-cart/{id}',  'App\Http\Controllers\cartController@removeElement')->name('removeElem');
    Route::get('/Cart',  'App\Http\Controllers\cartController@getCart')->name('cart');
    Route::post('/Add-to-cart-drink',  'App\Http\Controllers\cartController@addToCartDrink');             
    Route::post('/Store-order',  'App\Http\Controllers\cartController@storeOrder')->name('storeOrder');  
    Route::get('/Miei-ordini',  'App\Http\Controllers\OrderController@userOrders')->name('mieiOrdini');
    Route::get('/Svuota-cart',  'App\Http\Controllers\cartController@removeAll')->name('eliminaCart');
    
});

//Route::get('/admin/add/pizza', 'App\Http\Controllers\AdminController@addPizza')->name('pizza.add');
//Route::get('/admin/add/ingrediente', 'App\Http\Controllers\AdminController@addIng')->name('ing.add');
//Route::get('/admin/add/Bevanda', 'App\Http\Controllers\AdminController@addBevanda')->name('bere.add');

//Route::get('/admin/pizze', 'App\Http\Controllers\AdminController@getPizze')->name('admin.pizze');
//Route::get('/admin/ingredienti', 'App\Http\Controllers\AdminController@getIngredients')->name('admin.ing');



//***** Spostate in auth admin *****

//Route::resource('admin/pizzas', \App\Http\Controllers\PizzaAdminController::class);
//Route::resource('admin/ingredients', \App\Http\Controllers\IngredientAdminController::class);
//Route::resource('admin/drinks', \App\Http\Controllers\DrinkAdminController::class);

  Route::get('/check-ingredient','App\Http\Controllers\IngredientAdminController@checkIngredientUsed');    
  Route::prefix('admin')->name('admin.')->group(function(){
    
    Route::middleware(['guest:admin'])->group(function(){
        Route::view('/login', 'auth.admin.login')->name('login');     
        Route::post('/check','App\Http\Controllers\AdminController@check')->name('check');      
    });

    Route::middleware(['auth:admin'])->group(function(){
        Route::view('/home', 'auth.admin.home')->name('home');
        Route::post('/logout','App\Http\Controllers\AdminController@logout')->name('logout');
        Route::get('/pizza-nascondi','App\Http\Controllers\AjaxAdminController@cambiaDisponibilita'); //->name('pizzaDisp');  
        Route::get('/drink-nascondi','App\Http\Controllers\AjaxAdminController@cambiaDisponibilitaDrink'); 
        Route::get('/ing-nascondi','App\Http\Controllers\AjaxAdminController@cambiaDisponibilitaIng'); 
        Route::resource('pizzas', \App\Http\Controllers\PizzaAdminController::class);
        Route::resource('ingredients', \App\Http\Controllers\IngredientAdminController::class);     
        Route::resource('drinks', \App\Http\Controllers\DrinkAdminController::class);
       
         });
    
    
});    


