var elixir = require('laravel-elixir'),
 liveReload = require('gulp-livereload'),
 clean = require('gulp-clean'),
 gulp = require('gulp');



gulp.task('test', function() {
  console.log('it works');
});

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss');
});
