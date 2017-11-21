module.exports = function (grunt) {
  grunt.registerTask('build', [
  	'sync:php',
  	'jshint:all',
  	'sync:js',
  	'sync:images'
	]);
};
