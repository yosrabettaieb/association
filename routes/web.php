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

use App\Membre;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/membres/form', function () {
    return view('membres.form');
});
Route::get('/table', function () {
    return view('table');
});

Route::get('/auth/login', function () {
    return view('auth.login');
});

Route::get('/auth/register', function () {
    return view('auth.register');
});

Route::get('/error-404', function () {
    return view('error-404');
});

Route::get('/error-500', function () {
    return view('error-500');
});

Route::get('/chart', function () {
    return view('chart');
});
Route::get('/profil','MembreController@editprofil');
Route::put('/updateprofil','MembreController@updateprofil');

Route::resource('documentSideBar','DocumentsController');
Route::resource('DocumentFinanciere','DocumentsfinancieresController');
Route::resource('revenu','RevenusController');
Route::resource('depense','DepensesController');

Route::get('download/{id}','DocumentsController@download');
Route::get('downloadf/{id}','DocumentsfinancieresController@download');

Route::get('show/{id}','DocumentsController@show');
Route::get('showf/{id}','DocumentsfinancieresController@show');
Route::get('showRev/{id}','RevenusController@show');
Route::get('showDep/{id}','DepensesController@show');

Route::put('/update/{id}','DocumentsController@update');
Route::put('/updatef/{id}','DocumentsfinancieresController@update');
Route::put('/updateRev','RevenusController@update');
Route::put('/updateDep','DepensesController@update');

Route::resource('membres', 'MembreController');
Route::get('/membres/form', 'MembreController@index');
Route::get('/show/{id}', 'MembreController@show');
Route::patch('/membres/{id}', 'MembreController@update');

Route::get('showImage/{id}', function($id) {
    $membre = Membre::findOrFail($id);

    $file = storage_path($membre->photo);

    return response()->file($file);
});

