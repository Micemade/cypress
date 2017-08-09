<?php
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function as_meta_boxes( array $meta_boxes ) {
	
	global $cypress_woo_is_active;
	
	$prefix = 'as_';
	
	// general settings meta boxes:
	$general_fields = array(
		
		array(
			'name'	=> __('Hide post images in post archive','cypress'),
			'desc'	=> 'remove featured image OR images attached to post from archives (and taxonomy pages).',
			'id'	=> $prefix.'hide_featured_image',
			'type'  => 'checkbox',
		),
		array(
			'name'	=> __('Hide post title in archives','cypress'),
			'desc'	=> 'hide post title when post is listed in archives ( useful when using Image or Quote post formats, for example) ',
			'id'	=> $prefix.'hide_archive_titles',
			'type'	=> 'checkbox',
		),
		array(
			'name'	=> __('Hide page title','cypress'),
			'desc'  => __('applies only to pages not singular posts','cypress'),
			'id'    => $prefix.'hide_title',
			'type'  => 'checkbox',
		)
	
	);
	
	$meta_boxes[] = array(
		'title'		=> 'General settings',
		'pages'		=> array('post','page'),
		'fields'	=> $general_fields,
		'context'	=> 'side',
		'priority'	=> 'high'
	);
	
	
	
	// POST FORMAT MENU
	// add post format tabs menu first:
	$meta_boxes[] = array( 
		'title'		=> 'Post format tabs', 
		'fields'	=> array(),
		'pages'		=> array('page','post','portfolio'),
		'context'	=> 'normal',
		'priority'	=> 'high' 
	);
	
	// POST FORMAT meta boxes - gallery:
	$format_gallery_fields = array(
		
		array(
			'name'			=> __('Upload images','cypress'), 
			'id'			=> $prefix.'gallery_images',
			'type'			=> 'image',
			'repeatable'	=> true,
			'sortable'		=> true,
			'show_size' 	=> true 
		),
		array(
			'name'		=> __('Gallery image format','cypress'),
			'desc'		=> __('choose the format for image display in gallery.','cypress'),
			'id'		=> $prefix.'gall_image_format',
			'type'		=> 'select',
			'options'	=> array(
				
				'thumbnail'		=> __('Thumbnail','cypress'),
				'medium'		=> __('Medium','cypress'),
				'as-portrait'	=> __('Cypress portrait','cypress'),
				'as-landscape'	=> __('Cypress landscape','cypress'),
				'large'			=> __('Large','cypress')
			),
			'default'		=> 'as-portrait',
			'cols'			=> 4

		),
		array(
			'name'		=> __('Slider of images or thumbnails ?','cypress'),
			'id'		=> $prefix . 'slider_thumbs',
			'type'		=> 'radio',
			'options'	=> array(			
				'slider'		=> 'Slider',
				'thumbnails'	=> 'Thumbnails', 
			),
			'default'	=> 'slider',
			'cols'		=> 4
		),

		array(
			'name'		=> __('Thumbnails columns (if there are more then one attached image)','cypress'),
			'desc'		=> __('type in the number of thumbnails in a row. If left empty, the default number of <strong>3</strong> will be set','cypress'),
			'id'		=> $prefix . 'thumb_columns',
			'type'		=> 'text_small',
			'default'	=> '3',
			'cols'		=> 4
		),
		
		array(
			'name'		=> __('Slider navigation','cypress'),
			'desc'		=> __('add previous/next arrows (appear on hover)','cypress'),
			'id'		=> $prefix . 'slider_nav',
			'type'		=> 'checkbox',
			'cols'		=> 3
		),
		
		array(
			'name'		=> __('Slider pagination','cypress'),
			'desc'		=> __('add previous/next arrows (appear on hover)','cypress'),
			'id'		=> $prefix . 'slider_pagin',
			'type'		=> 'checkbox',
			'cols'		=> 3
		),
		array(
			'name'		=> __('Slider timing','cypress'),
			'desc'		=> __('interval between slide transitions ( in milliseconds )','cypress'),
			'id'		=> $prefix . 'slider_timer',
			'type'		=> 'text_small',
			'default'	=> '5000',
			'cols'		=> 3
		),
		array(
			'name'		=> __('Slider transition effect','cypress'),
			'desc'		=> __('choose the slider transition effect','cypress'),
			'id'		=> $prefix . 'slider_trans',
			'type'		=> 'select',
			'options'	=> array(
				'none'		=> 'None',
				'fade'		=> 'Fade',
				'backSlide'	=> 'Back Slide',
				'goDown'	=> 'Go Down',
				'fadeUp'	=> 'Fade Up'
			),
			'cols'		=> 3,
			'allow_none'=> false, 
			'sortable'	=> false, 
			'repeatable'=> false
		),
		
	);
	
	$meta_boxes[] = array(
		'title'		=> 'Gallery settings',
		'pages'		=> array('post','portfolio'),
		'fields'	=> $format_gallery_fields,
		'context'	=> 'normal',
		'priority'	=> 'high'
	);
	
	
	
	// POST FORMAT meta boxes - AUDIO:
	$format_audio_fields = array(
		array( // Text Input
			'name'		=> __('Audio file','cypress'), 
			'id'		=> $prefix.'audio_file',
			'type'		=> 'file',
			'file_type' => 'audio',
			'desc'	=> 'upload the audio file',
		),
	);
	
	$meta_boxes[] = array(
		'title'		=> 'Audio settings',
		'pages'		=> array('post','portfolio'),
		'fields'	=> $format_audio_fields,
		'context'	=> 'normal',
		'priority'	=> 'high'
	);
	
	// POST FORMAT meta boxes - VIDEO:
	$format_video_fields = array(
		array(
			'name'		=> __('Video host site','cypress'),
			'desc'		=> __('choose the video host service site to fetch the video from (YouTube, Vimeo etc...)','cypress'),
			'id'		=> $prefix.'video_host',
			'type'		=> 'select',
			'options'	=> array(
				'youtube'		=> 'YouTube',
				'screenr'		=> 'Screenr',
				'vimeo'			=> 'Vimeo',
				'dailymotion'	=> 'DailyMotion',
				'yahoo'			=> 'Yahoo',
				'bliptv'		=> 'BlipTV',
				'veoh'			=> 'Veoh',
				'viddler'		=> 'Viddler',
			),
			'cols' => 6,
			'default'     => 'youtube',
		),
		array(
			'name'		=> __('Video ID','cypress'),
			'desc'		=> __('enter the video ID number or code, NOT the whole address','cypress'),
			'id'		=> $prefix.'video_id',
			'type'		=> 'text',
			'cols' => 6,
			'default'    => '',
		 ),
		 array(
			'name'		=> __('Width of the video','cypress'),
			'desc'		=> __('enter the width - allowed units: px, em, %','cypress'),
			'id'		=> $prefix.'video_width',
			'type'		=> 'text',
			'cols' => 6,
			'default'	=> '100%',
		 ),
		array(
			'name'		=> __('Height of the video','cypress'),
			'desc'		=> __('enter the height - allowed units: px, em, %','cypress'),
			'id'		=> $prefix.'video_height',
			'type'		=> 'text',
			'cols' => 6,
			'default'	 => '350px',
		),
		array(
			'name'		=> __('Featured image or video thumbnails','cypress'),
			'desc'		=> __('show post featured image or fetch thumbnail of video from video host service.<br /><strong>NOTE: some services do not provide high resolution image so it is advisable to use featured image. Supported: YouTube, Screenr, Vimeo, Daily Motion and BlipTV</strong>'),
			'id'		=> $prefix.'video_thumb',
			'type'		=> 'select',
			'options'	=> array(
				'featured'		=> __('Featured image','cypress'),
				'host_thumb'	=> __('Video host thumbnail','cypress')
			),
			'cols' => 12,
			'default'	=> 'three',
		),
	);
	$meta_boxes[] = array(
		'title'		=> 'Video settings',
		'pages'		=> array('post','portfolio'),
		'fields'	=> $format_video_fields,
		'context'	=> 'normal',
		'priority'	=> 'high'
	);
	
	
	// POST FORMAT meta boxes - QUOTE:
	$format_quote_fields = array(
		array(
			'name'	=> __('Quote author','cypress'), 
			'desc'	=> __('enter the name and/or title of quote author.','cypress'),
			'id'	=> $prefix.'quote_author',
			'type'	=> 'text',
		),

		array(
			'name'	=> __('Quote author URL','cypress'), 
			'desc'	=> __('Enter full URL including http:// .','cypress'),
			'id'	=> $prefix.'quote_author_url',
			'type'	=> 'url',
		),

		array(
			'name'	=> __('Avatar email for avatar image','cypress'), 
			'desc'	=> __('If quote author uses gravatar.com quote author avatar can be displayed. If set, it will override the featured image.','cypress'),
			'id'	=> $prefix.'avatar_email',
			'type'	=> 'text',
		),
	);
	$meta_boxes[] = array(
		'title'		=> 'Quote settings',
		'pages'		=> array('post'),
		'fields'	=> $format_quote_fields,
		'context'	=> 'normal',
		'priority'	=> 'high'
	);
	
	
	// POST FORMAT meta boxes - IMAGE:
	$format_image_fields = array(
		array( 
			'name'		=> __('NOTE:','cypress'), 
			'desc'		=> '',
			'id'		=> $prefix.'image',
			'type'		=> 'text',
			'readonly'	=> true,
			'default'	=> __('simply select featured image for this post','cypress'),
		)
	);
	$meta_boxes[] = array(
		'title'		=> 'Image settings',
		'pages'		=> array('post','portfolio'),
		'fields'	=> $format_image_fields,
		'context'	=> 'normal',
		'priority'	=> 'high'
	);
	
	
	/**
	 *	PORTFOLIO META BOXES
	 *
	 */
	
	$portfolio_fields = array(
		array(
			'name'		=> __('Tagline or slogan','cypress'), 
			'desc'		=> __('optional tagline text.','cypress'),
			'id'		=> $prefix.'tagline',
			'type'		=> 'text',
		),
		array(
			'name'		=> __('Layout mode','cypress'),
			'desc'		=> '',
			'id'		=> $prefix.'single_layout',
			'type'		=> 'select',
			'options'	=> array(
				'float_left'	=> 'Float left',
				'float_right'	=> 'Float right',
				'centered'		=> 'Centered'
			),
			'cols' => 4,
			'default'     => 'float_left',
		),
		array(
			'name'		=> __('Featured image format','cypress'),
			'desc'		=> '',
			'id'		=> $prefix.'feat_port_image_format',
			'type'		=> 'select',
			'options'	=> array(
				'thumbnail'		=> 'Thumbnail',
				'medium'		=> 'Medium',
				'as-portrait'	=> 'cypress portrait',
				'as-landscape'	=> 'cypress landscape',
				'large'			=> 'Large',
				'full'			=> 'Full'
			),
			'cols' => 4,
			'default'     => 'thumbnail',
		),
		array(
			'name'		=> __('Number of related items','cypress'), 
			'desc'		=> '',
			'id'		=> $prefix.'related_portfolios',
			'type'		=> 'text',
			'cols'		=> 4,
			'default'	=> 3
		),
		array(
			'name'		=> __('Button URL','cypress'), 
			'desc'		=> __('If no url or no button label (next input field), no button will be displayed.','cypress'),
			'id'		=> $prefix.'button_url',
			'type'		=> 'text',
			'cols'		=> 6,
			'default'	=> ''
		)
		,	array(
			'name'		=> __('Button label','cypress'), 
			'desc'		=> __('If no label or no button url (previous input field), no button will be displayed.','cypress'),
			'id'		=> $prefix.'button_label',
			'type'		=> 'text',
			'cols'		=> 6,
			'default'	=> ''
		),
	);
	$meta_boxes[] = array(
		'title'		=> 'Portfolio item settings',
		'pages'		=> array('portfolio'),
		'fields'	=> $portfolio_fields,
		'context'	=> 'normal',
		'priority'	=> 'default'
	);

	
	/**
	 *	SHOP META BOXES
	 *	- if WooCommerce plugin is active these will show
	 */
	if( $cypress_woo_is_active ) {
	
		$single_product_fields = array( 
			array ( 
				'id'		=> $prefix.'before_catalog',
				'name'		=> 'Before product catalog',
				'desc'		=> 'Display additional content on catalog page, BEFORE products catalog.',
				'type'		=> 'wysiwyg',
				'options'	=> array( 
									'editor_height'	=> '100' 
								)
			),
			array ( 
				'id'		=> $prefix.'after_catalog',
				'name'		=> 'After product catalog',
				'desc'		=> 'Display additional content on catalog page, AFTER products catalog.',
				'type'		=> 'wysiwyg',
				'options'	=> array( 
									'editor_height'	=> '100' 
								)
			),
			
		);				
		
		$meta_boxes[] = array(
			'title'		=> 'Catalog page meta box',
			'id'		=> 'catalog-page-meta-box',
			'pages'		=> array('page'),
			'fields'	=> $single_product_fields,
			'context'	=> 'normal',
			'priority'	=> 'low'
		);
		
	}
	
	/**
	 *	CUSTOM HEADER IMAGE:
	 *
	 */
	$custom_header_image_fields = array(
		
		array( 
			'id'			=> $prefix.'custom_head_image', 
			'name'			=> __('Custom header background image','cypress'),
			'desc'			=> __('Replace default featured product background image header with custom image ','cypress'),
			'type' 			=> 'image',
			'repeatable'	=> false,
			'show_size'		=> true 
		),
		array( 
			'id'			=> $prefix.'custom_head_image_format',
			'name'			=> __('Background image format','cypress'),
			'type'			=> 'select',
			'options'		=> array(
					'thumbnail'		=> 'Thumbnail',
					'medium'		=> 'Medium',
					'as-portrait'	=> 'Cypress portrait',
					'as-landscape'	=> 'Cypress landscape',
					'large'			=> 'Large',
					'full'			=> 'Full'
				),
			'cols'			=> 6,
			'allow_none'	=> false,
			'sortable'		=> false,
			'repeatable'	=> false
		),
		array( 
			'id'			=> $prefix.'custom_head_image_repeat',
			'name'			=> __('Background image repeat','cypress'),
			'type'			=> 'select',
			'options'		=> array(
					'repeat'	=> 'Repeat',
					'no-repeat'	=> 'No repeat',
					'repeat-x'	=> 'Repeat X',
					'repeat-y'	=> 'Repeat Y'
				),
			'cols'			=> 6,
			'allow_none'	=> true,
			'sortable'		=> false,
			'repeatable'	=> false
		),
		array( 
			'id'			=> $prefix.'custom_head_image_size',
			'name'			=> __('Background image size','cypress'),
			'type'			=> 'select',
			'options'		=> array(
					'50%'		=> '50%',
					'100% 100%'	=> '100%',
					'cover'		=> 'Cover',
					'contain'	=> 'Contain'
				),
			'cols'			=> 6,
			'allow_none'	=> true,
			'sortable'		=> false,
			'repeatable'	=> false
		),
		
		
		
	);
	$chmf_pages = $cypress_woo_is_active ? array('post','product','portfolio') : array('post','portfolio');
	$meta_boxes[] = array(
		'title'		=> 'Custom header image',
		'id'		=> 'custom-header-image',
		'pages'		=> $chmf_pages,
		'fields'	=> $custom_header_image_fields,
		'context'	=> 'side',
		'priority'	=> 'low'
	);
	
	
	
	// FINALLY - OUTPUT META BOXES:
	return $meta_boxes;

}
add_filter( 'as_meta_boxes', 'as_meta_boxes' );
//
//
//
/**
 *	HIDE DEFAULT META BOXES
 *
 */
// initial default hiding of meta boxes - can be overridden by "Screen options" :
add_filter('default_hidden_meta_boxes', 'hide_meta_lock', 10, 2);
function hide_meta_lock( $hidden, $screen ) {
	
	$hidden = array();
	if ( 'post' == $screen->base ) {
		$hidden = array('postexcerpt','slugdiv','postcustom','trackbacksdiv', 'commentstatusdiv', 'commentsdiv', 'authordiv', 'revisionsdiv');
	}
	return $hidden;
}
// force hiding meta boxes - indepenent on "Screen options" :
$hidden_metaboxes = isset( $of_cypress['hidden_metaboxes'] ) ? $of_cypress['hidden_metaboxes'] : null;
if( $hidden_metaboxes ) {
	add_filter( 'hidden_meta_boxes', 'custom_hidden_meta_boxes' );
	function custom_hidden_meta_boxes( $hidden ) {
		$hidden[] = 'postexcerpt';
		return $hidden;
	}
}
?>