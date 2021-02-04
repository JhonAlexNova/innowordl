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
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});


Route::get('/',function(){
    return redirect('login');
});
Route::view('/inactivo','auth.inactivo');

Route::get('/pdf',function(){
    return view('pdf.factura');
});
Auth::routes();


Route::group(['prefix'=>'app', 'middleware'=>['auth','status']],function(){
    Route::get('/','AppController@index');
    Route::resource('/ciudad','CiudadController');
    Route::resource('/usuarios','UsuarioController');
    Route::resource('/detalles_asignacion','DetallesAsignacionController');
    Route::resource('/factura','FacturaController');
    Route::resource('/permiso','PermisoController');
});




