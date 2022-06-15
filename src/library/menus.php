<?php

/**
 * Register site menus
 */

function register_menu()
{
  register_nav_menu('header-menu', __('Header Menu'));
  register_nav_menu('footer-menu', __('Footer Menu'));
}
add_action('init', 'register_menu');
