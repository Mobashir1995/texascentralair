<?php
/**
 * Theme functions and definitions
 *
 * @package PluginDevs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'TEXAS_CENTRAL_AIR_CHILD_VERSION', '0.0.1' );

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