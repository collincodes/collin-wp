<?php
/** Theme enqueues to make the theme what it is **/

function theme_enqueues() {
  // Enqueue main theme stylesheet
  wp_enqueue_style( 'theme-css', get_template_directory_uri() . '/dist/theme.min.css' );

  // Deregister the jquery included with WordPress and upgrade
  wp_deregister_script( 'jquery' );
  wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', array(), null, false );

  // Deregister the jquery-migrate version bundled with WordPress and upgrade
  wp_deregister_script( 'jquery-migrate' );
  wp_register_script( 'jquery-migrate', '//code.jquery.com/jquery-migrate-3.3.1.min.js', array('jquery'), null, false );

  // Enqueue fontawesome — be sure to add kit id
  // wp_enqueue_script( 'fontawesome', '//kit.fontawesome.com/.js', array(), null, true );

  // Enqueue lodash
  wp_enqueue_script( 'lodash', '//cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.20/lodash.min.js', array(), null, true );

  // Enqueue slick slider
  wp_enqueue_script( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js' );
  wp_enqueue_style( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css' );

  // Enqueue main theme scripts
  wp_enqueue_script( 'theme-js', get_template_directory_uri() . '/dist/theme.min.js', array('jquery'), null, true );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueues', 100 );
