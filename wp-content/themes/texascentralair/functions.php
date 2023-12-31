<?php
/**
 * Theme functions and definitions
 *
 * @package PluginDevs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'TEXAS_CENTRAL_AIR_CHILD_VERSION', '0.0.3.46' );

/**
 * After Setup Theme Hook
 */
function pd_hello_child_setup_theme() {
	//Add Theme Supports.
	add_theme_support('menus');
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'pd_hello_child_setup_theme' );


/**
 * Loads Styles and Scripts
 */
function pd_hello_child_enqueue() {
	$parent_style = 'hello-elementor';

	wp_dequeue_style( 'hello-elementor' );
	wp_enqueue_style('child_theme_style', get_stylesheet_uri(), array(), TEXAS_CENTRAL_AIR_CHILD_VERSION, 'all');
	wp_enqueue_style('responsive', get_stylesheet_directory_uri() . '/assets/css/responsive.css' , array(), TEXAS_CENTRAL_AIR_CHILD_VERSION, 'all');

	// Dequeue Parent Theme JS
	wp_dequeue_script( 'hello-theme-frontend' );
	//Enqueue Scripts.
	wp_enqueue_script('jquery');
	wp_enqueue_script('masonry-js', 'https://unpkg.com/packery@2/dist/packery.pkgd.js', array(), TEXAS_CENTRAL_AIR_CHILD_VERSION, false);
	wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js', array(), TEXAS_CENTRAL_AIR_CHILD_VERSION, false);
	wp_enqueue_script('theme', get_stylesheet_directory_uri() . '/assets/js/theme.js', array( 'jquery' ), TEXAS_CENTRAL_AIR_CHILD_VERSION, true);
}
add_action( 'wp_enqueue_scripts', 'pd_hello_child_enqueue' );

/**
 * Add Wrapper for Elementor Full Width Template
 */
function tca_start_elementor_content_wrapper() {
    echo '<div class="tca-content-wrapper">';
}
add_action( 'elementor/page_templates/header-footer/before_content', 'tca_start_elementor_content_wrapper' );

/**
 * Add Wrapper for Elementor Full Width Template
 */
function tca_end_elementor_content_wrapper() {
    echo '</div>';
}
add_action( 'elementor/page_templates/header-footer/after_content', 'tca_end_elementor_content_wrapper' );

/**
 * Apply a custom template when the post is inserted.
 * 
 * @param  int    $post_ID The post ID.
 * @param  object $post    The post object
 * @param  bool   $update  True if the post is updated, false if inserted.
 * @return void
 */
function tca_apply_elementor_full_width_template_on_insert( int $post_ID, object $post, bool $update ) {
	if (
		in_array( get_post_type($post_ID), array( 'post', 'page', 'review' ) ) &&
		empty( $update ) ||
		'auto-draft' === $post->post_status
	) {
		update_post_meta( $post_ID, '_wp_page_template', 'elementor_header_footer' );
	}
}
add_action( 'wp_insert_post', 'tca_apply_elementor_full_width_template_on_insert', 10, 3 );

/**
 * Add Shortcode for Display Breadcumb with Breadcumb NavXT
 */
function tca_breadcumb_navxt_shortcode() {
	ob_start();
	if(function_exists('bcn_display'))
    {
		echo '<div class="tca-breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">';
        bcn_display();
		echo '</div>';
    }
	return ob_get_clean();
}
add_shortcode( 'tca_breadcumb', 'tca_breadcumb_navxt_shortcode' );

/**
 * Add custom html wrapper to breadcumb separator
 * 
 * @param string $separator
 * @param string $position
 * @param string $last_position
 * @param integer $depth
 * 
 * @return string $separator
 */
function tca_bcn_separator($separator, $position, $last_position, $depth)
{
    $separator ='<span class="tca-breadcumb-separator">'.$separator.'</span>';
    return $separator;
}
add_filter('bcn_display_separator', 'tca_bcn_separator', 10, 4);

/**
 * Add Search Form to the Main Menu
 * 
 * @param string $items
 * @param object $args
 * 
 * @return string $items
 */
function add_last_nav_item($items, $args) {
	if ( 'main-menu' === $args->menu ) {
		  $homelink = get_search_form(false);
		  $items .= '<li class="menu-search-form tca-align-center tca-d-flex">'.$homelink.'</li>';
		  return $items;
	}
	return $items;
}
add_filter( 'wp_nav_menu_items', 'add_last_nav_item', 10, 2 );

/**
 * Add CSS class to Main Menu
 * 
 * @param array $classes
 * @param string $item
 * @param object $args
 * 
 * @return array $classes
 */
function tca_add_main_menu_classes( $classes, $item, $args ) {
	if ( 'main-menu' === $args->menu ) {
	  $classes[] = 'tca-align-center';
	  $classes[] = 'tca-d-flex';
	}
	return $classes;
}
add_filter('nav_menu_css_class', 'tca_add_main_menu_classes', 1, 3);

/**
 * Include Files
 */
require_once get_stylesheet_directory() . '/inc/custom-post-types.php';
require_once get_stylesheet_directory() . '/inc/elementor.php';