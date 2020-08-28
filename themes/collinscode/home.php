<?php
/*
  Template for displaying all posts
  This is the main blog template
*/
get_header(); ?>

<main id="blog-page">
  <div class="blog-container">
    <?php
      $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
      $args = array( 'posts_per_page' => '12', 'paged' => $paged );
      $query = new WP_Query( $args );
    ?>
    <?php if ( $query->have_posts() ) : ?>
      <div class="blog-posts">
        <?php while ( $query->have_posts() ) : $query->the_post() ?>

          <div class="blog-post-container">
            <div class="blog-post">
              <h3><?php the_title(); ?></h3>
              <h5><?php the_author(); ?></h5>
              <?php the_excerpt(); ?>
            </div>
          </div>

        <?php endwhile; ?>
      </div>

      <nav class="pagination">
        <div class="content">
          <p><?php previous_posts_link( 'Previous', $query->max_num_pages) ?></p>
          <p><?php next_posts_link( 'Next', $query->max_num_pages) ?></p>
        </div>
      </nav>
    <?php wp_reset_postdata(); endif; ?>

  </div>
</main>

<?php get_footer();
