<?php
/**
 * Template Name: Services Template
 */
 $services = get_post_meta($post->ID, 'services', true);
 $counter = 1;
?>

<?php if ($services): ?>
  <?php foreach ($services as $service): ?>
    <?php
      $service_row_title = $service['service_row_title'];
      $service_row_description = $service['service_row_description'];
      $service_items = $service['services'];
    ?>
    <section id="service--<?php echo $counter; ?>" class="section section-service--<?php echo $counter; ?> stagger">
      <div class="section--inner layout-container">
        <div class="narrow--s center-block spacing">
          <h2><?php echo $service_row_title; ?></h2>
          <p><?php echo $service_row_description; ?></p>
          <?php if ($service_items): ?>
            <div class="grid grid--50-50">
              <?php foreach ($service_items as $service_item): ?>
              <?php
                $thumb_id = $service_item['service_icon'][0];
                $title = $service_item['service_title'];
                $description = $service_item['service_description'];
               ?>
              <div class="grid-item">
                <?php if ($thumb_id): ?>
                  <div class="icon icon--l">
                    <img src="<?php echo wp_get_attachment_image_src($thumb_id, "square--xs")[0]; ?>" alt="<?php echo get_post_meta($thumb_id, '_wp_attachment_image_alt', true); ?>">
                  </div>
                <?php endif; ?>
                <?php if ($title): ?>
                  <h3><?php echo $title; ?></h3>
                <?php endif; ?>
                <?php if ($description): ?>
                  <p><?php echo $description; ?></p>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>
  <?php $counter++; endforeach; ?>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class("article"); ?> role="article">
    <div class="article__body layout-container">
      <div class="narrow--s center-block">
        <div class="spacing text-align--center">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </article>
<?php endwhile; ?>
