<?php get_header(); ?>
<?php $format = get_post_format(); ?>

<section class="content">
	
	<div class="pad group">			
	
	<?php while ( have_posts() ): the_post(); ?>
	
		<article <?php post_class(); ?>>
		
			<h1 class="post-title pad"><?php the_title(); ?></a></h1>
			
			<ul class="post-meta pad group">
				<li><?php the_category(' / '); ?></li>
				<li><i class="fa fa-clock-o"></i><?php the_time('j M, Y'); ?></li>
				<li><a href="<?php comments_link(); ?>"><i class="fa fa-comment"></i><?php comments_number( '0', '1', '%' ); ?></a></li>
			</ul>
			
			<div class="post-inner">
				
				<?php get_template_part('inc/post-formats'); ?>
				
				<div class="post-deco">
					<div class="hex hex-small">
						<div class="hex-inner"><i class="fa"></i></div>
						<?php if ( $format != false ) :?><a href="<?php echo get_post_format_link($format); ?>"></a><?php endif; ?>
						<div class="corner-1"></div>
						<div class="corner-2"></div>
					</div>
				</div>
				
				<div class="post-content pad">
				
					<div class="entry">
						<?php the_content(); ?>
						<?php wp_link_pages(array('before'=>'<div class="post-pages">'.__('Pages:','anew'),'after'=>'</div>')); ?>
					</div><!--/.entry-->
					
					<?php the_tags('<p class="post-tags"><span>'.__('Tags:','anew').'</span> ','','</p>'); ?>
					
				</div><!--/.post-content-->
				<?php if ( !ot_get_option('sharrre') ) { get_template_part('inc/sharrre'); } ?>
				
			</div><!--/.post-inner-->
			
		</article><!--/.post-->			
	<?php endwhile; ?>
		
	<?php if ( !ot_get_option( 'author-bio' ) && get_the_author_meta( 'description' ) ): // authorbio ?>
		<div class="author-bio">
			<div class="bio-avatar"><?php echo get_avatar(get_the_author_meta('user_email'),'128'); ?></div>
			<p class="bio-name"><?php the_author_posts_link(); ?></p>
			<p class="bio-desc"><?php the_author_meta('description'); ?></p>
			<div class="clear"></div>
		</div>
	<?php endif; ?>
	
	<?php if ( ot_get_option( 'post-nav' ) == 'content') { get_template_part('inc/post-nav'); } ?>
	
	<?php if ( ot_get_option( 'related-posts' ) != '1' ) { get_template_part('inc/related-posts'); } ?>
	
	<?php comments_template('/comments.php',true); ?>
	
	</div><!--/.pad-->
	
</section><!--/.content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>