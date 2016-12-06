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
    mix
        .styles([
            'picker.default.css',
            'picker.default.date.css',
            'signup.css'
        ], 'public/css/signup.css')

        .scripts([
            'picker.js',
            'picker.date.js'
        ], 'public/js/pickadate.js')

        .webpack('home.js')

        .webpack('signup.events.js')
        
        .webpack('signup.event.js');
});
