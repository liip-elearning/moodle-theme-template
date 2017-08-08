const gulp          = require('gulp');
const $             = require('gulp-load-plugins')();
const browserSync   = require('browser-sync').create();
const reload        = browserSync.reload;

/**
 * Watching files for changes
 */
gulp.task('watch', ['build'], function() {
  browserSync.init({
    proxy: '{{cookiecutter.theme_id}}.lo',
    open: false,
  });

  gulp.watch('templates/**/*.mustache')
  gulp.watch('scss/**/*.scss', ['sass']);
});


/**
 * Compile Sass to CSS
 * Add vendor prefixes with Autoprefixer
 * Write sourcemaps in dev mode
 */
gulp.task('sass', function() {

    return gulp.src('./scss/{{cookiecutter.theme_id}}.scss')
      .pipe($.concat('compiled.scss'))
      .pipe(gulp.dest('build/test'))
      .pipe($.sourcemaps.init())
      .pipe(
        $.sass({
          outputStyle: 'compressed',
          includePaths: ['./scss']
        })
        .on('error', function(error) {
          browserSync.sockets.emit('fullscreen:message', {
            title: 'Sass compilation error',
            body: error.message
          });
          $.sass.logError.apply(this, arguments);
        })
        .on('data', function(data) {
          browserSync.sockets.emit('fullscreen:message:clear');
        })
      )
      .pipe($.autoprefixer({cascade: false}))
      .pipe($.sourcemaps.write('.'))
      .pipe(gulp.dest('build/stylesheets'))
      .pipe(reload({stream: true}));
});


gulp.task('build', ['sass']);
gulp.task('default', ['watch']);
