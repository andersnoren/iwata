<?php get_header(); ?>

<div class="section content">
	
	<div class="section-inner">

		<?php 

		$archive_title = '';

		if ( is_archive() ) {
			$archive_title = get_the_archive_title();
		} elseif ( is_search() ) {
			$archive_title = sprintf( __( 'Search Results: "%s"', 'iwata' ), get_search_query() );
		}

		if ( $archive_title ) : ?>

			<div class="page-title">
			
				<h4><?php echo $archive_title; ?></h4>
				
				<?php
				$tag_description = tag_description();
				if ( ! empty( $tag_description ) ) {
					echo apply_filters( 'tag_archive_meta', '<div class="page-title-meta">' . $tag_description . '</div>' );
				}
				?>
				
			</div><!-- .page-title -->

		<?php endif; ?>
																	                    
		<?php if ( have_posts() ) : ?>
		
			<div class="posts" id="posts">
								
				<?php 
				while ( have_posts() ) : the_post();
				
					get_template_part( 'content', get_post_format() );
													
				endwhile; 
				?>

			</div><!-- .posts -->
								
		<?php elseif ( is_search() ) : ?>

			<div class="post">
					
				<div class="post-content">
				
					<p><?php _e( 'No results. Try again, would you kindly?', 'iwata' ); ?></p>
					
					<?php get_search_form(); ?>
				
				</div><!-- .post-content -->
				
				<div class="clear"></div>
			
			</div><!-- .post -->

		<?php endif; ?>
		
		<?php iwata_archive_navigation(); ?>
	
	</div><!-- .section-inner -->
		
</div><!-- .content.section -->
	              	        
<?php get_footer(); ?>