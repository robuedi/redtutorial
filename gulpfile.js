var gulp = require('gulp');

var sass = require('gulp-sass');
var rename = require("gulp-rename");

var concat = require('gulp-concat');
var uglify = require('gulp-uglify');

//sass
gulp.task('sass', function () {
    return gulp.src('./resources/assets/sass/app.scss')
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(rename("app.min.css"))

        .pipe(gulp.dest('./public/assets/css'));
});

gulp.task('sass:watch', function () {
    gulp.watch('./resources/assets/sass/**/*.scss', ['sass']);
});

gulp.task('scripts', function() {
    return gulp.src(['./resources/assets/js/libs/**/*.js', './resources/assets/js/user_defined/**/*.js'])
        .pipe(concat('scripts.js'))
        .pipe(gulp.dest('./public/assets/js'))
        .pipe(rename('scripts.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./public/assets/js'));
});

