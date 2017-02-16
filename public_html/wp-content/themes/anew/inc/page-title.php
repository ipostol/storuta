<?php $format = get_post_format(); ?>
<div class="page-title pad">

	<?php if ( is_search() ): ?>
		<h1>
			<?php if ( have_posts() ): ?><i class="fa fa-search"></i><?php endif; ?>
			<?php if ( !have_posts() ): ?><i class="fa fa-exclamation-circle"></i><?php endif; ?>
			<?php $search_count = 0; $search = new WP_Query("s=$s & showposts=-1"); if($search->have_posts()) : while($search->have_posts()) : $search->the_post(); $search_count++; endwhile; endif; echo $search_count;?> 
			<?php _e('Results','anew'); ?> <span><?php _e('for','anew'); ?> "<?php echo get_search_query(); ?>"</span>
		</h1>
		<?php get_search_form(); ?>
			
	<?php elseif ( is_404() ): ?>
		<h1><i class="fa fa-exclamation-circle"></i><?php _e('Error 404.','anew'); ?> <span><?php _e('Page not found!','anew'); ?></span></h1>
		<?php get_search_form(); ?>
		
	<?php elseif ( is_author() ): ?>
		<?php $author = get_userdata( get_query_var('author') );?>
		<h1><i class="fa fa-user"></i><?php _e('Author:','anew'); ?> <span><?php echo $author->display_name;?></span></h1>
		
	<?php elseif ( is_category() ): ?>
		<h1><i class="fa fa-folder-open"></i><?php _e('Category:','anew'); ?> <span><?php echo single_cat_title('', false); ?></span></h1>
		<?php if ((category_description() != '') && !is_paged()) : ?>
			<div class="category-description">
				<?php echo category_description(); ?>
			</div>
		<?php endif; ?>

	<?php elseif ( is_tag() ): ?>
		<h1><i class="fa fa-tags"></i><?php _e('Tagged:','anew'); ?> <span><?php echo single_tag_title('', false); ?></span></h1>
		
	<?php elseif ( is_day() ): ?>
		<h1><i class="fa fa-calendar"></i><?php _e('Daily Archive:','anew'); ?> <span><?php echo get_the_time('F j, Y'); ?></span></h1>
		
	<?php elseif ( is_month() ): ?>
		<h1><i class="fa fa-calendar"></i><?php _e('Monthly Archive:','anew'); ?> <span><?php echo get_the_time('F Y'); ?></span></h1>
			
	<?php elseif ( is_year() ): ?>
		<h1><i class="fa fa-calendar"></i><?php _e('Yearly Archive:','anew'); ?> <span><?php echo get_the_time('Y'); ?></span></h1>
	
		<?php elseif ( has_post_format('audio') ): ?>
			<h1><i class="fa fa-headphones"></i><?php _e('Type:','anew'); ?> <span><?php _e('Audio','anew'); ?></span></h1>
		<?php elseif ( has_post_format('aside') ): ?>
			<h1><i class="fa fa-pen"></i><?php _e('Type:','anew'); ?> <span><?php _e('Aside','anew'); ?></span></h1>
		<?php elseif ( has_post_format('chat') ): ?>
			<h1><i class="fa fa-comments-o"></i><?php _e('Type:','anew'); ?> <span><?php _e('Chat','anew'); ?></span></h1>
		<?php elseif ( has_post_format('gallery') ): ?>
			<h1><i class="fa fa-picture-o"></i><?php _e('Type:','anew'); ?> <span><?php _e('Gallery','anew'); ?></span></h1>
		<?php elseif ( has_post_format('image') ): ?>
			<h1><i class="fa fa-camera"></i><?php _e('Type:','anew'); ?> <span><?php _e('Image','anew'); ?></span></h1>
		<?php elseif ( has_post_format('link') ): ?>
			<h1><i class="fa fa-link"></i><?php _e('Type:','anew'); ?> <span><?php _e('Link','anew'); ?></span></h1>
		<?php elseif ( has_post_format('quote') ): ?>
			<h1><i class="fa fa-quote-left"></i><?php _e('Type:','anew'); ?> <span><?php _e('Quote','anew'); ?></span></h1>
		<?php elseif ( has_post_format('status') ): ?>
			<h1><i class="fa fa-bullhorn"></i><?php _e('Type:','anew'); ?> <span><?php _e('Status','anew'); ?></span></h1>
		<?php elseif ( has_post_format('video') ): ?>
			<h1><i class="fa fa-video-camera"></i><?php _e('Type:','anew'); ?> <span><?php _e('Video','anew'); ?></span></h1>

	<?php endif; ?>

</div><!--/.page-title-->