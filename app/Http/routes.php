<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/', ['as' => 'index.index', 'uses' => 'IndexController@index']);

Route::get('/home', ['as' => 'home.index', 'uses' => 'HomeController@index']);

Route::get('/search/{text}', ['as' => 'api.search', 'uses' => 'ApiController@search']);

Route::get('/history/{steamid?}', ['as' => 'api.gethistorymatches', 'uses' => 'ApiController@getHistoryMatches']);

Route::get('/match/info/{matchid}',['as' => 'match.info', 'uses' => 'MatchController@info']);

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
    'api' => 'ApiController',
]);



