<?php
  use Roots\Sage\Titles;
  $display_title = '';
  $intro = '';
  if (is_page() || is_single()) {
    $display_title = get_post_meta($post->ID, 'display_title', true);
    $intro = get_post_meta($post->ID, 'intro', true);
  }
?>
<div class="page-header spacing">
  <h1 class="font--primary--xl color--tan stagger">
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
    <p class="font--m color--white stagger"><?php echo $intro; ?></p>
  <?php endif; ?>
  <?php if (is_page('home')): ?>
    <a href="/free-estimate" class="btn center-block stagger">Get a free estimate!</a>
  <?php endif; ?>
</div>
