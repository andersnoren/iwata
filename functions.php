<?php


/* ---------------------------------------------------------------------------------------------
   THEME SETUP
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'iwata_setup' ) ) :
	function iwata_setup() {
		
		// Automatic feed
		add_theme_support( 'automatic-feed-links' );
		
		// Post thumbnails
		add_theme_support( 'post-thumbnails' ); 
		set_post_thumbnail_size( 688, 9999 );
		
		// Post Formats
		add_theme_support( 'post-formats', array( 'aside', 'image', 'quote' ) );
			
		// Jetpack infinite scroll
		add_theme_support( 'infinite-scroll', array(
			'container' => 'posts'
		) );
		
		// Custom header
		add_theme_support( 'custom-header', array(
			'header-text'	=> false,
			'height'		=> 198,
			'uploads'		=> true,
			'width'			=> 1440,
			
		) );

		// Content width
		global $content_width;
		if ( ! isset( $content_width ) ) $content_width = 640;
		
		// Custom background
		add_theme_support( 'custom-background', array( 
			'default-color'	=> 'f6f6f6' 
		) ); 
		
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
endif;


/* ---------------------------------------------------------------------------------------------
   INCLUDE REQUIRED FILES
   --------------------------------------------------------------------------------------------- */

// Customizer class
require get_template_directory() . '/inc/classes/class-iwata-customize.php';


/* ---------------------------------------------------------------------------------------------
   REGISTER AND ENQUEUE SCRIPTS
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'iwata_load_javascript_files' ) ) :
	function iwata_load_javascript_files() {
		
		$theme_version = wp_get_theme( 'iwata' )->get( 'Version' );

		wp_register_script( 'iwata_doubletap', get_template_directory_uri() . '/assets/js/doubletaptogo.js' );
		wp_enqueue_script( 'iwata_global', get_template_directory_uri() . '/assets/js/global.js', array( 'jquery', 'iwata_doubletap' ), $theme_version, true );
		
		if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );

	}
	add_action( 'wp_enqueue_scripts', 'iwata_load_javascript_files' );
endif;


/* ---------------------------------------------------------------------------------------------
   REGISTER AND ENQUEUE STYLES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'iwata_load_style' ) ) :
	function iwata_load_style() {

		if ( is_admin() ) return;

		$theme_version = wp_get_theme( 'iwata' )->get( 'Version' );
		$dependencies = array();

		/**
		 * Translators: If there are characters in your language that are not
		 * supported by the theme fonts, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		$google_fonts = _x( 'on', 'Google Fonts: on or off', 'iwata' );

		if ( 'off' !== $google_fonts ) {
			wp_register_style( 'iwata_googleFonts', '//fonts.googleapis.com/css?family=Fira+Sans:400,500,700,400italic,500italic,700italic' );
			$dependencies[] = 'iwata_googleFonts';
		}

		wp_register_style( 'iwata_fontawesome', get_template_directory_uri() . '/assets/fonts/fa/css/font-awesome.css' );
		$dependencies[] = 'iwata_fontawesome';

		wp_enqueue_style( 'iwata_style', get_stylesheet_uri(), $dependencies, $theme_version );

	}
	add_action( 'wp_print_styles', 'iwata_load_style' );
endif;


/* ---------------------------------------------------------------------------------------------
   ADD EDITOR STYLES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'iwata_add_editor_styles' ) ) :
	function iwata_add_editor_styles() {

		add_editor_style( 'assets/css/iwata-classic-editor-styles.css' );

		/**
		 * Translators: If there are characters in your language that are not
		 * supported by the theme fonts, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		$google_fonts = _x( 'on', 'Google Fonts: on or off', 'iwata' );

		if ( 'off' !== $google_fonts ) {
			$font_url = '//fonts.googleapis.com/css?family=Fira+Sans:400,500,700,400italic,500italic,700italic';
			add_editor_style( str_replace( ', ', '%2C', $font_url ) );
		}

	}
	add_action( 'init', 'iwata_add_editor_styles' );
endif;


/* ---------------------------------------------------------------------------------------------
   CHECK WHETHER THE BROWSER SUPPORTS JS
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'iwata_html_js_class' ) ) :
	function iwata_html_js_class () {

		echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>'. "\n";

	}
	add_action( 'wp_head', 'iwata_html_js_class', 1 );
endif;


/* ---------------------------------------------------------------------------------------------
   ADD CLASSES TO NEXT/PREVIOUS POSTS LINKS
   --------------------------------------------------------------------------------------------- */


if ( ! function_exists( 'iwata_next_posts_link_attributes' ) ) :
	function iwata_next_posts_link_attributes() { 

		return 'class="archive-nav-older"'; 

	}
	add_filter( 'next_posts_link_attributes', 'iwata_next_posts_link_attributes' );
endif;


if ( ! function_exists( 'iwata_previous_posts_link_attributes' ) ) :
	function iwata_previous_posts_link_attributes() { 

		return 'class="archive-nav-newer"'; 

	}
	add_filter( 'previous_posts_link_attributes', 'iwata_previous_posts_link_attributes' );
endif;


/* ---------------------------------------------------------------------------------------------
   CUSTOM MORE LINK TEXT
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'iwata_custom_more_link' ) ) :
	function iwata_custom_more_link( $more_link, $more_link_text ) {

		return str_replace( $more_link_text, __( 'Read more', 'iwata' ), $more_link );

	}
	add_filter( 'the_content_more_link', 'iwata_custom_more_link', 10, 2 );
endif;


/* ---------------------------------------------------------------------------------------------
   SET EXCERPT LENGTH
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'iwata_custom_excerpt_length' ) ) :
	function iwata_custom_excerpt_length( $length ) {

		return 33;

	}
	add_filter( 'excerpt_length', 'iwata_custom_excerpt_length', 999 );
endif;


/* ---------------------------------------------------------------------------------------------
   SET EXCERPT SUFFIX
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'iwata_new_excerpt_more' ) ) :
	function iwata_new_excerpt_more( $more ) {

		return '...';

	}
	add_filter( 'excerpt_more', 'iwata_new_excerpt_more' );
endif;


/* ---------------------------------------------------------------------------------------------
   ADD POST CLASSES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'iwata_post_classes' ) ) :
	function iwata_post_classes( $classes ) {

		// Always include the "post" class, used for styling
		$classes[] = 'post';

		return $classes; 

	}
	add_filter( 'post_class', 'iwata_post_classes' );
endif;


/* ---------------------------------------------------------------------------------------------
   POST META FUNCTION
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'iwata_post_meta' ) ) :
	function iwata_post_meta() { ?>

		<?php if ( get_post_type() == 'post' || comments_open() || current_user_can( 'edit_posts' ) ) : ?>
		
			<div class="post-meta">
					
				<?php if ( is_sticky() ) : ?>
					<p class="post-sticky is-sticky"><span class="fa fw fa-thumb-tack"></span><?php echo __( 'Sticky', 'iwata' ) . '<span> ' . __( 'Post', 'iwata' ) . '</span>'; ?></p>
				<?php endif; ?>
				
				<?php if ( get_post_type() == 'post' ) : ?>
					<p class="post-date"><a href="<?php the_permalink(); ?>"><span class="fa fw fa-calendar"></span><?php the_time(get_option( 'date_format' ) ); ?></a></p>
				<?php endif; ?>
				
				<?php if ( comments_open() ) : ?>
					<p class="post-comments">
						<?php comments_popup_link( '<span class="fa fw fa-comment"></span>' . __( 'Add Comment', 'iwata' ), '<span class="fa fw fa-comment"></span>1 ' . __( 'Comment', 'iwata' ), '<span class="fa fw fa-comment"></span>% ' . __( 'Comments', 'iwata' ) ); ?>
					</p>
				<?php endif; ?>
				
				<?php edit_post_link( '<span class="fa fw fa-cog"></span>' . __( 'Edit', 'iwata' ), '<p class="post-edit">', '</p>' ); ?>
				
			</div><!-- .post-meta -->
			
			<?php 
		endif;

	}
endif;


/* ---------------------------------------------------------------------------------------------
   MODIFY JETPACK INFINITE SCROLL TEXT
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'iwata_custom_jetpack_infinite_more' ) ) :
	function iwata_custom_jetpack_infinite_more() { 

		if ( is_home() || is_archive() ) : 
			?>

			<script type="text/javascript">
				//<![CDATA[
				infiniteScroll.settings.text = "<?php _e( 'Load More', 'iwata' ); ?>";
				//]]>
			</script> 

			<?php
		endif;

	}
	add_action( 'wp_footer', 'iwata_custom_jetpack_infinite_more', 3 );
endif;




/*	-----------------------------------------------------------------------------------------------
	FILTER ARCHIVE TITLE

	@param	$title string		The initial title
--------------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'iwata_filter_archive_title' ) ) :
	function iwata_filter_archive_title( $title ) {

		// On search, show the search query.
		if ( is_search() ) {
			$title = sprintf( _x( 'Search: %s', '%s = The search query', 'iwata' ), '&ldquo;' . get_search_query() . '&rdquo;' );
		}

		return $title;

	}
	add_filter( 'get_the_archive_title', 'iwata_filter_archive_title' );
endif;


/*	-----------------------------------------------------------------------------------------------
	FILTER ARCHIVE DESCRIPTION

	@param	$description string		The initial description
--------------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'iwata_filter_archive_description' ) ) :
	function iwata_filter_archive_description( $description ) {

		// On search, show a string describing the results of the search.
		if ( is_search() ) {
			global $wp_query;
			if ( $wp_query->found_posts ) {
				/* Translators: %s = Number of results */
				$description = sprintf( _nx( 'We found %s result for your search.', 'We found %s results for your search.',  $wp_query->found_posts, '%s = Number of results', 'iwata' ), $wp_query->found_posts );
			} else {
				$description = __( 'We could not find any results for your search.', 'iwata' );
			}
		}

		return $description;

	}
	add_filter( 'get_the_archive_description', 'iwata_filter_archive_description' );
endif;


/* ---------------------------------------------------------------------------------------------
   IWATA COMMENT FUNCTION
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'iwata_comment' ) ) :
	function iwata_comment( $comment, $args, $depth ) {

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

						<a class="comment-date-link" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php echo get_comment_date() . '<span> ' . __( 'at', 'iwata' ) . ' ' . get_comment_time() . '</span>'; ?></a>

						<?php if ( $comment->user_id === $post->post_author ) : ?>
							<div class="post-author-text"><span>&bull;</span><?php _e( 'Post Author', 'iwata' ); ?></div>
						<?php endif; ?>
						
					</div><!-- .comment-meta -->
				
				</div><!-- .comment-header -->

				<div class="comment-content post-content">
				
					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'iwata' ); ?></p>
					<?php endif; ?>
				
					<?php comment_text(); ?>
					
				</div><!-- .comment-content -->
				
				<div class="comment-actions">
					
					<?php 
					comment_reply_link( array_merge( $args, array( 
						'after'			=>	'</p>',
						'before'		=>	'<p class="comment-reply">',
						'depth'			=> 	$depth, 
						'max_depth' 	=> 	$args['max_depth'],
						'reply_text' 	=>  '<span class="fa fw fa-reply"></span>' . __( 'Reply', 'iwata' ), 
					) ) ); 
					
					edit_comment_link( '<span class="fa fw fa-cog"></span>' . __( 'Edit', 'iwata' ), '<p class="comment-edit">', '</p>' ); 
					
					?>
													
				</div><!-- .comment-actions -->
							
			</div>
					
		<?php
			break;
		endswitch;

	}
endif;


/* ---------------------------------------------------------------------------------------------
   SPECIFY BLOCK EDITOR SUPPORT
------------------------------------------------------------------------------------------------ */

if ( ! function_exists( 'iwata_add_block_editor_features' ) ) :
	function iwata_add_block_editor_features() {

		/* Block Editor Features ------------- */

		add_theme_support( 'align-wide' );

		/* Block Editor Palette -------------- */

		$accent_color = get_theme_mod( 'accent_color', '#00A0D7' );

		add_theme_support( 'editor-color-palette', array(
			array(
				'name' 	=> _x( 'Accent', 'Name of the accent color in the Block Editor palette', 'iwata' ),
				'slug' 	=> 'accent',
				'color' => $accent_color,
			),
			array(
				'name' 	=> _x( 'Black', 'Name of the black color in the Block Editor palette', 'iwata' ),
				'slug' 	=> 'black',
				'color' => '#333',
			),
			array(
				'name' 	=> _x( 'Dark Gray', 'Name of the dark gray color in the Block Editor palette', 'iwata' ),
				'slug' 	=> 'dark-gray',
				'color' => '#555',
			),
			array(
				'name' 	=> _x( 'Medium Gray', 'Name of the medium gray color in the Block Editor palette', 'iwata' ),
				'slug' 	=> 'medium-gray',
				'color' => '#777',
			),
			array(
				'name' 	=> _x( 'Light Gray', 'Name of the light gray color in the Block Editor palette', 'iwata' ),
				'slug' 	=> 'light-gray',
				'color' => '#999',
			),
			array(
				'name' 	=> _x( 'White', 'Name of the white color in the Block Editor palette', 'iwata' ),
				'slug' 	=> 'white',
				'color' => '#fff',
			),
		) );

		/* Block Editor Font Sizes ----------- */

		add_theme_support( 'editor-font-sizes', array(
			array(
				'name' 		=> _x( 'Small', 'Name of the small font size in Block Editor', 'iwata' ),
				'shortName' => _x( 'S', 'Short name of the small font size in the Block Editor editor.', 'iwata' ),
				'size' 		=> 16,
				'slug' 		=> 'small',
			),
			array(
				'name' 		=> _x( 'Normal', 'Name of the regular font size in Block Editor', 'iwata' ),
				'shortName' => _x( 'N', 'Short name of the regular font size in the Block Editor editor.', 'iwata' ),
				'size' 		=> 18,
				'slug' 		=> 'normal',
			),
			array(
				'name' 		=> _x( 'Large', 'Name of the large font size in Block Editor', 'iwata' ),
				'shortName' => _x( 'L', 'Short name of the large font size in the Block Editor editor.', 'iwata' ),
				'size' 		=> 24,
				'slug' 		=> 'large',
			),
			array(
				'name' 		=> _x( 'Larger', 'Name of the larger font size in Block Editor', 'iwata' ),
				'shortName' => _x( 'XL', 'Short name of the larger font size in the Block Editor editor.', 'iwata' ),
				'size' 		=> 27,
				'slug' 		=> 'larger',
			),
		) );

	}
	add_action( 'after_setup_theme', 'iwata_add_block_editor_features' );
endif;


/* ---------------------------------------------------------------------------------------------
   BLOCK EDITOR STYLES
   --------------------------------------------------------------------------------------------- */

if ( ! function_exists( 'iwata_block_editor_styles' ) ) :
	function iwata_block_editor_styles() {

		$theme_version = wp_get_theme( 'iwata' )->get( 'Version' );
		$dependencies = array();

		/**
		 * Translators: If there are characters in your language that are not
		 * supported by the theme fonts, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		$google_fonts = _x( 'on', 'Google Fonts: on or off', 'iwata' );

		if ( 'off' !== $google_fonts ) {
			wp_register_style( 'iwata-block-editor-styles-font', '//fonts.googleapis.com/css?family=Fira+Sans:400,500,700,400italic,500italic,700italic', false, 1.0, 'all' );
			$dependencies[] = 'iwata-block-editor-styles-font';
		}

		// Enqueue the editor styles
		wp_enqueue_style( 'iwata-block-editor-styles', get_theme_file_uri( '/assets/css/iwata-block-editor-styles.css' ), $dependencies, $theme_version, 'all' );

	}
	add_action( 'enqueue_block_editor_assets', 'iwata_block_editor_styles', 1 );
endif;
