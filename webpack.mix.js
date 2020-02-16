const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.scripts([
    'node_modules/jquery/dist/jquery.js',
    'resources/js/jquery-ui.min.js',
    'resources/js/bootstrap.js',
    'resources/js/adminlte.js',
    'resources/js/scripts.js'], 'public/js/app.js');

mix.styles([
    'resources/css/adminlte.css',
    'resources/css/fontawesome-all.css',
    'resources/css/ionicons.min.css',
    'resources/css/icheck-bootstrap.min.css',
    'resources/css/styles.css'], 'public/css/app.css');
