<?php
/*
  This serves as the default template for the home page
*/
get_header(); ?>

<main id="home">

  <?= the_content() ?>

</main>

<?php get_footer();
