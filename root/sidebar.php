<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package {%= title %}
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" class="site-sidebar" role="complementary">
	<div class="widgets-area">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</div><!-- #secondary -->
