<?php
/**
 * Nav Menu API: Walker_Nav_Menu class
 *
 * @package WordPress
 * @subpackage Nav_Menus
 * @since 4.6.0
 */

/**
 * Core class used to implement an HTML list of nav menu items.
 *
 * @since 3.0.0
 *
 * @see Walker
 */
class Mokime_Walker_Nav_Menu extends Walker {

	public function start_lvl(&$output, $depth = 0, $args = array()) {
		$output .= '';
	}

	public function end_lvl(&$output, $depth = 0, $args = array()) {
		$output .= '';
	}

	public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {

		if ($this->hasChildren($item)) {
			$output .= $this->startDropdownButton($item);
		} else {
			$output .= $this->getLinkButton($item);
		}
	}

	public function end_el(&$output, $item, $depth = 0, $args = array()) {

		if ($args->walker->has_children) {
			$output .= $this->endDropdownButton($item);
		} else {
			$output .= '';
		}
	}

	public function hasChildren($item) {

		if (in_array("menu-item-has-children", $item->classes)) {
			return true;
		}

		return false;
	}

	public function getLinkButton($item) {
		$url         = $item->url ?? '';
		$classes     = empty($item->classes) ? array() : (array) $item->classes;
		$class_names = '';

		if (in_array('current-menu-item', $classes)) {
			$class_names .= 'is-active';
		}

		$button = sprintf("<a href='%s' class='navbar-item is-white %s'>%s</a>", $url, $class_names, $item->title);

		return $button;
	}

	public function startDropdownButton($item) {
		$url         = $item->url ?? '';
		$classes     = empty($item->classes) ? array() : (array) $item->classes;
		$class_names = '';

		if (in_array('current-menu-item', $classes)) {
			$class_names .= 'is-active';
		}

		$button = sprintf("<a href='%s' class='navbar-link %s is-white'>%s</a>", $url, $class_names, $item->title);

		$dropdown = sprintf("<div class='navbar-item has-dropdown is-hoverable'>%s", $button);

		$dropdown .= "<div class='navbar-dropdown is-boxed'>";
		return $dropdown;
	}

	public function endDropdownButton($item) {
		return "</div></div>";
	}

}

