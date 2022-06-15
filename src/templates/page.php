<?php

/**
 * General template
 */

get_header();

?>

<main>

  <?= apply_filters('the_content', $post->post_content) ?>

</main>

<?php

get_footer();
