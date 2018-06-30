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

/*
|--------------------------------------------------------------------------
| NOTA
|--------------------------------------------------------------------------
| Si no tienes usuarios ni roles de usuario en la base de datos, saca del
| grupo las rutas de roles y usuarios. Por si no quieres hacerlo con tinker
| o desde phpMyAdmin y accede a ellas con su url correspondiente.
|
| Roles: http://localhost:8000/roles
| Usuarios: Roles: http://localhost:8000/users
*/

Route::group(['middleware' => ['auth']], function() {

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

});

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
