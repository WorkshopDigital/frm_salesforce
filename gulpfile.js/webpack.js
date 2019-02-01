const Path = require( 'path' );
const Webpack = require( 'webpack' );
const Reload  = require( 'gulp-livereload' );

const config = {
	entry: './admin/js/frm-salesforce-admin.js',
	mode: 'development',
  output: {
      filename: './frm-salesforce-admin.js',
      path: Path.resolve(__dirname, '../dist/admin/js')
  },
  context: Path.resolve(__dirname, '../src'),
  module: {
  	rules: [
	  	{ test: /\.js$/, use: 'babel-loader' }
  	]
  }
};

function webpack() {

	return new Promise(resolve => Webpack(config, (err,stats) => {
	  if (err) console.log('Webpack', err)

	  console.log(stats.toString());

	  resolve()
	}))
	.then(Reload);

}

module.exports = { config, webpack }
