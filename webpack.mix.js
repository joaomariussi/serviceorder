const mix = require('laravel-mix');


mix.js('resources/js/app.js', 'public/js')
    .copy('resources/js/scripts.js', 'public/js')

mix.copy('resources/css', 'public/css');

