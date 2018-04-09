<?php get_header();?>

<div id="blog">
  <div  class="header d-flex justify-content-center align-items-center"
        style="background-image: url(<?php bloginfo('template_url')?>/img/blog-header.jpeg)">
    <h3 class="text-white"><b>B</b><span>usiness</span> <b>LOG</b></h1>
  </div>

  <div id="filter-container" class="container">
    <?php
      $all_posts = new WP_Query(array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => -1));
      // count($all_posts->posts);
      $categories = get_categories(array(
          'orderby' => 'name',
          'order' => 'ASC',
      ));

      $class_label = 'btn btn-light text-dark font-weight-bold';
      $class_input = 'd-none';
      $class_count = 'badge badge-pill badge-secondary';
    ?>
    
    <div class="row my-4">
      <div class="col text-center">
        <div data-toggle="buttons" class="btn-group d-block">
          <label class="<?php echo $class_label ?> active">
            <input type="radio" name="shuffle-filter" value="all" checked="checked" class="<?php echo $class_input ?>"/>ALL
            <span class="<?php echo $class_count ?>">
              <?php echo count($all_posts->posts); ?>
            </span>
          </label>

          <?php foreach ($categories as $category): ?>
            <label class="<?php echo $class_label ?>">
              <input type="radio" name="shuffle-filter" value="<?php echo $category->cat_ID ?>" class="<?php echo $class_input ?>"/>
                <?php echo strtoupper($category->name) ?>
              <span class="<?php echo $class_count ?>">
                <?php echo $category->count ?>
              </span>
            </label>
          <?php endforeach;?>
        </div>

      </div>
    </div>

    <div class="row my-shuffle">
      <?php if ($all_posts->have_posts()): ?>
        <?php while ($all_posts->have_posts()): $all_posts->the_post();?>
          <?php
            $the_ctgs = array();
            foreach ((get_the_category()) as $category) {
                array_push($the_ctgs, strval($category->cat_ID));
            }
            $the_ctgs = json_encode($the_ctgs);
            $the_content = substr(strip_tags(get_the_content()), 0, 60) . "...";
          ?>
          <figure class="image-item col-md-6 col-lg-4" data-groups='<?php echo $the_ctgs ?>'>
            <?php if (has_post_thumbnail()): ?>
              <!-- <img class="" src="" alt="sample"> -->
              <div class="aspect aspect--16x9">
                <div class="aspect__inner zm-container">
                  <a href="<?php the_permalink(); ?>" class="text-dark">
                    <img  src="<?php the_post_thumbnail_url('large') ?>"
                          class="rounded zm-item"
                          alt="test" />
                    <div class="zm-item-text">+</div>
                  </a>
                </div>
              </div>
            <?php endif?>
            <div class="px-4 py-2">
              <h5 class="mt-2"><?php the_time(get_option('date_format')); ?></h5>
              <h3 class="text-uppercase font-weight-bold m-0">
                <a href="<?php the_permalink(); ?>" class="text-dark"><?php the_title(); ?></a>
              </h3>
              <p>
                <?php echo $the_content; ?>
              </p>
            </div>
          </figure>
        <?php endwhile;?>
          <div class="col-1 my-sizer-element"></div>
          <?php wp_reset_postdata();?>
      <?php else: ?>
        <p><?php _e('Sorry, no posts matched');?></p>
      <?php endif;?>
    </div>
  </div>


</div>

<?php get_footer();?>
