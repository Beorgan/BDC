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


Route::get('/', function () {
    return file_get_contents(public_path().'/index.html');
});*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', 'HomeController@index')->name('home');
route::get ('/probleme/nouveau','ProblemController@create');
Route::post('probleme/enregistrer', 'ProblemController@store');
Route::get('Probleme/Consulter/{id}', 'ProblemController@consulter');
Route::post('solution/enregistrer', 'SolutionController@store');
Route::get('probleme/solution/{id}', 'SolutionController@create');
Route::post('upload', 'UploadController@upload');
Route::get('Probleme/Consulter/storage/{id}/{filename}', 'UploadController@upload');
Route::get ('probleme/update/{id}','ProblemController@edit');
Route::post ('/probleme/update/{id}','ProblemController@update');
Route::get('/probleme/delete/{id}','ProblemController@destroy');
Route::get ('probleme/{id}/solution/{id2}/update','SolutionController@edit');
Route::post ('probleme/{id}/solution/{id2}/update','SolutionController@update');
Route::get('/solution/delete/{id}','SolutionController@destroy');
Route::get('/admin','AdminController@index');
Route::get('admin/platforme/{id}/serveur/nouveau','AdminController@create');
Route::post('app/enregistrer', 'AppController@store');
Route::post('db/enregistrer', 'DbController@store');
Route::post('os/enregistrer', 'OsController@store');
Route::post('serveur/enregistrer', 'ServeurController@store');
Route::post('platforme/enregistrer', 'PlatformeController@store');
Route::get ('probleme/update/{id}','ProblemController@edit');
Route::get('/platforme/delete/{id}','PlatformeController@destroy');
Route::get('/admin/users','AdminController@show');
Route::post('/admin/users/update/{id}','AdminController@update');
Route::get('profile', 'userController@profile');
Route::post('profile', 'UserController@update_avatar');
Route::get('/admin/users/delete/{id}','AdminController@destroy');
Route::post('serveur/update/{id}', 'ServeurController@update');
Route::get('/serveur/delete/{id}','ServeurController@destroy');
Route::get('/problem/export/xls', 'ProblemController@export_xls');










Auth::routes();
