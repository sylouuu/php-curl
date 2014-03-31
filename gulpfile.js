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

    // Unit tests
    // ------------------------------------------------------------------------------------------------------
    gulp.task('php_tests', function() {

        return gulp
            .src('RESTClient.class.php')
            .pipe(phpunit('"./vendor/bin/phpunit"'));

    });

    // Default tasks (called when running `gulp` from cli)
    // ------------------------------------------------------------------------------------------------------
    gulp.task('default', ['php_tests']);

}());
