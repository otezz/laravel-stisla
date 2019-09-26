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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

mix.styles([
    'resources/vendor/stisla/css/style.css',
    'resources/vendor/stisla/css/components.css'
], 'public/css/style.css');

mix.sass('resources/sass/page/dashboard.scss', 'public/css/page');

// General scripts
mix.scripts([
    'resources/vendor/stisla/js/stisla.js',
    'resources/vendor/stisla/js/scripts.js',
    'resources/vendor/stisla/js/custom.js'
], 'public/js/template.js');

// Register page
mix.js([
    'resources/js/page/auth-register.js',
], 'public/js/page/auth-register.js');

// Dashboard
mix.js([
    'resources/js/page/dashboard.js',
], 'public/js/page/dashboard.js');

mix.copyDirectory('resources/vendor/stisla/img', 'public/img');
mix.copyDirectory('node_modules/flag-icon-css/flags', 'public/img/flags');

mix.version();
