<?php
/*
  Template for displaying any and all single posts
*/
get_header(); ?>

<main id="single-post">
  <div class="single-post-container">
    <?php if ( have_posts() ): ?>
      <?php while ( have_posts() ): the_post(); ?>

        <!-- Content Layout Here -->
        <?php the_content(); ?>

    <?php endwhile; wp_reset_postdata(); endif; ?>
  </div>
</main>

<?php get_footer();
