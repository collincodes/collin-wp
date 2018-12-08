<?php
/*
  Template Name: 404 Error Page
*/
get_header(); ?>

<main id="page-not-found">
  <?php get_template_part('/components/header/child-header'); ?>

  <section class="error-container" style="padding: 5rem 10vw; text-align: center;">
    <h2>Oops!</h2>
    <h5>We can't seem to find the page you are looking for:</h5>
    <h5><a href="<?php echo home_url(); ?>">Return to the Homepage</a></h5>
  </section>

</main>

<?php get_footer();
