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
    //return view('welcome');
    return view('layouts.general');
});

// Roles de usuario.
Route::resource('roles', 'RolController');

// Docentes.
Route::resource('docentes', 'DocenteController');

// Usuarios.
Route::resource('users', 'UserController');

// Materias.
Route::resource('materias', 'MateriaController');

//Nivel Educativo
Route::resource('nivel', 'NivelEducativoController');

// Grados
Route::resource('grados', 'GradoController');

// Años
Route::resource('anios','AnioController');

//Jornada laboral
Route::resource('jornadas','JornadaController'); 

// Vista de la Pagina Reportes
Route::get('reportes', function(){
	return view('pdf.principal');
})->name('reportes');

// Para descargar PDF de Grados
Route::get('descargar/grados', 'GradoController@pdf')->name('grados.pdf');

// Para descargar PDF de Docentes
Route::get('descargar/docentes', 'DocenteController@pdf')->name('docentes.pdf');

// Para descargar PDF de niveles
Route::get('descargar/niveles', 'NivelEducativoController@pdf')->name('nivel.pdf');

// Para descargar PDF de MAterias
Route::get('descargar/materias', 'MateriaController@pdf')->name('materias.pdf');

// Para descargar PDF de Jornadas Laborales
Route::get('descargar/jornadas', 'JornadaController@pdf')->name('jornadas.pdf');
