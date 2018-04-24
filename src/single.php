<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
<div id="single">
  <div id="main" role="main">
	
    <div  class="header d-flex flex-column justify-content-center align-items-center"
          style="background-image: url(
            <?php has_post_thumbnail() ? the_post_thumbnail_url('full') : ''; ?>
          )">
			<h3 class="text-white text-center text-uppercase font-weight-bold mt-5 mb-2 mx-3 mx-md-5"><?php the_title(); ?></h1>
			<div class="post-info text-white d-flex text-uppercase">
				<span><?php the_time(get_option('date_format')); ?></span>
				<span class="mx-3">|</span>
				<span><?php the_category(', '); ?></span>
				<span class="mx-3">|</span>
        <span>by <?php the_author(); ?></span>
			</div>
    </div>
    
    <div class="content container my-5 row flex-column align-items-center mx-auto">
			<div id="lightgallery" class="d-none row my-5 over-width">
				<a class="col text-center zm-container p-0 mx-2" href="<?php bloginfo('template_url')?>/img/post-quality1.jpg">
					<img class="img-fluid rounded zm-item" src="<?php bloginfo('template_url')?>/img/post-quality1.jpg" />
				</a>
				<a class="col text-center zm-container p-0 mx-2" href="<?php bloginfo('template_url')?>/img/post-quality2.jpg">
					<img class="img-fluid rounded zm-item" src="<?php bloginfo('template_url')?>/img/post-quality2.jpg" />
				</a>
				<a class="col text-center zm-container p-0 mx-2" href="<?php bloginfo('template_url')?>/img/post-quality3.jpg">
					<img class="img-fluid rounded zm-item" src="<?php bloginfo('template_url')?>/img/post-quality3.jpg" />
				</a>
			</div>
      <?php
  			/*
  			 * Include the post format-specific template for the content. If you want to
  			 * use this in a child theme, then include a file called content-___.php
  			 * (where ___ is the post format) and that will be used instead.
  			 */
  			get_template_part( 'content', get_post_format('gallery') );
  
  			// If comments are open or we have at least one comment, load up the comment template.
  			if ( comments_open() || get_comments_number() ) :
					comments_template();
  			endif;
			?>
			<div id="post-nav" class="d-flex justify-content-between w-100">
				<div>
					<?php previous_post_link($format = '%link', $link = 'prev'); ?>
				</div>
				<div>
					<a href="#top" class="link-primary text-uppercase">go to top</a>
				</div>
				<div>
					<?php next_post_link($format = '%link', $link = 'next'); ?>
				</div>
			</div>
    </div>
  </div>
</div>
<?php endwhile ?>


<?php get_footer(); ?>
