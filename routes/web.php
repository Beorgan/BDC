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

// Home 
Route::get('/home', 'HomeController@index')->name('home');

// Probleme routes
route::get ('/probleme/nouveau','ProblemController@create');             // Interface nouveau probleme (resources/view/problem/Create.blade.php)
Route::post('probleme/enregistrer', 'ProblemController@store');          // Enregistrer nouveau probleme 
Route::get('Probleme/Consulter/{id}', 'ProblemController@consulter');    // Interface consulter probleme (resources/view/problem/Show.blade.php)
Route::post ('/probleme/update/{id}','ProblemController@update');        // Interface Mise a jour probleme (resources/view/problem/Update.blade.php)
Route::get ('probleme/update/{id}','ProblemController@edit');            // Enregistrer mise a jour probleme
Route::get('/probleme/delete/{id}','ProblemController@destroy');         // Supprimer un probleme
Route::get('Probleme/Consulter/storage/{id}/{filename}', 'UploadController@upload'); // lien recuperation du fichier d'attachement

// Solution routes
Route::get('probleme/solution/{id}', 'SolutionController@create');       // Interface nouvelle solution (resources/view/Solution/new.blade.php)
Route::post('solution/enregistrer', 'SolutionController@store');         // Enregistrer Solution
Route::post ('probleme/{id}/solution/{id2}/update','SolutionController@update');//Interface MAJ solution (resources/view/Solution/Update.blade.php)
Route::get ('probleme/{id}/solution/{id2}/update','SolutionController@edit');  // Enregistrer mise a jour solution
Route::get('/solution/delete/{id}','SolutionController@destroy');        // Supprimer Solution

// Platform routes
Route::post('platforme/enregistrer', 'PlatformeController@store');       // Enregistrer nouvelle platforme
Route::get('/platforme/delete/{id}','PlatformeController@destroy');      // Supprimer nouvelle platforme

// Server routes
Route::post('serveur/enregistrer', 'ServeurController@store');            // Enregistrer nouveau serveur
Route::post('serveur/update/{id}', 'ServeurController@update');           // Mettre a jour serveur
Route::get('/serveur/delete/{id}','ServeurController@destroy');           // Supprimer serveur

// Administration routes
Route::get('/admin','AdminController@index');                  // Afficher l'administration des tables (resources/view/Config/Administration.blade.php)
Route::get('/admin/users','AdminController@show');             // Afficher l'administration des utilisateurs (resources/view/Config/UserGest.blade.php)
Route::post('/admin/users/update/{id}','AdminController@update');   // Mettre a jour le role de l'utilisateur
Route::get('/admin/users/delete/{id}','AdminController@destroy');   // Supprimer l'utilisateur

// Profile routes
Route::get('profile', 'userController@profile');                // Afficher la vue du profile (resources/view/User.blade.php)
Route::post('profile', 'UserController@update_avatar');			// Mettre a jour la photo de profile de l'utilisateur
Route::post('upload', 'UploadController@upload');				// Sauvegarde et reccuperation de l'image du profile

// Export en cours de construction
Route::get('/problem/export/xls', 'ProblemController@export_xls');










Auth::routes();
