<?php

/**
 * WP cleanup
 */

function allow_only_theme($allowed_blocks)
{
  return array(
    // 'acf/hero',
    'core/spacer'
  );
}
add_filter('allowed_block_types_all', 'allow_only_theme', 10, 2);

/**
 * General template
 */

// function register_general_template()
// {
//   $post_type_object = get_post_type_object('page');
//   $post_type_object->template = array(
//     array('acf/hero'),
//   );
// }
// add_action('init', 'register_general_template');

/**
 * WP Excerpt
 */

function new_excerpt_length()
{
  return 25;
}
add_filter('excerpt_length', 'new_excerpt_length', 999);

function new_excerpt_more()
{
  return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');
