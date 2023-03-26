<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// App v1.0.0 API
Route::group([
    'namespace'  => '\App\Http\Controllers'
], function ($router) {
	Route::get('all', 'Web\InstitucionalController@index');
    Route::get('arquivo/{arq_id}/show', 'Geral\ArquivoController@show');
    Route::post('contato', 'Web\ContatoController@faleconosco');
});
