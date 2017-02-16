<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package web2feel
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header container" role="banner">
		<div class="row">
		<div class="site-branding col-sm-4">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			
		</div>
		
		<div class="col-sm-8 mainmenu">
		<div class="mobilenavi"></div>
				<?php wp_nav_menu( array( 'container_id' => 'submenu', 'theme_location' => 'primary','container_class' => 'topmenu','menu_id'=>'topmenu' ,'menu_class'=>'sfmenu' ) ); ?>
		</div>
		
		</div> <!-- end row -->
	</header><!-- #masthead -->
	
	
	<?php if( is_page_template('homepage.php') ){ get_template_part( 'inc/feature' ); } ?>

	<div id="content" class="site-content ">
	