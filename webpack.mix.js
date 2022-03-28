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

mix
.js('resources/js/app.js', 'public/js')
.scripts('resources/js/script.js', 'public/js/dashboard/app.js')
.scripts('node_modules/jquery-ui/ui/widgets/draggable.js', 'public/js/dashboard/draggable.js')
.scripts('node_modules/jquery/dist/jquery.js', 'public/js/dashboard/jquery.js')
.postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
])
.postCss('resources/css/dashboard/app.css', 'public/css/dashboard', []);
