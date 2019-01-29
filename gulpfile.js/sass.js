'use strict';
const Sass   = require( 'gulp-sass' );
const Reload = require( 'gulp-livereload' );
const Banner = require( 'gulp-header')
const Prefixer = require( 'gulp-autoprefixer' );
const Pkg = require('../package');
const { src, dest } = require( 'gulp' );

const header = `
/*
Theme Name: ${Pkg.name}
Theme URI: ${Pkg.homepage}
Template: genesis
Author: Workshop Digital
Author URI: ${Pkg.homepage}
Description: ${Pkg.description}
Version: ${Pkg.version}
*/

`;

function syncSass() {
  return src( [ 'src/*.scss', ] )
  .pipe(
    Sass({
      includePaths: [
        'node_modules/breakpoint-sass/stylesheets',
        'node_modules/susy/sass',
        'node_modules/@fortawesome/fontawesome-free/scss'
      ]
    })
  )
  .pipe(
    Prefixer()
  )
  .pipe(
    Banner(header)
  )
  .pipe( dest( 'dist' ) )
  .pipe( Reload() );
}

module.exports = syncSass;
