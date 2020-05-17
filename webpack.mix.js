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

mix.copyDirectory('resources/img', 'public/img');

mix.sass('resources/sass/AdminLTE.scss', 'public/css/app.css')
   .options({
        processCssUrls: false,
    });

mix.scripts([
    'resources/js/jquery.js',
    'resources/js/jquery-ui.js',
    'resources/js/jquery.inputmask.js',
    'resources/js/toastr.js',
    'resources/js/select2.full.js',
    'resources/js/jquery.dataTables.js',
    'resources/js/dataTables.bootstrap4.js',
    'resources/js/dataTables.buttons.js',
    'resources/js/buttons.bootstrap.js',
    'resources/js/jszip.js',
    'resources/js/pdfmake.js',
    'resources/js/vfs_fonts.js',
    'resources/js/buttons.html5.js',
    'resources/js/buttons.print.js.js',
    'resources/js/buttons.colVis.js.js',
    'resources/js/adminlte.js',
    'resources/js/bootstrap.js',
    'resources/js/scripts.js'
], 'public/js/app.js');