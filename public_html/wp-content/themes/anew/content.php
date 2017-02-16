<?php $format = get_post_format(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('group'); ?>>	
	
	<h2 class="post-title pad">
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
	</h2><!--/.post-title-->
	
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
				<?php 
					if ( ot_get_option('post-text') == 'content' ) { the_content(); } 
					else the_excerpt();
				?>
			</div><!--/.entry-->
			
			<a class="more-link-custom" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><span><i><?php _e('More','anew'); ?></i></span></a>
			
		</div><!--/.post-content-->
	
	</div><!--/.post-inner-->
	
</article><!--/.post-->	