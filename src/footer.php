  <footer class="bg-dark d-flex flex-column">
    <div class="container mb-auto">
      <div class="card-deck">

        <div class="card bg-transparent border-0">
          <div class="card-body px-1 text-white">
            <h5 class="card-title my-5 text-uppercase font-weight-bold">about us</h5>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis aliquid provident maiores dolorem dolores placeat aspernatur animi pariatur quis esse.</p>
          </div>
        </div>

        <div class="card bg-transparent border-0 d-none d-lg-flex">
          <div class="card-body px-1 text-white">
            <h5 class="card-title my-5 text-uppercase font-weight-bold">latest news</h5>
            <ul class="list-group list-group-flush">
              <?php query_posts('category_name=News&showposts=3'); ?>
              <?php while (have_posts()) : the_post(); ?>
                <li class="list-group-item bg-transparent border-0 p-0 mb-2">
                  <a href="<?php the_permalink(); ?>" class="text-white"><?php the_title(); ?></a>
                  <br/><span><?php the_time(get_option('date_format')); ?></span>
                </li>
              <?php endwhile ?>
            </ul>
          </div>
        </div>

        <div class="card bg-transparent border-0">
          <div class="card-body px-1 text-white">
            <h5 class="card-title my-5 text-uppercase font-weight-bold">popular posts</h5>
            <ul class="list-group list-group-flush">
              <?php $popular = new WP_Query(array('posts_per_page' => 4, 'meta_key' => 'popular_posts', 'orderby' => 'meta_value_num', 'order' => 'DESC'));
                    while ($popular->have_posts()) : $popular->the_post(); ?>
                <li class="list-group-item bg-transparent border-0 p-0 mb-0">
                  <a href="<?php the_permalink(); ?>" class="text-white"><?php the_title(); ?></a>
                </li>
              <?php endwhile;
                    wp_reset_postdata(); ?>
            </ul>
          </div>
        </div>

        <div class="card bg-transparent border-0">
          <div class="card-body px-1 text-white">
            <h5 class="card-title my-5 text-uppercase font-weight-bold">tags</h5>
            <?php 
              $tags = get_tags();
              $html = '<div class="post_tags">';
              foreach ($tags as $tag) {
                  $tag_link = get_tag_link($tag->term_id);
                  $class = 'mr-1 mb-1 badge text-white bg-transparent border border-secondary rounded text-uppercase';
                  $html .= "<a href='{$tag_link}' class='$class'>";
                  $html .= "{$tag->name}</a>";
              }
              $html .= '</div>';
              echo $html; 
            ?>
          </div>
        </div>
      </div>
    </div>
    <div class="d-flex">
      <div class="container my-auto">
        <div class="row my-5 my-lg-0">
          <div class="col-12 col-lg-6 text-white text-center text-lg-left order-2 order-lg-1">&copy; <?php echo date("Y"); ?> All rights reserved</div>
          <div class="col-12 col-lg-6 text-white text-center text-lg-right order-1 order-lg-2 mb-3 mb-lg-0">
            <div id="sns" class="">
              <a class="mx-1" href="#"><img src="<?php bloginfo('template_url') ?>/img/sns-facebook.png" alt="sns link for facebook"></a>
              <a class="mx-1" href="#"><img src="<?php bloginfo('template_url') ?>/img/sns-twitter.png" alt="sns link for twitter"></a>
              <a class="mx-1" href="#"><img src="<?php bloginfo('template_url') ?>/img/sns-linkedin.png" alt="sns link for linked in"></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    
  </footer>

  <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/dist/bundle.js"></script>


  <?php wp_footer(); ?>
</body>
</html>