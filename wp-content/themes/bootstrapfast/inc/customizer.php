<?php
/**
 * BootstrapFast Theme Customizer
 *
 * @package BootstrapFast
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bootstrapfast_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'bootstrapfast_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function bootstrapfast_customize_preview_js() {
	wp_enqueue_script( 'bootstrapfast_customizer', get_template_directory_uri() . '/assets/admin/js/customizer.js', array( 'customize-preview' ), '20170101', true );
}
add_action( 'customize_preview_init', 'bootstrapfast_customize_preview_js' );


if ( ! function_exists( 'bootstrapfast_theme_customize_register' ) ) {
	/**
	 * Register individual settings through customizer's API.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer reference.
	 */
	function bootstrapfast_theme_customize_register( $wp_customize ) {

		// Theme layout settings.
		$wp_customize->add_section( 'bootstrapfast_theme_layout_options', array(
			'title'       => __( 'Theme Layout Settings', 'bootstrapfast' ),
			'capability'  => 'edit_theme_options',
			'description' => __( 'Container width and sidebar defaults', 'bootstrapfast' ),
			'priority'    => 160,
		) );

		$wp_customize->add_setting( 'bootstrapfast_container_type', array(
			'default'           => 'container-fluid',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'bootstrapfast_container_type_sanitize',
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'container_type', array(
					'label'       => __( 'Container Width', 'bootstrapfast' ),
					'description' => __( "Choose between Bootstrap's container and container-fluid", 'bootstrapfast' ),
					'section'     => 'bootstrapfast_theme_layout_options',
					'settings'    => 'bootstrapfast_container_type',
					'type'        => 'select',
					'choices'     => array(
						'container'       => __( 'Fixed width container', 'bootstrapfast' ),
						'container-fluid' => __( 'Full width container', 'bootstrapfast' ),
					),
					'priority'    => '10',
				)
			)
		);

		$wp_customize->add_setting( 'bootstrapfast_mainheader_position', array(
			'default'           => 'left',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'bootstrapfast_mainheader_position_sanitize',
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'bootstrapfast_mainheader_position', array(
					'label'       => __( 'Main Header Positioning', 'bootstrapfast' ),
					'description' => __( 'Main Sidebar can be from the top, left or right.',
					'bootstrapfast' ),
					'section'     => 'bootstrapfast_theme_layout_options',
					'settings'    => 'bootstrapfast_mainheader_position',
					'type'        => 'select',
					'choices'     => array(
						'left'	  => __( 'Left', 'bootstrapfast' ),
						'right'   => __( 'Right', 'bootstrapfast' ),
						'top' 	  => __( 'Top', 'bootstrapfast' ),
					),
					'priority'    => '20',
				)
			)
		);
	}
}

add_action( 'customize_register', 'bootstrapfast_theme_customize_register' );

/**
 * Top overrides for the header area.
 */
function bootstrapfast_main_header_style() {
	$maincontainer = get_theme_mod( 'bootstrapfast_mainheader_position' );
	if ( 'left' === $maincontainer ) {
		return 'col-md-3 left-head';
	} elseif ( 'right' === $maincontainer ) {
		return 'col-md-3 push-md-9';
	} else {
		return 'col-md-12 top-position';
	}
}

/**
 * Body overrides.
 */
function bootstrapfast_main_body_style() {
	$maincontainer = get_theme_mod( 'bootstrapfast_mainheader_position' );
	if ( 'left' === $maincontainer ) {
		return 'col-md-9';
	} elseif ( 'right' === $maincontainer ) {
		return 'col-md-9 pull-md-3';
	} else {
		return 'col-md-12';
	}
}

/**
 * Container is fluid or not overrides.
 */
function bootstrapfast_container_type() {
	$container = get_theme_mod( 'bootstrapfast_container_type' );
	if ( 'container' === $container ) {
		return 'container';
	} else {
		return 'container-fluid';
	}
}

/**
 * Sidebar placement.
 */
function bootstrapfast_main_sidebar_placement() {
	$maincontainer = get_theme_mod( 'bootstrapfast_mainheader_position' );
	if ( 'left' === $maincontainer ) {
		return true;
	} elseif ( 'right' === $maincontainer ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Sanitize bootstrap container type.
 */
function bootstrapfast_container_type_sanitize( $containertype ) {
    if ( ! in_array( $containertype, array( 'container-fluid', 'container' ) ) ) {
        $containertype = 'container-fluid';
    }
    return $containertype;
}

/**
 * Sanitize bootstrap header position.
 */
function bootstrapfast_mainheader_position_sanitize( $headerposition ) {
    if ( ! in_array( $headerposition, array( 'left', 'right', 'top' ) ) ) {
        $headerposition = 'left';
    }
    return $headerposition;
}
