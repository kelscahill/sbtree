<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="manifest" href="/manifest.json">
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/dist/images/favicon.png">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

  <script>
    // Picture element HTML5 shiv
    document.createElement("picture");
  </script>

  <?php
    $post = get_post();

    // Meta Description
    $subtitle = '';
    $intro = '';
    $description = '';
    $thumb_id = '';
    if (is_page() || is_single()) {
      $subtitle = get_post_meta($post->ID, 'subtitle', true);
      $intro = get_post_meta($post->ID, 'intro', true);
      $description = $post->post_content;
      $thumb_id = get_post_thumbnail_id($post->ID);
    }
    if ($subtitle) {
      $description = strip_tags($subtitle);
    }
    elseif ($intro) {
      $description = strip_tags($intro);
    }
    else {
      $description = wp_trim_words($description, 55);
      $description = strip_shortcodes($description);
    }
    // Meta Image
    if ($thumb_id) {
      $image = wp_get_attachment_image_src($thumb_id, "horiz__16x9--l")[0];
    } else {
      $image = get_template_directory_uri() . '/dist/images/meta-og.png';
    }
  ?>
  <!-- Twitter Card data -->
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:title" content="<?php the_title(); ?>" />
  <meta name="twitter:description" content="<?php echo $description; ?>" />
  <meta name="twitter:creator" content="@" />
  <meta name="twitter:image" content="<?php echo $image; ?>" />

  <!-- Open Graph data -->
  <meta property="og:locale" content="en_US" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="<?php the_title(); ?>" />
  <meta property="og:description" content="<?php echo $description; ?>" />
  <meta property="og:url" content="<?php the_permalink(); ?>" />
  <meta property="og:site_name" content="Old Ellicot City" />
  <meta property="og:image" content="<?php echo $image; ?>" />

  <?php wp_head(); ?>
</head>
