<?php
/* ------------------------------------------------------------------------- *
 *  Dynamic styles
/* ------------------------------------------------------------------------- */

/*  Convert hexadecimal to rgb
/* ------------------------------------ */
if ( ! function_exists( 'alx_hex2rgb' ) ) {

	function alx_hex2rgb( $hex, $array=false ) {
		$hex = str_replace("#", "", $hex);

		if ( strlen($hex) == 3 ) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}

		$rgb = array( $r, $g, $b );
		if ( !$array ) { $rgb = implode(",", $rgb); }
		return $rgb;
	}
	
}	


/*  Google fonts
/* ------------------------------------ */
if ( ! function_exists( 'alx_google_fonts' ) ) {

	function alx_google_fonts () {
		if ( ot_get_option('dynamic-styles') ) {
			if ( ot_get_option( 'font' ) == 'titillium-web-ext' ) { echo '<link href="http://fonts.googleapis.com/css?family=Titillium+Web:400,400italic,300italic,300,600&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( ot_get_option( 'font' ) == 'droid-serif' ) { echo '<link href="http://fonts.googleapis.com/css?family=Droid+Serif:400,400italic,700" rel="stylesheet" type="text/css">'. "\n"; }
			if ( ot_get_option( 'font' ) == 'source-sans-pro' ) { echo '<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300italic,300,400italic,600&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( ot_get_option( 'font' ) == 'lato' ) { echo '<link href="http://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700" rel="stylesheet" type="text/css">'. "\n"; }
			if ( ot_get_option( 'font' ) == 'ubuntu' ) { echo '<link href="http://fonts.googleapis.com/css?family=Ubuntu:400,400italic,300italic,300,700&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( ot_get_option( 'font' ) == 'roboto-condensed' ) { echo '<link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300italic,300,400italic,700&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( ot_get_option( 'font' ) == 'roboto-condensed-cyr' ) { echo '<link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300italic,300,400italic,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( ot_get_option( 'font' ) == 'open-sans' ) { echo '<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,300italic,300,600&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( ot_get_option( 'font' ) == 'open-sans-cyr' ) { echo '<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,300italic,300,600&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">'. "\n"; }
		}
	}
	
}
add_action( 'wp_head', 'alx_google_fonts', 2 );


/*  Dynamic css output
/* ------------------------------------ */
if ( ! function_exists( 'alx_dynamic_css' ) ) {

	function alx_dynamic_css() {
		if ( ot_get_option('dynamic-styles') ) {
		
			// rgb values
			$color_1 = ot_get_option('color-1');
			$color_1_rgb = alx_hex2rgb($color_1);
			
			// start output
			$styles = '<style type="text/css">'."\n";
			$styles .= '/* Dynamic CSS: For no styles in head, copy and put the css below in your custom.css or child theme\'s style.css, disable dynamic styles */'."\n";		
			
			// google fonts
			if ( ot_get_option( 'font' ) == 'titillium-web' ) { $styles .= 'body, input, textarea, button, select, label { font-family: "Titillium Web", Arial, sans-serif; }'."\n"; }
			if ( ot_get_option( 'font' ) == 'droid-serif' ) { $styles .= 'body, input, textarea, button, select, label { font-family: "Droid Serif", sans-serif; }'."\n"; }
			if ( ot_get_option( 'font' ) == 'source-sans-pro' ) { $styles .= 'body, input, textarea, button, select, label { font-family: "Source Sans Pro", Arial, sans-serif; }'."\n"; }
			if ( ot_get_option( 'font' ) == 'lato' ) { $styles .= 'body, input, textarea, button, select, label { font-family: "Lato", Arial, sans-serif; }'."\n"; }
			if ( ot_get_option( 'font' ) == 'ubuntu' ) { $styles .= 'body, input, textarea, button, select, label { font-family: "Ubuntu", Arial, sans-serif; }'."\n"; }	
			if ( ( ot_get_option( 'font' ) == 'roboto-condensed' ) || ( ot_get_option( 'font' ) == 'roboto-condensed-cyr' ) ) { $styles .= 'body, input, textarea, button, select, label { font-family: "Roboto Condensed", Arial, sans-serif; }'."\n"; }			
			if ( ( ot_get_option( 'font' ) == 'open-sans' ) || ( ot_get_option( 'font' ) == 'open-sans-cyr' ) )	{ $styles .= 'body, input, textarea, button, select, label { font-family: "Open Sans", Arial, sans-serif; }'."\n"; }
			if ( ot_get_option( 'font' ) == 'arial' ) { $styles .= 'body, input, textarea, button, select, label { font-family: Arial, sans-serif; }'."\n"; }
			if ( ot_get_option( 'font' ) == 'georgia' ) { $styles .= 'body, input, textarea, button, select, label { font-family: Georgia, serif; }'."\n"; }
			
			// container width
			if ( ot_get_option('container-width') != '1380' ) {			
				if ( ot_get_option( 'boxed' ) ) { 
					$styles .= '.boxed #wrapper, .container { max-width: '.ot_get_option('container-width').'px; }'."\n";
				}
				else {
					$styles .= '.container { max-width: '.ot_get_option('container-width').'px; }'."\n";
				}
			}
			// primary accent color
			if ( ot_get_option('color-1') != '#e8554e' ) {
				$styles .= '
::selection { background-color: '.ot_get_option('color-accent').'; }
::-moz-selection { background-color: '.ot_get_option('color-accent').'; }

a,
.themeform label .required,
.post-title a:hover,
.post-meta a:hover,
.author-bio .bio-name a:hover,
.post-nav li a:hover span,
.post-nav li a:hover i,
.widget_rss ul li a,
.widget_calendar a,
.alx-tab .tab-item-category a,
.alx-posts .post-item-category a,
.alx-tab li:hover .tab-item-title a,
.alx-tab li:hover .tab-item-comment a,
.alx-posts li:hover .post-item-title a,
#footer .widget_rss ul li a,
#footer .widget_calendar a,
#footer .alx-tab .tab-item-category a,
#footer .alx-posts .post-item-category a,
.comment-tabs li.active a,
.comment-awaiting-moderation,
.child-menu a:hover,
.child-menu .current_page_item > a,
.wp-pagenavi a { color: '.ot_get_option('color-accent').'; }

.themeform input[type="submit"],
.themeform button[type="submit"],
.s1 .sidebar-toggle,
.more-link,
.post-tags a:hover,
.author-bio .bio-avatar:after,
.widget_calendar caption,
.commentlist li.bypostauthor > .comment-body:after { background-color: '.ot_get_option('color-accent').'; }

.alx-tabs-nav li.active a,
.wp-pagenavi a:hover,
.wp-pagenavi a:active,
.wp-pagenavi span.current { border-bottom-color: '.ot_get_option('color-accent').'!important; }

.themeform input[type="text"]:focus, 
.themeform input[type="password"]:focus, 
.themeform input[type="email"]:focus, 
.themeform textarea:focus,
.comment-tabs li.active a { border-color: '.ot_get_option('color-accent').'; }		
				'."\n";
			}		
			// topbar color
			if ( ot_get_option('color-topbar') != '#222222' ) {
				$styles .= '
.search-expand,
#nav-topbar.nav-container { background-color: '.ot_get_option('color-topbar').'; }
@media only screen and (min-width: 720px) {
	#nav-topbar .nav ul { background-color: '.ot_get_option('color-topbar').'; }
}			
				'."\n";
			}
			// header color
			if ( ot_get_option('color-header') != '#f2f2f2' ) {
				$styles .= '#header, .boxed #header { background-color: '.ot_get_option('color-header').'; }'."\n";
			}
			// footer color
			if ( ot_get_option('color-footer') != '#222222' ) {
				$styles .= '#footer-bottom { background-color: '.ot_get_option('color-footer').'; }'."\n";
			}
			// footer toplink color
			if ( ot_get_option('color-footer-toplink') != '#333333' ) {
				$styles .= '
#footer-bottom #back-to-top { background: '.ot_get_option('color-footer-toplink').'; }
#footer-bottom #back-to-top:before,
#footer-bottom #back-to-top:after { border-color: '.ot_get_option('color-footer-toplink').' transparent; }
#footer-bottom { border-color: '.ot_get_option('color-footer-toplink').'; }
				'."\n";
			}
			// header logo max-height
			if ( ot_get_option('logo-max-height') != '80' ) {
				$styles .= '
.site-title a img { max-height: '.ot_get_option('logo-max-height').'px; }
.site-description { line-height: '.ot_get_option('logo-max-height').'px; }
				'."\n";
			}
			// format audio
			if ( ot_get_option('color-audio') != '#69bac8' ) {
				$styles .= '
.format-audio .hex,
.format-audio .post-deco,
.jp-play-bar,
.jp-volume-bar-value { background-color: '.ot_get_option('color-audio').'; }
				'."\n";
			}
			// format chat
			if ( ot_get_option('color-chat') != '#69bac8' ) {
				$styles .= '
.format-chat .hex,
.format-chat .post-deco { background-color: '.ot_get_option('color-chat').'; }
.format-chat .format-container { background: '.ot_get_option('color-chat').' url('.get_template_directory_uri().'/img/styling/opacity-75-light.png) repeat; }
				'."\n";
			}
			// format gallery
			if ( ot_get_option('color-gallery') != '#7eb66f' ) {
				$styles .= '
.format-gallery .hex,
.format-gallery .post-deco { background-color: '.ot_get_option('color-gallery').'; }
				'."\n";
			}
			// format image
			if ( ot_get_option('color-image') != '#7eb66f' ) {
				$styles .= '
.format-image .hex,
.format-image .post-deco { background-color: '.ot_get_option('color-image').'; }
				'."\n";
			}
			// format link
			if ( ot_get_option('color-link') != '#e8554e' ) {
				$styles .= '
.format-link .hex,
.format-link .post-deco { background-color: '.ot_get_option('color-link').'; }
.format-link .post-format a { color: '.ot_get_option('color-link').'!important; }
.format-link .format-container { background: '.ot_get_option('color-link').' url('.get_template_directory_uri().'/img/styling/opacity-75-light.png) repeat; }
				'."\n";
			}
			// format quote
			if ( ot_get_option('color-quote') != '#e7ba3a' ) {
				$styles .= '
.format-quote .hex,
.format-quote .post-deco { background-color: '.ot_get_option('color-quote').'; }
.format-quote .format-container { background: '.ot_get_option('color-quote').' url('.get_template_directory_uri().'/img/styling/opacity-75-light.png) repeat; }
				'."\n";
			}
			// format status
			if ( ot_get_option('color-status') != '#ffa500' ) {
				$styles .= '
.format-status .hex,
.format-status .post-deco { background-color: '.ot_get_option('color-status').'; }
				'."\n";
			}
			// format video
			if ( ot_get_option('color-video') != '#e8554e' ) {
				$styles .= '
.format-video .hex,
.format-video .post-deco { background-color: '.ot_get_option('color-video').'; }
				'."\n";
			}
			// body background
			if ( ot_get_option('body-background') != '' ) {
				
				$body_background = ot_get_option('body-background');
				$body_color = $body_background['background-color'];
				$body_image = $body_background['background-image'];
				$body_position = $body_background['background-position'];
				$body_attachment = $body_background['background-attachment'];
				$body_repeat = $body_background['background-repeat'];
				
				if ( $body_image ) {
					$styles .= 'body { background: '.$body_color.' url('.$body_image.') '.$body_attachment.' '.$body_position.' '.$body_repeat.'; }'."\n";
				} elseif ( $body_background['background-color'] ) {
					$styles .= 'body { background-color: '.$body_color.'; }'."\n";
				} else {
					$styles .= '';
				}
			}
			
			$styles .= '</style>'."\n";
			// end output
			
			echo $styles;		
		}
	}
	
}
add_action( 'wp_head', 'alx_dynamic_css', 100 );
