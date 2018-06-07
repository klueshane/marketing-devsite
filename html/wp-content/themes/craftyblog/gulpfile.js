// Include gulp
var gulp = require('gulp');
require('gulp-grunt')(gulp); // add all the gruntfile tasks to gulp

// Include Our Plugins
var jshint = require('gulp-jshint');
var sass = require('gulp-ruby-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var imagemin = require('gulp-imagemin');
var pngcrush = require('imagemin-pngcrush');
var livereload = require('gulp-livereload');

// Lint Task
gulp.task('lint', function() {
    return gulp.src('js/*.js')
        .pipe(jshint())
        .pipe(jshint.reporter('default'));
});

// Compile Our Sass
gulp.task('sass', function() {
	return gulp.src('sass/*.scss')
		.pipe(sass())
		.pipe(gulp.dest(''));
});

// Concatenate & Minify JS
gulp.task('scripts', function() {
    return gulp.src('js/*.js')
        .pipe(concat('all.js'))
        .pipe(gulp.dest('dist'))
        .pipe(rename('all.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('dist'));
});

// Compress Images
gulp.task('compress', function () {
    return gulp.src('images/*')
        .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngcrush()]
        }))
        .pipe(gulp.dest('images'));
});

// Watch Files For Changes
gulp.task('watch', function() {
    livereload.listen();
    gulp.watch('js/*.js', ['lint', 'scripts']);
    gulp.watch('sass/*.scss', ['sass']);
    gulp.watch('style.css', ['grunt-cssjanus']);
});

// Default Task
gulp.task('default', ['lint', 'sass', 'scripts', 'compress', 'watch']);