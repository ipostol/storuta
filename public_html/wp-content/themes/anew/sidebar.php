<?php 
	$sidebar = alx_sidebar_primary();
	$layout = alx_layout_class();
	if ( $layout != 'col-1c'):
?>

	<div class="sidebar s1">
		
		<a class="sidebar-toggle" title="<?php _e('Expand Sidebar','anew'); ?>"><i class="fa icon-sidebar-toggle"></i></a>
		
		<div class="sidebar-content">
				
			<?php if( is_page_template('page-templates/child-menu.php') ): ?>
			<ul class="child-menu group">
				<?php wp_list_pages('title_li=&sort_column=menu_order&depth=3'); ?>
			</ul>
			<?php endif; ?>
			
			<?php dynamic_sidebar($sidebar); ?>
			
		</div><!--/.sidebar-content-->
		
	</div><!--/.sidebar-->
	
<?php endif; ?>