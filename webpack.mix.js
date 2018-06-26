let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/backend/js/common.js');


// mix.scripts([
//     'resources/assets/js/app.js',
//     'public/backend/js/jquery.min.js',
//     'public/backend/js/bootstrap.min.js',
//     'public/backend/js/nifty.min.js'
// ],  'public/backend/js/common.js');

// mix.styles([
//     'public/backend/css/bootstrap.min.css',
//     'public/backend/css/nifty.min.css',
//     'public/backend/css/demo/nifty-demo-icons.min.css',
//     'public/backend/css/demo/nifty-demo.min.css',
//     'public/backend/plugins/font-awesome/css/font-awesome.min.css'
// ], 'public/backend/css/common.css');
