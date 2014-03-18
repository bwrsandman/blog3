// include gulp
var gulp = require('gulp'),
    concat = require('gulp-concat'),
    jshint = require('gulp-jshint'),
    less = require('gulp-less'),
    rename = require('gulp-rename'),
    clean = require('gulp-clean'),
//    notify = require('gulp-notify'),
    cache = require('gulp-cache'),
    minifycss = require('gulp-minify-css'),
    jshint = require('gulp-jshint'),
    imagemin = require('gulp-imagemin'),
    path = require('path'),
    ngmin = require('gulp-ngmin'),
    watch = require('gulp-watch'),
    uglify = require('gulp-uglify'),
    shell = require('gulp-shell'),
    lr = require('tiny-lr'),
    server = lr();

var conf = {
    app: './src/',
    dist: './assets/build/',
    root: '../../'
};

var js = [
    conf.app + '/vendor/jquery/jquery.min.js',
    conf.app + '/vendor/jquery-ui/minified/jquery-ui.min.js',
    conf.dist + 'concat/scripts/vendor/angular/angular.min.js',
    conf.app + '/vendor/angular-bootstrap/ui-bootstrap.min.js',
    conf.app + '/vendor/angular-bootstrap/ui-bootstrap-tpls.js',
    conf.app + '/vendor/angular-route/angular-route.min.js',
    conf.app + '/vendor/angular-translate/*.min.js',
    conf.app + '/vendor/angular-ui/*.min.js',
    conf.app + '/vendor/angular-sortable/src/sortable.js',
    conf.app + '/vendor/angular-ui-utils/*.min.js',
    conf.app + '/vendor/angular-sanitize/*.min.js',
    conf.app + '/vendor/textAngular/*.min.js',
    conf.dist + '/concat/scripts/vendor/angular-elastic/elastic.js',


    conf.dist + '/concat/scripts/common/**/*.js',
    conf.dist + '/concat/scripts/app/app.js',
    conf.dist + '/concat/scripts/app/goal/services/goal.js',
    conf.dist + '/concat/scripts/app/goal/services/modal.js',
    conf.dist + '/concat/scripts/app/goal/services/category.js',
    conf.dist + '/concat/scripts/app/goal/services/report.js',
    conf.dist + '/concat/scripts/app/goal/services/tpl.js',
    conf.dist + '/concat/scripts/app/goal/services/user.js',
    conf.dist + '/concat/scripts/app/goal/services/server.js',
    conf.dist + '/concat/scripts/app/goal/services/alert.js',

//                        conf.dist + '/concat/scripts/app/goal/services/*.js',
    conf.dist + '/concat/scripts/app/goal/controllers/*.js',
    conf.dist + '/concat/scripts/app/goal/directives/*.js'
];

gulp.task('js', function () {
    gulp.src(conf.app + '/vendor/components-font-awesome/fonts/*')
        .pipe(gulp.dest(conf.dist + '/fonts/'));

    gulp.src(conf.app + '/vendor/angular-route/angular-route*')
        .pipe(gulp.dest(conf.dist));

    gulp.src(conf.app + '/vendor/jquery/jquery.min.map')
        .pipe(gulp.dest(conf.dist));

    gulp.src(conf.app + '/vendor/angular/*.map')
        .pipe(gulp.dest(conf.dist));

    gulp.src(js)
        .pipe(ngmin())
        .pipe(uglify({outSourceMap: true}))
        .pipe(concat('all.min.js'))
        .pipe(gulp.dest(conf.dist));
});


gulp.task('less', function () {
    gulp.src(conf.app + '/less/site.less')
        .pipe(less({
            paths: [ path.join(__dirname, 'less', 'includes') ]
        }))
        .pipe(concat('site.css'))
        .pipe(gulp.dest(conf.dist + '/css'));
});

gulp.task('clean', function () {
    return gulp.src([conf.dist], {read: false})
        .pipe(clean());
});

gulp.task('phpUnitTests', function () {
    gulp.src('')
        .pipe(shell('php ../vendor/bin/codecept run unit | grep -v " Ok"', {
            cwd: conf.root + "/frontend"
        }));
});

gulp.task('watch', function () {

    // Listen on port 35729
    server.listen(35729, function (err) {
        if (err) {
            return console.log(err)
        }

        gulp.watch(conf.app + '/**/*.js', ['js']);
        gulp.watch([conf.root + 'frontend/**/*.php', conf.root + 'common/**/*.php'], ['phpUnitTests']);
        gulp.watch(conf.app + 'less/**/*', ['less']);

//        gulp.watch([conf.app + '/**/*', conf.root + '/views/layouts/main.php', conf.app + '../less/**/*'], ['livereload']);
    });
});