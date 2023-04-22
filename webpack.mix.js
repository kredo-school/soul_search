const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .sass("resources/sass/side.scss", "public/css")
    .sass("resources/sass/login.scss", "public/css")
    .sass("resources/sass/home.scss", "public/css")
    .sass('resources/sass/profile.scss', 'public/css')
    .sass("resources/sass/post.scss", "public/css")
    .sass('resources/sass/message.scss', 'public/css')
    .sass('resources/sass/search.scss', 'public/css')
    .sass('resources/sass/admin_users.scss', 'public/css')
    .sass('resources/sass/contact.scss', 'public/css')
    .js('resources/js/registration.js', 'public/js')
    .sass('resources/sass/register.scss', 'public/css')

