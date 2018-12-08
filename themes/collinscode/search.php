<?php
/*
  The template for displaying Search Results pages.
*/
get_header(); ?>

<main id="search-results">
  <!-- Search specific child header -->
  <div class="child-header" style="background-image: url('<?php echo get_field('child_header','option'); ?>');">
    <h1 class="title">Search Results for: <?php echo $_GET['s']; ?></h1>
  </div>

  <div class="search-results-container">
    <form id="searchform" action="<?php echo home_url('/'); ?>" method="get">
      <button type="submit" value="Search">
        <i class="fas fa-search"></i>
      </button>
      <input type="text" class="search-field" name="s" value="<?php the_search_query(); ?>">
    </form>

    <?php if ( have_posts() ): ?>
      <div class="results">
        <?php while ( have_posts() ): the_post(); ?>

          <!-- Format layout of results as you see fit -->
          <?php the_title(); ?>

        <?php endwhile; wp_reset_postdata(); ?>
      </div>
    <?php else: ?>
      <div class="no-results">
        <h2>Sorry, there were no results found for <?php echo $_GET['s']; ?>.</h2>
        <a href="<?php home_url(); ?>">Return to Home Page</a>
      </div>
    <?php endif; ?>
  </div>

</main>

<?php get_footer();
