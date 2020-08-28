<?php
// spawn menus into existence
function register_menu() {
  register_nav_menu( 'header-menu', __('Header Menu') );
  register_nav_menu( 'footer-menu', __('Footer Menu') );
}
add_action( 'init', 'register_menu' );

// options pages registered
if( function_exists('acf_add_options_page') ) {
  acf_add_options_page(array(
    'page_title' 	=> 'Theme Options',
		'menu_slug' 	=> 'theme-options'
  ));
  acf_add_options_sub_page(array(
    'page_title' => 'Logos',
    'parent_slug' => 'theme-options'
  ));
  acf_add_options_sub_page(array(
    'page_title' => 'Contact',
    'parent_slug' => 'theme-options'
  ));
  acf_add_options_sub_page(array(
    'page_title' => 'Footer',
    'parent_slug' => 'theme-options'
  ));
}

// enqueue javascript & css files
function theme_enqueues() {
  // stylesheets
  wp_register_style( 'extra-css', get_template_directory_uri() . '/compiled/extra.min.css' );
  wp_register_style( 'theme-css', get_template_directory_uri() . '/compiled/theme.min.css' );
  // scripts
  wp_register_script( 'extra-js', get_template_directory_uri() . '/compiled/extra.min.js' );
  wp_register_script( 'theme-js', get_template_directory_uri() . '/compiled/theme.min.js' );

  // stylesheets
  wp_enqueue_style( 'extra-css' );
  wp_enqueue_style( 'theme-css' );
  // scripts
  wp_enqueue_script( 'extra-js' );
  wp_enqueue_script( 'theme-js' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueues', 100 );

// default setting
show_admin_bar( false );

// End Functions File
