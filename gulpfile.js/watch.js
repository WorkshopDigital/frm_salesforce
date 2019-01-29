'use strict';
const { watch, series }  = require( 'gulp' );
const Reload = require( 'gulp-livereload' );
const php = require( './php' );
const sass = require( './sass' );

function watchFiles() {
  Reload.listen();

  watch( 'src/**/*.php',  series( php ) );
  watch( 'src/**/*.scss',  series( sass ) );
}

module.exports = watchFiles;
