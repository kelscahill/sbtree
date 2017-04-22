<?php
/**
 * Template Name: Home Template
 */
?>

<section id="about" class="section section-about stagger">
  <div class="section--inner">
    <div class="grid grid--50-50">
      <div class="grid-item">
        <div class="grid-item--inner text-align--center spacing">
          <div class="grid-item__header">
            <h3 class="color--gold no-spacing">About</h3>
            <h2>Our Story</h2>
          </div>
          <p>S&amp;B Tree L.L.C. in Lakeville, Pennsylvania, offers prompt and reliable tree maintenance services when you need it most. We have developed a strong reputation in Northeast Pennsylvania because we show up when we say we will and finish the job in a timely manner for the same cost we quoted in the beginning.</p>
          <p>Our customers choose us because we are there to please them. We take great pride in what we do and enjoy all the different aspects the job brings to us. From large tree removal to utility line trimming, there is truly nothing we cannot do.</p>
        </div>
      </div>
      <div class="grid-item">
        <div class="grid-item--inner circle">
          <img src="http://sbtree.dev/wp-content/uploads/2017/04/trimming.png"/>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section section-services" data-stellar-background-ratio="0.5">
  <div class="section--inner">
    <div class="grid grid--50-50">
      <div class="grid-item">
        <div class="grid-item--inner text-align--center spacing">
          <div class="grid-item__header">
            <h3 class="color--gold no-spacing">Service</h3>
            <h2>Tree Removal</h2>
          </div>
          <p>Eliminate dead or diseased trees from your residential or commercial property with tree removal from S&amp;B Tree L.L.C. We deliver the prompt and safe tree removal you need at a price you can afford.</p>
          <a href="/services" class="btn">View Removal Services</a>
        </div>
      </div>
      <div class="grid-item">
        <div class="grid-item--inner text-align--center spacing">
          <div class="grid-item__header">
            <h3 class="color--gold no-spacing">Service</h3>
            <h2>Tree Trimming</h2>
          </div>
          <p>Enjoy the beauty of healthy, clean trees with our tree trimming and yard cleanup services. Our professional arborists prune your overgrown or hazardous trees with care and precision every time.</p>
          <a href="/services" class="btn">View Trimming Services</a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
  $testimonials = get_posts(array(
    'post_type' => 'testimonials', // Set post type you are relating to.
    'posts_per_page' => 10
  ));
?>
<?php if ($testimonials): ?>
  <section id="testimonials" class="section section-testimonials spacing stagger">
    <div class="section--inner spacing">
      <div class="section-header text-align--center">
        <h3 class="color--gold no-spacing">Testimonials</h3>
        <h2>What people are saying</h2>
      </div>
      <div class="testimonials js-slider color--white">
        <?php foreach ($testimonials as $testimonial): ?>
          <div class="block testimonial spacing">
            <div class="block__icon">
              <span class="icon icon--quote icon--quote--left">&ldquo;</span>
              <span class="icon icon--quote icon--quote--right">&rdquo;</span>
            </div>
            <p class="block__body color--tan"><?php echo $testimonial->post_content; ?></p>
            <h4 class="font--primary--s block__title"><?php echo $testimonial->post_title; ?></h4>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
<?php endif; ?>
