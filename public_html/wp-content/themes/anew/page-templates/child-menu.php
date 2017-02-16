<?php
/*
Template Name: Child Menu
*/
?>
<?php get_header(); ?>

<section class="content">
	
	<div class="pad group">
		
		<?php while ( have_posts() ): the_post(); ?>
		
			<article <?php post_class('group'); ?>>
			
				<?php get_template_part('inc/page-image'); ?>
				
				<h1 class="page-title-single"><?php echo alx_page_title(); ?></h1>
				
				<div class="entry themeform">
					<?php the_content(); ?>
					<div class="clear"></div>
				</div><!--/.entry-->
				
			</article>
			
			<?php if ( ot_get_option('page-comments') != '' ) { comments_template('/comments.php',true); } ?>
			
		<?php endwhile; ?>
		
	</div><!--/.pad-->
	
</section><!--/.content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>