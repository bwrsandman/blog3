// include gulp
var gulp = require('gulp'),
    concat = require('gulp-concat'),
    jshint = require('gulp-jshint'),
    less = require('gulp-less'),
    rename = require('gulp-rename'),
    clean = require('gulp-clean'),
//    notify = require('gulp-notify'),
    cache = require('gulp-cached'),
    changed = require('gulp-changed'),
    minifycss = require('gulp-minify-css'),
    jshint = require('gulp-jshint'),
    imagemin = require('gulp-imagemin'),
    newer = require('gulp-newer'),
    path = require('path'),
    ngmin = require('gulp-ngmin'),
    watch = require('gulp-watch'),
    uglify = require('gulp-uglify'),
    shell = require('gulp-shell'),
    livereload = require('gulp-livereload'),
    lr = require('tiny-lr'),
    server = lr();

var conf = {
    app: './src/',
    dist: './assets/build/',
    root: '../../'
};

var js = [
    conf.app + '/vendor/jquery/dist/jquery.min.js',
    conf.app + '/vendor/jquery-ui/minified/jquery-ui.min.js',
    conf.dist + '/ngmin/vendor/angular.min.js',
//    conf.app + '/vendor/angular-bootstrap/ui-bootstrap.min.js',
//    conf.app + '/vendor/angular-bootstrap/ui-bootstrap-tpls.js',
//    conf.app + '/vendor/angular-route/angular-route.min.js',
    conf.app + '/vendor/angular-translate/*.min.js',
    conf.app + '/vendor/angular-ui/*.min.js',
    conf.app + '/vendor/angular-sortable/src/sortable.js',
    conf.app + '/vendor/angular-ui-utils/*.min.js',
    conf.app + '/vendor/angular-sanitize/*.min.js',
    conf.app + '/vendor/textAngular/*.min.js',
    conf.dist + '/ngmin/vendor/angular-elastic/elastic.js',


    conf.dist + '/ngmin/common/**/*.js',
    conf.dist + '/ngmin/app/app.js',
    conf.dist + '/ngmin/app/goal/services/goal.js',
    conf.dist + '/ngmin/app/goal/services/modal.js',
    conf.dist + '/ngmin/app/goal/services/category.js',
    conf.dist + '/ngmin/app/goal/services/report.js',
    conf.dist + '/ngmin/app/goal/services/tpl.js',
    conf.dist + '/ngmin/app/goal/services/user.js',
    conf.dist + '/ngmin/app/goal/services/server.js',
    conf.dist + '/ngmin/app/goal/services/alert.js',

//                        conf.dist + '/ngmin/app/goal/services/*.js',
    conf.dist + '/ngmin/app/goal/controllers/*.js',
    conf.dist + '/ngmin/app/goal/directives/*.js'
];

gulp.task('fonts', function() {
    gulp.src(conf.app + '/vendor/components-font-awesome/fonts/*')
        .pipe(gulp.dest(conf.dist + '/fonts/'));
});

gulp.task('js.copy', function() {

    gulp.src(conf.app + '/vendor/angular-route/angular-route*')
        .pipe(newer(conf.dist))
        .pipe(gulp.dest(conf.dist));

    gulp.src(conf.app + '/vendor/jquery/dist/jquery.min.map')
        .pipe(newer(conf.dist))
        .pipe(gulp.dest(conf.dist));

    gulp.src(conf.app + '/vendor/angular/*.map')
        .pipe(newer(conf.dist))
        .pipe(gulp.dest(conf.dist));

});

gulp.task('js.ngmin', function () {

    gulp.src(conf.app + '/app/**/*.js')
        .pipe(ngmin())
        .pipe(newer(conf.dist + '/ngmin/app'))
//        .pipe(changed(conf.dist + '/ngmin/app'))
        .pipe(gulp.dest(conf.dist + '/ngmin/app'));

    gulp.src([conf.app +  '/vendor/angular-elastic/elastic.js', conf.app +  '/vendor/angular/angular.min.js'])
        .pipe(ngmin())
        .pipe(newer(conf.dist + '/ngmin/vendor'))
//        .pipe(changed(conf.dist + '/ngmin/vendor'))
        .pipe(gulp.dest(conf.dist + '/ngmin/vendor'));

    gulp.src([conf.app +  '/common/**/*.js'])
        .pipe(ngmin())
        .pipe(newer(conf.dist + '/ngmin/common'))
//        .pipe(changed(conf.dist + '/ngmin/common'))
        .pipe(gulp.dest(conf.dist + '/ngmin/common'));

});

gulp.task('js.concat', ['js.ngmin', 'js.copy'], function () {

    return gulp.src(js)
        .pipe(newer(conf.dist+'all.js'))
        .pipe(concat('all.js'))
        .pipe(gulp.dest(conf.dist));
});

gulp.task('js.compress', ['js.concat'], function () {

    return gulp.src(conf.dist + '/all.js')
        .pipe(concat('all.min.js'))
        .pipe(uglify({outSourceMap: true}))
        .pipe(gulp.dest(conf.dist));
});


gulp.task('less', function () {
    return gulp.src(conf.app + '/less/site.less')
        .pipe(less({
            paths: [ path.join(__dirname, 'less', 'includes') ]
        }))
        .pipe(concat('site.css'))
        .pipe(gulp.dest(conf.dist + '/css'))
        .pipe(livereload(server));
});

gulp.task('clean', function () {
    return gulp.src([conf.dist], {read: false})
        .pipe(clean());
});

gulp.task('php.tests.unit', function () {
    gulp.src('')
        .pipe(shell('php ../vendor/bin/codecept run unit | grep -v " Ok"', {
            cwd: conf.root + "/frontend"
        }));
});

gulp.task('js', ['js.compress']);
gulp.task('js.dev', ['js.concat'], function() {
    gulp.src('').pipe(livereload(server));
});

gulp.task('build', ['clean'], function() {
    gulp.start('fonts', 'js', 'less');
});
gulp.task('build.dev', ['clean'], function() {
    gulp.start('fonts', 'js.dev', 'less', 'php.tests.unit');
});

gulp.task('watch', ['build.dev'], function () {

    // Listen on port 35729
    server.listen(35729, function (err) {
        if (err) {
            return console.log(err)
        }

        gulp.watch(conf.app + '/**/*.js', ['js.dev']);
        gulp.watch([conf.root + 'frontend/**/*.php', conf.root + 'common/**/*.php'], ['php.tests.unit']);
        gulp.watch(conf.app + 'less/**/*', ['less']);

//        gulp.watch([conf.app + '/**/*', conf.root + '/views/layouts/main.php', conf.app + '../less/**/*'], ['livereload']);
    });
});