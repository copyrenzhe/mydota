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
        .less('index.less','resources/css')
        .less('match.less','public/css')
        .less('item.less','public/css')
        .less('hero.less','public/css');

    mix
        .styles('libs/global.css','public/css/global.css','resources/css')
        .styles('libs/global-chinese.css','public/css/global-chinese.css','resources/css')
        .styles('libs/heropedia.css','public/css/heropedia.css','resources/css')
        .styles('app.css','public/css/app.css','resources/css')
        .styles('index.css','public/css/index.css','resources/css');

    mix
        .version([
            'css/app.css',
            'css/index.css',
            'css/match.css',
            'css/item.css',
            'css/global.css',
            'css/global-chinese.css',
            'css/heropedia.css',
            'js/app.js'
        ]);

    mix
        .scripts([
            'require.js',
            'config.js'
        ],'public/js/app.js','resources/js');

});
