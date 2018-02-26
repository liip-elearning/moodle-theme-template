const gulp          = require('gulp');
const $             = require('gulp-load-plugins')();
const browserSync   = require('browser-sync').create();
const reload        = browserSync.reload;

// Match [[font:font-reference]]?v=1.2.3 and [[pix:pix-url]] for replacement
const pattern       = new RegExp(/\[\[([^:]*):([^\]]+)\]\](\?v=([\d\.]+))?/, 'g');

/**
 * Watching files for changes
 */
gulp.task('watch', ['build'], function() {
  browserSync.init({
    proxy: '{{cookiecutter.theme_id}}.lo',
    open: false,
  });

  gulp.watch('templates/**/*.mustache', reload);
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
    .pipe($.replace(pattern, (match, p1, p2, p3, p4) => {
      return `/theme/{{cookiecutter.theme_id}}/gulpfiles.php?${p1}=${p2}&v=${p4}`;
    }))
    .pipe($.sourcemaps.write('.'))
    .pipe(gulp.dest('build/stylesheets'))
    .pipe(reload({stream: true}));
});


gulp.task('build', ['sass']);
gulp.task('default', ['watch']);
