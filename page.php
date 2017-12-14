<?php get_header(); ?>

<div class="section content">
	
	<div class="section-inner">
											        
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
			<div id="post-<?php the_ID(); ?>" <?php post_class( 'post single' ); ?>>

				<?php if ( has_post_thumbnail() ) : ?>
				
					<div class="featured-media">	
						
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
						
							<?php the_post_thumbnail( 'post-image' ); ?>
						
						</a>
						
					</div><!-- .featured-media -->
						
				<?php endif; ?>
				
				<div class="post-header">
					
					<?php the_title( '<h1 class="post-title">', '</h1>' ); ?>
				    
				    <?php iwata_post_meta(); ?>
				    	    
				</div><!-- .post-header -->
								
				<div class="post-content">
				
					<?php the_content(); ?>
				
				</div>
				
				<?php if ( is_single() ) : ?>
					
					<?php 
					$link_pages_args = array(
						'before'           => '<div class="clear"></div><p class="page-links"><span class="title">' . __( 'Pages:', 'iwata' ) . '</span>',
						'after'            => '</p>',
						'link_before'      => '<span>',
						'link_after'       => '</span>',
						'separator'        => '',
						'pagelink'         => '%',
						'echo'             => 1
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
					    
					</div><!-- .bottom-post-meta -->
				
				<?php endif; ?>
			
			</div><!-- .post -->
													                        
		<?php 
		endwhile; 
		else: ?>
	
			<p><?php _e( "We couldn't find any posts that matched your query. Please try again.", "iwata" ); ?></p>
		
		<?php endif; ?>   
		
	</div><!-- .section-inner -->
	
</div><!-- .content -->

<?php if ( comments_open() ) : ?>

	<div class="comments-section section">
		
		<div class="section-inner">
								
			<?php comments_template( '', true ); ?>
		
		</div><!-- .section-inner --> 
	
	</div><!-- .comments-section -->
	
<?php endif; ?>
		
<?php get_footer(); ?>