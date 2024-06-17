const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .copy('resources/css', 'public/css')
    .copy('resources/images', 'public/images')
    .copy('resources/fonts', 'public/fonts');
