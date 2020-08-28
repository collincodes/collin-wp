<?php
/*
  Default page template
*/
get_header(); ?>

<main id="page-template">

  <?= apply_filters('the_content', $post->post_content) ?>

</main>

<?php get_footer();
