'use strict';
const Sass   = require( 'gulp-sass' );
const Reload = require( 'gulp-livereload' );
const Prefixer = require( 'gulp-autoprefixer' );
const { src, dest } = require( 'gulp' );



function syncSass() {
  return src( [ 'src/*.scss', ] )
  .pipe(
    Sass({
      includePaths: [
        'node_modules/breakpoint-sass/stylesheets',
        'node_modules/@fortawesome/fontawesome-free/scss'
      ]
    })
  )
  .pipe(
    Prefixer()
  )
  .pipe( dest( 'dist' ) )
  .pipe( Reload() );
}

module.exports = syncSass;
