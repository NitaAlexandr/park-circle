<?php if ( ! defined( 'WP_DEBUG' ) ) {
	die( 'Direct access forbidden.' );
}

function the_core_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_stylesheet_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'the_core_theme_enqueue_styles' );



function the_core_top_bar( $atts = array('top_bar_text' => '', 'enable_header_socials' => '', 'enable_search' => '', 'search_type' => '', 'placeholder_text' => '', 'search_position' => '') )
{
    if ( $atts['enable_header_socials'] == 'yes' ) {
        echo the_core_get_socials( 'fw-top-bar-social' );
    }
}