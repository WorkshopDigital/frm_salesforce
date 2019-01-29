'use strict';

const Reload = require( 'gulp-livereload' );
const { src, dest } = require( 'gulp' );


function syncImages() {
  return src( ['src/images/**/*.*'] )
  .pipe( dest('dist/images') );
}

module.exports = syncImages;
