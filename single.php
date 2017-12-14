<?php get_header(); ?>

<div class="section content">
	
	<div class="section-inner">
											        
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php if ( has_post_thumbnail() ) : ?>
				
					<div class="featured-media">	
						
						<?php the_post_thumbnail( 'post-image' ); ?>
						
					</div><!-- .featured-media -->
						
				<?php endif; ?>
				
				<div class="post-header">
					
				    <?php the_title( '<h1 class="post-title">', '</h1>' ); ?>
				    
				    <?php iwata_post_meta(); ?>
				    	    
				</div><!-- .post-header -->
				
				<div class="post-content">
				
					<?php the_content(); ?>
				
				</div>
				
				<?php 
				$link_pages_args = array(
					'after'            => '</p>',
					'before'           => '<div class="clear"></div><p class="page-links"><span class="title">' . __( 'Pages:', 'iwata' ) . '</span>',
					'echo'             => 1,
					'link_after'       => '</span>',
					'link_before'      => '<span>',
					'pagelink'         => '%',
					'separator'        => '',
				);
			
				wp_link_pages( $link_pages_args ); 
				?>
				
				<div class="post-meta bottom">
							    
				    <?php if ( has_category() ) : ?>
					
						<p><span class="fa fw fa-folder"></span><?php the_category( ', ' ); ?></p>
					
					<?php endif; ?>
					
					<?php if ( has_tag() ) : ?>
							
						<p class="post-tags"><?php the_tags( '<span class="fa fw fa-tags"></span>', ', ', '' ); ?></p>
					
					<?php endif; ?>
				    
				</div><!-- .post-meta.bottom -->
				
				<div class="post-navigation">
				
					<?php
					$prev_post = get_previous_post();
					$next_post = get_next_post();
					
					if ( ! empty( $next_post ) ) : ?>
						
						<a class="prev-post" title="<?php echo esc_attr( get_the_title( $next_post ) ); ?>" href="<?php echo get_permalink( $next_post->ID ); ?>">
							<p><?php _e( 'Previous Post', 'iwata' ); ?></p>
							<h4><?php echo get_the_title( $next_post ); ?></h4>
						</a>
				
					<?php endif;
					
					if ( ! empty( $prev_post ) ): ?>
					
						<a class="next-post" title="<?php echo esc_attr( get_the_title( $prev_post ) ); ?>" href="<?php echo get_permalink( $prev_post->ID ); ?>">
							<p><?php _e( 'Next Post', 'iwata' ); ?></p>
							<h4><?php echo get_the_title( $prev_post ); ?></h4>
						</a>
					<?php endif; ?>
					
					<div class="clear"></div>
					
				</div><!-- .post-navigation -->
			
			</div><!-- .post -->
													                        
		<?php 
		endwhile; 
		else: ?>
	
			<p><?php _e( "We couldn't find any posts that matched your query. Please try again.", "iwata" ); ?></p>
		
		<?php endif; ?>   
		
	</div><!-- .section-inner -->
	
</div><!-- .content -->

<div class="comments-section section">
	
	<div class="section-inner">
							
		<?php comments_template( '', true ); ?>
	
	</div><!-- .section-inner --> 

</div><!-- .comments-section -->
		
<?php get_footer(); ?>