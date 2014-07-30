<?php

//* Theme Setting Defaults
add_filter( 'genesis_theme_settings_defaults', 'personify_theme_defaults' );
function personify_theme_defaults( $defaults ) {

	$defaults['posts_nav']                 = 'numeric';
	$defaults['site_layout']               = 'full-width-content';

	return $defaults;

}

//* Theme Setup
add_action( 'after_switch_theme', 'personify_theme_setting_defaults' );
function personify_theme_setting_defaults() {

	_genesis_update_settings( array(
		'posts_nav'                 => 'numeric',
		'site_layout'               => 'full-width-content',
	) );

	update_option( 'posts_per_page', 5 );

}

//* Simple Social Icon Defaults
add_filter( 'simple_social_default_styles', 'personify_social_default_styles' );
function personify_social_default_styles( $defaults ) {

	$args = array(
		'alignment'              => 'aligncenter',
		'background_color'       => '#776666',
		'background_color_hover' => '#f48177',
		'border_radius'          => 36,
		'icon_color'             => '#ffffff',
		'icon_color_hover'       => '#ffffff',
		'size'                   => 42,
		);
		
	$args = wp_parse_args( $args, $defaults );
	
	return $args;
	
}
