<?php
use App\Http\Controllers\MedicamentController;

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
Route::get('/home', function () {
    return view('home');
})->name('home');

Route::resource('laboratory', 'LaboratoryController');
Route::get('select-laboratory', 'LaboratoryController@autocomplete');
Route::resource('customer', 'CustomerController');
Route::get('select-customer', 'CustomerController@autocomplete');
Route::resource('sale', 'SaleController');
Route::get('sale/search/{date?}', 'SaleController@indexByDate')->name('sale.search');
Route::resource('inventory', 'InventoryController');
Route::get('select-inventory', 'InventoryController@autocomplete');
Route::get('select-inventory/{id_medicament}', 'InventoryController@getInventoryByIdMedicament');
Route::get('inventory/search/{option}', 'InventoryController@search')->name('inventory.search');
Route::get('options-inventory/{id_active}', 'InventoryController@getInventoriesByPrincipleActive');
Route::resource('medicament', 'MedicamentController');
Route::get('select-medicament', 'MedicamentController@autocomplete');
Route::resource('laboratory', 'LaboratoryController');
Route::resource('principle', 'ActivePrinciplesController');
Route::get('select-principle', 'ActivePrinciplesController@autocomplete');
Route::post('save_customer', 'CustomerController@ajaxStore');
Route::post('/save_laboratory', 'LaboratoryController@ajaxStore');
Route::post('/save_active', 'ActivePrinciplesController@ajaxStore');
Route::resource('expense', 'ExpenseController');
Route::get('expense/search/{date?}', 'ExpenseController@indexByDate')->name('expense.search');

// Users:
Route::get('/users', 'OtherUserController@index')->name('user.index');
Route::get('/users/create', 'OtherUserController@create')->name('user.create');
Route::post('/users', 'OtherUserController@store')->name('user.store');
Route::delete('/users/{id}', 'OtherUserController@destroy')->name('user.destroy');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
