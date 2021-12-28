<?php
/**
 * Fire Theme Customizer
 *
 * @package Fire
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function fire_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'fire_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'fire_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'fire_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function fire_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function fire_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function fire_customize_preview_js() {
	wp_enqueue_script( 'fire-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'fire_customize_preview_js' );

/**
 * Switches the location of the styles
 */
function fire_customize_enqueue_theme_css() {
    wp_enqueue_style(
      'default',
      get_template_directory_uri() . '/dist/styles.css'
    );
}
add_action( 'wp_enqueue_scripts', 'fire_customize_enqueue_theme_css' );
