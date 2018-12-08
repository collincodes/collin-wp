<?php
/*
  Template Name: Page
  page.php (the Template for displaying all single posts)
*/
get_header(); ?>

<main id="page-template">
  <?php get_template_part('components/header/child-header'); ?>

  <div class="page-container">
    <?php if ( have_posts() ): ?>
      <?php while ( have_posts() ): the_post(); ?>

        <!-- Set Content Layout -->

    <?php endwhile; wp_reset_postdata(); endif; ?>
  </div>
</main>

<?php get_footer();
