<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php if ( has_post_thumbnail() ) : ?>
	
		<div class="featured-media">
			
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			
				<?php the_post_thumbnail(); ?>
			
			</a>
			
		</div>
	
	<?php endif; ?>
	
	<div class="post-header">
		
	    <h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
	    
	    <?php iwata_post_meta(); ?>
	    	    
	</div><!-- .post-header -->
	
	<div class="post-content">
	
		<?php the_excerpt(); ?>
	
	</div>
	
	<div class="clear"></div>

</div><!-- .post -->