<?php
  // Register Custom Navigation Walker
  require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';

  
  // Theme support
  function wp_theme_setup() {
    // Nav menus
    register_nav_menus(array(
      'primary' => __('Primary Menu', 'wp-agency'),
    ));
    
    // Add thumbnails
    add_theme_support('post-thumbnails');
  }

  add_action('after_setup_theme', 'wp_theme_setup');


  // Excerpt Length Control
  function set_excerpt_length() {
    return 18;
  }

  add_filter('excerpt_length', 'set_excerpt_length');
  