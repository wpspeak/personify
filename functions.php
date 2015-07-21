<?php

//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Personify Theme' );
define( 'CHILD_THEME_URL', 'http://wpspeak.com/themes/personify-theme/' );
define( 'CHILD_THEME_VERSION', '1.0.2' );

//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Enqueue Custom Scripts
add_action( 'wp_enqueue_scripts', 'personify_custom_scripts' );
function personify_custom_scripts() {

	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'personify-google-font', '//fonts.googleapis.com/css?family=Raleway|Droid+Serif', array(), CHILD_THEME_VERSION );
	wp_enqueue_script( 'personify-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );

}

//* Add new image size
add_image_size( 'featured-image', 620, 999, true );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 2-column footer widgets
add_theme_support( 'genesis-footer-widgets', 2 );

//* Remove the header right widget area
unregister_sidebar( 'header-right' );

//* Unregister sidebars
unregister_sidebar( 'sidebar' );
unregister_sidebar( 'sidebar-alt' );

//* Create color style options
add_theme_support( 'genesis-style-selector', array(
	'personify-turquoise'   => __( 'Turquoise', 'personify' ),
	'personify-green'  => __( 'Green', 'personify' ),
) );

//* Set default layout setting
genesis_set_default_layout( 'full-width-content' );

//* Unregister layouts
genesis_unregister_layout( 'content-sidebar' );
genesis_unregister_layout( 'sidebar-content' );
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

//* Unregister secondary navigation menu
add_theme_support( 'genesis-menus', array( 'primary' => __( 'Primary Navigation Menu', 'genesis' ) ) );

//* Modify the size of the Gravatar in comments
add_filter( 'genesis_comment_list_args', 'personify_comments_gravatar' );
function personify_comments_gravatar( $args ) {

	$args['avatar_size'] = 80;
	return $args;
	
}

//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'personify_author_box_gravatar_size' );
function personify_author_box_gravatar_size( $size ) {

	return '80';

}

//* Remove navigation extras meta boxes
add_action( 'genesis_theme_settings_metaboxes', 'personify_remove_genesis_metaboxes' );
function personify_remove_genesis_metaboxes( $_genesis_theme_settings_pagehook ) {

    remove_meta_box( 'genesis-theme-settings-nav', $_genesis_theme_settings_pagehook, 'main' );

}

//* Remove output of primary navigation right extras
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );

//* Remove HTML allowed tag in comment form
add_filter( 'comment_form_defaults', 'personify_comment_form_allowed_tags' );
function personify_comment_form_allowed_tags( $defaults ) {
 
	$defaults['comment_notes_after'] = '';
	return $defaults;
 
}

//* Add circular date before post title
add_action( 'genesis_before_entry_content','personify_custom_date');
function personify_custom_date () {
	if( !is_page() ) {
	
	?>
		<div class="my-date">
			<span class="my-date-day"><?php echo do_shortcode("[post_date format='j']"); ?></span>
			<span class="my-date-month"><?php echo do_shortcode("[post_date format='M']"); ?></span>
		</div>
	<?php
	}
	
}

//* Customize the entry meta in the entry header 
add_filter( 'genesis_post_info', 'personify_post_info_filter' );
function personify_post_info_filter($post_info) {

	$post_info = '[post_author_posts_link] [post_comments] [post_edit]';
	return $post_info;
	
}

//* Customize the entry meta in the entry footer 
add_filter( 'genesis_post_meta', 'personify_post_meta_filter' );
function personify_post_meta_filter($post_meta) {

	$post_meta = '[post_categories before=""] [post_tags before=""]';
	return $post_meta;
	
}

//* Change the footer text
add_filter('genesis_footer_creds_text', 'personify_footer_creds_filter');
function personify_footer_creds_filter( $creds ) {
	$creds = '[footer_copyright] &middot; ' . get_bloginfo('name') . ' &middot; Proudly powered by [footer_wordpress_link] and [footer_childtheme_link before=""]';
	return $creds;
}

//* Add top widget section
add_action( 'genesis_after_header', 'personify_top_widget', 15 );
function personify_top_widget() {

	genesis_widget_area( 'top-widget', array(
		'before' => '<aside class="top-widget"> <div class="wrap">',
		'after'  => '</aside> </div>',
	) );
	
}

//** Register top widget in sidebar
genesis_register_sidebar( array(
    'id'       		 => 'top-widget',
    'name'			 => __( 'Top  Widget', 'personify' ),
    'description'    => __( 'This is the top widget section.', 'personify' ),
) );
