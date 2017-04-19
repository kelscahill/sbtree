<article <?php post_class("article"); ?> role="article">
  <div class="article__body layout-container">
    <div class="narrow--s center-block">
      <?php if (have_posts()): ?>
        <div class="grid">
          <?php while (have_posts()) : the_post(); ?>
            <div class="grid-item">
              <?php include(locate_template('patterns/blocks/block.php')); ?>
            </div>
          <?php endwhile; ?>
        </div>
      <?php else: ?>
        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
      <?php endif; ?>
    </div>
  </div>
</article>
