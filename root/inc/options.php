<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
	register_setting( '{%= prefix %}_options', '{%= prefix %}_theme_options', 'theme_options_validate' );
}

/**
 * Load up the menu page
 */
function theme_options_add_page() {
	add_theme_page( __( 'Options', '{%= prefix %}' ), __( 'Options', '{%= prefix %}' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}

/**
 * Create the options page
 */
function theme_options_do_page() {

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . wp_get_theme() . __( ' Options', '{%= prefix %}' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', '{%= prefix %}' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( '{%= prefix %}_options' ); ?>
			<?php $options = get_option( '{%= prefix %}_theme_options' ); ?>

			<table class="form-table">

				<?php
				/**
				 * Fixed Navigation
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Navigation', '{%= prefix %}' ); ?></th>
					<td>
						<input id="{%= prefix %}_theme_options[fixed_nav]" name="{%= prefix %}_theme_options[fixed_nav]" type="checkbox" value="1" <?php checked( '1', $options['fixed_nav'] ); ?> />
						<label class="description" for="{%= prefix %}_theme_options[fixed_nav]"><?php _e( 'Fixed', '{%= prefix %}' ); ?></label>
					</td>
				</tr>

				<?php
				/**
				 * Twitter URL
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Twitter', '{%= prefix %}' ); ?></th>
					<td>
						<input id="{%= prefix %}_theme_options[twitter]" class="regular-text" type="text" name="{%= prefix %}_theme_options[twitter]" value="<?php esc_attr_e( $options['twitter'] ); ?>" />
						<label class="description" for="{%= prefix %}_theme_options[twitter]"><?php _e( 'http://twitter.com/username', '{%= prefix %}' ); ?></label>
					</td>
				</tr>
				<?php
				/**
				 * Facebook URL
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Facebook', '{%= prefix %}' ); ?></th>
					<td>
						<input id="{%= prefix %}_theme_options[facebook]" class="regular-text" type="text" name="{%= prefix %}_theme_options[facebook]" value="<?php esc_attr_e( $options['facebook'] ); ?>" />
						<label class="description" for="{%= prefix %}_theme_options[facebook]"><?php _e( 'http://facebook.com/username', '{%= prefix %}' ); ?></label>
					</td>
				</tr>
				<?php
				/**
				 * Instagram URL
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Instagram', '{%= prefix %}' ); ?></th>
					<td>
						<input id="{%= prefix %}_theme_options[instagram]" class="regular-text" type="text" name="{%= prefix %}_theme_options[instagram]" value="<?php esc_attr_e( $options['instagram'] ); ?>" />
						<label class="description" for="{%= prefix %}_theme_options[instagram]"><?php _e( 'http://instagram.com/username', '{%= prefix %}' ); ?></label>
					</td>
				</tr>
				<?php
				/**
				 * Flickr URL
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Flickr', '{%= prefix %}' ); ?></th>
					<td>
						<input id="{%= prefix %}_theme_options[flickr]" class="regular-text" type="text" name="{%= prefix %}_theme_options[flickr]" value="<?php esc_attr_e( $options['flickr'] ); ?>" />
						<label class="description" for="{%= prefix %}_theme_options[flickr]"><?php _e( 'http://flickr.com/username', '{%= prefix %}' ); ?></label>
					</td>
				</tr>
				<?php
				/**
				 * Linkedin URL
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Linkedin', '{%= prefix %}' ); ?></th>
					<td>
						<input id="{%= prefix %}_theme_options[linkedin]" class="regular-text" type="text" name="{%= prefix %}_theme_options[linkedin]" value="<?php esc_attr_e( $options['linkedin'] ); ?>" />
						<label class="description" for="{%= prefix %}_theme_options[linkedin]"><?php _e( 'http://linkedin.com/username', '{%= prefix %}' ); ?></label>
					</td>
				</tr>
				<?php
				/**
				 * YouTube URL
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'YouTube', '{%= prefix %}' ); ?></th>
					<td>
						<input id="{%= prefix %}_theme_options[youtube]" class="regular-text" type="text" name="{%= prefix %}_theme_options[youtube]" value="<?php esc_attr_e( $options['youtube'] ); ?>" />
						<label class="description" for="{%= prefix %}_theme_options[youtube]"><?php _e( 'http://youtube.com/username', '{%= prefix %}' ); ?></label>
					</td>
				</tr>
				<?php
				/**
				 * Vimeo URL
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Vimeo', '{%= prefix %}' ); ?></th>
					<td>
						<input id="{%= prefix %}_theme_options[vimeo]" class="regular-text" type="text" name="{%= prefix %}_theme_options[vimeo]" value="<?php esc_attr_e( $options['vimeo'] ); ?>" />
						<label class="description" for="{%= prefix %}_theme_options[vimeo]"><?php _e( 'http://vimeo.com/username', '{%= prefix %}' ); ?></label>
					</td>
				</tr>
				<?php
				/**
				 * Pinterest URL
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Pinterest', '{%= prefix %}' ); ?></th>
					<td>
						<input id="{%= prefix %}_theme_options[pinterest]" class="regular-text" type="text" name="{%= prefix %}_theme_options[pinterest]" value="<?php esc_attr_e( $options['pinterest'] ); ?>" />
						<label class="description" for="{%= prefix %}_theme_options[pinterest]"><?php _e( 'http://pinterest.com/username', '{%= prefix %}' ); ?></label>
					</td>
				</tr>
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', '{%= prefix %}' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {

	// Say our text option must be safe text with no HTML tags
	$input['twitter'] = wp_filter_nohtml_kses( $input['twitter'] );
	$input['facebook'] = wp_filter_nohtml_kses( $input['facebook'] );
	$input['instagram'] = wp_filter_nohtml_kses( $input['instagram'] );
	$input['flickr'] = wp_filter_nohtml_kses( $input['flickr'] );
	$input['linkedin'] = wp_filter_nohtml_kses( $input['linkedin'] );
	$input['youtube'] = wp_filter_nohtml_kses( $input['youtube'] );
	$input['vimeo'] = wp_filter_nohtml_kses( $input['vimeo'] );
	$input['pinterest'] = wp_filter_nohtml_kses( $input['pinterest'] );

	return $input;
}

/**
 * Connections
 */
function {%= prefix %}_social_links() {
	$networks = array(
	  'twitter' => '',
	  'facebook' => '',
	  'instagram' => '',
	  'flickr' => '',
	  'linkedin' => '',
	  'youtube' => '',
	  'vimeo' => '-square',
	  'pinterest' => '');
	$html = '';
	foreach ( $networks as $network => $prefix ) {
		$option = get_option( '{%= prefix %}_theme_options' );
		$href = $option[$network];
		if ( !empty( $href ) ) {
			$html .= '<li>';
			$html .= '<a href="' . $href . '" class="' . $network . '-icon">';
			$html .= '<i class="fa fa-' . $network . $prefix . '"></i>';
			$html .= '</a>';
			$html .= '</li>';
		}
	}
	if ( !empty( $html ) ) {
		echo '<ul class="social-list">' . $html . '</ul>';
	}
}
