<?php
/**
 * Plugin Name: Fantastic Slideshow
 * Plugin URI: TBD
 * Version: 1.0
 * Author: TBD
 * Description: Create and customize a slideshow for your website.
 * Author URI: TBD
 */

defined( 'ABSPATH' ) or exit( "File protected." );


add_action( 'admin_enqueue_scripts', function(){ 
    wp_enqueue_style( 'fantastic-slideshow-admin-styling', plugin_dir_url(__FILE__) . '/assets/css/fantastic-slideshow-admin-styles.css' ); 
});

add_action( 'wp_enqueue_scripts', function(){ 
  wp_enqueue_style( 'fantastic-slideshow-styling', plugin_dir_url(__FILE__) . '/assets/css/fantastic-slideshow-styles.php' ); 
});


function fs_create_slideshow_post_type() {
    register_post_type( 'fantastic-slideshow',
            array(
                'labels' => array(
                    'name' => __( 'Fantastic Slideshow' ),
                    'singular_name' => __( 'Fantastic Slideshow' )
                ),
                'public' => true,
                'show_in_menu' => true,
                'supports' => array( 'title', 'editor', 'thumbnail', 'custom_fields' ),
                'hierarchical' => false
            )
    );
}
add_action( 'init', 'fs_create_slideshow_post_type' );

