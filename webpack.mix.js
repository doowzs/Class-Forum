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
    .js('resources/js/sw/sw.js', 'public') // put to root dir
    .js('resources/js/sw/sw-register.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

if (mix.inProduction() || process.env.npm_lifecycle_event !== 'hot') {
    mix.version();
}