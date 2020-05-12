<?php

global $wp_query;
global $paged;

if ( $wp_query->max_num_pages > 1 ) : ?>
			
	<div class="archive-nav group">
		<?php echo get_next_posts_link( __( 'Older', 'iwata' ) . '<span> ' . __( 'Posts', 'iwata' ) . '</span> &raquo;' ); ?>
		<div class="page-number"><?php printf( __( 'Page %1$s of %2$s', 'iwata' ), $paged, $wp_query->max_num_pages ); ?></div>
		<?php echo get_previous_posts_link( '&laquo; ' . __( 'Newer', 'iwata' ) . '<span> ' .__( 'Posts', 'iwata' ) . '</span>' ); ?>
	</div><!-- .archive-nav-->
					
	<?php 
endif;
		