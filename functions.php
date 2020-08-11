<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_VERSION', '2.2.0' );

if ( ! isset( $content_width ) ) {
	$content_width = 800; // Pixels.
}

if ( ! function_exists( 'hello_elementor_setup' ) ) {
	/**
	 * Set up theme support.
	 *
	 * @return void
	 */
	function hello_elementor_setup() {
		$hook_result = apply_filters_deprecated( 'elementor_hello_theme_load_textdomain', [ true ], '2.0', 'hello_elementor_load_textdomain' );
		if ( apply_filters( 'hello_elementor_load_textdomain', $hook_result ) ) {
			load_theme_textdomain( 'hello-elementor', get_template_directory() . '/languages' );
		}

		$hook_result = apply_filters_deprecated( 'elementor_hello_theme_register_menus', [ true ], '2.0', 'hello_elementor_register_menus' );
		if ( apply_filters( 'hello_elementor_register_menus', $hook_result ) ) {
			register_nav_menus( array( 'menu-1' => __( 'Primary', 'hello-elementor' ) ) );
		}

		$hook_result = apply_filters_deprecated( 'elementor_hello_theme_add_theme_support', [ true ], '2.0', 'hello_elementor_add_theme_support' );
		if ( apply_filters( 'hello_elementor_add_theme_support', $hook_result ) ) {
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'title-tag' );
			add_theme_support(
				'html5',
				array(
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
				)
			);
			add_theme_support(
				'custom-logo',
				array(
					'height'      => 100,
					'width'       => 350,
					'flex-height' => true,
					'flex-width'  => true,
				)
			);

			/*
			 * Editor Style.
			 */
			add_editor_style( 'editor-style.css' );

			/*
			 * WooCommerce.
			 */
			$hook_result = apply_filters_deprecated( 'elementor_hello_theme_add_woocommerce_support', [ true ], '2.0', 'hello_elementor_add_woocommerce_support' );
			if ( apply_filters( 'hello_elementor_add_woocommerce_support', $hook_result ) ) {
				// WooCommerce in general.
				add_theme_support( 'woocommerce' );
				// Enabling WooCommerce product gallery features (are off by default since WC 3.0.0).
				// zoom.
				add_theme_support( 'wc-product-gallery-zoom' );
				// lightbox.
				add_theme_support( 'wc-product-gallery-lightbox' );
				// swipe.
				add_theme_support( 'wc-product-gallery-slider' );
			}
		}
	}
}
add_action( 'after_setup_theme', 'hello_elementor_setup' );

if ( ! function_exists( 'hello_elementor_scripts_styles' ) ) {
	/**
	 * Theme Scripts & Styles.
	 *
	 * @return void
	 */
	function hello_elementor_scripts_styles() {
		$enqueue_basic_style = apply_filters_deprecated( 'elementor_hello_theme_enqueue_style', [ true ], '2.0', 'hello_elementor_enqueue_style' );
		$min_suffix          = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		if ( apply_filters( 'hello_elementor_enqueue_style', $enqueue_basic_style ) ) {
			wp_enqueue_style(
				'hello-elementor',
				get_template_directory_uri() . '/style.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		}

		if ( apply_filters( 'hello_elementor_enqueue_theme_style', true ) ) {
			wp_enqueue_style(
				'hello-elementor-theme-style',
				get_template_directory_uri() . '/theme.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		}

        wp_enqueue_script( 'main-script', get_template_directory_uri() . '/assets/js/main-script.js');

	}
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_scripts_styles' );


if ( ! function_exists( 'hello_elementor_register_elementor_locations' ) ) {
	/**
	 * Register Elementor Locations.
	 *
	 * @param EleentorPro\Modules\ThemeBuilder\Classes\Locations_Manager $elementor_theme_manager theme manager.m
	 *
	 * @return void
	 */
	function hello_elementor_register_elementor_locations( $elementor_theme_manager ) {
		$hook_result = apply_filters_deprecated( 'elementor_hello_theme_register_elementor_locations', [ true ], '2.0', 'hello_elementor_register_elementor_locations' );
		if ( apply_filters( 'hello_elementor_register_elementor_locations', $hook_result ) ) {
			$elementor_theme_manager->register_all_core_location();
		}
	}
}
add_action( 'elementor/theme/register_locations', 'hello_elementor_register_elementor_locations' );

if ( ! function_exists( 'hello_elementor_content_width' ) ) {
	/**
	 * Set default content width.
	 *
	 * @return void
	 */
	function hello_elementor_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'hello_elementor_content_width', 800 );
	}
}
add_action( 'after_setup_theme', 'hello_elementor_content_width', 0 );

if ( is_admin() ) {
	require get_template_directory() . '/includes/admin-functions.php';
}

if ( ! function_exists( 'hello_elementor_check_hide_title' ) ) {
	/**
	 * Check hide title.
	 *
	 * @param bool $val default value.
	 *
	 * @return bool
	 */
	function hello_elementor_check_hide_title( $val ) {
		if ( defined( 'ELEMENTOR_VERSION' ) ) {
			$current_doc = \Elementor\Plugin::instance()->documents->get( get_the_ID() );
			if ( $current_doc && 'yes' === $current_doc->get_settings( 'hide_title' ) ) {
				$val = false;
			}
		}
		return $val;
	}
}
add_filter( 'hello_elementor_page_title', 'hello_elementor_check_hide_title' );

/**
 * Wrapper function to deal with backwards compatibility.
 */
if ( ! function_exists( 'hello_elementor_body_open' ) ) {
	function hello_elementor_body_open() {
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open();
		} else {
			do_action( 'wp_body_open' );
		}
	}
}

require get_template_directory() . '/includes/elementor/widgets-manager.php';


add_action( 'init', 'register_post_types' );
function register_post_types(){
    register_post_type( 'zen_programs', [
        'label'  => null,
        'labels' => [
            'name'               => __( 'Programs', 'builder' ),
            'singular_name'      => __( 'Program', 'builder' ),
            'add_new'            => __( 'Add program', 'builder' ),
            'add_new_item'       => __( 'New program', 'builder' ),
            'edit_item'          => __( 'Edit program', 'builder' ),
            'new_item'           => __( 'New program', 'builder' ),
            'view_item'          => __( 'View program', 'builder' ),
            'search_items'       => __( 'Search program', 'builder' ),
            'not_found'          => __( 'Program not found', 'builder' ),
            'not_found_in_trash' => __( 'Program not found', 'builder' ),
            'parent_item_colon'  => '',
            'menu_name'          => __( 'Programs', 'builder' ),
        ],
        'description'         => '',
        'public'              => true,
        'show_in_menu'        => null,
        'show_in_rest'        => null,
        'rest_base'           => null,
        'menu_position'       => null,
        'menu_icon'           => null,
        'hierarchical'        => false,
        'supports'            => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
        'taxonomies'          => [],
        'has_archive'         => false,
        'query_var'           => true,
    ] );

//    register_post_type( 'zen_block_programs', [
//        'label'  => null,
//        'labels' => [
//            'name'               => __( 'Block Programs', 'builder' ),
//            'singular_name'      => __( 'Block Program', 'builder' ),
//            'add_new'            => __( 'Add block program', 'builder' ),
//            'add_new_item'       => __( 'New program block', 'builder' ),
//            'edit_item'          => __( 'Edit program block', 'builder' ),
//            'new_item'           => __( 'New program block', 'builder' ),
//            'view_item'          => __( 'View program block', 'builder' ),
//            'search_items'       => __( 'Search program block', 'builder' ),
//            'not_found'          => __( 'Program not found', 'builder' ),
//            'not_found_in_trash' => __( 'Program not found', 'builder' ),
//            'parent_item_colon'  => '',
//            'menu_name'          => __( 'Programs Block', 'builder' ),
//        ],
//        'description'         => '',
//        'public'              => true,
//        'show_in_menu'        => null,
//        'show_in_rest'        => null,
//        'rest_base'           => null,
//        'menu_position'       => null,
//        'menu_icon'           => null,
//        'hierarchical'        => false,
//        'supports'            => [ 'title', 'editor', 'thumbnail', 'excerpt' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
//        'taxonomies'          => [],
//        'has_archive'         => false,
//        'query_var'           => true,
//    ] );
}