<?php
/**
 * Enqueue parent theme styles
 */
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    $parent_handle = 'gridbox-style';
    $theme = wp_get_theme();
    wp_enqueue_style( $parent_handle, get_template_directory_uri() . '/style.css', 
        array(),
        $theme->parent()->get( 'Version' )
    );
}

/**
 * Register child theme footer menu area
 */
register_nav_menu( 'secondary', esc_html__( 'Footer Navigation', 'gridbox-child' ) );

/**
 * Child theme customizer settings 
 */

//Add Custom Theme Options Panel
add_action( 'customize_register' , 'gridbox_child_panel_customizer' );
function gridbox_child_panel_customizer($wp_customize) {
	$wp_customize->add_panel( 'gridbox_custom_options_panel', array(
		'priority'       => 180,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__( 'Custom Theme Options', 'gridbox-child' ),
	) );
}

// Footer Customizer
add_action( 'customize_register' , 'gridbox_child_footer_customizer' );
function gridbox_child_footer_customizer($wp_customize){  
	$wp_customize->add_section('custom_footer_settings_section', array(
		'title'          => 'Custom Footer Section',
		'panel'    => 'gridbox_custom_options_panel'
	));

	// Title
	$wp_customize->add_setting( 'custom_footer_title', array(
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'default' => 'About',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	));

	$wp_customize->add_control('custom_footer_title',array(
		'label'      => 'Custom Footer Title',
		'section'    => 'custom_footer_settings_section',
		'settings'   => 'custom_footer_title',
		'type'=> 'text',
	)); 

	$wp_customize->selective_refresh->add_partial( 'custom_footer_title', array(
		'selector'         => '#custom-footer__title',
		'fallback_refresh' => false,
	));

	// Description
	$wp_customize->add_setting( 'custom_footer_description', array(
		'type' => 'theme_mod',
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'default' => 'Your Text Here',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	));

	$wp_customize->add_control('custom_footer_description',array(
		'label'      => 'Custom Footer Description',
		'section'    => 'custom_footer_settings_section',
		'settings'   => 'custom_footer_description',
		'type'=> 'textarea',
	));

	$wp_customize->selective_refresh->add_partial( 'custom_footer_description', array(
		'selector'         => '#custom-footer__description',
		'fallback_refresh' => false,
	));

	// Navigation

		// Navigation Checkbox
		$wp_customize->add_setting( 'footer_col_checkbox', array(
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'gridbox_sanitize_checkbox',
			'default' => 1,
		) );

		$wp_customize->add_control( 'footer_col_checkbox', array(
			'type' => 'checkbox',
			'section' => 'custom_footer_settings_section',
			'label' => __( 'Show Footer Navigation Options' ),
			'description' => __( 'See the available footer navigation options.' ),
		) );

		// Navigation Title
		$wp_customize->add_setting( 'custom_footer_nav', array(
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'theme_supports' => '',
			'default' => 'Navegação',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		));

		$wp_customize->add_control( 'custom_footer_nav',array(
			'label'      => 'Custom Footer Nav Title',
			'section'    => 'custom_footer_settings_section',
			'settings'   => 'custom_footer_nav',
			'type'=> 'text',
			'active_callback' => function() use ( $wp_customize ) {
				return true === $wp_customize->get_setting( 'footer_col_checkbox' )->value();
			},
		)); 

		$wp_customize->selective_refresh->add_partial( 'custom_footer_nav', array(
			'selector'         => '#custom-footer__navbar-title',
			'fallback_refresh' => false,
		));

		// Footer Selector
		$wp_customize->add_setting( 'custom_footer_menu', array(
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'theme_supports' => '',
			'default' => '',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		));

		$wp_customize->add_control( 'custom_footer_menu', array(
			'label'      => 'Custom Footer Menu',
			'section'    => 'custom_footer_settings_section',
			'settings'   => 'custom_footer_menu',
			'type' => 'select',
			'choices' => get_registered_nav_menus(),
			'active_callback' => function() use ( $wp_customize ) {
				return true === $wp_customize->get_setting( 'footer_col_checkbox' )->value();
			},
		)); 

		$wp_customize->selective_refresh->add_partial( 'custom_footer_menu', array(
			'selector'         => '#custom-footer__menu',
			'fallback_refresh' => false,
		));

		// Copyright
		$wp_customize->add_setting( 'custom_footer_copy', array(
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'theme_supports' => '',
			'default' => 'Your Copyright',
			'transport' => 'refresh',
			'sanitize_callback' => 'sanitize_text_field'
		));

		$wp_customize->add_control( 'custom_footer_copy',array(
			'label'      => 'Custom Footer Copyright Text',
			'section'    => 'custom_footer_settings_section',
			'settings'   => 'custom_footer_copy',
			'type'=> 'text',
		)); 

		$wp_customize->selective_refresh->add_partial( 'custom_footer_copy', array(
			'selector'         => '#custom-footer__copyright-text',
			'fallback_refresh' => false,
		));
}

/**
 * Removes archive prefixes
 */
add_filter( 'get_the_archive_title_prefix', '__return_false' );