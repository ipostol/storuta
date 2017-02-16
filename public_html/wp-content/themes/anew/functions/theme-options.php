<?php

/*  Initialize the options before anything else. 
/* ------------------------------------ */
add_action( 'admin_init', 'custom_theme_options', 1 );


/*  Build the custom settings & update OptionTree.
/* ------------------------------------ */
function custom_theme_options() {
	
	// Get a copy of the saved settings array.
	$saved_settings = get_option( 'option_tree_settings', array() );

	// Custom settings array that will eventually be passed to the OptionTree Settings API Class.
	$custom_settings = array(

/*  Help pages
/* ------------------------------------ */	
	'contextual_help' => array(
      'content'       => array( 
        array(
          'id'        => 'general_help',
          'title'     => 'Documentation',
          'content'   => '
			<h1>Anew</h1>
			<p>Thanks for using this theme! First, a friendly warning: Please remember that the "Reset Options" button resets <strong>ALL</strong> options. That means, if you reset your styling options, all your custom sidebars and other settings will be reset as well.</p>
			<h3>Frequently Asked Questions</h3>
			<p><i>Q: Why are social sharing buttons missing Google Plus?</i> &mdash; A: You need to enable urlCurl on your server for G+ to work. Ask your webhost to do so. If you are unable to, you can disable the buttons and use any other plugin instead.</p>
			<p><i>Q: My old thumbnails have different sizes, why?</i> &mdash; A: Thumbnails uploaded before changing theme will not be automatically re-cropped. To fix this, you need to run the <a target="_blank" href="http://wordpress.org/plugins/regenerate-thumbnails/">Regenerate Thumbnails</a> plugin once.</p>
			<p><i>Q: I did not use featured images before and have many posts, what do I do?</i> &mdash; A: Use the <a target="_blank" href="http://wordpress.org/plugins/easy-add-thumbnail/">Easy Add Thumbnail</a> plugin to automatically make the first image uploaded to each post a featured image.</p>
			<p><i>Q: Why is my featured image not appearing on the single post page?</i> &mdash; A: You need to use the "Image" format option for it to show up, as not everyone wants to show the featured image at the top for the "Standard" post format.</p>
			<p><i>Q: My gallery format post shows images twice, why?</i> &mdash; A: This is because you insert a standard gallery into the post itself. This is not needed, as the gallery format post will auto-display attached images in the slider above.</p>
			<p><i>Q: My slider gallery includes images I only want to show in the content below</i> &mdash; A: The gallery format will always show all attached images. For it to not show up, go to Media > Add New and upload it there. Then go back to the post and add it.</p>
			<h3>Dynamic Styles</h3>
			<p>The dynamic styles will be added directly to the head of your theme. This is according to WordPress best practices, but if you do not want it printed out there, simply inspect the code of your page with the styling options set. Copy the CSS from head into your child theme\'s style.css file or this theme\'s custom.css (which you need to enable), and disable dynamic styling.</p>
			<h3>Theme Customization</h3>
			<p>When modifiying the theme you should always use a child theme, otherwise your customized files will be removed/overwritten when you update the theme. Download the sample child theme below and upload it via admin. Then activate your child theme and start customizing it!</p>
			<ul>
				<li>Read more how to use a child theme <a target="_blank" href="http://codex.wordpress.org/Child_Themes">here</a>.</li>
				<li>Download the Anew sample child theme <a href="https://github.com/AlxMedia/anew-child/archive/master.zip">here</a>.</li>
			</ul>
			<p>If you are <strong>not using a child theme</strong>, you must do this before each theme update:</p>
			<ol>
				<li>Backup your custom.css file if you have used it, it will be overwritten and needs to be re-added after the update.</li>
				<li>Backup your additional language files if you have created/modified any, they will be removed and need to be re-added after the update.</li>
				<li>Backup any other custom code.</li>
			</ol>
		'
        )
      )
    ),
	
/*  Admin panel sections
/* ------------------------------------ */	
	'sections'        => array(
		array(
			'id'		=> 'general',
			'title'		=> 'General'
		),
		array(
			'id'		=> 'blog',
			'title'		=> 'Blog'
		),
		array(
			'id'		=> 'header',
			'title'		=> 'Header'
		),
		array(
			'id'		=> 'footer',
			'title'		=> 'Footer'
		),
		array(
			'id'		=> 'layout',
			'title'		=> 'Layout'
		),
		array(
			'id'		=> 'sidebars',
			'title'		=> 'Sidebars'
		),
		array(
			'id'		=> 'social-links',
			'title'		=> 'Social Links'
		),
		array(
			'id'		=> 'styling',
			'title'		=> 'Styling'
		),
	),
	
/*  Theme options
/* ------------------------------------ */
	'settings'        => array(
		
		// General: Custom CSS
		array(
			'id'		=> 'custom',
			'label'		=> 'Пользовательские стили',
			'desc'		=> 'Load your custom styles [ <strong>custom.css</strong> ]<br /><i>Note: You must backup this file before a theme update. Consider using a <a target="_blank" href="http://codex.wordpress.org/Child_Themes">child theme</a> instead. A sample child theme is available in the help dropdown.</i>',
			'type'		=> 'checkbox',
			'section'	=> 'general',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => 'Включить'
				)
			)
		),
		// General: Responsive Layout
		array(
			'id'		=> 'responsive',
			'label'		=> 'Адаптивный дизайн',
			'desc'		=> 'Отключение адаптиного дизайна. (адаптируется под размеры экранов планшетов и смартфонов) [ <strong>responsive.css</strong> ]',
			'type'		=> 'checkbox',
			'section'	=> 'general',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => 'Отключить'
				)
			)
		),
		// General: Mobile Sidebar
		array(
			'id'		=> 'mobile-sidebar-hide',
			'label'		=> 'Отключение Sidebar на маленьких экранах',
			'desc'		=> 'Убирается Сайдбар на экранах с низким разрешением (320px)',
			'type'		=> 'checkbox',
			'section'	=> 'general',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => 'Уберать'
				)
			)
		),
		// General: Favicon
		array(
			'id'		=> 'favicon',
			'label'		=> 'Favicon',
			'desc'		=> 'Загрузить 16x16px Png/Gif изображение для favicon',
			'type'		=> 'upload',
			'section'	=> 'general'
		),
		// General: RSS Feed
		array(
			'id'		=> 'rss-feed',
			'label'		=> 'FeedBurner URL',
			'desc'		=> 'Введите ваш FeedBurner URL (or any other preferred feed URL) if you wish to use FeedBurner over the standard WordPress feed e.g. http://feeds.feedburner.com/yoururlhere ',
			'type'		=> 'text',
			'section'	=> 'general'
		),
		// General: Tracking Code
		array(
			'id'		=> 'tracking-code',
			'label'		=> 'Tracking Code',
			'desc'		=> 'Можно ввести код Google Analytics или Яндекс Метрики',
			'type'		=> 'textarea-simple',
			'section'	=> 'general',
			'rows'		=> '3'
		),
		// General: Comments
		array(
			'id'		=> 'page-comments',
			'label'		=> 'Комментарии',
			'desc'		=> '',
			'type'		=> 'checkbox',
			'section'	=> 'general',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => 'Включить комментарии на страницах',
					'std'	=> '1'
				)
			)
		),
		// Blog: Single - Content or Excerpt
		array(
			'id'		=> 'post-text',
			'label'		=> 'Вид обрезки текста',
			'desc'		=> 'Выбор способа обрезки текст, или при помощи функции More, или обрезать автоматически ',
			'std'		=> 'excerpt',
			'type'		=> 'radio',
			'section'	=> 'blog',
			'choices'	=> array(
				array( 
					'value' => 'excerpt',
					'label' => 'Через Выдержку'
				),
				array( 
					'value' => 'content',
					'label' => 'Через фнкцию more'
				)
			)
		),
		// Blog: Excerpt Length
		array(
			'id'			=> 'excerpt-length',
			'label'			=> 'Длина Выдержки',
			'desc'			=> 'Максимальное количество слов',
			'std'			=> '34',
			'type'			=> 'numeric-slider',
			'section'		=> 'blog',
			'min_max_step'	=> '0,100,1'
		),
		// Blog: Single - Sharrre
		array(
			'id'		=> 'sharrre',
			'label'		=> ' Кнопки социальных сетей на страницах с записями',
			'desc'		=> 'Отключение и включение',
			'type'		=> 'checkbox',
			'section'	=> 'blog',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => 'Отключить'
				)
			)
		),
		// Blog: Twitter Username
		array(
			'id'		=> 'twitter-username',
			'label'		=> 'Twitter Username',
			'desc'		=> 'Your @username will be added to share-tweets of your posts (optional)',
			'type'		=> 'text',
			'section'	=> 'blog'
		),
		// Blog: Single - Authorbox
		array(
			'id'		=> 'author-bio',
			'label'		=> 'Single &mdash; Author Bio',
			'desc'		=> 'Shows post author description, if it exists',
			'type'		=> 'checkbox',
			'section'	=> 'blog',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => 'Disable'
				)
			)
		),
		// Blog: Single - Post Navigation
		array(
			'id'		=> 'post-nav',
			'label'		=> 'Навигация на страницах с записями',
			'desc'		=> 'Показывает ссылки на следующие и предыдущие записи',
			'std'		=> 'content',
			'type'		=> 'radio',
			'section'	=> 'blog',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => 'Отключение'
				),
				array( 
					'value' => 'content',
					'label' => 'После текста'
				)
			)
		),
		// Header: Custom Logo
		array(
			'id'		=> 'custom-logo',
			'label'		=> 'Logo сайта',
			'desc'		=> 'Загрузите изображение логотипа.',
			'type'		=> 'upload',
			'section'	=> 'header'
		),
		// Header: Site Description
		array(
			'id'		=> 'site-description',
			'label'		=> 'Описание сайта',
			'desc'		=> 'Описание, которое появляется рядом с вашим логотипом',
			'type'		=> 'checkbox',
			'section'	=> 'header',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => 'Отключение'
				)
			)
		),
		// Header: Header Image
		array(
			'id'		=> 'header-image',
			'label'		=> 'Изображение в шапке',
			'desc'		=> 'Загрузите нужное изображение для сайта, это отключить логотип и описание',
			'type'		=> 'upload',
			'section'	=> 'header'
		),
		// Footer: Widget Columns
		array(
			'id'		=> 'footer-widgets',
			'label'		=> 'Подвал количество виджетов-колонок',
			'desc'		=> 'Выберите нужное количество, рекомендуется 3.',
			'std'		=> '0',
			'type'		=> 'radio-image',
			'section'	=> 'footer',
			'class'		=> '',
			'choices'	=> array(
				array(
					'value'		=> '0',
					'label'		=> 'Disable',
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> '1',
					'label'		=> '1 Column',
					'src'		=> get_template_directory_uri() . '/functions/images/footer-widgets-1.png'
				),
				array(
					'value'		=> '2',
					'label'		=> '2 Columns',
					'src'		=> get_template_directory_uri() . '/functions/images/footer-widgets-2.png'
				),
				array(
					'value'		=> '3',
					'label'		=> '3 Columns',
					'src'		=> get_template_directory_uri() . '/functions/images/footer-widgets-3.png'
				),
				array(
					'value'		=> '4',
					'label'		=> '4 Columns',
					'src'		=> get_template_directory_uri() . '/functions/images/footer-widgets-4.png'
				)
			)
		),
		// Footer: Custom Logo
		array(
			'id'		=> 'footer-logo',
			'label'		=> 'Logo в подвале',
			'desc'		=> 'Загрузите нужное изображение',
			'type'		=> 'upload',
			'section'	=> 'footer'
		),
		// Footer: Copyright
		array(
			'id'		=> 'copyright',
			'label'		=> 'Подвал Авторские права',
			'desc'		=> 'Введите нужный текст',
			'type'		=> 'text',
			'section'	=> 'footer'
		),
		// Footer: Credit
		array(
			'id'		=> 'credit',
			'label'		=> 'Footer Credit',
			'desc'		=> 'Отключает ссылки в подвале',
			'std'		=> '',
			'type'		=> 'checkbox',
			'section'	=> 'footer',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => 'Отключить'
				)
			)
		),
		// Layout : Global
		array(
			'id'		=> 'layout-global',
			'label'		=> 'Глобальное расположение',
			'desc'		=> 'По умолчанию',
			'std'		=> 'col-2cl',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'col-1c',
					'label'		=> '1 Column',
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> '2 Column Left',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> '2 Column Right',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				)
			)
		),
		// Layout : Home
		array(
			'id'		=> 'layout-home',
			'label'		=> 'Главная',
			'desc'		=> '[ <strong>is_home</strong> ] Posts homepage layout',
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> 'Inherit Global Layout',
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> '1 Column',
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> '2 Column Left',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> '2 Column Right',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				)
			)
		),
		// Layout : Single
		array(
			'id'		=> 'layout-single',
			'label'		=> 'Записи',
			'desc'		=> '[ <strong>is_single</strong> ] Single post layout - If a post has a set layout, it will override this.',
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> 'Inherit Global Layout',
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> '1 Column',
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> '2 Column Left',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> '2 Column Right',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				)
			)
		),
		// Layout : Archive
		array(
			'id'		=> 'layout-archive',
			'label'		=> 'Архивы',
			'desc'		=> '[ <strong>is_archive</strong> ] Category, date, tag and author archive layout',
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> 'Inherit Global Layout',
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> '1 Column',
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> '2 Column Left',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> '2 Column Right',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				)
			)
		),
		// Layout : Archive - Category
		array(
			'id'		=> 'layout-archive-category',
			'label'		=> 'Архивы &mdash; Категории',
			'desc'		=> '[ <strong>is_category</strong> ] Category archive layout',
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> 'Inherit Global Layout',
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> '1 Column',
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> '2 Column Left',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> '2 Column Right',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				)
			)
		),
		// Layout : Search
		array(
			'id'		=> 'layout-search',
			'label'		=> 'Поиск',
			'desc'		=> '[ <strong>is_search</strong> ] Search page layout',
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> 'Inherit Global Layout',
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> '1 Column',
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> '2 Column Left',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> '2 Column Right',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				)
			)
		),
		// Layout : Error 404
		array(
			'id'		=> 'layout-404',
			'label'		=> 'Ошибка 404',
			'desc'		=> '[ <strong>is_404</strong> ] Error 404 page layout',
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> 'Inherit Global Layout',
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> '1 Column',
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> '2 Column Left',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> '2 Column Right',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				)
			)
		),
		// Layout : Default Page
		array(
			'id'		=> 'layout-page',
			'label'		=> 'По умолчанию Страница',
			'desc'		=> '[ <strong>is_page</strong> ] Default page layout - If a page has a set layout, it will override this.',
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> 'Inherit Global Layout',
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> '1 Column',
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> '2 Column Left',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> '2 Column Right',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				)
			)
		),
		// Sidebars: Create Areas
		array(
			'id'		=> 'sidebar-areas',
			'label'		=> 'Создать Sidebars',
			'desc'		=> 'You must save changes for the new areas to appear below. <br /><i>Warning: Make sure each area has a unique ID.</i>',
			'type'		=> 'list-item',
			'section'	=> 'sidebars',
			'choices'	=> array(),
			'settings'	=> array(
				array(
					'id'		=> 'id',
					'label'		=> 'Sidebar ID',
					'desc'		=> 'This ID must be unique, for example "sidebar-about"',
					'std'		=> 'sidebar-',
					'type'		=> 'text',
					'choices'	=> array()
				)
			)
		),
		// Sidebar 1 & 2
		array(
			'id'		=> 's1-home',
			'label'		=> 'Home',
			'desc'		=> '[ <strong>is_home</strong> ]',
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-single',
			'label'		=> 'Single',
			'desc'		=> '[ <strong>is_single</strong> ] If a single post has a unique sidebar, it will override this.',
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-archive',
			'label'		=> 'Archive',
			'desc'		=> '[ <strong>is_archive</strong> ]',
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-archive-category',
			'label'		=> 'Archive &mdash; Category',
			'desc'		=> '[ <strong>is_category</strong> ]',
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-search',
			'label'		=> 'Search',
			'desc'		=> '[ <strong>is_search</strong> ]',
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-404',
			'label'		=> 'Error 404',
			'desc'		=> '[ <strong>is_404</strong> ]',
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-page',
			'label'		=> 'Default Page',
			'desc'		=> '[ <strong>is_page</strong> ] If a page has a unique sidebar, it will override this.',
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		// Social Links : List
		array(
			'id'		=> 'social-links',
			'label'		=> 'Социальные ссылки',
			'desc'		=> 'Создать социальную ссылку',
			'type'		=> 'list-item',
			'section'	=> 'social-links',
			'choices'	=> array(),
			'settings'	=> array(
				array(
					'id'		=> 'social-icon',
					'label'		=> 'Icon Name',
					'desc'		=> 'Font Awesome icon names [<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank"><strong>View all</strong>]</a>  ',
					'std'		=> 'fa-',
					'type'		=> 'text',
					'choices'	=> array()
				),
				array(
					'id'		=> 'social-link',
					'label'		=> 'Link',
					'desc'		=> 'Enter the full url for your icon button',
					'std'		=> 'http://',
					'type'		=> 'text',
					'choices'	=> array()
				),
				array(
					'id'		=> 'social-color',
					'label'		=> 'Icon Color',
					'desc'		=> 'Set a unique color for your icon (optional)',
					'std'		=> '',
					'type'		=> 'colorpicker',
					'section'	=> 'styling'
				),
				array(
					'id'		=> 'social-target',
					'label'		=> 'Link Options',
					'desc'		=> '',
					'std'		=> '',
					'type'		=> 'checkbox',
					'choices'	=> array(
						array( 
							'value' => '_blank',
							'label' => 'Open in new window'
						)
					)
				)
			)
		),
		// Styling: Enable
		array(
			'id'		=> 'dynamic-styles',
			'label'		=> 'Динамические стили',
			'desc'		=> 'Turn styling options on / off',
			'type'		=> 'checkbox',
			'section'	=> 'styling',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => 'Enable to use the options below'
				)
			)
		),
		// General: Boxed Layout
		array(
			'id'		=> 'boxed',
			'label'		=> 'Boxed Layout',
			'desc'		=> 'Use a boxed layout',
			'type'		=> 'checkbox',
			'section'	=> 'styling',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => 'Enable'
				)
			)
		),
		// Styling: Font
		array(
			'id'		=> 'font',
			'label'		=> 'Font',
			'desc'		=> 'Select font for the theme',
			'type'		=> 'select',
			'std'		=> '30',
			'section'	=> 'styling',
			'choices'	=> array(
				array( 
					'value' => 'lato',
					'label' => 'Lato, Latin (Self-hosted)'
				),
				array( 
					'value' => 'titillium-web',
					'label' => 'Titillium Web, Latin-Ext (Google Fonts)'
				),
				array( 
					'value' => 'droid-serif',
					'label' => 'Droid Serif, Latin (Google Fonts)'
				),
				array( 
					'value' => 'source-sans-pro',
					'label' => 'Source Sans Pro, Latin-Ext (Google Fonts)'
				),
				array( 
					'value' => 'ubuntu',
					'label' => 'Ubuntu, Latin-Ext (Google Fonts)'
				),
				array( 
					'value' => 'roboto-condensed',
					'label' => 'Roboto Condensed, Latin-Ext (Google Fonts)'
				),
				array( 
					'value' => 'roboto-condensed-cyr',
					'label' => 'Roboto Condensed, Latin / Cyrillic-Ext (Google Fonts)'
				),
				array( 
					'value' => 'open-sans',
					'label' => 'Open Sans, Latin-Ext (Google Fonts)'
				),
				array( 
					'value' => 'open-sans-cyr',
					'label' => 'Open Sans, Latin / Cyrillic-Ext (Google Fonts)'
				),
				array( 
					'value' => 'arial',
					'label' => 'Arial'
				),
				array( 
					'value' => 'georgia',
					'label' => 'Georgia'
				)
			)
		),
		// Styling: Container Width
		array(
			'id'			=> 'container-width',
			'label'			=> 'Website Max-width',
			'desc'			=> 'Max-width of the container. <br /><i>Note: For 680px media, 600px content (default) use <strong>1080px</strong> with sidebar active. If you use no sidebars anywhere, use <strong>740px</strong> (or more).</i>',
			'std'			=> '1080',
			'type'			=> 'numeric-slider',
			'section'		=> 'styling',
			'min_max_step'	=> '740,1600,1'
		),
		// Styling: Primary Color
		array(
			'id'		=> 'color-accent',
			'label'		=> 'Primary Accent Color',
			'desc'		=> '<i>Default: #e8554e</i>',
			'std'		=> '#e8554e',
			'type'		=> 'colorpicker',
			'section'	=> 'styling'
		),
		// Styling: Topbar Background
		array(
			'id'		=> 'color-topbar',
			'label'		=> 'Topbar Background',
			'desc'		=> '<i>Default: #222222</i>',
			'std'		=> '#222222',
			'type'		=> 'colorpicker',
			'section'	=> 'styling'
		),
		// Styling: Header Background
		array(
			'id'		=> 'color-header',
			'label'		=> 'Header Background',
			'desc'		=> '<i>Default: #f2f2f2</i>',
			'std'		=> '#f2f2f2',
			'type'		=> 'colorpicker',
			'section'	=> 'styling'
		),
		// Styling: Header Light Text
		array(
			'id'		=> 'light-header-text',
			'label'		=> 'Header Text Color',
			'desc'		=> '',
			'std'		=> '',
			'type'		=> 'checkbox',
			'section'	=> 'styling',
			'choices'	=> array(
				array( 
					'value' => '1',
					'label' => 'Use light header text'
				)
			)
		),
		// Styling: Footer Background
		array(
			'id'		=> 'color-footer',
			'label'		=> 'Footer Background',
			'desc'		=> '<i>Default: #222222</i>',
			'std'		=> '#222222',
			'type'		=> 'colorpicker',
			'section'	=> 'styling'
		),
		// Styling: Footer Toplink Color
		array(
			'id'		=> 'color-footer-toplink',
			'label'		=> 'Footer Toplink Color',
			'desc'		=> 'Suggestion - use the same color as your primary accent color<br /><i>Default: #333333</i>',
			'std'		=> '#333333',
			'type'		=> 'colorpicker',
			'section'	=> 'styling'
		),
		// Styling: Header Logo Max-height
		array(
			'id'			=> 'logo-max-height',
			'label'			=> 'Header Logo Image Max-height',
			'desc'			=> 'Your logo image should have the double height of this to be high resolution',
			'std'			=> '80',
			'type'			=> 'numeric-slider',
			'section'		=> 'styling',
			'min_max_step'	=> '40,200,1'
		),
			// Styling: Formats
			array(
				'id'		=> 'color-audio',
				'label'		=> 'Format: Audio',
				'desc'		=> '<i>Default: #69bac8</i>',
				'std'		=> '#69bac8',
				'type'		=> 'colorpicker',
				'section'	=> 'styling'
			),
			array(
				'id'		=> 'color-chat',
				'label'		=> 'Format: Chat',
				'desc'		=> '<i>Default: #69bac8</i>',
				'std'		=> '#69bac8',
				'type'		=> 'colorpicker',
				'section'	=> 'styling'
			),
			array(
				'id'		=> 'color-gallery',
				'label'		=> 'Format: Gallery',
				'desc'		=> '<i>Default: #7eb66f</i>',
				'std'		=> '#7eb66f',
				'type'		=> 'colorpicker',
				'section'	=> 'styling'
			),
			array(
				'id'		=> 'color-image',
				'label'		=> 'Format: Image',
				'desc'		=> '<i>Default: #7eb66f</i>',
				'std'		=> '#7eb66f',
				'type'		=> 'colorpicker',
				'section'	=> 'styling'
			),
			array(
				'id'		=> 'color-link',
				'label'		=> 'Format: Link',
				'desc'		=> '<i>Default: #e8554e</i>',
				'std'		=> '#e8554e',
				'type'		=> 'colorpicker',
				'section'	=> 'styling'
			),
			array(
				'id'		=> 'color-quote',
				'label'		=> 'Format: Quote',
				'desc'		=> '<i>Default: #e7ba3a</i>',
				'std'		=> '#e7ba3a',
				'type'		=> 'colorpicker',
				'section'	=> 'styling'
			),
			array(
				'id'		=> 'color-status',
				'label'		=> 'Format: Status',
				'desc'		=> '<i>Default: #ffa500</i>',
				'std'		=> '#ffa500',
				'type'		=> 'colorpicker',
				'section'	=> 'styling'
			),
			array(
				'id'		=> 'color-video',
				'label'		=> 'Format: Video',
				'desc'		=> '<i>Default: #e8554e</i>',
				'std'		=> '#e8554e',
				'type'		=> 'colorpicker',
				'section'	=> 'styling'
			),			
		// Styling: Body Background
		array(
			'id'		=> 'body-background',
			'label'		=> 'Body Background',
			'desc'		=> 'Set background color and/or upload your own background image',
			'type'		=> 'background',
			'section'	=> 'styling'
		)
	)
);

/*  Settings are not the same? Update the DB
/* ------------------------------------ */
	if ( $saved_settings !== $custom_settings ) {
		update_option( 'option_tree_settings', $custom_settings ); 
	} 
}
