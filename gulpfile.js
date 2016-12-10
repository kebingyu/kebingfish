const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.webpack('home.js');

    mix.styles([
        'picker.default.css',
        'picker.default.date.css',
        'signup.css'
    ], 'public/css/signup.css');

    mix.scripts([
        'picker.js',
        'picker.date.js',
        'signup.events.js'
    ], 'public/js/signup.events.js');

    mix.scripts([
        'signup.event.js'
    ], 'public/js/signup.event.js');

    mix.scripts([
        'picker.js',
        'picker.date.js',
        'signup.event.update.js'
    ], 'public/js/signup.event.update.js');
});
