<?php 

if ( post_password_required() ) return;

if ( have_comments() ) : ?>

	<div class="comments-container">

		<a name="comments"></a>
		
		<div class="comments-title-container">
			
			<h3 class="comments-title group">
			
				<?php 
				$comment_count = count( $wp_query->comments_by_type['comment'] );
				echo $comment_count . ' ' . _n( 'Comment', 'Comments', $comment_count, 'iwata' ); 
				?>
				
			</h3>
		
		</div><!-- .comments-title-container -->
	
		<div class="comments">
			
			<?php if ( have_comments() ) : ?>
		
				<ol class="commentlist">
				    <?php wp_list_comments( array( 'type' => 'comment', 'callback' => 'iwata_comment' ) ); ?>
				</ol>
			
			<?php endif; ?>
			
			<?php if ( ! empty( $comments_by_type['pings'] ) ) : ?>
			
				<div class="pingbacks">
								
					<h3 class="pingbacks-title">
					
						<?php 
						$pingback_count = count( $wp_query->comments_by_type['pings'] );
						echo $pingback_count . ' ' . _n( 'Pingback', 'Pingbacks', $pingback_count, 'iwata' ); 
						?>
					
					</h3>
				
					<ol class="pingbacklist">
					    <?php wp_list_comments( array( 'type' => 'pings', 'callback' => 'iwata_comment' ) ); ?>
					</ol>
											
				</div><!-- .pingbacks -->
			
			<?php endif; ?>
					
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
				
				<div class="comments-nav group" role="navigation">
					<div class="fleft"><?php previous_comments_link( '&laquo; ' . __( 'Older Comments', 'iwata' ) ); ?></div>
					<div class="fright"><?php next_comments_link( __( 'Newer Comments', 'iwata' ) . ' &raquo;' ); ?></div>
				</div><!-- .comment-nav-below -->
				
			<?php endif; ?>
			
		</div><!-- .comments -->
		
	</div><!-- .comments-container -->
	
	<?php 
endif;

$comments_args = array(

	'comment_notes_before' => 
		'',
		
	'comment_notes_after' =>
		'',

	'comment_field' => 
		'<p class="comment-form-comment">
			<label for="comment">' . __( 'Comment', 'iwata' ) . '</label>
			<textarea id="comment" name="comment" cols="45" rows="6" required></textarea>
		</p>',
);

comment_form( $comments_args );

?>