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
    'public/backend/js/jquery.min.js',
    'public/backend/js/popper.min.js',
    'public/backend/js/bootstrap.min.js',
    'public/backend/js/parsley.min.js',
    'public/backend/js/toastr.min.js',
], 'public/backend/js/all.js');

mix.scripts([
    'public/backend/js/moment.min.js',
    'public/backend/js/datepicker.min.js',
    'public/backend/js/jquery.datetimepicker.full.js',
    'public/backend/js/jquery-ui.js',
    'public/backend/js/jquery.multiselect.js',
    'public/backend/js/jquery.mask.js',
    'public/backend/library/tinymce/js/tinymce/tinymce.js',
    'public/backend/js/timepicki.js',
], 'public/backend/js/only_backend.js');

mix.styles([
    'public/backend/css/bootstrap.min.css',
    'public/backend/css/font-awesome.min.css',
    'public/backend/css/style.css',
    'public/backend/css/parsley.css',
    'public/backend/css/toastr.css',
], 'public/backend/css/all.css');


mix.styles([
    'public/backend/css/jquery.datetimepicker.css',
    'public/backend/css/datepicker.css',
    'public/backend/css/jquery-ui.min.css',
    'public/backend/css/timepicki.css',
    'public/backend/css/jquery.multiselect.css',
], 'public/backend/css/only_backend.css');

/*mix.minify('public/backend/js/only_backend.js');
mix.minify('public/backend/js/all.js');*/
