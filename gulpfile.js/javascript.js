'use strict';
const Reload = require( 'gulp-livereload' );
const Rollup = require('rollup-stream');
const CommonJs = require( 'rollup-plugin-commonjs' );
const Babel = require( 'rollup-plugin-babel' );
const Source = require( 'vinyl-source-stream' );
const Resolve = require( 'rollup-plugin-node-resolve' );
const { src, dest, parallel } = require( 'gulp' );


function jsAdminReact() {
  return Rollup({
      input: 'src/admin/js/frm-salesforce-admin.js',
      format: 'iife',
      external: [ 'global' ],
			globals: {
				'global': 'window'
			},
      plugins: [       
	      Resolve(),
		    Babel({
		    	sourceType: 'unambiguous',
		      babelrc: false,
		      presets: ['@babel/preset-react', '@babel/plugin-proposal-class-properties'],
		    }),	     	      
	      CommonJs()		    
      ]
    })
    .pipe(Source('frm-salesforce-admin.js'))
    .pipe(dest('dist/admin/js'));
}



module.exports = parallel( jsAdminReact );
