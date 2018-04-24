<?php
// enqueue style
function wpa_styles_enqueue() {
  wp_enqueue_style('main-styles', get_template_directory_uri() . '/dist/main.css', array(), filemtime(get_template_directory() . '/dist/main.css'), false);
  wp_enqueue_script( 'bundle-js', get_template_directory_uri() . '/dist/bundle.js', array(), '1.0.0', true );
  wp_localize_script('bundle-js', 'magicalData', array(
	'nonce' => wp_create_nonce('wp_test'),
	'siteURL' => get_site_url()
));
}
add_action('wp_enqueue_scripts', 'wpa_styles_enqueue');


// Register Custom Navigation Walker
require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';

// Theme support
function wpa_theme_setup() {
  // Nav menus
  register_nav_menus(array(
    'primary' => __('Primary Menu', 'wp-agency'),
  ));

  add_theme_support('post-thumbnails');
  add_theme_support('post-formats', array('gallery'));
}
add_action('after_setup_theme', 'wpa_theme_setup');

// Excerpt Length Control
function wpa_set_excerpt_length() {
  return 1;
}
add_filter('excerpt_length', 'wpa_set_excerpt_length', 999);

// Count posts
function wp_total_posts() {
  $total = wp_count_posts()->publish;
  echo 'Total Posts: ' . $total;
}

// Count post view
function wpa_popular_posts($post_id) {
  $count_key = 'wpa_popular_posts';
  $count = get_post_meta($post_id, $count_key, true);
  if ($count == '') {
  $count = 0;
  delete_post_meta($post_id, $count_key);
  add_post_meta($post_id, $count_key, '0');
  } else {
  $count++;
  update_post_meta($post_id, $count_key, $count);
  }
}
function wpa_track_posts($post_id) {
  if (!is_single()) {
  return;
  }
  if (empty($post_id)) {
  global $post;
  $post_id = $post->ID;
  }
  wpa_popular_posts($post_id);
}
add_action('wp_head', 'wpa_track_posts');

// filter to replace class on reply link
function wpa_replace_reply_link_class($class){
    // $class = str_replace("class='comment-reply-link", "class='reply", $class);
    $pattern = '/(class=[\'\"])(.*?)(?=[\'\"])([\'\"])/i';
    $replace = '${1}${2} text-uppercase${3}';
    $class = preg_replace($pattern, $replace, $class);
    return $class;
}
add_filter('comment_reply_link', 'wpa_replace_reply_link_class');

// add class in post-navs(prev, next)
function wpa_post_link_attributes($output) {
  $code = 'class="text-uppercase link-primary font-weight-bold"';
  return str_replace('<a href=', '<a '.$code.' href=', $output);
}
add_filter('next_post_link', 'wpa_post_link_attributes');
add_filter('previous_post_link', 'wpa_post_link_attributes');

  
  
// includes
require get_template_directory() . '/inc/customizer.php'; // Customizer for front page
require get_template_directory() . '/inc/functions/shortcode.php';
require get_template_directory() . '/inc/functions/comment-format.php';