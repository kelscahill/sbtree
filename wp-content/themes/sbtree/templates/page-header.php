<?php
  use Roots\Sage\Titles;
  $display_title = '';
  $intro = '';
  if (is_page() || is_single()) {
    $display_title = get_post_meta($post->ID, 'display_title', true);
    $intro = get_post_meta($post->ID, 'intro', true);
  }
?>
<div class="page-header spacing inviewable">
  <h1 class="font--primary--xl color--tan inview-fadeIn">
    <?php if (is_page('home')): ?>
      <span class="icon icon--headline"><?php get_template_part('patterns/components/graphic-headline'); ?></span>
    <?php else: ?>
      <?php if ($display_title): ?>
        <?php echo $display_title; ?>
      <?php else: ?>
        <?php echo Titles\title(); ?>
      <?php endif; ?>
    <?php endif; ?>
  </h1>
  <?php if ($intro): ?>
    <p class="font--m color--white inview-fadeIn delay-1"><?php echo $intro; ?></p>
  <?php endif; ?>
  <?php if (is_page('home')): ?>
    <a href="/free-estimate" class="btn center-block inview-fadeIn delay-1">Get a free estimate!</a>
  <?php endif; ?>
</div>
