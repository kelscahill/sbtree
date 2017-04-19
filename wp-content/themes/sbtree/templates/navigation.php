<span class="nav-toggler js-toggle" data-prefix="main-nav" data-toggled="nav__primary">
  <div class="nav-toggler__inner">
    <span class="toggle-span toggle-span--1"></span><span class="toggle-span toggle-span--2"></span><span class="toggle-span toggle-span--3"></span><span class="toggle-span toggle-span--4"></span>
  </div> <!-- /.nav-toggler__inner -->
</span> <!-- /.nav-toggler -->
<nav class="nav__primary" role="navigation">
  <?php if (has_nav_menu('primary_navigation')): ?>
    <?php
      $primary_menu_args = array(
        'echo' => false,
        'menu_class' => 'primary-nav__list',
        'container' => false,
        'depth' => 2,
        'theme_location' => 'primary_navigation'
      );

      // Native WordPress menu classes to be replaced.
      $primary_menu_replace = array(
        'menu-item ',
        'current-menu-item',
        'current_page_item',
        '<a'
      );

      // Custom classes to replace.
      $primary_menu_replace_with = array(
        'primary-nav__list-item ',
        'active',
        'active',
        '<a class="primary-nav__link color--purple"'
      );
    ?>
    <?php echo str_replace($primary_menu_replace, $primary_menu_replace_with, wp_nav_menu($primary_menu_args)); ?>
  <?php  endif; ?>
</nav> <!-- /.nav__primary -->
