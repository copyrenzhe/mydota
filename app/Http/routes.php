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

/**
 * anbu debugger
 * @example
 *  Route::get('/', function()
 *  {
 *      //dump function
 *      ad('foo');
 *      ad('3');
 *      ad('30.33');
 *      ad(with(new stdClass)->foo = 'bar');
 *      ad(['name' => 'zhangsan', 'age' => 14]);
 *
 *      //timers
 *      Anbu::timers()->start('test');
 *      sleep(1); // Do something interesting.
 *      Anbu::timers()->end('test', 'Completed doing something.');
 *
 *      //db query
 *      \DB::table('anbu')->get();
 *
 *      //log entries
 *      \Log::info('another message');
 *      \Log::error('wrong message');
 *
 *      return View::make('hello');
 *  });
 */

/**
 *  Queue list
 *  @example
 *  Route::get('/queue',function(){
 *      Queue::push(function($job){
 *          File::append(app_path().'/tset.md','welcom'.PHP_EOL);
 *          $job->delete();
 *      });
 *      return 'job pushed';
 *  })
 */

/**
 * Route::get('mail',function(){
 *    $data = ['name' => 'maple'];
 *    Mail::send('emails.test',$data,function($message){
 *        $message->to('copyrenzhe@163.com')->subject("welcome! It's a test");
 *        $message->attach((public_path().'/css/all.css'));
 *    });
 *    return 'success';
 * });
 */

Route::get('/', ['as' => 'index.index', 'uses' => 'IndexController@index']);

Route::get('/home', ['as' => 'home.index', 'uses' => 'HomeController@index']);

Route::get('/search/{text}', ['as' => 'api.search', 'uses' => 'ApiController@search']);

/**
 * queue
 */
Route::group(['prefix' => 'queue'], function () {
    $controller = 'ApiController@';
    $resource = 'api';
    #matches
    Route::get('matches/{steamid?}', ['as' => $resource . 'gethistorymatches', 'uses' => $controller . 'getHistoryMatches']);
    #items
    Route::get('items', ['as' => $resource . 'getItemsWeb', 'uses' => $controller . 'getItemsWeb']);
    Route::get('test',function(){
    	return 'test';
    });

});

Route::get('test', 'ApiController@test');

Route::get('/match/info/{matchid}', ['as' => 'match.info', 'uses' => 'MatchController@info']);

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
