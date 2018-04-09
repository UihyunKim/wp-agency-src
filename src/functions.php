<?php
  // enqueue style
  function mytheme_styles() {
    wp_enqueue_style('main-styles', get_template_directory_uri() . '/dist/main.css', array(), filemtime(get_template_directory() . '/dist/main.css'), false);
  }

  add_action('wp_enqueue_scripts', 'mytheme_styles');


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
    return 1;
  }

  add_filter('excerpt_length', 'set_excerpt_length', 999);

  // Count posts
  function wp_total_posts() {
    $total = wp_count_posts()->publish;
    echo 'Total Posts: ' . $total;
  }

  // Count post view
  function popular_posts($post_id) {
    $count_key = 'popular_posts';
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
  function track_posts($post_id) {
    if (!is_single()) {
    return;
    }
    if (empty($post_id)) {
    global $post;
    $post_id = $post->ID;
    }
    popular_posts($post_id);
  }
  add_action('wp_head', 'track_posts');

  function wporg_shortcode($atts = [], $content = null) {
    // do something to $content
    if ($content == null) {
      $o = "<div id='lg-here' class='lg-container'></div>";
    } else {
      $o = "Param contained";
    }
    // always return
    return $o;
  }
  add_shortcode('wporg', 'wporg_shortcode');
  
  // filter to replace class on reply link
  function replace_reply_link_class($class){
      // $class = str_replace("class='comment-reply-link", "class='reply", $class);
      $pattern = '/(class=[\'\"])(.*?)(?=[\'\"])([\'\"])/i';
      $replace = '${1}${2} text-uppercase${3}';
      $class = preg_replace($pattern, $replace, $class);
      return $class;
  }
  add_filter('comment_reply_link', 'replace_reply_link_class');
  
  // add class in post-navs(prev, next)
  function post_link_attributes($output) {
    $code = 'class="text-uppercase link-primary font-weight-bold"';
    return str_replace('<a href=', '<a '.$code.' href=', $output);
  }
  add_filter('next_post_link', 'post_link_attributes');
  add_filter('previous_post_link', 'post_link_attributes');

?>

<?php
  // comment callback function
  function format_comment($comment, $args, $depth) {
    if ('div' === $args['style']) {
      $tag = 'div';
      $add_below = 'comment';
    } else {
      $tag = 'li';
      $add_below = 'div-comment';
    }
?>

    <<?php echo $tag; ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="comment-<?php comment_ID() ?>">
      <?php if ('div' != $args['style']) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body border-top py-4 d-flex flex-column flex-md-row">

          <div class="avatar">
            <?php 
              if ($args['avatar_size'] != 0) {
                // echo get_avatar($comment, $args['avatar_size']);
                $class = "border rounded-circle mr-4";
                $avatar = get_avatar($comment, $args['avatar_size']);
                $avatar = explode("class='", $avatar);
                $avatar[1] = "class='" . $class . ' ' . $avatar[1];
                $avatar = $avatar[0] . $avatar[1];
                echo $avatar;
              }
            ?>
          </div>

          <div class="comment-main d-md-flex flex-md-row flex-wrap w-100">
            <div class="order-md-0 comment-user my-3 mt-md-0 mr-md-auto">
              <?php printf(__('<h3 class="font-weight-bold">%s</h3>'), get_comment_author()); ?>
  
              <h4>
                <?php
                  /* translators: 1: date, 2: time */
                  printf(
                    __('%1$s, %2$s'),
                    get_comment_date(),
                    get_comment_time()
                  ); ?>
              </h4>
            </div>
            <div class="order-md-2 comment-text w-100">
              <?php if ($comment->comment_approved == '0') : ?>
                <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.'); ?></em><br/>
              <?php endif ?>
              <?php comment_text(); ?>
            </div>

            <div class="order-md-1 comment-reply d-flex flex-row my-3 mt-md-0">
              <div class="comment-meta commentmetadata mr-2 text-uppercase">
                <?php edit_comment_link(__('Edit'), '  ', ''); ?>
              </div>
              <div>
                <?php comment_reply_link(
                  array_merge(
                    $args,
                    array(
                      'add_below' => $add_below,
                      'depth'   => $depth,
                      'max_depth' => $args['max_depth']
                    )
                  )
                  ); ?>
              </div>
            </div>
              
          </div>
        </div>
      <?php endif; ?>
    <!-- </<?php echo $tag; ?>> -->
<?php 
  } ?>
  
  
<?php
  // Customizer for front page
  require get_template_directory() . '/inc/customizer.php';
?>