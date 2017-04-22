<?php
  use Roots\Sage\Titles;
  // Featured image id & alt
  $thumb_id = get_post_thumbnail_id();
  $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
?>
<div class="header-utility background--black color--tan">
  <div class="header-utility--inner layout-container">
    <div class="header-utility--left"><p>A Full Service Tree Company</p></div>
    <div class="header-utility--right">
      <p><span class="icon icon--s path-fill--brown"><?php get_template_part('patterns/icons/icon-clock'); ?></span>24/7 Emergency Service</p>
      <p><span class="icon icon--s path-fill--brown"><?php get_template_part('patterns/icons/icon-phone'); ?></span>(570) 878-8183</p>
    </div>
  </div>
</div>
<header class="header" role="banner" id="header" role="banner">
  <div class="header--inner layout-container">
    <div class="header__nav">
      <div class="header__nav-logo">
        <a href="<?php echo get_home_url(); ?>" class="header__logo-link">
          <?php get_template_part('patterns/components/logo'); ?>
        </a>
      </div>
      <?php get_template_part('templates/navigation'); ?>
    </div>
  </div>
</header> <!-- .header -->
<div class="banner<?php if ($thumb_id): echo ' background-image--' . $thumb_id; endif; ?>" data-stellar-background-ratio="0.5">
  <div class="banner--inner has-overlay">
    <?php if ($thumb_id): ?>
      <style>
        .background-image--<?php echo $thumb_id; ?> {
          background-image: url(<?php echo wp_get_attachment_image_src($thumb_id, "featured__hero--s")[0]; ?>);
        }
        @media (min-width: 500px) {
          .background-image--<?php echo $thumb_id; ?> {
            background-image: url(<?php echo wp_get_attachment_image_src($thumb_id, "featured__hero--m")[0]; ?>);
          }
        }
        @media (min-width: 800px) {
          .background-image--<?php echo $thumb_id; ?> {
            background-image: url(<?php echo wp_get_attachment_image_src($thumb_id, "featured__hero--l")[0]; ?>);
          }
        }
        @media (min-width: 1100px) {
          .background-image--<?php echo $thumb_id; ?> {
            background-image: url(<?php echo wp_get_attachment_image_src($thumb_id, "featured__hero-ml")[0]; ?>);
          }
        }
      </style>
    <?php endif; ?>
    <?php get_template_part('templates/page', 'header'); ?>
  </div>
</div>
