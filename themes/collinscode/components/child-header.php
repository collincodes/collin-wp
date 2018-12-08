<?php
  $ch = get_field('child_header');
  $cho = get_field('child_header','option');
?>

<div class="child-header"
  <?php if ($ch): ?>
    style="background-image: url('<?=$ch; ?>');"
  <?php else: ?>
    style="background-image: url('<?=$cho; ?>');"
  <?php endif; ?>>

  <!-- title -->
  <?php if (is_home()): ?>
    <h1 class="title">Blog</h1>
  <?php else: ?>
    <h1 class="title"><?=get_the_title(); ?></h1>
  <?php endif; ?>

</div>
