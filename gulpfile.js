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
    mix
        .less('app.less','resources/css')
        .less('index.less','resources/css','resource/assets/less')
        .less('match.less','public/css','resources/assets/less')
        .less('item.less','public/css','resources/assets/less');

    mix
        .styles('libs/global.css','public/css/global.css','resources/css')
        .styles('libs/global-chinese.css','public/css/global-chinese.css','resources/css')
        .styles('libs/heropedia.css','public/css/heropedia.css','resources/css')
        .styles('app.css','public/css/app.css','resources/css')
        .styles('index.css','public/css/index.css','resources/css');

    mix.scripts([
            'require.js',
            'config.js'
        ],'public/js/app.js','resources/js');

});
