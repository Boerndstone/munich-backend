//gulpfile.js
var gulp = require('gulp'),
    minifyCSS = require('gulp-minify-css'),
    uglify = require('gulp-uglify'),
    rename = require("gulp-rename"),
    sass = require('gulp-sass');


// This is for the path of sass compilation
var sassFiles = 'assets/style.scss',
    cssDest = 'public/build/';

// This is for the process of sass compilation
gulp.task('styles', function() {
    gulp.src(sassFiles)
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest(cssDest));
});

// This is for the process of sass compilation
gulp.task('pages-styles', function() {
    gulp.src('assets/pages/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('public/build/pages/'));
});

// This is for the minify css

gulp.task('minify-css', function() {
    return gulp.src(['public/build/*.css', '!public/build/**/*.min.css'])
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(minifyCSS())
        .pipe(gulp.dest('public/build/'))
});
// This is for the minifyjs
gulp.task('js', function() {
    return gulp.src(['assets/js/custom.js', '!assets/js/**/*.min.js'])
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(uglify())
        .pipe(gulp.dest('public/build/'))
});
//Setting up the Watcher

gulp.task('watch', function() {
    gulp.watch(['assets/styles/**/*.scss', 'assets/js/**/*.js'], ['styles', 'js', 'pages-styles']);

});
gulp.task('watchcss', function() {
    gulp.watch(['public/build/style.css'], ['minify-css']);

});

// This is for the copy node module depandancy to the other folder

var npmDist = require('gulp-npm-dist');

// Copy dependencies to ./public/libs/
gulp.task('copy', function() {
    gulp.src(npmDist(), {
            base: './node_modules'
        })
        .pipe(gulp.dest('./assets/libs'));
});

//Monitor

gulp.task('default', ['watch', 'watchcss', 'copy']);