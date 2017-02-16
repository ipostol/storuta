<?php get_header(); ?>

<section class="content">

	<div class="pad group">
	
		<?php get_template_part('inc/page-title'); ?>
		
		<?php if ( !have_posts() ) : ?>
		<div class="entry">				
			<p><?php _e( 'Sorry, no posts matched your criteria. Try again with some other terms.', 'anew' ); ?></p>
		</div><!--/.entry-->
		<?php endif; ?>	
		
		<?php if ( have_posts() ) : ?>
			
			<?php while ( have_posts() ): the_post(); ?>
				<?php get_template_part('content'); ?>		
			<?php endwhile; ?>
			
			<?php get_template_part('inc/pagination'); ?>
			
		<?php endif; ?>	
	</div><!--/.pad-->
	
</section><!--/.content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>