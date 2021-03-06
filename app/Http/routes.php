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

Route::get('mail',function(){
    $data = ['name' => 'maple'];
    Mail::send('emails.subscribe',$data,function($message){
        $message->to('copyrenzhe@163.com')->subject("DOTA2每周战绩");
        $message->attach((public_path().'/css/app.css'));
    });
    return 'success';
});



Route::get('/', ['as' => 'index.index', 'uses' => 'IndexController@index']);

Route::get('/home', ['as' => 'home.index', 'uses' => 'HomeController@index']);


// Route::get('/search/{text}', ['as' => 'api.search', 'uses' => 'ApiController@search']);
Route::get('/search/{text}',['as' => 'index.search', 'uses' => 'IndexController@search']);

/**
 * players
 */
Route::group(['prefix' => 'player'],function(){
    $controller = 'PlayerController@';
    $resource = 'player.';
    #player detail
    Route::get('detail/{account_id}',['as'=>$resource.'detail','uses'=>$controller.'index']);
    #player history
    Route::get('history',['as'=>$resource.'history','uses'=>$controller.'history']);
});


/**
 * heroes
 */
Route::group(['prefix' => 'hero'],function(){
    $controller = 'HeroController@';
    $resource = 'hero.';
    #hero list
    Route::get('index',['as'=>$resource . 'index','uses'=>$controller.'index']);
    Route::get('ability',['as'=>$resource . 'ability','uses'=>$controller.'ability']);
    #hero info
    Route::get('{hero_name}',$controller.'info')
    ->where('hero_name','\w+');
});

/**
 * items
 */
Route::group(['prefix'=>'item'],function(){
    $controller = 'ItemController@';
    $resource = 'item.';
    #item list
    Route::get('index',['as'=>$resource.'index','uses'=>$controller.'index']);
});


/**
 * queue
 */
Route::group(['prefix' => 'queue'], function () {
    $controller = 'ApiController@';
    $resource = 'api.';
    #Playermatches
    Route::get('matches/{steamid}', ['as' => $resource . 'getPlayerMatches', 'uses' => $controller . 'getPlayerMatches'])
    ->where('steamid', '[0-9]+');
    #items
    Route::get('items', ['as' => $resource . 'getItemsWeb', 'uses' => $controller . 'getItemsWeb']);
    #heros
    Route::get('heroes', ['as' => $resource . 'getHeroesWeb', 'uses' => $controller . 'getHeroesWeb']);
    #matches
    Route::get('history/matches/{skill}', ['as' => $resource . 'getHistoryMatches', 'uses' => $controller . 'getHistoryMatches'])
    ->where('skill', '[0-3]');
    #mail
    Route::get('emails', ['as' => $resource. 'sendMails','uses' => $controller. 'sendMails']);
    #test
    Route::get('tests',$controller.'test');
});

/**
 * data synchronization
 */
Route::group(['prefix' => 'sync'], function () {
    $controller = 'SyncController@';
    $resource = 'sync.';
    #items
    Route::get('sync/items', ['as' => $resource . 'fetchItems', 'uses' => $controller . 'fetchItems']);
    #heros
    Route::get('sync/heros', ['as' => $resource . 'fetchHeros', 'uses' => $controller . 'fetchHeros']);
});

Route::get('/match/info/{matchid}', ['as' => 'match.info', 'uses' => 'MatchController@info'])
    ->where('matchid', '[0-9]+');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

