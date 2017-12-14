<?php get_header(); ?>

<div class="content section">
	
	<div class="section-inner">
	
		<div class="page-title">
				
			<h4>
				<?php
				if ( is_day() ) :
					printf( __( 'Date: %s', 'iwata' ), '' . get_the_date() . '' );
				elseif ( is_month() ) :
					printf( __( 'Month: %s', 'iwata' ), '' . get_the_date( _x( 'F Y', 'F = Month, Y = Year', 'iwata' ) ) );
				elseif ( is_year() ) :
					printf( __( 'Year: %s', 'iwata' ), '' . get_the_date( _x( 'Y', 'Y = Year', 'iwata' ) ) );
				elseif ( is_category() ) :
					printf( __( 'Category: %s', 'iwata' ), '' . single_cat_title( '', false ) . '' );
				elseif ( is_tag() ) :
					printf( __( 'Tag: %s', 'iwata' ), '' . single_tag_title( '', false ) . '' );
				elseif ( is_author() ) :
					$curauth = ( isset($_GET['author_name'] ) ) ? get_user_by( 'slug', $author_name) : get_userdata( intval( $author ) );
					printf( __( 'Author: %s', 'iwata' ), $curauth->display_name );
				else :
					_e( 'Archive', 'iwata' );
				endif; ?>
			</h4>
			
			<?php
			$tag_description = tag_description();
			if ( ! empty( $tag_description ) ) {
				echo apply_filters( 'tag_archive_meta', '<div class="page-title-meta">' . $tag_description . '</div>' );
			}
			?>
			
		</div><!-- .page-title -->
		
		<?php if ( have_posts() ) : ?>
				
			<div class="posts" id="posts">
				
				<?php 
				while ( have_posts() ) : the_post();
							
					get_template_part( 'content', get_post_format() );
					
				endwhile; 
				?>
								
			</div><!-- .posts -->
			
			<?php iwata_archive_navigation(); ?>
					
		<?php endif; ?>
	
	</div><!-- .section-inner -->

</div><!-- .content -->

<?php get_footer(); ?>