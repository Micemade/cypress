<?php
/**
 *	AS_Ajax_Categories.
 *
 *	block and class for displaying posts, portfolios or products.
 *	ajax load of items from selected category
 */
class AS_Ajax_Categories extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Ajax content',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('as_ajax_categories', $block_options);
	}
	
	function form($instance) {
		
		global $cypress_woo_is_active;
		
		$defaults = array(
			'title'				=> '',
			'subtitle'			=> '',
			'title_style'		=> 'center',
			'post_type'			=> 'post',
			'post_cats'			=> '',
			'portfolio_cats'	=> '',
			'product_cats'		=> '',
			'block_style'		=> 'style1',
			'tax_menu_style'	=> 'inline',
			'img_format'		=> 'as-portrait',
			'custom_img_width'	=> '',
			'custom_img_height'	=> '',
			'total_items'		=> 6,
			'in_row'			=> 3,
			'only_featured' 	=> false,
			'use_slider'		=> true,
			'slider_navig'		=> true,
			'slider_pagin'		=> true,
			'slider_timing'		=> '',
			'transition'		=> 'none',
			'display_excerpt'	=> true,
			'display_postmeta'	=> true,
			'in_slide'			=> 3,
			'more_link_text'	=> 'Read more',
			'more_link_url'		=> '',
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		?>
		<div class="description third">
		
			<label for="<?php echo $this->get_field_id('title') ?>">Block title (optional)</label>
				
			<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			
		</div>
		
		<div class="description third">
		
			<label for="<?php echo $this->get_field_id('subtitle') ?>">Block subtitle (optional)</label>
				
			<?php echo aq_field_input('subtitle', $block_id, $subtitle, $size = 'full') ?>
			
		</div>
		
		<div class="description third last">
			<label for="<?php echo $this->get_field_id('title_style') ?>">
				Block title style
			</label>	<br/>
			<?php
			$img_formats = array(
				'center'		=> 'Center',
				'float_left'	=> 'Float left',
				'float_right'	=> 'Float right'
				);
			echo aq_field_select('title_style', $block_id, $img_formats, $title_style); 
			?>	
		</div>
		
		
		<div class="clearfix clear"></div>
		<hr>	
		

		<?php // GET POST TYPES AND TAXONOMIES FOR FILTERING 
		$is_port_tax	= taxonomy_exists( 'portfolio_category' );
		?>
		
		<div class="description <?php echo $cypress_woo_is_active ? 'fourth' : 'third'; ?>">
			<label for="<?php echo $this->get_field_id('post_type') ?>">
				Post type
			</label>	<br/>
			<?php
			
			if( $cypress_woo_is_active ) {
				$post_types = array(
					'post'=> 'Post',
					'product' => 'Product',
					'portfolio' => 'Portfolio'
				);
			}else{
				$post_types = array(
					'post'=> 'Post',
					'portfolio' => 'Portfolio'
				);
			}
			echo aq_field_select('post_type', $block_id, $post_types, $post_type); 
			?>
		</div>
		
		<div class="description <?php echo $cypress_woo_is_active ? 'fourth' : 'third'; ?>">
			
			<label for="<?php echo $this->get_field_id('post_cats') ?>">Post categories:</label><br/>
				
			<?php

			$post_cats_arr = apply_filters('as_terms', 'category' );
			
			echo aq_field_multiselect('post_cats', $block_id, $post_cats_arr, $post_cats); 
			?>
		</div>
		
					
		<div class="description <?php echo $cypress_woo_is_active ? 'fourth' : 'third last'; ?>">
		
			<?php if( $is_port_tax ) { ?>
			
				<label for="<?php echo $this->get_field_id('portfolio_cats') ?>">Portfolio categories:</label><br/>
					
				<?php
				
				$terms_arr = apply_filters('as_terms', 'portfolio_category' );
				
				echo aq_field_multiselect('portfolio_cats', $block_id, $terms_arr, $portfolio_cats); 
				?>
				
			<?php 
			}else{
				
				echo '<p class="description">There is no <strong>"Portfolio category"</strong> taxonomy registered.<br /> <br /> Please, install and activate "Aligator Custom Post Types plugin</p>';
			}
			?>
		</div>	
								
		
		<?php if( $cypress_woo_is_active ) { ?>
		<div class="description fourth last">
		
			<label for="<?php echo $this->get_field_id('product_cats') ?>">Product categories:</label><br/>
				
			<?php
			
			$product_cats_arr = apply_filters('as_terms', 'product_cat' );
			
			echo aq_field_multiselect('product_cats', $block_id, $product_cats_arr, $product_cats); 
			?>
			
		</div>
		<?php } ?>
		
		<div class="clearfix clear"></div>
		<hr />	
		
		
		<div class="description half">
			
			<label for="<?php echo $this->get_field_id('block_style') ?>">Block style</label><br/>	
			
			<?php
			$block_styles = array(
				'style1' => 'Style 1',
				'style2' => 'Style 2 (Float left)',
				'style3' => 'Style 3 (Float right)'
				);
			echo aq_field_select('block_style', $block_id, $block_styles, $block_style); 
			?>
			
		</div>		
		
		<div class="description half last">
			
			<label for="<?php echo $this->get_field_id('tax_menu_style') ?>">Taxonomy menu style</label><br/>	
			
			<?php
			$tax_menu_styles = array(
				'inline' => 'Inline menu',
				'dropdown' => 'Dropdown menu'
				);
			echo aq_field_select('tax_menu_style', $block_id, $tax_menu_styles, $tax_menu_style); 
			?>
			
		</div>		
		
		
		<div class="clearfix clear"></div>
		<hr />	
		
		
		<div class="description fourth ">	
			
			<label for="<?php echo $this->get_field_id('img_format') ?>">Image format</label><br/>	
			<?php
			$post_types = array(
				'thumbnail'=> 'Thumbnail',
				'medium' => 'Medium',
				'as-portrait' => 'Cypress portrait',
				'as-landscape' => 'Cypress landscape',
				'large' => 'Large'
				);
			echo aq_field_select('img_format', $block_id, $post_types, $img_format); 
			?>
			
			<div class="clearfix clear"></div>
			
			<label for="<?php echo $this->get_field_id('custom_img_width') ?>">Custom image width</label><br />
			<?php echo aq_field_input('custom_img_width', $block_id, $custom_img_width, $size="min"); ?>

			<div class="clearfix clear"></div>
			
			<label for="<?php echo $this->get_field_id('custom_img_height') ?>">Custom image height</label><br />
			<?php echo aq_field_input('custom_img_height', $block_id, $custom_img_height, $size="min"); ?>
			
			<p class="description">"Custom image size" overrides "Image Format" (registered image sizes) settings. Use both width and height value.</p>
		
		</div>
		
		
		
		<div class="description fourth">
						
			<label for="<?php echo $this->get_field_id('use_slider') ?>">Use slider ?</label><br />
			
			<?php echo aq_field_checkbox('use_slider', $block_id, $use_slider); ?>
			
			<div class="clearfix clear"></div>
			
			<label for="<?php echo $this->get_field_id('slider_pagin') ?>">Slider pagination</label><br />
			
			<?php echo aq_field_checkbox('slider_pagin', $block_id, $slider_pagin); ?>
			
			<div class="clearfix clear"></div>
					
			<label for="<?php echo $this->get_field_id('slider_navig') ?>">Slider navigation</label><br />
			
			<?php echo aq_field_checkbox('slider_navig', $block_id, $slider_navig); ?>
		
			<div class="clearfix clear"></div>
					
			<label for="<?php echo $this->get_field_id('slider_timing') ?>">Slider timing</label><br />
			<?php echo aq_field_input('slider_timing', $block_id, $slider_timing, $size = 'min');	?>
			
			<p class="description">If empty, the slider will not slide automatically </p>
		
			<hr>
				
			<label for="<?php echo $this->get_field_id('transition') ?>">CSS transitions</label><br />
			<?php 
			$transitions = array(
				'none'		=> 'None',
				'fade'		=> 'Fade',
				'backSlide'	=> 'Back Slide',
				'goDown'	=> 'Go Down',
				'fadeUp'	=> 'Fade Up',
				);
			echo aq_field_select('transition', $block_id, $transitions, $transition) ?>
			
		
		</div>	
		
		<div class="description fourth">
			
			<label for="<?php echo $this->get_field_id('total_items') ?>">Total items</label><br />
			<?php echo aq_field_input('total_items', $block_id, $total_items, $size="min"); ?>
			
			<div class="clearfix"></div>
			
			<label for="<?php echo $this->get_field_id('in_row') ?>">In one row</label>
			<?php
			$in_row_array = array(
				'1'	=> '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'6' => '6'
				);
			echo aq_field_select('in_row', $block_id, $in_row_array, $in_row);
			?>
			
			<div class="clearfix"></div>
			
			<label for="<?php echo $this->get_field_id('in_slide') ?>">In one slide</label><br />
			<?php echo aq_field_input('in_slide', $block_id, $in_slide, $size = 'min'); ?>
		
		</div>	
		
		<div class="description fourth last">
			
			<label for="<?php echo $this->get_field_id('only_featured') ?>">Display only featured ?</label><br />
			<?php echo aq_field_checkbox('only_featured', $block_id, $only_featured); ?>
			
			<div class="clearfix clear"></div>
			<label for="<?php echo $this->get_field_id('display_excerpt') ?>">Display excerpt ?</label><br />
			<?php echo aq_field_checkbox('display_excerpt', $block_id, $display_excerpt); ?>
			
			<div class="clearfix clear"></div>
			<label for="<?php echo $this->get_field_id('display_postmeta') ?>">Display post meta ?</label><br />
			<?php echo aq_field_checkbox('display_postmeta', $block_id, $display_postmeta); ?>
			
			
		</div>
		

		<hr />		
		<div class="clearfix clear"></div>
		
		<div class="description half">	
			<label for="<?php echo $this->get_field_id('more_link_text') ?>">Text for "more" link</label>
			<?php echo aq_field_input('more_link_text', $block_id, $more_link_text, $size = 'full') ?>
		</div>	
				
		<div class="description half last">	
			<label for="<?php echo $this->get_field_id('more_link_url') ?>">URL address  for "more" link</label>
			<?php echo aq_field_input('more_link_url', $block_id, $more_link_url, $size = 'full') ?>
		</div>	
		
		<div class="clearfix clear"></div>
		
		<div class="description">	
			If either of these two fields are empty, the button "more" button won't display.
		</div>
		
	<?php
	
	}
	
	function block($instance) {
		
		global $post, $product, $woocommerce_loop, $wp_query, $woocommerce;
		
		extract($instance);
		
		$grid = round( 100 / $in_row );
		$sticky_array = get_option( 'sticky_posts' );
		$total_items = $total_items ? $total_items : -1;
		
		// FEATURED POSTS FILTER ARGS
		if ( $post_type == 'post' && $only_featured ) {
			$args_only_featured = array('post__in' => $sticky_array);
		}elseif ( $post_type == 'portfolio' && $only_featured ){
			$args_only_featured = array( 
				'meta_key' => 'as_featured_item',
				'meta_value' => 1
			);
		}elseif ( $post_type == 'product' && $only_featured ){
			if( apply_filters( 'cypress_wc_version', '3.0.0' ) ) {
				$args_only_featured['tax_query'] = array(
					array(
						'taxonomy' => 'product_visibility',
						'field'    => 'name',
						'terms'    => 'featured',
					)
				);
			}else{
				$args_only_featured = array( 
					'meta_key' => '_featured',
					'meta_value' => 'yes'
				);
			}
		}else{
			$args_only_featured = array();
		}
		//
		
		// TAXONOMY FILTER ARGS
		if( isset( $post_cats) &&  $post_type == 'post' ) {
			$tax_terms = $post_cats;
			$taxonomy = 'category';
		}elseif( isset($portfolio_cats) && $post_type == 'portfolio' ){
			$tax_terms = $portfolio_cats;
			$taxonomy = 'portfolio_category';
		}elseif( isset($product_cats) && $post_type == 'product' ){
			$tax_terms = $product_cats;
			$taxonomy = 'product_cat';
		}else{
			$tax_terms = '';
			$taxonomy = '';
		}
		
		echo $subtitle ? '<div class="block-subtitle '. $title_style .'">' . $subtitle . '</div>' : ''; 
		
		echo $title ? '<h2 class="categories-block block-title '. $title_style .'">' . $title . '</h2>' : '';

		if( $tax_terms ) {
		
		echo $tax_menu_style == 'dropdown' ?'<div class="menu-toggler block-tax-toggler"><a href="#" title="'.__('Toggle categories','cypress').'" class="button iconized-button"><span class="fs" data-icon="&#xe05a;"></span></a></div>' : null;
		
		?>
		
		<ul class="taxonomy-menu <?php echo $tax_menu_style == 'dropdown' ? ' tax-dropdown' : null; ?>">
		
		<?php 
		// GET TAXONOMY OBJECT:
		$term_Objects = array();
		foreach ( $tax_terms as $term ) {
			$term_Objects[] = get_term_by( 'slug', $term, $taxonomy );
			
		}
		// DISPLAY TAXONOMY MENU:
		foreach ( $term_Objects as $term_obj ) {
		
			echo '<li class="category-link" id="cat-'.$term_obj->term_id .'">';
			echo '<a href="#" class="'.$term_obj->slug .' ajax-posts" data-id="'. $term_obj->slug .'">';
			echo '<div class="term">' . $term_obj->name . '</div>';
			echo '</a>';
			echo '</li>';
			
		}
		?>
		</ul>
		
		<?php } // endif $tax_terms ?>
		
		<?php
		
		if( $custom_img_width || $custom_img_height ) {
			$img_width = $custom_img_width ? $custom_img_width : 450;
			$img_height = $custom_img_height ? $custom_img_height : 300;
		}else{
			// REGISTERED IMAGE SIZES:
			$imgSizes = all_image_sizes(); // as custom fuction
			$img_width = $imgSizes[$img_format]['width'];
			$img_height = $imgSizes[$img_format]['height'];
		}
						
		/*
		IMPORTANT: HIDDEN INPUT TYPE - HOLDER OF VARS SENT VIA POST BY AJAX :
		*/
		?>

		<input type="hidden" class="varsHolder" data-tax = "<?php echo $taxonomy; ?>"  data-ptype = "<?php echo $post_type; ?>" data-totitems = "<?php echo $total_items; ?>" data-feat = "<?php echo $only_featured; ?>" data-row ="<?php echo $in_row; ?>" data-slider ="<?php echo $use_slider; ?>" data-img = <?php echo $img_format; ?> data-inslide ="<?php echo $in_slide; ?>" data-custom-img-w="<?php echo $custom_img_width; ?>" data-custom-img-h="<?php echo $custom_img_height; ?>"  data-postmeta="<?php echo $display_postmeta; ?>" data-excerpt="<?php echo $display_excerpt; ?>" data-blockstyle="<?php echo $block_style; ?>" data-taxmenustlye="<?php echo $tax_menu_style; ?>" data-block-id="<?php echo $block_id; ?>" />
		
		<div class="clearfix"></div>
		
		<?php 
		
		// if there are taxonomies selected, turn on taxonomy filter:
		if( !empty($tax_terms) ) {

			$tax_filter_args = array('tax_query' => array(
								array(
									'taxonomy' => $taxonomy,
									'field' => 'slug', // can be 'slug' too
									'operator' => 'IN', // NOT IN to exclude
									'terms' => $tax_terms
								)
							)
						);
		}else{
			$tax_filter_args = array();
		}
		$main_args = array(
			'no_found_rows' => 1,
			'post_status' => 'publish',
			'post_type' => $post_type,
			'post_parent' => 0,
			'suppress_filters' => false,
			'orderby'     => 'post_date',
			'order'       => 'DESC',
			'numberposts' => $total_items
		);
		
		$all_args = array_merge( $main_args, $args_only_featured, $tax_filter_args );

		$content = get_posts($all_args);

		?>
		
		<div class="loading-animation" style="display: none;"><?php echo __('Loading ...','cypress'); ?></div>
		
		<div id="<?php echo $block_id; ?>" class="content-block cb-2">
			
			<?php if( !empty( $tax_terms )) { ?>
			<div class="cat-title">
				<div class="wrap"></div>
				<a href="#" class="ajax-posts"<?php echo !empty( $tax_terms ) ? ' data-id="' . implode(",", $tax_terms) .'"' : null; // array to string ?>>
					<?php $t = __('Reset categories','cypress');?>
					<div class="fs" aria-hidden="true" data-icon="&#xe09c;" title="<?php echo $t; ?>"></div>
				</a>
			</div>
			<?php } ?>			
		
			
			<input type="hidden" class="slides-config" data-navigation="<?php echo $slider_navig; ?>" data-pagination="<?php echo $slider_pagin; ?>" data-auto="<?php echo $slider_timing; ?>" <?php echo ($transition != 'none') ? 'data-trans="'.$transition.'"' : ''; ?> />
			
			<div class="<?php echo $use_slider ? ' contentslides' : '';?> category-content">
			
			<?php 
	
			$i = 0;

			if( count( $content ) == 1 || $in_row == 1) {
				$t_grid = '100';
			}else{
				$t_grid = '50';
			}
			
			//start posts loop
			foreach ( $content as $post ) {
				
				setup_postdata( $post );
				
				if ($i++%$in_slide==0): ?>
								
				<ol class="itemgroup">
					
				<?php endif;  ?>	
					
					<li class="grid-<?php echo $grid ? $grid : '50'; ?> item scroll tablet-grid-<?php echo $t_grid; ?> mobile-grid-100<?php echo ' '.$block_style; ?>"  <?php echo ( $i%$in_row  == 1 ) ? 'style="clear: both;"': null ?>>
						
						<?php
						if( defined('WPML_ON') ) { // if WPML plugin is active
							$post_id	= icl_object_id( get_the_ID(), get_post_type(), false, ICL_LANGUAGE_CODE ); 
							$lang_code	= ICL_LANGUAGE_CODE;
						}else{
							$post_id	= get_the_ID();
							$lang_code	= '';
						}
						$link			= get_permalink($post_id);
						$post_format	= get_post_format();
						$pP_rel			= '';
						
						// //////////////////////////////////////////////////////////////////////
						
						if( $post_format == 'video' ) { // <---------- GALLERY POST VIDEO
						
							$featured_or_thumb	= get_post_meta($post_id,'as_video_thumb', true);
							$video_host			= get_post_meta($post_id,'as_video_host', true);
							$video_id			= get_post_meta($post_id,'as_video_id', true);
							$width				= get_post_meta($post_id,'as_video_width', true);
							$height				= get_post_meta($post_id,'as_video_height', true);
							
							$img_url = get_template_directory_uri() . '/inc/blocks/ajax_video.php?video_host='.$video_host.'&video_id='.$video_id.'&vid_width='.$width.'&vid_height='.$height.'&ajax=true&width=80%';
							
							if ( $featured_or_thumb == 'host_thumb' ) { // if thumbs from video hosts
							
								$img = video_thumbs();
								$image_output = '<div class="entry-image"><img src="'. fImg::resize( $img , $img_width, $img_height, true  ) .'" alt="'. esc_attr(strip_tags(get_the_title())) .'" /></div>';
							
							}else{
							
								$img = as_get_full_img_url();
								$image_output = '<div class="entry-image"><img src="'. fImg::resize( $img , $img_width, $img_height, true  ) .'" alt="'. esc_attr(strip_tags(get_the_title())) .'" /></div>';
								
							}
							$pP_rel = '[ajax-'.$post_id.'-'.$block_id.']';
							$img_urls_gallery = ''; // avoid duplicate gallery image urls
							
						}elseif( $post_format == 'gallery' ) { // <------------- GALLERY POST FORMAT
							
							// WP gallery img id's:
							$wpgall_ids 	= apply_filters('as_wpgallery_ids','ids_wp_gallery');
							// AS gallery img id's (from custom meta):
							$gall_img_array = get_post_meta( get_the_ID(),'as_gallery_images');
														
							$img_urls_gallery = '';
							$n = 0;
							if( !empty($wpgall_ids) ) {
								
								foreach ( $wpgall_ids as $wpgall_img_id ){
									
									if( $n == 0 ) {
										$img_url = as_get_full_img_url( $wpgall_img_id );
									}else{
										$img_urls_gallery .= '<a href="' .as_get_full_img_url( $wpgall_img_id ) .'" class="invisible-gallery-urls" data-rel="prettyPhoto[pp_gal-'.$post_id.'-'.$block_id.']"></a>';
									}
									$n++;
								}
								$image_output = get_unattached_image( $wpgall_ids[0], $img_format, $img_width, $img_height );
								
							}elseif( !empty($gall_img_array) ) {
								
								foreach ( $gall_img_array as $gall_img_id ){
									
									if( $n == 0 ) {
										$img_url = as_get_full_img_url( $gall_img_id );
									}else{
										$img_urls_gallery .= '<a href="' .as_get_full_img_url( $gall_img_id ) .'" class="invisible-gallery-urls" data-rel="prettyPhoto[pp_gal-'.$post_id.'-'.$block_id.']"></a>';
									}
									$n++;
								
								}
								$image_output = as_image( $img_format,1, $img_width, $img_height );
								
							}
							
							
							
							
							$pP_rel			= '[pp_gal-'.$post_id.'-'.$block_id.']';
						
						}elseif( $post_format == 'audio' ){ // <--------------AUDIO POST FORMAT
							
							$audio_file_id		= get_post_meta($post_id,'as_audio_file', true);
							$audio_file			= wp_get_attachment_url( $audio_file_id );	
							
							$large_image		= as_get_full_img_url();
							$img_url			= get_template_directory_uri() . '/inc/blocks/ajax_audio.php?audio_file='.$audio_file.'&large_image='.$large_image.'&post_id='.$post_id.'&ajax=true';
							
							$image_output		= as_image( $img_format,1, $img_width, $img_height );
							$pP_rel				= '';
							$img_urls_gallery	= ''; // avoid duplicate gallery image urls
							
							//wp_enqueue_style( 'wp-mediaelement' );
							//wp_enqueue_script( 'wp-mediaelement' );
							
						}elseif( $post_format == 'quote' ){ // <---------------- QUOTE POST FORMAT
							
							$quote_author	= get_post_meta($post_id,'as_quote_author', true);
							$quote_url		= get_post_meta($post_id,'as_quote_author_url', true);
							$avatar			= get_post_meta($post_id,'as_avatar_email', true);
							
							$quote_html = '<div class="quote-inline format-quote">';
							
							if( $avatar || has_post_thumbnail() ) {
								
							$quote_html		.= '<div class="avatar-img">';
								
								$quote_html .= $quote_url ? '<a href="'.$quote_url.'" title="'. $quote_author .'">' : '';
								if( $avatar ) {
									$quote_html .= get_avatar( $avatar , 120 );
								}elseif( has_post_thumbnail() ){
									$quote_html .= get_the_post_thumbnail('thumbnail');
								}
								$quote_html		.= $quote_url ? '</a>' : '';
								
								$quote_html		.= '<div class="arrow-left"></div></div>';

							}; 
						
							$quote_html .= '<div class="quote">';
								
								$quote_html		.= '<p>'. get_the_content() .'</p>'; 
								$quote_html		.=  $quote_url ? '<a href="'.$quote_url.'" title="'. $quote_author .'">' : '';
								$quote_html		.=  $quote_author ? '<h5>'.$quote_author.'</h5>' : '';
								$quote_html		.=  $quote_url ? '</a>' : '';

							$quote_html .= '</div></div>';
							
							$img_url			= '#quote-'.$post_id;
							$image_output		= as_image( $img_format,1, $img_width, $img_height );
							$pP_rel				= '[inline-'.$post_id.'-'.$block_id.']';
							$img_urls_gallery	= ''; // avoid duplicate gallery image urls
							
						}else{ // <---------------- STANDARD POST FORMAT
							
							$img_url			= as_get_full_img_url();
							$image_output		= as_image( $img_format,1, $img_width, $img_height );
							$pP_rel				= '';
							$img_urls_gallery	= ''; // avoid duplicate gallery image urls
							
						}
						?>

						<?php if( $block_style != 'style1') { ?>
								<h4><a href="<?php echo $link; ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php echo esc_html( strip_tags(get_the_title()) ); ?></a></h4>
						<?php } ?>
												
						<div class="item-images">
							
							<div class="item-img">
							
								<div class="front">
								
									<?php echo $image_output ; ?>
									
									<?php
									if( $block_style == 'style1' ) {
										
										echo '<h4><a href="'. $link.'" title="'. esc_attr(get_the_title()).'">'. esc_html( strip_tags(get_the_title()) ) .'</a></h4>';
									
										if( $display_excerpt ) {
											
											echo '<div class="excerpt">';
										
											echo '<p>' . apply_filters('as_custom_excerpt',80, false) . '</p>';
												
											echo '</div>';
										}
									
									}
									?>
									
									<div class="clearfix"></div>
								
								</div><!-- .front-->
								
								<div class="back">
								
									<?php echo $image_output ; ?>
								
									<div class="item-overlay"></div>
									<div class="back-buttons">
								
									<?php
									echo '<a href="'.$img_url.'" class="button" data-rel="prettyPhoto'.$pP_rel.'" title="'. esc_attr(strip_tags(get_the_title())) .'">'.as_post_format_icon_action().'</a>';
								
									echo '<a href="'.$link.'" class="button" title="'. esc_attr(strip_tags(get_the_title())) .'"><div class="fs" aria-hidden="true" data-icon="&#xe065;"></div></a>';
									?>

									</div>
								</div>
								
								<?php
								echo $img_urls_gallery ? $img_urls_gallery : null; // for usage with prettPhoto
								
								echo $post_format == 'quote' ? '<div class="hidden-quote" id="quote-'.$post_id.'">'. $quote_html .'</div>' : null;

								?>
							
							</div>
							
							
						</div><!-- .item-images -->
						
						
						<?php if( $display_excerpt && $block_style != 'style1'  ) {?>	
						<div class="item-text">
							
							<div class="excerpt">
								
								<?php echo '<p>' . apply_filters('as_custom_excerpt',80, true) . '</p>'; ?>
								
							</div>

						</div>

						<?php  };  ?>
						
						<?php if( $display_postmeta && $block_style != 'style1'  ) { // post meta
						
							echo '<div class="clearfix"></div>';
							echo '<div class="post-meta-bottom">';
							entryMeta_comments();
							entryMeta_dateUser();
							entryMeta_cats_tags();
							echo '</div>';
						}
						?>
						
					</li>

					<?php if ($i%$in_slide==0 || $i==count($content)): ?>

				</ol>
				
				
				<?php 
				
				endif; // $i%$in_slide==0
				
			}// END foreach
			
			wp_reset_query();
			
			?>
			</div>

		
			<?php if( $more_link_text && $more_link_url ) { ?>
			<div class="bottom-block-link">
			
				<a href="<?php echo $more_link_url ; ?>" title="<?php echo esc_attr($more_link_text); ?>" class="button">
					<?php echo esc_html($more_link_text); ?>
				</a>
				
			</div>
			<?php } //endif; $more_link_text ?>
			
			<div class="clearfix"></div>
			
		</div><!-- /.carousel -->
		
	<?php
	
	}/// END func block
	
	function update($new_instance, $old_instance) {
		return $new_instance;
	}
} ?>