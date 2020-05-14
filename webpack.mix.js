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

mix.sass('resources/sass/app.scss', 'public/css');

mix.styles([
    'resources/css/fontawesome-all.css',
    'resources/css/ionicons.min.css',
    'resources/css/icheck-bootstrap.min.css',
    'resources/css/toastr.min.css',
    'resources/css/select2.css',
    'resources/css/select2-bootstrap4.css',
    'resources/css/dataTables.bootstrap4.min.css',
    'responses/css/bootstrap.css',
    'resources/css/adminlte.css',
    'resources/css/animate.css',
    'resources/css/styles.css'
], 'public/css/app.css');

mix.scripts([
    'resources/js/jquery.min.js',
    'resources/js/jquery-ui.min.js',
    'resources/js/jquery.inputmask.bundle.min.js',
    'resources/js/toastr.min.js',
    'resources/js/select2.full.js',
    'resources/js/jquery.dataTables.js',
    'resources/js/dataTables.bootstrap4.js',
    'resources/js/dataTables.buttons.min.js',
    'resources/js/buttons.bootstrap.min.js',
    'resources/js/jszip.min.js',
    'resources/js/pdfmake.min.js',
    'resources/js/vfs_fonts.js',
    'resources/js/buttons.html5.min.js',
    'resources/js/buttons.print.min.js.js',
    'resources/js/buttons.colVis.min.js.js',
    'resources/js/adminlte.js',
    'resources/js/bootstrap.js',
    'resources/js/scripts.js'
], 'public/js/app.js');