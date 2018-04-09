<article id="post-<?php the_ID(); ?>" <?php post_class('w-100'); ?>>

	<header class="entry-header">
		<?php
			if ( is_single() ) :
				// the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			endif;
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content();
		?>
	</div><!-- .entry-content -->
	
	<div class="entry-tags my-5">
		<?php 
			$open = "<span class='border rounded mr-1 px-1 text-uppercase d-inline-block'>";
			$close = "</span>";
			$close_open = $close . $open;
			the_tags($open,$close_open,$close)
		?>
	</div>

	<?php
		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' );
		endif;
		
		edit_post_link(__('Edit', 'wp-agency'), '<span class="edit-link">', '</span>', '', 'post-edit-link btn btn-outline-info btn-sm');
		?>

	<footer class="entry-footer">
		<section class="relate-posts my-5 border-top over-width">
			<?php get_template_part( 'related-posts' ); ?>
		</section>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
