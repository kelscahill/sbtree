<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }
  require_once $filepath;
}
unset($file, $filepath);

// Enable shortcodes in text widgets
add_filter('widget_text','do_shortcode');

/**
 * Allow SVG's through WP media uploader
 */
function cc_mime_types($mimes) {
 $mimes['svg'] = 'image/svg+xml';
 return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/**
 * Require plugins on theme install
 */
require_once get_template_directory() . '/lib/plugin-activation.php';
add_action( 'tgmpa_register', 'sb_register_required_plugins' );
function sb_register_required_plugins() {
  $plugins = array(
    array(
      'name'               => 'Piklist', // The plugin name.
      'slug'               => 'piklist', // The plugin slug (typically the folder name).
      'source'             => get_template_directory() . '/lib/plugins/piklist.zip', // The plugin source.
      'required'           => true, // If false, the plugin is only 'recommended' instead of required.
      'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
      'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
    )
  );
  $config = array(
    'id'           => 'sb',                 // Unique ID for hashing notices for multiple instances of TGMPA.
    'default_path' => '',                      // Default absolute path to bundled plugins.
    'menu'         => 'tgmpa-install-plugins', // Menu slug.
    'parent_slug'  => 'themes.php',            // Parent menu slug.
    'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
    'has_notices'  => true,                    // Show admin notices or not.
    'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
    'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
    'is_automatic' => false,                   // Automatically activate plugins after installation or not.
    'message'      => '',                      // Message to output right before the plugins table.
  );
  tgmpa( $plugins, $config );
}

/**
 * Fix for Piklist fields not saving
 */
function my_custom_init() {
  remove_post_type_support( 'post', 'custom-fields' );
  remove_post_type_support( 'page', 'custom-fields' );
}
add_action( 'init', 'my_custom_init' );

/**
 * Piklist Theme Settings
 */
add_filter('piklist_admin_pages', 'piklist_theme_setting_pages');
function piklist_theme_setting_pages($pages) {
   $pages[] = array(
    'page_title' => __('Custom Settings'),
    'menu_title' => __('Settings', 'piklist'),
    'sub_menu' => 'themes.php', //Under Appearance menu
    'capability' => 'manage_options',
    'menu_slug' => 'custom_settings',
    'setting' => 'sb_theme_settings',
    'menu_icon' => plugins_url('piklist/parts/img/piklist-icon.png'),
    'page_icon' => plugins_url('piklist/parts/img/piklist-page-icon-32.png'),
    'single_line' => true,
    'default_tab' => 'Basic',
    'save_text' => 'Save Theme Settings'
  );
  return $pages;
}

/**
 * Post types
 */
add_filter('piklist_post_types', 'testimonials_post_types');
function testimonials_post_types($post_types) {
  $post_types['testimonials'] = array(
    'labels' => piklist('post_type_labels', 'Testimonials'),
    'title' => 'Enter a new Testimonial title',
    'menu_icon' => 'dashicons-format-quote',
    'page_icon' => 'dashicons-format-quote',
    'supports' => array(
      'title',
      'editor',
      'thumbnail',
      'excerpt'
    ),
    'public' => true,
    'has_archive' => true,
    'rewrite' => array(
      'slug' => 'testimonials'
    ),
    'capability_type' => 'post',
    'edit_columns' => array(
      'title' => 'Testimonial Title'
    ),
    'hide_meta_box' => array(
      'author'
    )
  );
  return $post_types;
}
