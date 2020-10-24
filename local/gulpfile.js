const gulp = require('gulp');
const less = require('gulp-less');
const path = require('path');
const concat = require('gulp-concat');
const rename = require('gulp-rename');
const cleanCSS = require('gulp-clean-css');
const wepbackStream = require('webpack-stream');

gulp.task('less', function () {
    return gulp.src('./css/**/*.less')
        .pipe(less({
            paths: [path.join(__dirname, 'less', 'includes')]
        }))
        .pipe(cleanCSS())
        .pipe(gulp.dest('./css/build'));
});

gulp.task('scripts', function() {
    return gulp.src('./js/src/**/*.js')
        .pipe(concat('index.js'))
        .pipe(gulp.dest("./js/"))
        // .pipe(wepbackStream(require('./wepback.config.js')))
        // .pipe(gulp.dest('./js/bundles'))
});

gulp.task('webpack', function() {
    return gulp.src('./js/index.js')
    .pipe(wepbackStream(require('./wepback.config.js')))
    .pipe(gulp.dest('./js/bundles'))
});

gulp.task('watch', function() {
    gulp.watch('./js/src/**/*.js', gulp.series('webpack'));
    gulp.watch('./css/**/*.less', gulp.series('less'));
});

gulp.task('default', gulp.parallel('less', 'webpack', 'watch'));
