<div class="author-info pt-5 border-top">
	<div class="author-avatar mb-3">
		<?php
        function avatar ($id_or_email, $size = '100', $class) {
          $avatar = get_avatar(get_the_author_meta($id_or_email), $size);
          $avatar = explode("class='", $avatar);
          $avatar[1] = "class='" . $class . ' ' . $avatar[1];
          $avatar = $avatar[0] . $avatar[1];
          return $avatar;
        }
        echo avatar('user_email', 120, 'border rounded-circle');
        

        ?>
	</div><!-- .author-avatar -->

	<div class="author-description my-3">
		<h3 class="author-title"><?php echo get_the_author(); ?></h3>

		<p class="author-bio">
			<?php the_author_meta('description'); ?>
		</p><!-- .author-bio -->
    <a class="author-link text-uppercase text-dark font-weight-bold btn btn-outline-secondary btn-sm" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" rel="author">
      all author posts
    </a>

	</div><!-- .author-description -->
</div><!-- .author-info -->
