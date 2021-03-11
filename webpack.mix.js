const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.
    styles([
        'public/css/web/all.css',
        'public/css/web/header.css',
        'public/css/web/footer.css',
    ], 'public/css/web/web.min.css');

