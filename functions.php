<?php
/**
 * PBrx 2017 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */

include( 'inc/functions/pbrx-functions.php' );
// include( 'inc/functions/class-pbrx-customizer-options.php' );
include( 'inc/functions/class-slick-slider-customizer.php' );

/**
 * As a child theme, let's make sure we enqueue scripts and styles from the parent theme.
 */
function enqueue_pbrx_2017_style() {
	wp_enqueue_style( 'parent-style', esc_url( trailingslashit( get_template_directory_uri() ) . 'style.css' ) );
}
add_action( 'wp_enqueue_scripts', 'enqueue_pbrx_2017_style' );

/**
 * Return value of front panels.
 **/
function pbrx_adjust_panel_quantity() {
	$front_page_panels = get_theme_mod( 'front_page_panels' );
	return $front_page_panels;
}
add_filter( 'twentyseventeen_front_page_sections', 'pbrx_adjust_panel_quantity' );

