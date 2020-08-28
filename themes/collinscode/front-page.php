<?php
/*
  This serves as the default template for the home page
*/
get_header(); ?>

<main id="home">

  <?= apply_filters('the_content', $post->post_content) ?>

</main>

<?php get_footer();
