'use strict';
const Reload = require( 'gulp-livereload' );
const rollup = require('rollup-stream');
const source = require('vinyl-source-stream');
const { src, dest, parallel } = require( 'gulp' );


function jsRollupMain() {
  return rollup({
      entry: 'src/js/main.js',
      format: 'umd'
    })
    .pipe(source('main.js'))
    .pipe(dest('dist/js'));
}

function jsExternalPackages() {
  return src( [

  ])
  .pipe( dest('dist/js/ext/') );
}



module.exports = parallel( jsRollupMain, jsExternalPackages );
