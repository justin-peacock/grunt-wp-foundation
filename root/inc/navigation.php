<?php
/**
* Top Bar
* Customize the menu output for use with Foundation
*
* @package {%= title %}
*/

/**
* Build Top Bar
*/
function {%= prefix %}_build_topbar() {
	if (has_nav_menu( 'primary' ) ) {
		echo wp_nav_menu( array(
			'theme_location' => 'primary',
			'menu_class' => 'left',
			'walker' => new {%= prefix %}_topbar_walker(),
			'container' => ''
		));
	}
	else {
		echo '<ul class="left">';
			echo '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
		echo '</ul>';
	}
}

/**
* Navigation Menu Adjustments
*/
class {%= prefix %}_topbar_walker extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"dropdown\">\n";
	}
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
		$id_field = $this->db_fields['id'];
		if ( !empty( $children_elements[ $element->$id_field ] ) ) {
			$element->classes[] = 'has-dropdown';
		}
		Walker_Nav_Menu::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}
