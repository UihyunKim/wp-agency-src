<?php
  // Default arguments
  $args = array(
    'posts_per_page' => 3, // How many items to display
    'post__not_in'   => array( get_the_ID() ), // Exclude current post
    'no_found_rows'  => true, // We don't need pagination so this speeds up the query
  );
  // Check for current post category and add tax_query to the query arguments
  $cats = wp_get_post_terms( get_the_ID(), 'category' ); 
  $cats_ids = array();  
  foreach( $cats as $related_cat ) {
    $cats_ids[] = $related_cat->term_id; 
  }
  if ( ! empty( $cats_ids ) ) {
    $args['category__in'] = $cats_ids;
  }
  // Query posts
  $query = new wp_query( $args );
  if ($query->have_posts()) {
    echo '<h3 class="my-5 col-12 text-center text-uppercase font-weight-bold">Related Posts By Category</h3>';
    // Loop through posts
    foreach ($query->posts as $post) : setup_postdata($post);
    $the_content = substr(strip_tags(get_the_content()), 0, 60) . "..."; ?>

    <div class="col col-md-4">
      <div class="card">
        <?php if (has_post_thumbnail()): ?>
          <img 	class="card-img-top" 
                src="<?php the_post_thumbnail_url('medium') ?>" 
                alt="thumbnail image"
                style="height: 110px"
                >
        <?php endif ?>
        <div class="card-body">
          <small class="text-dark"><?php the_time(get_option('date_format')); ?></small>
          <h5 class="card-title my-2">
            <a class="text-dark font-weight-bold" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
          </h5>
          <p class="card-text"><?php echo $the_content; ?></p>
        </div>
      </div>
    </div>
    <?php
    // End loop
    endforeach;
  }
  // Reset post data
  wp_reset_postdata(); ?>
