<?php
/**
 * Google Fonts Implementation
 *
 * @package Natural Lite
 * @since Natural Lite 1.0
 */

/**
 * Register Google Fonts
 *
 * @since Natural Lite 1.0
 */
function natural_lite_register_fonts() {
	$protocol = is_ssl() ? 'https' : 'http';
	wp_register_style( 'montserrat', "$protocol://fonts.googleapis.com/css?family=Montserrat:400,700" );
	wp_register_style( 'roboto', "$protocol://fonts.googleapis.com/css?family=Roboto:400,300italic,300,500,400italic,500italic,700,700italic" );
	wp_register_style( 'roboto-slab', "$protocol://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300,100" );
	wp_register_style( 'merriweather', "$protocol://fonts.googleapis.com/css?family=Merriweather:400,700,300,900" );
}
add_action( 'init', 'natural_lite_register_fonts' );

/**
 * Enqueue Google Fonts on Front End
 *
 * @since Natural Lite 1.0
 */

function natural_lite_fonts() {
	wp_enqueue_style( 'montserrat' );
	wp_enqueue_style( 'roboto' );
	wp_enqueue_style( 'merriweather' );
	wp_enqueue_style( 'roboto-slab' );
}
add_action( 'wp_enqueue_scripts', 'natural_lite_fonts' );

/**
 * Enqueue Google Fonts on Custom Header Page
 *
 * @since Natural Lite 1.0
 */
function natural_lite_admin_fonts( $hook_suffix ) {
	if ( 'appearance_page_custom-header' != $hook_suffix ) {
		return; }

	wp_enqueue_style( 'montserrat' );
	wp_enqueue_style( 'roboto' );
	wp_enqueue_style( 'merriweather' );
	wp_enqueue_style( 'roboto-slab' );
}
add_action( 'admin_enqueue_scripts', 'natural_lite_admin_fonts' );
