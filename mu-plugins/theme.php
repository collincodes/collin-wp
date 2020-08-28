<?php
/*
Plugin Name: Theme Must-Use
Description: Must-use code to make the site work.
Plugin URI: https://collinscode.dev
Author: Collin Smith
*/

function setup_post_types()
{
  //
}
add_action( 'init', 'setup_post_types' );
