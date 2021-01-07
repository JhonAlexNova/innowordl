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
Route::get('/',function(){
	return redirect('login');
});
Auth::routes();


Route::group(['prefix'=>'app'],function(){
    Route::get('/','AppController@index');
    Route::resource('/ciudad','CiudadController');
    Route::resource('/usuarios','UsuarioController');
    Route::resource('/detalles_asignacion','DetallesAsignacionController');
    Route::resource('factura','FacturaController');
});





/*===========================================*/
//Clear Route cache:
Route::get('/route-clear', function() {
    return '<h1>Route cache cleared</h1>';
});
Route::get('/view-clear', function() { 
    return '<h1>View cache cleared</h1>';
});
Route::get('/config-cache', function() {
    return '<h1>Clear Config cleared</h1>';
});