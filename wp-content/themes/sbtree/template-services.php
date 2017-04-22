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
      $service_row_kicker = $service['service_row_kicker'];
      $service_items = $service['services'];
    ?>
    <section id="service--<?php echo $counter; ?>" class="section section-service--<?php echo $counter; ?> stagger">
      <div class="section--inner layout-container spacing--double text-align--center">
        <div class="narrow--s center-block spacing">
          <div class="section__header">
            <h3 class="color--gold no-spacing"><?php echo $service_row_kicker; ?></h3>
            <h2><?php echo $service_row_title; ?></h2>
          </div>
          <p><?php echo $service_row_description; ?></p>
        </div>
        <?php if ($service_items): ?>
          <div class="narrow--l center-block">
            <div class="grid grid--4-col">
              <?php foreach ($service_items as $service_item): ?>
                <?php
                  $title = $service_item['service_title'];
                  $description = $service_item['service_description'];
                 ?>
                <div class="grid-item block padding">
                  <div class="block--inner padding spacing">
                    <?php if ($title): ?>
                      <h3 class="block__title font--m"><?php echo $title; ?></h3>
                      <hr class="hr--small">
                    <?php endif; ?>
                    <?php if ($description): ?>
                      <p class="block__excerpt color--tan font--s"><?php echo $description; ?></p>
                    <?php endif; ?>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>
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

<?php get_template_part('patterns/components/section--cta'); ?>
