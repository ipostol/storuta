<?php
/*
	AlxPosts Widget
	
	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html
	
	Copyright: (c) 2013 Alexander "Alx" Agnarson - http://alxmedia.se
	
		@package AlxPosts
		@version 1.0
*/

class AlxPosts extends WP_Widget {

/*  Constructor
/* ------------------------------------ */
	function AlxPosts() {
		parent::__construct( false, 'AlxPosts', array('description' => 'Показывает записи и категории', 'classname' => 'widget_alx_posts') );;	
	}
	
/*  Widget
/* ------------------------------------ */
	public function widget($args, $instance) {
		extract( $args );
		$instance['title']?NULL:$instance['title']='';
		$title = apply_filters('widget_title',$instance['title']);
		$output = $before_widget."\n";
		if($title)
			$output .= $before_title.$title.$after_title;
		ob_start();
	
?>

	<?php
		$posts = new WP_Query( array(
			'post_type'				=> array( 'post' ),
			'showposts'				=> $instance['posts_num'],
			'cat'					=> $instance['posts_cat_id'],
			'ignore_sticky_posts'	=> true,
			'orderby'				=> $instance['posts_orderby'],
			'order'					=> 'dsc',
			'date_query' => array(
				array(
					'after' => $instance['posts_time'],
				),
			),
		) );
	?>
		
	<ul class="alx-posts group <?php if($instance['posts_thumb']) { echo 'thumbs-enabled'; } ?>">
		<?php while ($posts->have_posts()): $posts->the_post(); ?>
		<li>
			
			<?php if($instance['posts_thumb']) { // Thumbnails enabled? ?>
			<div class="post-item-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php if ( has_post_thumbnail() ): ?>
						<?php the_post_thumbnail('thumb-medium'); ?>
					<?php else: ?>
						<img src="<?php echo get_template_directory_uri(); ?>/img/thumb-medium.png" alt="<?php the_title(); ?>" />
					<?php endif; ?>
					<?php if ( has_post_format('video') && !is_sticky() ) echo'<span class="thumb-icon"><i class="fa fa-play"></i></span>'; ?>
					<?php if ( has_post_format('audio') && !is_sticky() ) echo'<span class="thumb-icon"><i class="fa fa-headphones"></i></span>'; ?>
					<?php if ( is_sticky() ) echo'<span class="thumb-icon"><i class="fa fa-star"></i></span>'; ?>
				</a>
			</div>
			<?php } ?>
			
			<div class="post-item-inner group">
				<?php if($instance['posts_category']) { ?><p class="post-item-category"><?php the_category(' / '); ?></p><?php } ?>
				<p class="post-item-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
				<?php if($instance['posts_date']) { ?><p class="post-item-date"><?php the_time('j M, Y'); ?></p><?php } ?>
			</div>
			
		</li>
		<?php endwhile; ?>
	</ul><!--/.alx-posts-->

<?php
		$output .= ob_get_clean();
		$output .= $after_widget."\n";
		echo $output;
	}
	
/*  Widget update
/* ------------------------------------ */
	public function update($new,$old) {
		$instance = $old;
		$instance['title'] = strip_tags($new['title']);
	// Posts
		$instance['posts_thumb'] = $new['posts_thumb']?1:0;
		$instance['posts_category'] = $new['posts_category']?1:0;
		$instance['posts_date'] = $new['posts_date']?1:0;
		$instance['posts_num'] = strip_tags($new['posts_num']);
		$instance['posts_cat_id'] = strip_tags($new['posts_cat_id']);
		$instance['posts_orderby'] = strip_tags($new['posts_orderby']);
		$instance['posts_time'] = strip_tags($new['posts_time']);
		return $instance;
	}

/*  Widget form
/* ------------------------------------ */
	public function form($instance) {
		// Default widget settings
		$defaults = array(
			'title' 			=> '',
		// Posts
			'posts_thumb' 		=> 1,
			'posts_category'	=> 1,
			'posts_date'		=> 1,
			'posts_num' 		=> '4',
			'posts_cat_id' 		=> '0',
			'posts_orderby' 	=> 'date',
			'posts_time' 		=> '0',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
?>

	<style>
	.widget .widget-inside .alx-options-posts .postform { width: 100%; }
	.widget .widget-inside .alx-options-posts p { margin-bottom: 0.3em; }
	.widget .widget-inside .alx-options-posts hr { border: none; border-bottom: 2px solid #ddd; margin: 1em 0; }
	.widget .widget-inside .alx-options-posts h4 { margin-bottom:0.665em; }
	</style>
	
	<div class="alx-options-posts">
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Заголовок:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
		</p>
		
		<hr>
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('posts_category'); ?>" name="<?php echo $this->get_field_name('posts_category'); ?>" <?php checked( (bool) $instance["posts_category"], true ); ?>>
			<label for="<?php echo $this->get_field_id('posts_category'); ?>">Показать категории</label>
		</p>
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('posts_date'); ?>" name="<?php echo $this->get_field_name('posts_date'); ?>" <?php checked( (bool) $instance["posts_date"], true ); ?>>
			<label for="<?php echo $this->get_field_id('posts_date'); ?>">Показывать дату</label>
		</p>

		<hr>
		<h4>List Posts</h4>
		
		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('posts_thumb'); ?>" name="<?php echo $this->get_field_name('posts_thumb'); ?>" <?php checked( (bool) $instance["posts_thumb"], true ); ?>>
			<label for="<?php echo $this->get_field_id('posts_thumb'); ?>">Показывать миниатюру</label>
		</p>	
		<p>
			<label style="width: 55%; display: inline-block;" for="<?php echo $this->get_field_id("posts_num"); ?>">Количество записей</label>
			<input style="width:20%;" id="<?php echo $this->get_field_id("posts_num"); ?>" name="<?php echo $this->get_field_name("posts_num"); ?>" type="text" value="<?php echo absint($instance["posts_num"]); ?>" size='3' />
		</p>
		<p>
			<label style="width: 100%; display: inline-block;" for="<?php echo $this->get_field_id("posts_cat_id"); ?>">Категория:</label>
			<?php wp_dropdown_categories( array( 'name' => $this->get_field_name("posts_cat_id"), 'selected' => $instance["posts_cat_id"], 'show_option_all' => 'All', 'show_count' => true ) ); ?>		
		</p>
		<p style="padding-top: 0.3em;">
			<label style="width: 100%; display: inline-block;" for="<?php echo $this->get_field_id("posts_orderby"); ?>">Сортировать по:</label>
			<select style="width: 100%;" id="<?php echo $this->get_field_id("posts_orderby"); ?>" name="<?php echo $this->get_field_name("posts_orderby"); ?>">
			  <option value="date"<?php selected( $instance["posts_orderby"], "date" ); ?>>Последнее</option>
			  <option value="comment_count"<?php selected( $instance["posts_orderby"], "comment_count" ); ?>>Комментируемое</option>
			  <option value="rand"<?php selected( $instance["posts_orderby"], "rand" ); ?>>Случайно</option>
			</select>	
		</p>
		<p style="padding-top: 0.3em;">
			<label style="width: 100%; display: inline-block;" for="<?php echo $this->get_field_id("posts_time"); ?>">Записи за:</label>
			<select style="width: 100%;" id="<?php echo $this->get_field_id("posts_time"); ?>" name="<?php echo $this->get_field_name("posts_time"); ?>">
			  <option value="0"<?php selected( $instance["posts_time"], "0" ); ?>>Все время</option>
			  <option value="1 year ago"<?php selected( $instance["posts_time"], "1 year ago" ); ?>>Год</option>
			  <option value="1 month ago"<?php selected( $instance["posts_time"], "1 month ago" ); ?>>Месяц</option>
			  <option value="1 week ago"<?php selected( $instance["posts_time"], "1 week ago" ); ?>>Неделя</option>
			  <option value="1 day ago"<?php selected( $instance["posts_time"], "1 day ago" ); ?>>24 часа</option>
			</select>	
		</p>

	</div>
<?php

}

}

/*  Register widget
/* ------------------------------------ */
if ( ! function_exists( 'alx_register_widget_posts' ) ) {

	function alx_register_widget_posts() { 
		register_widget( 'AlxPosts' );
	}
	
}
add_action( 'widgets_init', 'alx_register_widget_posts' );
