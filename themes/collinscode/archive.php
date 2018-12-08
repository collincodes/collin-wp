<?php
/*
  Template Name: Default
  Template for Archive pages
*/
get_header(); ?>

<main id="archive-page">
  <?php get_template_part('components/child-header'); ?>

  <section class="archive-container">
    <?php
      $args = array( 'posts_per_page' => -1 );
      $query = new WP_Query( $args );
    ?>
    <?php if ( $query->have_posts() ) : ?>
      <?php while ( $query->have_posts() ) : $query->the_post() ?>

        <article class="blog-post">
          
        </article>

    <?php endwhile; endif; ?>
  </section>

</main>

<?php get_footer();
