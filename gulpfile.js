'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
const minify = require('gulp-minify');
var scssSourcePath = "./src/**/*.scss";
var scssDestPath = "./css";
var jsSourcePath = "./src/**/*.js";
var destPath = "./dist";
let cleanCSS = require('gulp-clean-css');


gulp.task('sass', function () {
 return gulp.src(scssSourcePath)
  .pipe(sourcemaps.init())
  .pipe(sass().on('error', sass.logError))
  .pipe(sourcemaps.write())
  .pipe(gulp.dest(scssDestPath));
});


gulp.task('compress', function() {
  gulp.src(jsSourcePath)
    .pipe(minify({
        ext:{
            src:'-debug.js',
            min:'.js'
        },
        exclude: ['tasks'],
        ignoreFiles: ['.combo.js', '-min.js']
    }))
    .pipe(gulp.dest(destPath))
});


gulp.task('files:watch', function () {
  gulp.watch(scssSourcePath, ['sass']);
  gulp.watch(jsSourcePath, ['compress']);
});
