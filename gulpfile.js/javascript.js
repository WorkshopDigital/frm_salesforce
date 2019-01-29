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
      format: 'umd',
      external: [ 'global' ],
			globals: {
				'global': 'window'
			},
      plugins: [       
		    Babel({
		      babelrc: false,
		      presets: ['@babel/react'],
		    }),	                 
	      Resolve({
	      	module:true,
					main: true	      	
	      }),
	      // CommonJs({
		     //  exclude: [
		     //    'node_modules/**',
		     //  ],
		     //  namedExports: {
		     //    'node_modules/react/index.js': ['Children', 'Component', 'PropTypes', 'createElement'],
		     //    'node_modules/react-dom/index.js': ['render'],
		     //  },	  
	      // }),
	      
      ]

    })
    .pipe(Source('frm-salesforce-admin.js'))
    .pipe(dest('dist/admin/js'));
}



module.exports = parallel( jsAdminReact );
