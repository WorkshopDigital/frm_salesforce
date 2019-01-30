
'use strict';
const { series, parallel } = require( 'gulp' );
const clean        = require( './clean' );
const php          = require( './php' );
const sass         = require( './sass' );
const watch        = require( './watch' );
const images       = require( './images' );
const javascript   = require( './javascript' );
const { webpack }  = require( './webpack' );

exports.sass    = sass;
exports.watch   = watch;
exports.webpack = webpack;
exports.default = series(
  clean,
  parallel( php, images, webpack, sass )
);
