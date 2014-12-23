<?php
/**
 * Scripts and stylesheets
 *
 * Enqueue stylesheets in the following order:
 * 1. /theme/assets/css/main.css
 *
 * Enqueue scripts in the following order:
 * 2. /theme/assets/js/vendor/modernizr.min.js
 * 3. /theme/assets/js/scripts.js (in footer)
 *
 */
function {%= prefix %}_scripts() {
	/**
	 * The build task in Grunt renames production assets with a hash
	 * Read the asset names from assets-manifest.json
	 */
	if (WP_ENV === 'development') {
		$assets = array(
			'css'       => '/assets/css/main.css',
			'rtl'       => '/assets/css/main-rtl.css',
			'child'     => '/style.css',
			'icons'     => '/assets/css/font-awesome.css',
			'js'        => '/assets/js/scripts.js',
			'modernizr' => '/bower_components/modernizr/modernizr.js',
			'livereload'  => '//localhost:35729/livereload.js'
		);
	} else {
		$get_assets = file_get_contents(get_template_directory() . '/assets/manifest.json');
		$assets     = json_decode($get_assets, true);
		$assets     = array(
			'css'       => '/assets/css/main.min.css?' . $assets['assets/css/main.min.css']['hash'],
			'rtl'       => '/assets/css/main-rtl.css?' . $assets['assets/css/main-rtl.css']['hash'],
			'child'     => '/style.css?',
			'icons'     => '/assets/css/font-awesome.min.css?' . $assets['assets/css/font-awesome.min.css']['hash'],
			'js'        => '/assets/js/scripts.min.js?' . $assets['assets/js/scripts.min.js']['hash'],
			'modernizr' => '/assets/js/vendor/modernizr.min.js'
		);
	}

	wp_enqueue_style( '{%= prefix %}-css', get_template_directory_uri() . $assets['css'], false, null);
	wp_enqueue_style( '{%= prefix %}-fonts', {%= prefix %}_fonts_url(), array(), null );
	wp_enqueue_style( '{%= prefix %}-icons', get_template_directory_uri() . $assets['icons'], false, null);

	if ( is_child_theme() ){
		wp_enqueue_style( '{%= prefix %}-child', get_stylesheet_directory_uri() . $assets['child'], false, null);
	}

	if ( is_rtl() ) {
		wp_enqueue_style( '{%= prefix %}-rtl', get_template_directory_uri() . $assets['rtl'], false, null);
	}

	if ( is_single() && comments_open() && get_option('thread_comments') ) {
		wp_enqueue_script('comment-reply');
	}

	wp_enqueue_script( 'modernizr', get_template_directory_uri() . $assets['modernizr'], array(), null, false);
	wp_enqueue_script( 'jquery');
	wp_enqueue_script( '{%= prefix %}-js', get_template_directory_uri() . $assets['js'], array(), null, true);

	if (WP_ENV === 'development') {
		wp_enqueue_script( 'livereload', $assets['livereload'], '', false, true );
	}
}
add_action('wp_enqueue_scripts', '{%= prefix %}_scripts', 100);

/**
 * Add conditional IE styles and scripts
 */
function {%= prefix %}_ie_scripts() {
	?>
	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/assets/js/ie.js" type="text/javascript"></script>
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/rem-fallback.css">
	<![endif]-->
	<?php
}
add_action( 'wp_head', '{%= prefix %}_ie_scripts', 8 );
