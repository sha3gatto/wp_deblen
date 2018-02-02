<?php
if ( ! function_exists( 'bootstrapfastchild_setup' ) ) :

	function bootstrapfastchild_setup() {

        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

        add_theme_support( 'title-tag' );

        register_nav_menus( array(
            'page-info-menu' => __( 'Page Info' ),
            'page-reference-menu' => __( 'Page Reference' ),
            'page-details-menu' => __( 'Page Details' ),
            'page-listings-menu' => __( 'Page Listings' )
        ) );
	}

endif;
add_action( 'after_setup_theme', 'bootstrapfastchild_setup' );

function bfc_theme_enqueue_styles() {

    $parent_style = 'bootstrapfast';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'bootstrapfast-child',
        get_stylesheet_directory_uri() . '/stylesheets/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'bfc_theme_enqueue_styles' );

get_template_part("/inc/LinkToDetails_Walker");
get_template_part("/inc/LinkToPropertyInfo_Walker");

/**
 * Wyłączyć tę funkcjonalność w pliku function.php motywu rodzica.
 *
 * Load icon functions from svg.
 */
//require get_template_directory() . '/inc/icon-functions.php';
?>
