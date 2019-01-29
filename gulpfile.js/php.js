'use strict';
const Reload  = require( 'gulp-livereload' );
const Replace = require('gulp-replace');
const Header  = require( 'gulp-header' );
const Pkg     = require('../package.json');
const { src, dest, parallel, series } = require( 'gulp' );

const banner = `<?php
/**
 * Formidable Forms Salesforce Integration
 *
 * Upload Formidable Forms submissions into the Salesforce CRM via their API.
 *
 *
 * @link              https://workshopdigital.com
 * @since             2.0.0
 * @package           FRM_Salesforce
 *
 * @wordpress-plugin
 * Plugin Name:       Formidable Forms Salesforce
 * Plugin URI:        https://workshopdigital.com
 * Description:       ${Pkg.description}
 * Version:           ${Pkg.version}
 * Author:            ${Pkg.author}
 * Author URI:        https://workshopdigital.com
 * License:           Copyright Workshop Digital
 * Text Domain:       frm-salesforce
 * Domain Path:       /languages
 */
 */
 ?>
`;

const destination = 'dist/';

function syncPHP() {
  const glob = ['src/**/*.php', '!src/frm-salesforce.php'];
  return src( ['src/**/*.php', '!src/frm-salesforce.php'] ).pipe( dest( destination ) ).pipe(Reload());
}

function syncMainPHP() {
  const glob = 'src/frm-salesforce.php';
  return src( glob )
	  .pipe( Replace( '%%PLUGIN_VER%%', `'${Pkg.version}'` ) )
	  .pipe( Header( banner ) )
	  .pipe( dest( destination ) );
}

exports.syncMainPHP = syncMainPHP;
exports.syncPHP     = syncPHP;
module.exports      = parallel( syncMainPHP, syncPHP );