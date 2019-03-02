// gulp dependencies
var autoprefixer = require('gulp-autoprefixer');
var babel = require('gulp-babel');
var browserSync = require('browser-sync').create();
var cleanCSS = require('gulp-clean-css');
var concat = require('gulp-concat');
var eslint = require('gulp-eslint');
var gulp = require('gulp');
var imagemin = require('gulp-imagemin');
var rename = require('gulp-rename');
var sass = require('gulp-sass');
var uglify = require('gulp-uglify');

// browsersync and paths
var serverURL = 'http://localhost';
var paths = {
  compiled: './compiled',
  css: './css/*.css',
  js: './js/*.js',
  sass: './sass/**/*.sass',
  scripts: './js/scripts.js',
};

// default task
gulp.task('default', gulp.series(['sass', 'scripts', 'lint', 'compile-css', 'compile-js'], function() {
  gulp.watch(paths.sass, gulp.parallel(['sass']));
  gulp.watch(paths.js, gulp.parallel(['scripts', 'lint']));
  gulp.watch('./**/*.php').on('change', browserSync.reload);
  browserSync.init({
    proxy: serverURL,
    open: false,
  });
}));

// sass task
gulp.task('sass', function() {
  gulp.src('sass/**/main.sass')
    // compress & minify
    .pipe(sass({
      outputStyle: 'compressed'
    }).on('error', sass.logError))
    // add autoprefixers
    .pipe(autoprefixer({
      browsers: ['last 2 versions']
    }))
    // rename file
    .pipe(rename('styles.min.css'))
    .pipe(gulp.dest(paths.compiled))
    .pipe(browserSync.stream());
});

// scripts task
gulp.task('scripts', function() {
  gulp.src(paths.scripts)
    .pipe(babel({
      presets: ['@babel/env']
    }))
    .pipe(uglify())
    .pipe(rename('scripts.min.js'))
    .pipe(gulp.dest(paths.compiled));
});

// lint task
gulp.task('lint', function() {
  return gulp.src([paths.scripts])
    .pipe(eslint())
    .pipe(eslint.format());
});

// minify and concat all extra css
gulp.task('compile-css', function() {
  gulp.src(paths.css)
    .pipe(cleanCSS({
      compatibility: 'ie8'
    }))
    .pipe(concat('extra-css.min.css'))
    .pipe(gulp.dest(paths.compiled));
});

// minify and concat all extra js
gulp.task('compile-js', function() {
  gulp.src([paths.js, '!./js/scripts.js'])
    .pipe(uglify())
    .pipe(concat('extra-scripts.min.js'))
    .pipe(gulp.dest(paths.compiled));
});
