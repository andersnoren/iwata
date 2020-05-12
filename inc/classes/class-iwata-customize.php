<?php

/* ---------------------------------------------------------------------------------------------
   IWATA THEME OPTIONS
   --------------------------------------------------------------------------------------------- */


if ( ! class_exists( 'Iwata_Customize' ) ) : 
	class Iwata_Customize {

		public static function register ( $wp_customize ) {
			
			/* CUSTOM ACCENT COLOR SETTING */

			$wp_customize->add_setting( 'accent_color', array(
				'default' 			=> '#00A0D7',
				'type' 				=> 'theme_mod',
				'sanitize_callback' => 'sanitize_hex_color'
			) );
			
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'iwata_accent_color', array(
				'label' 			=> __( 'Accent Color', 'iwata' ),
				'priority' 			=> 10,
				'section' 			=> 'colors',
				'settings' 			=> 'accent_color',
			) ) );

		}

		public static function header_output() {

			$accent_default = '#00A0D7';
			$accent = get_theme_mod( 'accent_color', $accent_default );

			if ( ! $accent || $accent == $accent_default ) return;
			
			echo '<!-- Customizer CSS -->';
			echo '<style type="text/css">';
			self::generate_css( 'body a', 'color', $accent );

			self::generate_css( '.bg-accent', 'background-color', $accent );

			self::generate_css( '.main-menu ul a:hover', 'color', $accent );
			self::generate_css( '.post-title a:hover', 'color', $accent );

			self::generate_css( '.post-content blockquote:before', 'color', $accent );
			self::generate_css( '.post-content a.more-link,', 'background-color', $accent );
			self::generate_css( 'button, .button, .faux-button, input[type="submit"], input[type="reset"], input[type="button"], :root .wp-block-file .wp-block-file__button, :root .wp-block-button__link', 'background-color', $accent );
			self::generate_css( '.faux-button', 'background-color', $accent );
			self::generate_css( 'input[type="submit"]', 'background-color', $accent );
			self::generate_css( 'input[type="reset"]', 'background-color', $accent );
			self::generate_css( 'input[type="button"]', 'background-color', $accent );
			self::generate_css( '.post-content fieldset legend', 'background-color', $accent );

			self::generate_css( ':root .has-accent-color', 'color', $accent );
			self::generate_css( ':root .has-accent-background-color', 'background-color', $accent );

			self::generate_css( '#infinite-handle span', 'background-color', $accent );
			self::generate_css( '.page-links a:hover', 'background-color', $accent );
			self::generate_css( '.bypostauthor .avatar', 'border-color', $accent );
			self::generate_css( '.comment-actions a', 'color', $accent );
			self::generate_css( '.comment-actions a:hover', 'color', $accent );
			self::generate_css( '.comment-header h4 a:hover', 'color', $accent );
			self::generate_css( '#cancel-comment-reply-link', 'color', $accent );
			self::generate_css( '.comments-nav a:hover', 'color', $accent );
			self::generate_css( '.bypostauthor > .comment .avatar-container', 'background-color', $accent );

			self::generate_css( '.footer .to-the-top:hover', 'color', $accent );
			self::generate_css( '.nav-toggle.active .bar', 'background-color', $accent );
			echo '</style>';
			echo '<!--/Customizer CSS-->';

		}

		public static function generate_css( $selector, $style, $value, $prefix = '', $postfix = '', $echo = true ) {
			$return = '';
			if ( ! empty( $value ) ) {
				$return = sprintf( '%s { %s:%s; }',
					$selector,
					$style,
					$prefix.$value.$postfix
				);
				if ( $echo ) {
					echo $return;
				}
			}
			return $return;
		}

	}

	add_action( 'customize_register', array( 'Iwata_Customize', 'register' ) );
	add_action( 'wp_head', array( 'Iwata_Customize', 'header_output' ) );

endif;