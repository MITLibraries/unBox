<?php
/**
 * unBox functions and definitions.
 *
 * @package WordPress
 * @subpackage unBox
 * @since unBox 1.0
 */

/**
 * Register widget areas
 */
function slideshow_widgets_init() {
	register_sidebar( array(
			'name' => 'Slideshow Bar',
			'id' => 'slideshow',
			'before_widget' => '<div class="card">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'slideshow_widgets_init' );
function diptych_widgets_init() {
	register_sidebar( array(
			'name' => 'Diptych Bar',
			'id' => 'diptych',
			'before_widget' => '<div class="dip">',
			'after_widget' => '</div>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'diptych_widgets_init' );

add_filter( 'put_trailing_linebreak', '__return_false' );