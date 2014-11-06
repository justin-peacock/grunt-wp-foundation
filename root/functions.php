<?php
/**
 * {%= title %} functions and definitions
 *
 * @package {%= title %}
 */

/**
 * {%= title %} includes
 *
 * The ${%= prefix %}_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 */
${%= prefix %}_includes = array(
	'inc/setup.php',
	'inc/scripts.php',
	'inc/navigation.php',
	'inc/sidebars.php',
	'inc/widgets.php',
	'inc/template-tags.php',
	'inc/extras.php',
	'inc/jetpack.php'
);

foreach ( ${%= prefix %}_includes as $file ) {
	if ( !$filepath = locate_template( $file ) ) {
	  trigger_error( sprintf( __( 'Error locating %s for inclusion', '{%= prefix %}' ), $file ), E_USER_ERROR );
	}

  require_once $filepath;
}
unset( $file, $filepath );
