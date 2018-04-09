<?php
  //for use in the loop, list 5 post titles related to first tag on current post
  $tags = wp_get_post_tags($post->ID);
  if ($tags) {
    $first_tag = $tags[0]->term_id;
    $args = array (
      'tag__in' => array($first_tag),
      'post__not_in' => array($post->ID),
      'posts_per_page'=>3,
      'caller_get_posts'=>1
    );
    $query = new WP_Query($args);
    if( $query->have_posts() ) {
      echo '<h3 class="my-5 col-12 text-center text-uppercase font-weight-bold">Related Posts By Tag</h3>';
      while ($query->have_posts()) : $query->the_post();
        $the_content = substr(strip_tags(get_the_content()), 0, 60) . "...";
        ?>
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
      endwhile;
  }
  wp_reset_query();
}
?>