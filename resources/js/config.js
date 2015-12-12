window.config = config = window.config || {};
config.deps = config.deps || [];

require.config({
    map : {
            '*' : {
              'css' : 'require.css'
            }
        },
    deps : ["global"].concat(window.config.deps),
    baseUrl: "http://mydota/js",
    paths: {
        "global": "global",
        "browser": "lib/browser",
        "jquery": "lib/jquery",
        "underscore": "lib/underscore",
        "jquery.validate": "plugin/jquery.validate",
        "jquery.focusInput": "plugin/focusInput",
        "jquery.easing": "plugin/jquery.easing.1.3",
        "pace": "other/pace",
        "ie6": "special/ie6",
        "DD_belatedPNG": "special/DD_belatedPNG",
        "require.css": "lib/require-css-plugin"
    },
    urlArgs: "Version=1.1.2",
    waitSeconds: 5
})