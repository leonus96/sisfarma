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
Route::resource('inventory', 'InventoryController');
Route::get('select-inventory', 'InventoryController@autocomplete');
Route::resource('medicament', 'MedicamentController');
Route::get('select-medicament', 'MedicamentController@autocomplete');
Route::resource('laboratory', 'LaboratoryController');
Route::resource('principle', 'ActivePrinciplesController');
Route::get('select-principle', 'ActivePrinciplesController@autocomplete');
Route::post('save_customer', 'CustomerController@ajaxStore');
Route::post('/save_laboratory', 'LaboratoryController@ajaxStore');
Route::post('/save_active', 'ActivePrinciplesController@ajaxStore');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
