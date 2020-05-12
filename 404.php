<?php get_header(); ?>

<div class="section content">
	
	<div class="section-inner">

		<div class="post single">
		
			<div class="post-header">
			
				<h1 class="post-title"><?php _e( 'The page could not be found', 'iwata' ); ?></h1>
				
				<div class="post-meta">
					<p><span class="fa fw fa-times-circle"></span><?php _e( 'Error 404', 'iwata' ); ?></p>
				</div>
														
			</div><!-- .post-header -->
		                                                	            
	        <div class="post-content">
	        	            
	            <p><?php _e( "It seems like you have tried to open a page that doesn't exist. It could have been deleted, moved, or it never existed at all. You are welcome to search for what you are looking for with the form below.", 'iwata' ) ?></p>
	            
	            <?php get_search_form(); ?>
	            
	        </div><!-- .post-content -->
	        	            	                        	
		</div><!-- .post -->
	
	</div><!-- .section-inner -->
	
</div><!-- .content -->

<?php get_footer(); ?>
