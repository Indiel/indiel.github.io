const 	gulp = require('gulp'),
		$ = require('gulp-load-plugins')(),
		run = require('run-sequence'),
		del = require('del'),
		wiredep = require('wiredep')(),
		srcPath = './app/Resources',
		distPath = './web';

gulp.task('clean', function(){
    del([
        distPath + '/css',
        distPath + '/js',
        distPath + '/images',
        distPath + '/fonts'
    ])
});

gulp.task('sass', function(){
    return gulp.src(srcPath + '/scss/**/*.scss')
        .pipe($.sourcemaps.init())
        .pipe($.plumber())
        .pipe($.newer(distPath + '/css'))
        .pipe($.sass({
            style: 'extended',
            sourcemap: false,
            errLogToConsole: false
        }).on('error', $.sass.logError))
        .pipe($.autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe($.sourcemaps.write('.'))
        .pipe(gulp.dest(distPath + '/css'));
});

gulp.task('sassDone', function(){
    return gulp.src(srcPath + '/scss/**/*.scss')
        .pipe($.plumber())
        .pipe($.newer(distPath + '/css'))
        .pipe($.sass({
            style: 'extended',
            sourcemap: false,
            errLogToConsole: false
        }).on('error', $.sass.logError))
        .pipe($.autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe($.groupCssMediaQueries())
        .pipe($.uglifycss({
            "maxLineLen": 80,
            "uglyComments": true
        }))
        .pipe(gulp.dest(distPath + '/css'));
});

gulp.task('images', function(){
    gulp.src([srcPath + '/images/**/*'])
	    .pipe($.plumber())
        .pipe(gulp.dest(distPath + '/images'));
});

gulp.task('imagesDone', function(){
    gulp.src([srcPath + '/images/**/*'])
	    .pipe($.plumber())
        .pipe($.imagemin({verbose: true}))
        .pipe(gulp.dest(distPath + '/images'));
});

gulp.task('fonts', function(){
	gulp.src([
        srcPath + '/fonts/**/*'
	])
	.pipe($.contribCopy())
	.pipe(gulp.dest(distPath + '/fonts'));
});

gulp.task('debug', function(){
    console.log(wiredep.js);
});

gulp.task('js', function () {
    gulp.src((wiredep.js || []).concat([srcPath + '/js/**/*.js']))
        .pipe($.plumber())
        .pipe($.sourcemaps.init())
        .pipe($.concat('all.js'))
        .pipe($.sourcemaps.write('.'))
        .pipe(gulp.dest(distPath + '/js'));
});

gulp.task('jsDone', function () {
    gulp.src((wiredep.js || []).concat([srcPath + '/js/**/*.js']))
        .pipe($.plumber())
        .pipe($.concat('all.js'))
        //.pipe($.uglify())
        .pipe(gulp.dest(distPath + '/js'));
});

gulp.task('watch', function(){
    gulp.watch(srcPath + '/scss/**/*.scss', ['sass']);
    gulp.watch(srcPath + '/js/**/*.js', ['js']);
    gulp.watch(srcPath + '/images/**/*', ['images']);
    gulp.watch(srcPath + '/fonts/**/*', ['fonts']);
});

gulp.task('default', function(){
    run(
        'clean',
        'sass',
        'js',
        'images',
        'fonts',
        'watch'
    );
});

gulp.task('done', function(){
    run(
        'clean',
        'sassDone',
        'jsDone',
        'imagesDone',
        'fonts'
    );
});

var browserSync = require('browser-sync').create();

// Static server
gulp.task('browser-sync', function() {
    browserSync.init({
        server: "./app"
    });
});