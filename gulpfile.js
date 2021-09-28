"use strict"

const gulp = require('gulp');
const sass = require('gulp-sass')(require('node-sass'));


gulp.task('default', watch)
gulp.task('sass', compilerSass)

function compilerSass() {
  return gulp.src('./scss/**/*.scss')
    .pipe(sass({outputStyle: 'compressed'}))
    .on('error', sass.logError)
    .pipe(gulp.dest('./'));
}

function watch() {
  gulp.watch('./scss/**/*.scss', compilerSass)
}
