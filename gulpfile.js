// npm install gulp gulp-sass gulp-rename gulp-concat gulp-uglify
const gulp = require('gulp');

const sass = require('gulp-sass');
const rename = require("gulp-rename");

const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const babel = require('gulp-babel');


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
        .pipe(babel({
            presets: ['@babel/env']
        }))
        .pipe(uglify())
        .pipe(rename('scripts.min.js'))
        .pipe(gulp.dest('./public/assets/js'));
});

//watch
gulp.task('default', function () {
    gulp.watch('./resources/sass/**/*.scss', ['sass']);
    gulp.watch(['./resources/js/libs/**/*.js', './resources/js/user_defined/**/*.js'], ['js']);
});
