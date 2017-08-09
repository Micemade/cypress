<?php
/**
 *	AS_Ajax_Product_Categories.
 *
 *	block and class for displaying products.
 *	ajax load of items from selected product category
 */
class AS_Ajax_Product_Categories extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Ajax products ',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('as_ajax_product_categories', $block_options);
	}
	
	function form($instance) {
		
		global $cypress_woo_is_active;
		
		$defaults = array(
			'title'				=> '',
			'subtitle'			=> '',
			'title_style'		=> 'center',
			'post_type'			=> 'product',
			'img_format'		=> 'as-portrait',
			'total_items'		=> 6,
			'in_row'			=> 3,
			'filters'			=> 'latest',
			'use_slider'		=> true,
			'slider_navig'		=> true,
			'slider_pagin'		=> true,
			'slider_timing'		=> '',
			'transition'		=> 'none',
			'in_slide'			=> 3,
			'prod_cat_menu'		=> 'images',
			'menu_columns'		=> 'auto',
			'product_cats'		=> '',
			'shop_assets'		=> false,
			'button_text'		=> '',
			'button_link'		=> ''
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
		
		<hr>
		
		<div class="description fourth">
			
			<label for="<?php echo $this->get_field_id('product_cats') ?>">Product categories:</label><br/>
			<?php
			if( $cypress_woo_is_active ) {

				$terms_arr = apply_filters('as_terms', 'product_cat' );
				
				echo aq_field_multiselect('product_cats', $block_id, $terms_arr, $product_cats); 
			
			}else{
				echo '<p class="description">WooCommerce plugin is not active. Please, activate it to use product categories.</p>';
			}
			?>
			
			<div class="clearfix"></div>
			
			<label for="<?php echo $this->get_field_id('prod_cat_menu') ?>">Categories menu</label><br />
			<?php
			$prod_cat_menu_arr = array(
				'none'			=> 'None',
				'images'		=> 'With category images',
				'no_images'		=> 'Without category images',
				);
			echo aq_field_select('prod_cat_menu', $block_id, $prod_cat_menu_arr, $prod_cat_menu); 
			?>
			
			<div class="clearfix"></div>
			
			<label for="<?php echo $this->get_field_id('menu_columns') ?>">Menu columns</label><br />
			<?php
			$menu_columns_arr = array(
				'auto'		=> 'Auto float',
				'stretch'	=> 'Auto stretch',
				'1'			=> '1',
				'2'			=> '2',
				'3'			=> '3',
				'4'			=> '4',
				'6'			=> '6'
				);
			echo aq_field_select('menu_columns', $block_id, $menu_columns_arr, $menu_columns); 
			?>
			
			<div class="clearfix"></div><br />
			
			<label for="<?php echo $this->get_field_id('filters') ?>">Special filters</label><br />
			<?php
			$filters_array = array(
				'latest'		=> 'Latest products',
				'featured'		=> 'Featured products',
				'on_sale'		=> 'On sale',
				'best_sellers'	=> 'Best selling products',
				'best_rated'	=> 'Best rated products',
				'random'		=> 'Random products'
				);
			echo aq_field_select('filters', $block_id, $filters_array, $filters); 
			?>
			
		</div>

		
		<div class="description fourth last">
			
			<label for="<?php echo $this->get_field_id('img_format') ?>">
				Product image format
			</label>	<br/>
			<?php
			$img_formats = array(
				'thumbnail'		=> 'Thumbnail',
				'medium'		=> 'Medium',
				'as-portrait'	=> 'Cypress portrait',
				'as-landscape'	=> 'Cypress landscape',
				'large'			=> 'Large'
				);
			echo aq_field_select('img_format', $block_id, $img_formats, $img_format); 
			?>
			
			
			<label for="<?php echo $this->get_field_id('shop_assets') ?>">Shop assets: </label><br />
			<?php
			$shop_assets_array = array(
				'quick_view'		=> 'Quick view',
				'product_buttons'	=> 'Product page buttons',
				'no_shop_assets'	=> 'No shop assets'
				);
			echo aq_field_select('shop_assets', $block_id, $shop_assets_array, $shop_assets); 
			?>
			
			<p class="description">Shop assets are "Quick view", "Add to Cart" ("Select Options") buttons, price, star ratings... </p>
			
			<?php //echo aq_field_checkbox('shop_assets', $block_id, $shop_assets); ?>
			
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
		
							
		<div class="description fourth last">
		
			<label for="<?php echo $this->get_field_id('total_items') ?>">Total items to display</label><br />
			<?php echo aq_field_input('total_items', $block_id, $total_items, $size="min"); ?>
			
			<div class="clearfix"></div>
			
			<label for="<?php echo $this->get_field_id('in_row') ?>">Number of items columns</label>
			<?php
			$in_row_array = array(
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'6' => '6'
				);
			echo aq_field_select('in_row', $block_id, $in_row_array, $in_row);
			?>
			
			<div class="clearfix"></div>			
	
			<label for="<?php echo $this->get_field_id('in_slide') ?>">Items in one slide</label><br />
			<?php echo aq_field_input('in_slide', $block_id, $in_slide, $size = 'min');	?>
		
		</div>
		
		<div class="clearfix clear"></div>
		<hr />
		
		<p class="description">If using slider, "In one slide" setting will apply. If not using slider, total items will be displayed, in number of columns per row set in "On one row" setting. If checked "Only featured products?", only featured products will be displayed.</p>
	
		<hr />		
		
		
		<div class="description half">	
			<label for="<?php echo $this->get_field_id('button_text') ?>">Button text</label>
			<?php echo aq_field_input('button_text', $block_id, $button_text, $size = 'full') ?>
		</div>	
				
		<div class="description half last">	
			<label for="<?php echo $this->get_field_id('button_link') ?>">Button link</label>
			<?php echo aq_field_input('button_link', $block_id, $button_link, $size = 'full') ?>
		</div>
		
		<p class="description clearfix">	
			Both upper fields must be filled to display the button.
		</p>
		
	<?php
	
	}
	
	function block($instance) {
		
		global $post, $cypress_woo_is_active, $product, $woocommerce_loop, $wp_query, $woocommerce;
		
		extract($instance);
		
		if( $cypress_woo_is_active ) {
		
		$grid = round( 100 / $in_row );
		$total_items = $total_items ? $total_items : -1;
		
				
		// PRODUCT FILTERS:
		$order_rand	= false;
		$args_filters = array();
		if ( $filters == 'featured' ){
			
			$args_filters['tax_query'][] = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'name',
				'terms'    => 'featured',
			);
			
		}elseif( $filters == 'on_sale' ){
			
			$product_ids_on_sale    = wc_get_product_ids_on_sale();
			if( ! empty( $product_ids_on_sale ) ) {
				$args_filters['post__in'] = $product_ids_on_sale;
			}
		
		}elseif( $filters == 'best_sellers' ){
			
			$args_filters['meta_key']	= 'total_sales';
			$args_filters['orderby']	= 'meta_value_num';
		
		}elseif( $filters == 'best_rated' ){
			
			$args_filters['meta_key']	= '_wc_average_rating';
			$args_filters['orderby']	= 'meta_value_num';
			
		}elseif( $filters == 'random' ){
		
			$order_rand	= true;
			$args_filters = array();
			$args_filters['orderby'] = 'rand menu_order date';
			
		}
		// end filters
		
		// TAXONOMY FILTER ARGS
		if( isset($product_cats)  ){
			$tax_terms = $product_cats;
			$taxonomy = 'product_cat';
		}else{
			$tax_terms = '';
			$taxonomy = '';
		}
		
		// DISPLAY BLOCK TITLE AND "SUBTITLE":
		
		echo $subtitle ? '<div class="block-subtitle '. $title_style .' above">' . $subtitle . '</div>' : ''; 
		
		echo $title ? '<h2 class="categories-block block-title '. $title_style .'">' . $title . '</h2>' : '';
		
		?>
		
		<?php if( $tax_terms && $prod_cat_menu != 'none' ) { ?>
		<ul class="taxonomy-menu cat-images">
		
		<?php 
		// GET TAXONOMY OBJECT:
		$term_Objects = array();
		foreach ( $tax_terms as $term ) {
			$term_Objects[] = get_term_by( 'slug', $term, $taxonomy ); // get term object using slug
			
		}
		// menu items columns	
		if( $menu_columns == 'auto') {
			$grid_cat = '';
		}elseif( $menu_columns == 'stretch' ){
			$grid_cat = ' grid-' . floor(100 / count($term_Objects)) . ' tablet-grid-' . floor(100 / count($term_Objects)) . ' mobile-grid-50 ';
		}else{
			$grid_cat = ' grid-' . floor(100 / $menu_columns) . ' tablet-grid-' . floor(100 / $menu_columns) . ' mobile-grid-50 ';
		}
		
		
		// DISPLAY TAXONOMY MENU:
		foreach ( $term_Objects as $term_obj ) {
			
			if( $prod_cat_menu == 'images' ) { // if images should be displayed:
			
				$thumbnail_id = get_woocommerce_term_meta( $term_obj->term_id, 'thumbnail_id' );
				$image = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail' );

				if ( $image ) {
		
					echo '<li id="cat-'.$term_obj->term_id .'" class="category-image'. $grid_cat .' as-hover">';
					echo '<a href="#" class="'.$term_obj->slug .' ajax-products" data-id="'. $term_obj->slug .'">';
					echo '<div class="item-overlay"></div>';
					echo '<div class="term">' . $term_obj->name . '</div>';
					echo '<img src="' . fImg::resize( $image[0] , 300, 180, true  ). '" alt="" />';
					echo '<div class="arrow-down"></div></a>';
					echo '</li>';
				}else{
					echo '<li id="cat-'.$term_obj->term_id .'" class="category-image'. $grid_cat .' mobile-grid-50 as-hover">';
					echo '<a href="#" class="'.$term_obj->slug .' ajax-products" data-id="'. $term_obj->slug .'">';
					echo '<div class="item-overlay"></div>';
					echo '<div class="term">' . $term_obj->name . '</div>';
					echo '<img src="' . fImg::resize( PLACEHOLDER_IMAGE , 300, 180, true  ). '" alt="" />';
					echo '<div class="arrow-down"></div></a>';
					echo '</li>';
				}
				
			}elseif( $prod_cat_menu == 'no_images' ){
			
				echo '<li id="cat-'.$term_obj->term_id .'" class="category-link'. $grid_cat .' mobile-grid-50">';
				echo '<a href="#" class="'.$term_obj->slug .' ajax-products" data-id="'. $term_obj->slug .'">';
				echo '<div class="term">' . $term_obj->name . '</div>';
				echo '</a>';
				echo '</li>';
			}
		
		}

		?>
		</ul>
		
		<?php }// endif $tax_terms ?>
		
		<?php 	/*
				IMPORTANT: HIDDEN INPUT TYPE - HOLDER OF VARS SENT VIA POST BY AJAX :
				*/
		?>
		<input type="hidden" class="varsHolder" data-tax = "<?php echo $taxonomy; ?>"  data-ptype = "product" data-totitems = "<?php echo $total_items; ?>" data-filters = "<?php echo $filters; ?>" data-row ="<?php echo $in_row; ?>" data-slider ="<?php echo $use_slider; ?>" data-img = <?php echo $img_format; ?> data-inslide ="<?php echo $in_slide; ?>" data-shop_assets ="<?php echo $shop_assets; ?>" />
		
		
		<div class="clearfix"></div>

		
		<?php 
		
		// if there are taxonomies selected, turn on taxonomy filter:
		if( !empty($tax_terms) ) {
			
			$tax_filter_args = array('tax_query' => array(
								array(
									'taxonomy' => $taxonomy,
									'field' => 'slug', // can be 'slug' or 'id'
									'operator' => 'IN', // NOT IN to exclude
									'terms' => $tax_terms,
									'include_children' => true
								)
							)
						);
		}else{
			$tax_filter_args = array();
		}
			
		
		$main_args = array(
			'no_found_rows'		=> 0,
			'post_status'		=> 'publish',
			'post_type'			=> 'product',
			'post_parent'		=> 0,
			'suppress_filters'	=> false,
			'orderby'			=> $order_rand ? 'rand menu_order date' : 'menu_order date',
			'order'				=> 'ASC',
			'numberposts'		=> $total_items
		);
		
		$all_args = array_merge( $main_args, $args_filters, $tax_filter_args );

		$content = get_posts($all_args);
		
		?>	
	
		<div class="loading-animation" style="display: none;"><?php echo __('Loading products','cypress'); ?></div>
		
		<div id="<?php echo $block_id; ?>" class="content-block cb-1">

			<?php if( !empty( $tax_terms )) {?>
			<div class="cat-title">
				<div class="wrap"></div>
				<a href="#" class="ajax-products"<?php echo !empty( $tax_terms ) ? ' data-id="' . implode(",", $tax_terms) .'"' : null; // array to string ?>>
					<?php $t = __('Reset categories','cypress');?>
					<div class="fs" aria-hidden="true" data-icon="&#xe09c;" title="<?php echo $t; ?>"></div>
				</a>

			</div>
			<?php } ?>
		
			<input type="hidden" class="slides-config" data-navigation="<?php echo $slider_navig; ?>" data-pagination="<?php echo $slider_pagin; ?>" data-auto="<?php echo $slider_timing; ?>"  <?php echo ($transition != 'none') ? 'data-trans="'.$transition.'"' : ''; ?> />
			
			<div class="<?php echo $use_slider ? ' contentslides' : '';?> category-content">
			
			<?php 
	
			$i = 0;
			
			if( count( $content ) == 1 || $in_row == 1) {
				$t_grid = '100';
			}else{
				$t_grid = '50';
			}
			
			//add_action('woocommerce_after_shop_loop_item', function(){ do_action('as_wishlist_button');}, 20);
			
			//start products loop
			foreach ( $content as $post ) {
				
				setup_postdata( $post );
				
				global $product;
				
				
				if ($i++%$in_slide==0): ?>
								
				<ol class="itemgroup">
					
				<?php endif;  ?>	
					
					<li class="grid-<?php echo $grid ? $grid : '50'; ?> item scroll tablet-grid-<?php echo $t_grid; ?> mobile-grid-100">
						
						<?php
						if( defined('WPML_ON') ) { // if WPML plugin is active
							$id	= icl_object_id( get_the_ID(), 'product', false, ICL_LANGUAGE_CODE ); 
							$lang_code	= ICL_LANGUAGE_CODE;
						}else{
							$id	= get_the_ID();
							$lang_code	= '';
						}
						$link = get_permalink($id);
						
						
						// DATA for back image
						// 3.0.0 < Fallback conditional
						if( apply_filters( 'cypress_wc_version', '3.0.0' )	) {
							$attachment_ids   = $product->get_gallery_image_ids();
						}else{
							$attachment_ids   = $product->get_gallery_attachment_ids();
						}
						
						if ( $attachment_ids ) {
							$image_url = wp_get_attachment_image_src( $attachment_ids[0], 'large'  );
							$img_url = $image_url[0];
							// IMAGE SIZES:
							$imgSizes = all_image_sizes(); // as custom fuction
							$img_width = $imgSizes[$img_format]['width'];
							$img_height = $imgSizes[$img_format]['height'];
						}
						// end DATA
						
						$prod_title = '<h4><a href="'. $link .'" title="'.esc_attr(get_the_title()).'"> ' . esc_attr(get_the_title()) .'</a></h4>';
						
						?>
				
						<div class="item-content"><?php // item-content - wrapper for flip effect ?>
						
						<?php 
						if( $shop_assets == 'product_buttons' ) { 
						
							do_action( 'woocommerce_after_shop_loop_item' ); 
						
						}elseif( $shop_assets ==  'quick_view' ) {
							
							echo '<div class="quick-view-holder"><a href="#qv-holder" class="button quick-view"   title="'. esc_attr(strip_tags(get_the_title())) .'" data-id="'.$id.'" data-lang="'. $lang_code .'">'.__('Quick view','cypress').'</a>';
							
							do_action('as_wishlist_button');
							
							echo '</div>';
							
							if ( !wp_script_is( 'wc-add-to-cart-variation', 'enqueued' )) {
							
								wp_register_script( 'wc-add-to-cart-variation', WP_PLUGIN_DIR . '/woocommerce/assets/frontend/add-to-cart-variation.min.js');
								wp_enqueue_script( 'wc-add-to-cart-variation' );
								
							}

						}
						?>
						
						<div class="item-img">
							
							<div class="front">
															
								<?php function_exists('woocommerce_show_product_loop_sale_flash') ? woocommerce_show_product_loop_sale_flash() : '';
								
								echo as_image( $img_format ); ?>
							
							</div>
							
							<div class="back">
							
								<div class="item-overlay"></div>
								
								<?php 
								echo $prod_title; 
								woocommerce_template_loop_price();
								function_exists('woocommerce_template_loop_rating') ? woocommerce_template_loop_rating() : '';
								?>
								
								<?php 
								// second prod. image - first from prod. image gallery
								if ($attachment_ids ) {
									echo '<img src="'. fImg::resize( $img_url , $img_width, $img_height, true  ) .'" alt="'. esc_attr(get_the_title()) .'" class="back-image" />';
								}else{
									echo as_image( $img_format );
								}
									
								echo '<div class="back-buttons">';
																
								echo '<a href="'.as_get_full_img_url().'" class="button" data-rel="prettyPhoto" title="'. esc_attr(get_the_title()) .'"><div class="fs" aria-hidden="true" data-icon="&#xe022;"></div></a>';
								
								echo '<a href="'.$link.'" class="button" title="'. esc_attr(get_the_title()) .'"><div class="fs" aria-hidden="true" data-icon="&#xe065;"></div></a>';
								
								echo '</div>';
								?>
							
							</div>
							
						</div>
						
						<div class="clearfix"></div>
						
						</div><!-- /.item-content -->
						
					
					</li>

					<?php if ($i%$in_slide==0 || $i==count($content)): ?>

				</ol>
								
				<?php 
				
				endif; // $i%$in_slide==0
				
				
			}// END foreach

			
			wp_reset_postdata();
			?>
			</div>
			
			
			<?php if( $button_text && $button_link ) { ?>
			<div class="bottom-block-link">
			
				<a href="<?php echo $button_link ; ?>" title="<?php echo esc_attr($button_text); ?>" class="button">
					<?php echo esc_html($button_text); ?>
				</a>
				
			</div>
			<?php } //endif; $button_text ?>
			
			<div class="clearfix"></div>
			
		</div><!-- /.content-block cb-1 -->
		
		<?php
	
		}else{
			echo '<h5 class="no-woo-notice">' . __('AJAX PRODUCTS BLOCK DISABLED.<br> Sorry, it seems like WooCommerce is not active. Please install and activate last version of WooCommerce.','cypress') . '</h5>';
				return;
		} // if $cypress_woo_is_active
	
	}/// END func block
	
	function update($new_instance, $old_instance) {
		return $new_instance;
	}
} ?>