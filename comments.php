<?php 

if ( post_password_required() ) 
	return;

if ( have_comments() ) : ?>

	<div class="comments-container">

		<a name="comments"></a>
		
		<div class="comments-title-container">
			
			<h3 class="comments-title">
			
				<?php 
				$comment_count = count( $wp_query->comments_by_type['comment'] );
				echo $comment_count . ' ' . _n( 'Comment', 'Comments', $comment_count, 'iwata' ); ?>
				
			</h3>
			
			<div class="clear"></div>
		
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
					echo $pingback_count . ' ' . _n( 'Pingback', 'Pingbacks', $pingback_count, 'iwata' ); ?>
					
					</h3>
				
					<ol class="pingbacklist">
					    <?php wp_list_comments( array( 'type' => 'pings', 'callback' => 'iwata_comment' ) ); ?>
					</ol>
											
				</div><!-- .pingbacks -->
			
			<?php endif; ?>
					
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
				
				<div class="comments-nav" role="navigation">
				
					<div class="fleft">
										
						<?php previous_comments_link( '&laquo; ' . __( 'Older Comments', 'iwata' ) ); ?>
					
					</div>
					
					<div class="fright">
					
						<?php next_comments_link( __( 'Newer Comments', 'iwata' ) . ' &raquo;' ); ?>
					
					</div>
					
					<div class="clear"></div>
					
				</div><!-- .comment-nav-below -->
				
			<?php endif; ?>
			
		</div><!-- .comments -->
		
	</div><!-- .comments-container -->
	
<?php endif; ?>

<?php if ( ! comments_open() && ! is_page() ) : ?>

	<p class="no-comments"><?php _e( 'Comments are closed', 'iwata' ); ?></p>
	
<?php endif; ?>

<?php $comments_args = array(

	'comment_notes_before' => 
		'',
		
	'comment_notes_after' =>
		'',

	'comment_field' => 
		'<p class="comment-form-comment">
			<label for="comment">' . __( 'Comment', 'iwata' ) . '</label>
			<textarea id="comment" name="comment" cols="45" rows="6" required></textarea>
		</p>',
	
	'fields' => apply_filters( 'comment_form_default_fields', array(
	
		'author' =>
			'<p class="comment-form-author">
				<label for="author">' . __( 'Name', 'iwata' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label> 
				<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" />
			</p>',
		
		'email' =>
			'<p class="comment-form-email">
				<label for="email">' . __( 'Email', 'iwata' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label> 
				<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" />
			</p>',
		
		'url' =>
			'<p class="comment-form-url">
				<label for="url">' . __( 'Website', 'iwata' ) . '</label>
				<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />
			</p>' )
	),
);

comment_form($comments_args);

?>