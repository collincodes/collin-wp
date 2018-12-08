<?php
/*
  Template Name: Child
  child.php
*/
get_header(); ?>

<main id="child">
  <?php get_template_part('components/child-header'); ?>

  <div class="child-container">
    <?php if ( have_posts() ): ?>
      <?php while ( have_posts() ): the_post(); ?>

        <?php the_content(); ?>

    <?php endwhile; wp_reset_postdata(); endif; ?>
  </div>
</main>

<?php get_footer();
