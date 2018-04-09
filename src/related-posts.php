<?php

  function poByCategory () {
    // Default arguments
    $args = array(
      'posts_per_page' => 3, // How many items to display
      'post__not_in'   => array( get_the_ID() ), // Exclude current post
      'no_found_rows'  => true, // We don't need pagination so this speeds up the query
    );
    // Check for current post category and add tax_query to the query arguments
    $cats = wp_get_post_terms(get_the_ID(), 'category');
    $cats_ids = array();
    foreach ($cats as $related_cat) {
      $cats_ids[] = $related_cat->term_id;
    }
    if (! empty($cats_ids)) {
      $args['category__in'] = $cats_ids;
    }
    // Query posts
    $query = new wp_query($args);
    return $query;
  }
  
  function poByTag ($post) {
    //for use in the loop, list 5 post titles related to first tag on current post
    $tags = wp_get_post_tags($post->ID);
    if ($tags) {
      $tag_ids = array();
      foreach ($tags as $tag) {
        array_push($tag_ids, $tag->term_id);
      }
      $args = array (
        // 'tag__in' => array($first_tag),
        'tag__in' => $tag_ids,
        'post__not_in' => array($post->ID),
        'posts_per_page'=>3,
        'caller_get_posts'=>1
      );
      $query = new WP_Query($args);
      return $query;
    }
  }
  
  function mergeQuery ($query1, $query2) {
    //create new empty query and populate it with the other two
    $wp_query = new WP_Query();
    $wp_query->posts = array_merge( $query1->posts, $query2->posts );

    //populate post_count count for the loop to work correctly
    $wp_query->post_count = $query1->post_count + $query2->post_count;
    return $wp_query;
  }
  
  // By default, query posts by category
  $query_cat = poByCategory();
  
  // if posts by category is not enough to diplay(less than 3),
  // query posts by tags
  if ($query_cat->post_count < 3) {
    $query_tag = poByTag($post);
    // Merge to queries
    $query_all = mergeQuery($query_cat, $query_tag);
  } else {
    $query_all = $query_cat;
  }
  if ($query_all->have_posts()) {
    
    echo '<div class="row"><h3 class="my-5 col-12 text-center text-uppercase font-weight-bold">Related Posts</h3></div>';
    // echo '<div class="row">';
    echo '<div id="owl" class="">';
      // Loop through posts
      // Until 3
      $i = 0;
      foreach ($query_all->posts as $post) : setup_postdata($post);
        if ($i > 2) {
          break;
        }
        $the_content = substr(strip_tags(get_the_content()), 0, 18) . "..."; ?>

        <div class="col-12 col-md-4">
          <div class="card border-0">
            <?php if (has_post_thumbnail()): ?>
              <a href="<?php the_permalink() ?>" class="zm-container">
                <img 	class="card-img-top zm-item" 
                      src="<?php the_post_thumbnail_url('large') ?>" 
                      alt="thumbnail image"
                      style="height: 110px"
                      >
              </a>
            <?php endif ?>
            <div class="card-body">
              <small class="text-dark"><?php the_time(get_option('date_format')); ?></small>
              <h5 class="card-title my-2">
                <a class="text-dark font-weight-bold" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
              </h5>
              <p class="card-text"><?php echo $the_content; ?></p>
            </div>
            <div class="card-footer">
              <?php
                echo avatar('user_email', 22, 'border rounded-circle'); ?>
              <p class="card-text d-inline-block">by <?php the_author(); ?></p>
            </div>
          </div>
        </div>
      <?php
      $i++;
      // End loop
      endforeach;
    echo '</div>';
  }
  // Reset post data
  wp_reset_postdata(); ?>