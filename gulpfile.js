/*jslint browser: true, devel: true, plusplus: true, unparam: true, vars: true, white: true*/
/*global require*/

(function() {

    'use strict';

    // Gulp
    // ------------------------------------------------------------------------------------------------------
    // ------------------------------------------------------------------------------------------------------
    var gulp = require('gulp');

    // Importing Gulp dependencies
    // ------------------------------------------------------------------------------------------------------
    var phpunit = require('gulp-phpunit');

    // Tasks configuration
    // ------------------------------------------------------------------------------------------------------
    var tasks = {
        'php_tests': {
            source: 'RESTClient.class.php'
        }
    };

    // Unit tests
    // ------------------------------------------------------------------------------------------------------
    gulp.task('php_tests', function() {

        return gulp
            .src(tasks.php_tests.source)
            .pipe(phpunit('./vendor/bin/phpunit'));

    });

    // Default tasks (called when running `gulp` from cli)
    // ------------------------------------------------------------------------------------------------------
    gulp.task('default', [
        'php_tests'
    ]);

}());
