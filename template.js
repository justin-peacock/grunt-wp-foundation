/**
 * grunt-wp-foundation
 * https://github.com/mrdink/grunt-wp-foundation
 *
 * Copyright (c) 2014 Justin Peacock, Sixteenbit
 * Licensed under the MIT License
 */

'use strict';

// Basic template description
exports.description = 'Create a WordPress theme.';

// Template-specific notes to be displayed before question prompts.
exports.notes = '';

// Template-specific notes to be displayed after the question prompts.
exports.after = '';

// Any existing file or directory matching this wildcard will cause a warning.
exports.warnOn = '*';

// The actual init template
exports.template = function( grunt, init, done ) {
	init.process( {}, [
		// Prompt for these values.
		init.prompt( 'title', 'WP Theme' ),
		{
			name   : 'prefix',
			message: 'PHP function prefix (alpha and underscore characters only)',
			default: 'wptheme'
		},
		init.prompt( 'description', 'The best WordPress theme ever made!' ),
		init.prompt( 'homepage', 'http://wordpress.org/themes' ),
		init.prompt( 'author_name' ),
		init.prompt( 'author_email' ),
		init.prompt( 'author_url' )
	], function( err, props ) {
		props.keywords = [];
		props.version = '0.1.0';
		props.devDependencies = {
			"grunt": "^0.4.5",
			"load-grunt-tasks": "^1.0.0",
			"node-sass": "^1.2.1",
			"time-grunt": "^1.0.0",
			"grunt-sass": "^0.16.1",
			"grunt-csscomb": "^3.0.0",
			"grunt-cssjanus": "^0.2.2",
			"grunt-autoprefixer": "~1.0.1",
			"grunt-contrib-cssmin": "^0.10.0",
			"grunt-pixrem": "~0.1.1",
			"grunt-contrib-copy": "^0.7.0",
			"grunt-contrib-clean": "^0.6.0",
			"grunt-contrib-concat": "~0.5.0",
			"grunt-contrib-jshint": "~0.10.0",
			"grunt-contrib-uglify": "^0.6.0",
			"grunt-contrib-watch": "~0.6.1",
			"grunt-dev-update": "^1.0.1",
			"grunt-modernizr": "^0.6.0",
			"grunt-notify": "^0.3.1",
			"grunt-wp-i18n": "^0.4.9",
			"grunt-wp-assets": "~0.2.6"
		};

		// Sanitize names where we need to for PHP/JS
		props.name = props.title.replace( /\s+/g, '-' ).toLowerCase();
		// Development prefix (i.e. to prefix PHP function names, variables)
		props.prefix = props.prefix.replace('/[^a-z_]/i', '').toLowerCase();
		// Development prefix in all caps (e.g. for constants)
		props.prefix_caps = props.prefix.toUpperCase();
		// An additional value, safe to use as a JavaScript identifier.
		props.js_safe_name = props.name.replace(/[\W_]+/g, '_').replace(/^(\d)/, '_$1');
		// An additional value that won't conflict with NodeUnit unit tests.
		props.js_test_safe_name = props.js_safe_name === 'test' ? 'myTest' : props.js_safe_name;
		props.js_safe_name_caps = props.js_safe_name.toUpperCase();

		// Files to copy and process
		var files = init.filesToCopy( props );

		console.log( files );

		// Actually copy and process files
		init.copyAndProcess( files, props );

		// Generate package.json file
		init.writePackageJSON( 'package.json', props );

		// Done!
		done();
	});
};