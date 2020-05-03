<?php
// main_nav register its existence to wordpress
function register_menu() {
  register_nav_menu('primary', __('Primary'));
}
add_action('init', 'register_menu');

// options pages register
if( function_exists('acf_add_options_page') ) {
  acf_add_options_page(array(
    'page_title' 	=> 'General Options',
		'menu_slug' 	=> 'general-options'
  ));
  acf_add_options_sub_page(array(
    'page_title' => 'Header',
    'parent_slug' => 'general-options'
  ));
  acf_add_options_sub_page(array(
    'page_title' => 'Footer',
    'parent_slug' => 'general-options'
  ));
  acf_add_options_sub_page(array(
    'page_title' => 'Contact',
    'parent_slug' => 'general-options'
  ));
}

// enqueue javascript & css files
function theme_enqueues() {
  // STYLESHEETS
  wp_register_style( 'extra-css', get_template_directory_uri() . '/compiled/extra-css.min.css', false, NULL, 'all' );
  wp_register_style( 'theme-css', get_template_directory_uri() . '/compiled/styles.min.css', false, NULL, 'all' );
  // SCRIPTS
  wp_register_script( 'extra-scripts', get_template_directory_uri() . '/compiled/extra-scripts.min.js', array('jquery'), NULL, true );
  wp_register_script( 'scripts-js', get_template_directory_uri() . '/compiled/scripts.min.js', array('jquery'), NULL, true );

  // STYLESHEETS
  wp_enqueue_style( 'extra-css' );
  wp_enqueue_style( 'theme-css' );
  // SCRIPTS
  wp_enqueue_script( 'extra-scripts' );
  wp_enqueue_script( 'scripts-js' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueues', 100 );

// Example of  creating different media library image sizes to be created on upload of imagery WxH
// add_image_size( 'home-image', 288, 480, true );

//Add support for post featured image_type_to_extension
add_theme_support( 'post-thumbnails' );

// Register Custom/Dynamic Sidebars
function custom_sidebars() {

  $sidebar = array(
    'id'            => 'sidebarAll',
    'class'         => 'sideBar',
    'name'          => __( 'Full Site Sidebar', 'text_domain' ),
  );
  register_sidebar( $sidebar );

}
add_action( 'widgets_init', 'custom_sidebars' );
show_admin_bar(false);

// End Functions File
