// npm install gulp gulp-sass gulp-rename gulp-concat gulp-uglify
var gulp = require('gulp');

var sass = require('gulp-sass');
var rename = require("gulp-rename");

var concat = require('gulp-concat');
var uglify = require('gulp-uglify');

//sass
gulp.task('sass', function () {
    return gulp.src('./resources/sass/app.scss')
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(rename("app.min.css"))
        .pipe(gulp.dest('./public/assets/css'));
});

//js
gulp.task('js', function() {
    return gulp.src(['./resources/js/libs/**/*.js', './resources/js/user_defined/**/*.js'])
        .pipe(concat('scripts.js'))
        .pipe(uglify())
        .pipe(rename('scripts.min.js'))
        .pipe(gulp.dest('./public/assets/js'));
});

//watch
gulp.task('default', function () {
    gulp.watch('./resources/sass/**/*.scss', ['sass']);
    gulp.watch(['./resources/js/libs/**/*.js', './resources/js/user_defined/**/*.js'], ['js']);
});
