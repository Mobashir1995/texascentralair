<?php
function tca_elementor_widgets( $widgets_manager ) {

	require_once( get_stylesheet_directory() . '/inc/elementor-widgets/review-slider.php' );
	require_once( get_stylesheet_directory() . '/inc/elementor-widgets/quote-slider.php' );

	$widgets_manager->register( new \TCA_Review_Slider () );
	$widgets_manager->register( new \TCA_Quote_Slider () );

}
add_action( 'elementor/widgets/register', 'tca_elementor_widgets' );

/**
 * Create new Custom Category for Custom Elementor widgets
 */
function tca_elementor_custom_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'tca-widgets',
		[
			'title' => esc_html__( 'Theme Custom Widgets', 'textdomain' ),
			'icon' => 'fa fa-plug',
		]
	);

}
add_action( 'elementor/elements/categories_registered', 'tca_elementor_custom_widget_categories' );