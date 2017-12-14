<?php


/* ---------------------------------------------------------------------------------------------
   THEME SETUP
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'iwata_setup' ) ) {

	function iwata_setup() {
		
		// Automatic feed
		add_theme_support( 'automatic-feed-links' );
		
		// Post thumbnails
		add_theme_support( 'post-thumbnails' ); 
		add_image_size( 'post-image', 688, 9999 );
		
		// Post Formats
		add_theme_support( 'post-formats', array( 'aside', 'image', 'quote' ) );
			
		// Jetpack infinite scroll
		add_theme_support( 'infinite-scroll', array(
			'container' => 'posts'
		) );
		
		// Custom header
		$args = array(
			'width'         => 1440,
			'height'        => 198,
			'uploads'       => true,
			'header-text'  	=> false
			
		);
		add_theme_support( 'custom-header', $args );

		// Content width
		global $content_width;
		if ( ! isset( $content_width ) ) $content_width = 640;
		
		// Custom background
		add_theme_support( "custom-background", array( 'default-color' => 'f6f6f6' ) ); 
		
		// Add nav menu
		register_nav_menu( 'primary', __( 'Primary Menu', 'iwata' ) );
		
		// Title Tag
		add_theme_support( "title-tag" );
		
		// Make the theme translation ready
		load_theme_textdomain( 'iwata', get_template_directory() . '/languages' );
		
		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";
		if ( is_readable( $locale_file ) ) {
			require_once( $locale_file );
		}
		
	}
	add_action( 'after_setup_theme', 'iwata_setup' );

}


/* ---------------------------------------------------------------------------------------------
   REGISTER AND ENQUEUE SCRIPTS
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'iwata_load_javascript_files' ) ) {

	function iwata_load_javascript_files() {

		if ( ! is_admin() ) {
			wp_enqueue_script( 'iwata_doubletap', get_template_directory_uri().'/js/doubletaptogo.js', array( 'jquery' ), '', true );
			wp_enqueue_script( 'iwata_global', get_template_directory_uri().'/js/global.js', array( 'jquery' ), '', true );
			
			if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
			
		}
	}
	add_action( 'wp_enqueue_scripts', 'iwata_load_javascript_files' );

}


/* ---------------------------------------------------------------------------------------------
   REGISTER AND ENQUEUE STYLES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'iwata_load_style' ) ) {

	function iwata_load_style() {
		if ( ! is_admin() ) {
			wp_enqueue_style( 'iwata_googleFonts', '//fonts.googleapis.com/css?family=Fira+Sans:400,500,700,400italic,500italic,700italic' );
			wp_enqueue_style( 'iwata_fontawesome', get_template_directory_uri() . '/fa/css/font-awesome.css' );
			wp_enqueue_style( 'iwata_style', get_stylesheet_uri() );		
		}
	}
	add_action( 'wp_print_styles', 'iwata_load_style' );

}


/* ---------------------------------------------------------------------------------------------
   ADD EDITOR STYLES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'iwata_add_editor_styles' ) ) {

	function iwata_add_editor_styles() {
		add_editor_style( 'iwata-editor-styles.css' );
		$font_url = '//fonts.googleapis.com/css?family=Fira+Sans:400,500,700,400italic,500italic,700italic';
		add_editor_style( str_replace( ', ', '%2C', $font_url ) );
	}
	add_action( 'init', 'iwata_add_editor_styles' );

}


/* ---------------------------------------------------------------------------------------------
   CHECK WHETHER THE BROWSER SUPPORTS JS
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'iwata_html_js_class' ) ) {

	function iwata_html_js_class () {
		echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>'. "\n";
	}
	add_action( 'wp_head', 'iwata_html_js_class', 1 );

}


/* ---------------------------------------------------------------------------------------------
   ADD CLASSES TO NEXT/PREVIOUS POSTS LINKS
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'iwata_posts_link_attributes_1' ) ) {

	function iwata_posts_link_attributes_1() { 
		return 'class="archive-nav-older"'; 
	}
	add_filter( 'next_posts_link_attributes', 'iwata_posts_link_attributes_1' );

}


if ( ! function_exists( 'iwata_posts_link_attributes_2' ) ) {

	function iwata_posts_link_attributes_2() { 
		return 'class="archive-nav-newer"'; 
	}
	add_filter( 'previous_posts_link_attributes', 'iwata_posts_link_attributes_2' );

}


/* ---------------------------------------------------------------------------------------------
   CUSTOM MORE LINK TEXT
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'iwata_custom_more_link' ) ) {

	function iwata_custom_more_link( $more_link, $more_link_text ) {
		return str_replace( $more_link_text, __( 'Read more', 'iwata' ), $more_link );
	}
	add_filter( 'the_content_more_link', 'iwata_custom_more_link', 10, 2 );

}


/* ---------------------------------------------------------------------------------------------
   STYLE THE ADMIN AREA
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'iwata_admin_style' ) ) {

	function iwata_admin_style() { ?>
		<style type="text/css">
			#postimagediv #set-post-thumbnail img {
				max-width: 100%;
				height: auto;
			}
		</style>
		<?php
	}
	add_action( 'admin_head', 'iwata_admin_style' );

}


/* ---------------------------------------------------------------------------------------------
   SET EXCERPT LENGTH
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'iwata_custom_excerpt_length' ) ) {

	function iwata_custom_excerpt_length( $length ) {
		return 33;
	}
	add_filter( 'excerpt_length', 'iwata_custom_excerpt_length', 999 );

}


/* ---------------------------------------------------------------------------------------------
   SET EXCERPT SUFFIX
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'iwata_new_excerpt_more' ) ) {

	function iwata_new_excerpt_more( $more ) {
		return '...';
	}
	add_filter( 'excerpt_more', 'iwata_new_excerpt_more' );

}


/* ---------------------------------------------------------------------------------------------
   ADD POST CLASSES
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'iwata_post_classes' ) ) {

	function iwata_post_classes( $classes ) {

		// Is search
		if ( is_search() ) {
			$classes[] = 'post';
		}

		return $classes; 

	}
	add_filter( 'post_class', 'iwata_post_classes' );

}


/* ---------------------------------------------------------------------------------------------
   POST META FUNCTION
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'iwata_post_meta' ) ) {

	function iwata_post_meta() { ?>

		<?php if ( ! is_page() || comments_open() || current_user_can( 'edit_posts' ) ) : ?>
		
			<div class="post-meta">
					
				<?php if ( is_sticky() ) : ?>
					<p class="post-sticky is-sticky"><span class="fa fw fa-thumb-tack"></span><?php echo __( 'Sticky', 'iwata' ) . '<span> ' . __( 'Post', 'iwata' ) . '</span>'; ?></p>
				<?php endif; ?>
				
				<?php if ( !is_page() ) : ?>
					<p class="post-date"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><span class="fa fw fa-calendar"></span><?php the_time(get_option( 'date_format' ) ); ?></a></p>
				<?php endif; ?>
				
				<?php if ( comments_open() ) : ?>
					<p class="post-comments">
						<?php comments_popup_link( '<span class="fa fw fa-comment"></span>' . __( 'Add Comment', 'iwata' ), '<span class="fa fw fa-comment"></span>1 ' . __( 'Comment', 'iwata' ), '<span class="fa fw fa-comment"></span>% ' . __( 'Comments', 'iwata' ) ); ?>
					</p>
				<?php endif; ?>
				
				<?php edit_post_link( '<span class="fa fw fa-cog"></span>' . __( 'Edit', 'iwata' ), '<p class="post-edit">', '</p>' ); ?>
				
			</div><!-- .post-meta -->
			
		<?php endif;
	}

}


/* ---------------------------------------------------------------------------------------------
   ARCHIVE NAVIGATION FUNCTION
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'iwata_archive_navigation' ) ) {

	function iwata_archive_navigation() {
		
		global $wp_query;
		
		if ( $wp_query->max_num_pages > 1 ) : ?>
					
			<div class="archive-nav">
				
				<?php echo get_next_posts_link( __( 'Older', 'iwata' ) . '<span> ' . __( 'Posts', 'iwata' ) . '</span> &raquo;' ); ?>
				
				<?php global $paged; ?>
				
				<div class="page-number"><?php printf( __( 'Page %s of %s', 'iwata' ), $paged, $wp_query->max_num_pages ); ?></div>
							
				<?php echo get_previous_posts_link( '&laquo; ' . __( 'Newer', 'iwata' ) . '<span> ' .__( 'Posts', 'iwata' ) . '</span>' ); ?>
				
				<div class="clear"></div>
					
			</div><!-- .archive-nav-->
							
		<?php endif;
	}

}


/* ---------------------------------------------------------------------------------------------
   MODIFY JETPACK INFINITE SCROLL TEXT
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'iwata_custom_jetpack_infinite_more' ) ) {

	function iwata_custom_jetpack_infinite_more() { 
		if ( is_home() || is_archive() ) { ?>
			<script type="text/javascript">
				//<![CDATA[
				infiniteScroll.settings.text = "<?php _e( 'Load More', 'iwata' ); ?>";
				//]]>
			</script> 
			<?php
		}
	}
	add_action( 'wp_footer', 'iwata_custom_jetpack_infinite_more', 3 );

}


/* ---------------------------------------------------------------------------------------------
   IWATA COMMENT FUNCTION
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'iwata_comment' ) ) {
	function iwata_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
		
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		
			<?php __( 'Pingback:', 'iwata' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'iwata' ), '<span class="edit-link">', '</span>' ); ?>
			
		</li>
		<?php
				break;
			default :
			global $post;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		
			<div id="comment-<?php comment_ID(); ?>" class="comment">
			
				<div class="comment-header">
											
					<h4><?php echo get_comment_author_link(); ?></h4>
					
					<div class="comment-meta">
						<a class="comment-date-link" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>" title="<?php echo get_comment_date() . ' at ' . get_comment_time(); ?>"><?php echo get_comment_date() . '<span> ' . __( 'at', 'iwata' ) . ' ' . get_comment_time() . '</span>'; ?></a>
						<?php if ( $comment->user_id === $post->post_author ) : ?>
						
							<div class="post-author-text"><span>&bull;</span><?php _e( 'Post Author', 'iwata' ); ?></div>
						
						<?php endif; ?>
						
					</div>
				
				</div><!-- .comment-header -->

				<div class="comment-content post-content">
				
					<?php if ( '0' == $comment->comment_approved ) : ?>
					
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'iwata' ); ?></p>
						
					<?php endif; ?>
				
					<?php comment_text(); ?>
					
				</div><!-- .comment-content -->
				
				<div class="comment-actions">
					
					<?php 
						comment_reply_link( 
							array_merge( 
								$args, 
								array( 
									'reply_text' 	=>  '<span class="fa fw fa-reply"></span>' . __( 'Reply', 'iwata' ), 
									'depth'			=> 	$depth, 
									'max_depth' 	=> 	$args['max_depth'],
									'before'		=>	'<p class="comment-reply">',
									'after'			=>	'</p>'
								) 
							) 
						); 
					?>
					
					<?php edit_comment_link( '<span class="fa fw fa-cog"></span>' . __( 'Edit', 'iwata' ), '<p class="comment-edit">', '</p>' ); ?>
													
				</div><!-- .comment-actions -->
							
			</div>
					
		<?php
			break;
		endswitch;
	}
}


/* ---------------------------------------------------------------------------------------------
   IWATA THEME OPTIONS
   --------------------------------------------------------------------------------------------- */


class iwata_customize {

   public static function iwata_register ( $wp_customize ) {
   
      //1. Define a new section (if desired) to the Theme Customizer
      $wp_customize->add_section( 'iwata_options', 
         array(
            'title' => __( 'Options for Iwata', 'iwata' ), //Visible title of section
            'priority' => 35, //Determines what order this appears in
            'capability' => 'edit_theme_options', //Capability needed to tweak
            'description' => __( 'Allows you to customize theme settings for Iwata.', 'iwata' ), //Descriptive tooltip
         ) 
      );
      
      //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'accent_color', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => '#00A0D7', //Default setting/value to save
            'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
      		'sanitize_callback' => 'sanitize_hex_color'
         ) 
      );
      
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'iwata_accent_color', //Set a unique ID for the control
         array(
            'label' => __( 'Accent Color', 'iwata' ), //Admin-visible name of the control
            'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'accent_color', //Which setting to load and manipulate (serialized is okay)
            'priority' => 10, //Determines the order this control appears in for the specified section
         ) 
      ) );
      
      //4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
      $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
      $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
   }

   public static function iwata_header_output() {
      ?>
      
	      <!-- Customizer CSS --> 
	      
	      <style type="text/css">
	           <?php self::iwata_generate_css( 'body a', 'color', 'accent_color' ); ?>
	           <?php self::iwata_generate_css( 'body a:hover', 'color', 'accent_color' ); ?>
	           <?php self::iwata_generate_css( '.bg-accent', 'background', 'accent_color' ); ?>
	           <?php self::iwata_generate_css( '.main-menu ul a:hover', 'color', 'accent_color' ); ?>
	           <?php self::iwata_generate_css( '.post-title a:hover', 'color', 'accent_color' ); ?>
	           <?php self::iwata_generate_css( '.post-content a', 'color', 'accent_color' ); ?>
	           <?php self::iwata_generate_css( '.post-content a:hover', 'color', 'accent_color' ); ?>
	           <?php self::iwata_generate_css( '.post-content blockquote:before', 'color', 'accent_color' ); ?>
	           <?php self::iwata_generate_css( '.post-content a.more-link,', 'background', 'accent_color' ); ?>
	           <?php self::iwata_generate_css( '.post-content input[type="submit"]', 'background', 'accent_color' ); ?>
	           <?php self::iwata_generate_css( '.post-content input[type="reset"]', 'background', 'accent_color' ); ?>
	           <?php self::iwata_generate_css( '.post-content input[type="button"]', 'background', 'accent_color' ); ?>
	           <?php self::iwata_generate_css( '.post-content fieldset legend', 'background', 'accent_color' ); ?>
	           <?php self::iwata_generate_css( '.comment-form input[type="submit"]', 'background', 'accent_color' ); ?>
	           <?php self::iwata_generate_css( '#infinite-handle span', 'background', 'accent_color' ); ?>
	           <?php self::iwata_generate_css( '.page-links a:hover', 'background', 'accent_color' ); ?>
	           <?php self::iwata_generate_css( '.bypostauthor .avatar', 'border-color', 'accent_color' ); ?>
	           <?php self::iwata_generate_css( '.comment-actions a', 'color', 'accent_color' ); ?>
	           <?php self::iwata_generate_css( '.comment-actions a:hover', 'color', 'accent_color' ); ?>
	           <?php self::iwata_generate_css( '.comment-header h4 a:hover', 'color', 'accent_color' ); ?>
	           <?php self::iwata_generate_css( '#cancel-comment-reply-link', 'color', 'accent_color' ); ?>
	           <?php self::iwata_generate_css( '.comments-nav a:hover', 'color', 'accent_color' ); ?>
	           <?php self::iwata_generate_css( '.bypostauthor > .comment .avatar-container', 'background', 'accent_color' ); ?>
	           <?php self::iwata_generate_css( '.to-the-top:hover', 'color', 'accent_color' ); ?>
	           <?php self::iwata_generate_css( '.nav-toggle.active .bar', 'background', 'accent_color' ); ?>
	      </style> 
	      
	      <!--/Customizer CSS-->
	      
      <?php
   }
   
   public static function iwata_live_preview() {
      wp_enqueue_script( 
           'iwata-themecustomizer', // Give the script a unique ID
           get_template_directory_uri() . '/js/theme-customizer.js', // Define the path to the JS file
           array(  'jquery', 'customize-preview' ), // Define dependencies
           '', // Define a version (optional) 
           true // Specify whether to put in footer (leave this true)
      );
   }

   public static function iwata_generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
      $return = '';
      $mod = get_theme_mod($mod_name);
      if ( ! empty( $mod ) ) {
         $return = sprintf( '%s { %s:%s; }',
            $selector,
            $style,
            $prefix.$mod.$postfix
         );
         if ( $echo ) {
            echo $return;
         }
      }
      return $return;
    }
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'iwata_customize' , 'iwata_register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'iwata_customize' , 'iwata_header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'iwata_customize' , 'iwata_live_preview' ) );

?>