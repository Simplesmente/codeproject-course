var elixir = require('laravel-elixir'),
 liveReload = require('gulp-livereload'),
 rimraf = require('rimraf'),
 gulp = require('gulp');


var config = {

  assetsPath:'./resources/assets',
  buildPath:'./public/build'

};

config.bowerPath = config.assetsPath + '/../bower_componets';

config.buildPathJs = config.buildPath + '/js';
config.buildVendorPathJs = config.buildPathJs + '/vendor';
config.vendorPathJs = [
  config.bowerPath + '/jquery/dist/jquery.min.js',
  config.bowerPath + '/angular/angular.min.js',
  config.bowerPath + '/angular-route/angular-route.min.js',
  config.bowerPath + '/angular-resource/angular-resource.min.js',
  config.bowerPath + '/angular-animate/angular-animate.min.js',
  config.bowerPath + '/angular-messages/angular-messages.min.js',
  config.bowerPath + '/angular-bootstrap/ui-bootstrap.min.js',
  config.bowerPath + '/angular-strap/dist/modules/navbar.min.js',
  
];

config.buildPathCss = config.buildPath + '/css';
config.buildVendorPathCss = config.buildPathCss + '/vendor';
config.vendorPathCss = [
  config.bowerPath + '/bootstrap/dist/css/bootstrap.min.css',
  config.bowerPath + '/bootstrap/dist/css/bootstrap-theme.min.css',
];


gulp.task('copy-styles',function(){

  gulp.src([
   config.assetsPath + '/css/**/*.css'
  ])
 .pipe(gulp.dest(config.buildPathCss))
  .pipe(liveReload());

  gulp.src(config.vendorPathCss)
  .pipe(gulp.dest(config.buildVendorPathCss))
  .pipe(liveReload());

});

gulp.task('copy-scripts',function(){
  gulp.src([
    config.assetsPath + '/js/**/*.js'
  ])
  .pipe(gulp.dest(config.buildPathJs))
  .pipe(liveReload());
  
  gulp.src(config.vendorPathJs)
  .pipe(gulp.dest(config.buildVendorPathJs))
  .pipe(liveReload());

});

gulp.task('clean-build-folder',() => {
  rimraf.sync(config.buildPath);
});

gulp.task('default',['clean-build-folder'],() =>{
  elixir((mix)=> {
    
    mix.styles(config.vendorPathCss.concat([config.assetsPath + '/css/**/*.css']),
    'public/css/all.css',config.assetsPath);
    
    mix.scripts(config.vendorPathJs.concat([config.assetsPath + '/js/**/*.js']),
    'public/js/all.js',config.assetsPath);
    
    mix.version(['js/all.js','css/all.css']);
  
  });
});

gulp.task('watch-dev',['clean-build-folder'], function(){
  
  liveReload.listen();

  gulp.start('copy-styles','copy-scripts');
      gulp.watch(config.assetsPath + "/**", ['copy-styles','copy-scripts']);
});


