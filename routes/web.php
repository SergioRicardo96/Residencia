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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//clinica
Route::middleware(['auth', 'admin'])->namespace('Web\Admin')->group(function () 
{
	Route::get('/clinicas', 'ClinicaController@index');
	Route::get('/clinicas/create', 'ClinicaController@create');		//form registro
	Route::get('/clinicas/{clinica}/edit', 'ClinicaController@edit');	
	Route::post('/clinicas', 'ClinicaController@store');				//envio del form
	Route::put('/clinicas/{clinica}', 'ClinicaController@update');
	Route::delete('/clinicas/{clinica}', 'ClinicaController@destroy');

	//Especialidad
	Route::resource('especialidades', 'EspecialidadeController');

	//Odontologos
	Route::resource('odontologos','OdontologoController');

	//recepcionista
	Route::resource('recepcionistas','RecepcionistaController');

	//Administradores
	Route::resource('administradores','AdministradorController');
});
