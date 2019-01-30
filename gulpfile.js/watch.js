'use strict';
const { watch, series }  = require( 'gulp' );
const Reload = require( 'gulp-livereload' );
const php = require( './php' );
const sass = require( './sass' );
const { webpack } = require( './webpack' );

function watchFiles() {
  Reload.listen();

  watch( 'src/**/*.php',  series( php ) );
  watch( 'src/**/*.scss',  series( sass ) );
  watch( 'src/**/*.js', series( webpack ) );
}

module.exports = watchFiles;
