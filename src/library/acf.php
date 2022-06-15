<?php

/**
 * Add any advanced custom fields support here
 */

if (function_exists('acf_add_options_page')) {
  acf_add_options_page(array(
    'page_title'   => __('Global Options'),
    'menu_slug'   => 'global-options',
    'icon_url'    => 'dashicons-admin-site'
  ));

  acf_add_options_sub_page(array(
    'page_title' => __('Logos'),
    'parent_slug' => 'global-options'
  ));

  acf_add_options_sub_page(array(
    'page_title' => __('Contact'),
    'parent_slug' => 'global-options'
  ));

  acf_add_options_sub_page(array(
    'page_title' => __('Footer'),
    'parent_slug' => 'global-options'
  ));
}
