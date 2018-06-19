<?php

use App\Artigo;
use Illuminate\Http\Request;

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

Route::get('/', function (Request $request) {
	if(isset($request->busca) && $request->busca != ""){
		$busca = $request->busca;
		$artigos = Artigo::busca(6, $busca);
	}else{
		$artigos = Artigo::artigos(6);
		$busca = "";
	}

	// $artigos = Artigo::artigos(6);
    return view('site', compact('artigos', 'busca'));
});

Route::get('/artigo/{id}/{title?}', function ($id) {
	$artigo = Artigo::find($id);
	if($artigo){
		return view('artigo', compact('artigo'));
	}else{
		return back();
	}

})->name('artigo');

Auth::routes();

Route::get('/admin', 'AdminController@index')->name('admin')->middleware('can:isAutor');

Route::middleware(['auth'])->prefix('admin')->namespace('Admin')->group(function() {

	Route::resource('artigos', 'ArtigoController')->middleware('can:isAutor');
	Route::resource('users', 'UserController')->middleware('can:isAdmin');
	Route::resource('authors', 'AuthorController')->middleware('can:isAdmin');
	Route::resource('/admin', 'AdminController')->middleware('can:isAdmin');
});
