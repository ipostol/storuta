<!DOCTYPE html> 
<html class="no-js" <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php wp_title(''); ?></title>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="wrapper">

	<header id="header">
	
		<?php if (has_nav_menu('topbar')): ?>
			<nav class="nav-container group" id="nav-topbar">
				<div class="nav-toggle"><i class="fa fa-bars"></i></div>
				<div class="nav-text"><!-- put your mobile menu text here --></div>
				<div class="nav-wrap container"><?php wp_nav_menu(array('theme_location'=>'topbar','menu_class'=>'nav container-inner group','container'=>'','menu_id' => '','fallback_cb'=> false)); ?></div>
				
				<!--<div class="container">	
					<div class="toggle-search"><i class="fa fa-search"></i></div>
					<div class="search-expand">
						<div class="search-expand-inner">
							<?php get_search_form(); ?>
						</div>
					</div>
				</div><!--/.container-->
				
			</nav><!--/#nav-topbar-->
		<?php endif; ?>
		
		<div class="container">
			<?php if ( ot_get_option('header-image') == '' ): ?>
			<div class="pad group">
				<?php echo alx_site_title(); ?>
				<?php if ( !ot_get_option('site-description') ): ?><p class="site-description"><?php bloginfo( 'description' ); ?></p><?php endif; ?>
				<?php alx_social_links() ; ?>
			</div>
			<?php endif; ?>
			<?php if ( ot_get_option('header-image') ): ?>
				<a href="<?php echo home_url('/'); ?>" rel="home">
					<img class="site-image" src="<?php echo ot_get_option('header-image'); ?>" alt="<?php get_bloginfo('name'); ?>">
				</a>
			<?php endif; ?>
		</div><!--/.container-->
		
	</header><!--/#header-->
	
	<div id="page" class="container">
		<div class="main group">