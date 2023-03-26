<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// App v1.0.0 API
Route::group([
    'namespace'  => '\App\Http\Controllers'
], function ($router) {
	Route::post('login', 'Usuario\OnboardingController@login');

	Route::group(['middleware' => ['auth']], function() {
		Route::resource(
		    'usuario',
		    'Usuario\OnboardingController',
		    ['only' => ['index', 'show', 'store', 'update']]
		);
	});

	Route::group(['middleware' => ['auth']], function() {
		Route::resource(
		    'problema',
		    'Problema\ProblemaController',
		    ['only' => ['index', 'show', 'store', 'update']]
		);
	});
	Route::post('problema/comentario', 'Problema\ProblemaController@comentario');
	Route::get('problema/relatorio/gerar', 'Problema\ProblemaController@relatorio');
	Route::get('problema/{id}/relatorio/gerar', 'Problema\ProblemaController@relatorioDetalhe');

	Route::group(['middleware' => ['auth']], function() {
		Route::resource(
		    'locais',
		    'Locais\LocaisController',
		    ['only' => ['index', 'show', 'store', 'update']]
		);
	});

	Route::group(['middleware' => ['auth']], function() {
		Route::resource(
		    'institucional',
		    'Web\InstitucionalController',
		    ['only' => ['index', 'show', 'store']]
		);
		Route::post('institucional/{id}', 'Web\InstitucionalController@update');
	});

});
