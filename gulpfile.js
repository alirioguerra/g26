"use strict"

const gulp = require('gulp');
const sass = require('gulp-sass')(require('node-sass'));
const autoprefixer = require('gulp-autoprefixer');
const version = require('gulp-version-number');

gulp.task('default', watch)
gulp.task('sass', compilerSass)
gulp.task('html', compilerHTML)

function compilerHTML() {
  return gulp.src('./*.html')
  .pipe(version({
    'value': '%MDS%',
    'append': {
      'key': 'v',
      'to': ['css', 'js'],
    }
  }))
  .pipe(gulp.dest('./'));
}

function compilerSass() {
  return gulp.src('./scss/**/*.scss')
  .pipe(sass({outputStyle: 'compressed'})).pipe(autoprefixer({
    cascade: false
  }))
  .on('error', sass.logError)
  .pipe(gulp.dest('./'));
}

function watch() {
  gulp.watch('./scss/**/*.scss', compilerSass)
}
