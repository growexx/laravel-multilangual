<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LangController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/{id}/edit', [ LangController::class, 'edit' ]);
// Route::resource('/', LangController::class );
Route::get('change/lang', [ LangController::class, 'change' ])->name('changeLang');

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::resource('companies', LangController::class );
});
