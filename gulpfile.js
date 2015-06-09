var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.less('app.less','resources/css');
    mix.less('index.less','resources/css/index.css','resource/assets/less');

    mix.styles([
    	'libs/global.css',
    	'libs/heropedia.css',
    	'match.css'
    ],'public/css/test.css','resources/css');

    mix.styles([
    	'app.css',
    	'index.css'
    ],'public/css/index.css','resources/css');

});
