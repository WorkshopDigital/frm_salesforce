'use strict';
const Del = require( 'del' );

function cleanAll() {
  return Del( 'dist/*' );
}

module.exports = cleanAll;
