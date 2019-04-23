const gulp = require('gulp')

const pluginOptions = {
  DEBUG: true,
  camelize: true,
  lazy: true
}

const plugins = require('gulp-load-plugins')(pluginOptions)

const onError = err => console.log(`Error = ${err}`);

gulp.task('js', () => {
  return gulp.src('./src/js/**/*.js')
    .pipe(plugins.plumber({
      errorHandler: onError
    }))
    .pipe(plugins.sourcemaps.init())
      .pipe(plugins.concat('index.js'))
      .pipe(plugins.babel({
        presets: ['@babel/preset-env']
      }))
    .pipe(plugins.sourcemaps.write('.'))
    .pipe(gulp.dest('public/js', {
      overwrite: true
    }))
})

gulp.task('sass', () => {
  return gulp.src('./src/scss/style.scss')
    .pipe(plugins.plumber({
      errorHandler: onError
    }))
    .pipe(plugins.sourcemaps.init())
      .pipe(plugins.sass({
        outputStyle: 'compressed'
      }))
      .pipe(plugins.autoprefixer({
        browsers: ['last 2 versions']
      }))
    .pipe(plugins.sourcemaps.write('.'))
    .pipe(gulp.dest('public/css', {
      overwrite: true
    }))
})





gulp.watch(['src/scss/**/*.scss', 'src/js/**/*.js'], gulp.series('sass', 'js'))

gulp.task('default', gulp.series('sass','js'))