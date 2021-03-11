/*
 * Copyright (c) 2021.  Maicol07 - Tutti i diritti riservati - All rights reserved
 */

import gulp from 'gulp';
import del from 'del';
import { zip } from 'gulp-vinyl-zip';

/**
 * Delete the zip
 */
function clean() {
	return del( 'mdi-wp.zip' );
}

/**
 * Pack the plugin
 */
function pack() {
	gulp.src( 'node_modules/@mdi/font/css/materialdesignicons.min.css' ).pipe( 'css' );
	return gulp.src( [
		'**/*',
		'!node_modules/**/*',
		'!scss/**/*',
		'!test/**/*',
		'!vendor/**/*',
		'!*',
		'composer.json',
		'composer.lock',
		'LICENSE',
		'package.json',
		'plugin.php',
		'README.md',
		'readme.txt',
		'yarn.lock',
	] )
		.pipe( zip( 'mdi-wp.zip' ) )
		.pipe( gulp.dest( './' ) );
}

exports.default = gulp.series( clean, pack );
exports.clean = clean;
exports.zip = pack;
