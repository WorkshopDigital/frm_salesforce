
'use strict';
const { series, parallel } = require( 'gulp' );
const clean        = require( './clean' );
const php          = require( './php' );
const sass         = require( './sass' );
const watch        = require( './watch' );
const images       = require( './images' );
const javascript   = require( './javascript' );

exports.sass    = sass;
exports.watch   = watch;
exports.default = series(
  clean,
  parallel( php, images, javascript, sass )
);
