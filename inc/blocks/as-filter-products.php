<?php
/**
 *	AS_Fiter_Categories.
 *
 *	block and class for showing posts, portfolios.
 *	features - filtering and sorting items via jQuery Shuffle plugin
 */
class AS_Filter_Products extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Filtered products',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('as_filter_products', $block_options);
	}
	
	function form($instance) {
		
		global $cypress_woo_is_active;
		
		$defaults = array(
			'title'				=> '',
			'subtitle'			=> '',
			'title_style'		=> 'center',
			'post_type'			=> 'product',
			'img_format'		=> 'as-portrait',
			'product_cats'		=> '',
			'filters'			=> 'latest',
			'shop_assets'		=> false,
			'block_style'		=> 'style1',
			'tax_menu_style'	=> 'dropdown',
			'sorting'			=> false,
			'custom_img_width'	=> '',
			'custom_img_height'	=> '',
			'total_items'		=> 8,
			'in_row'			=> 4,
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
		
		<?php // POST TYPE AND TAXONOMIES FOR FILTERING:  ?>							
		
		<div class="description fourth">
		
			<label for="<?php echo $this->get_field_id('product_cats') ?>">Product categories:</label><br/>
				
			<?php
			if( $cypress_woo_is_active ) {
				
				$terms_arr = apply_filters('as_terms', 'product_cat' );
				
				
				echo aq_field_multiselect('product_cats', $block_id, $terms_arr, $product_cats); 
				
				echo '<p class="description">To show items without filtering deselect categories (using CTRL/Command + click). To select multiple, also use CTRL/Command + click.</p>';
			
			
			}else{
				echo '<p class="description">WooCommerce plugin is not active. Please, activate it to use product categories.</p>';
			}
			?>
			
			
			<div class="clearfix"></div><br />
			
			<label for="<?php echo $this->get_field_id('filters') ?>">Special filters</label><br />
			<?php
			$filters_array = array(
				'latest'		=> 'Latest products',
				'featured'		=> 'Featured products',
				'best_sellers'	=> 'Best selling products',
				'best_rated'	=> 'Best rated products',
				'random'		=> 'Random products'
				);
			echo aq_field_select('filters', $block_id, $filters_array, $filters); 
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
		
		</div>
		
		
		<div class="description fourth">
			
			<?php // IMAGE SETTINGS :?>
			
			<label for="<?php echo $this->get_field_id('img_format') ?>">Image format</label><br/>	
			<?php
			$img_format_array = array(
				'thumbnail'		=> 'Thumbnail',
				'medium'		=> 'Medium',
				'as-portrait'	=> 'Cypress portrait',
				'as-landscape'	=> 'Cypress landscape',
				'large'			=> 'Large'
				);
			echo aq_field_select('img_format', $block_id, $img_format_array, $img_format); 
			?>
			
			<div class="clearfix"></div>
			
			<label for="<?php echo $this->get_field_id('custom_img_width') ?>">Custom image width</label><br />
			<?php echo aq_field_input('custom_img_width', $block_id, $custom_img_width, $size="min"); ?>
			
			<div class="clearfix"></div>
			
			<label for="<?php echo $this->get_field_id('custom_img_height') ?>">Custom image height</label><br />
			<?php echo aq_field_input('custom_img_height', $block_id, $custom_img_height, $size="min"); ?>
			
		
		</div>	
		
		
		<div class="description fourth">	
			
			<label for="<?php echo $this->get_field_id('block_style') ?>">Block style</label><br/>	
			<?php
			$block_styles = array(
				'style1' => 'Style 1',
				'style2' => 'Style 2 (Float left)',
				'style3' => 'Style 3 (Float right)',
				'style4' => 'Style 4 (only title)'		
				);
			echo aq_field_select('block_style', $block_id, $block_styles, $block_style); 
			?>
			
			<label for="<?php echo $this->get_field_id('tax_menu_style') ?>">Taxonomy menu style</label><br/>	
			
			<?php
			$tax_menu_styles = array(
				'inline'	=> 'Inline menu',
				'dropdown'	=> 'Dropdown menu',
				'none'		=> 'None'
				);
			echo aq_field_select('tax_menu_style', $block_id, $tax_menu_styles, $tax_menu_style); 
			?>
			
			<label for="<?php echo $this->get_field_id('sorting') ?>">Show sorting dropdown ?</label><br />
			<?php echo aq_field_checkbox('sorting', $block_id, $sorting); ?>
			
		
		</div>
		
		<div class="description fourth last">
		
			<label for="<?php echo $this->get_field_id('total_items') ?>">Total items</label><br />
			<?php echo aq_field_input('total_items', $block_id, $total_items, $size="min"); ?>
			
			<p class="description">If empty, all items will e showed.</p>
		
			<div class="clearfix clear"></div>

			<label for="<?php echo $this->get_field_id('in_row') ?>">In one row</label>
			<?php
			$in_row_array = array(
				'1'	=> '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5'
				
				);
			echo aq_field_select('in_row', $block_id, $in_row_array, $in_row);
			?>
		</div>
		

		
		<div class="clearfix"></div>
		
		<p class="description">"Custom image size" overrides "Image Format" (registered image sizes) settings. Use both width and height value.</p>
		
		<hr />		

			
		
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
			If either of these two fields are empty, the button "more" button won't show.
		</div>
		
	<?php
	
	}
	
	function block($instance) {
		
		global $post, $product, $cypress_woo_is_active, $woocommerce_loop, $wp_query, $woocommerce;
		
	
		extract($instance);
		
		if( $cypress_woo_is_active ) {
		
		$grid = round( 100 / $in_row );
		$sticky_array = get_option( 'sticky_posts' );
		$total_items = $total_items ? $total_items : -1;
		
		
		// SET POST TYPE VARIABLE
		$post_type = 'product';
		
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
		
		
		// BEGIN HTML:
		
		echo $subtitle ? '<div class="block-subtitle '. $title_style .' above">' . $subtitle . '</div>' : ''; 
		
		echo $title ? '<h2 class="categories-block block-title '. $title_style .'">' . $title . '</h2>' : '';
		
		echo '<div class="shuffle-filter-holder">';
		
		
		if( $tax_terms && $tax_menu_style != 'none') {
				
			echo $tax_menu_style == 'dropdown' ?'<div class="menu-toggler block-tax-toggler"><a href="#" title="'.__('Toggle categories','cypress').'" class="button iconized-button"><span class="fs" data-icon="&#xe05a;"></span></a></div>' : null;
			?>
			
			<ul class="taxonomy-menu<?php echo $tax_menu_style == 'dropdown' ? ' tax-dropdown' : null; ?> tax-filters">
			
			<li class="all category-link"><a href="#" class="active"><div class="term"><?php echo __('All','cypress'); ?></div></a></li>
			
			<?php
			// GET TAXONOMY OBJECT:
			$term_Objects = array();
			foreach ( $tax_terms as $term ) {
				$term_Objects[] = get_term_by( 'slug', $term, $taxonomy );
			}
			// DISPLAY TAXONOMY MENU:
			foreach ( $term_Objects as $term_obj ) {
			
				echo '<li class="'.$term_obj->slug .' category-link" id="cat-'.$term_obj->slug .'">';
				echo '<a href="#" data-group="'. $term_obj->slug .'">';
				echo '<div class="term">' . $term_obj->name . '</div>';
				echo '</a>';
				echo '</li>';
				
			}
			?>
			</ul>
			
		<?php } // endif $tax_terms ?>

		<?php if( $sorting ) {?>
		<div class="sort-holder">	
			<select class="sort-options">
				<option value=""><?php echo __('Default sorting','cypress'); ?></option>
				<option value="title"><?php echo __('Sort by Title ','cypress'); ?></option>
				<option value="date-created"><?php echo __('Sort by Date Created','cypress'); ?></option>
			</select>
		</div>
		<?php }; ?>
		
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
		?>
		
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
		
		$order_random = ($filters == 'random') ? 'rand ' : '';
		
		$main_args = array(
			'no_found_rows'		=> 1,
			'post_status'		=> 'publish',
			'post_type'			=> $post_type,
			'post_parent'		=> 0,
			'suppress_filters'	=> false,
			'orderby'			=> $order_rand ? 'rand menu_order date' : 'menu_order date',
			'order'				=> 'DESC',
			'numberposts'		=> $total_items
		);
		
		$all_args = array_merge( $main_args, $args_filters, $tax_filter_args );

		$content = get_posts($all_args);

		?>	
			
		<div id="<?php echo $block_id; ?>" class="content-block cb-4">
			
		
			<ul class="category-content shuffle">
			
			<?php 
	
			$i = 1;
			/* even/odd for unsemantic - to do
			if( count( $content ) == 1 ) {
				$oe = '100';
			}elseif( $in_row % 2 == 0 ){ // more then 1 item and even
				$oe = '50';
			}else{		// more then 1 item and odd
				$oe = '33';
			};	
			*/
			
			if( count( $content ) == 1 || $in_row == 1) {
				$t_grid = '100';
			}else{
				$t_grid = '50';
			}
			
			//start products loop
			foreach ( $content as $post ) {
								
				setup_postdata( $post );
				
				global $product;
				
				// GET LIST OF ITEM CATEGORY (CATEGORIES) for FILTERING jquery.shuffle
				$terms = get_the_terms( $post->ID, $taxonomy );
				if ( $terms && ! is_wp_error( $terms ) ) : 
					$terms_str = '[';
					$t = 1;
					foreach ( $terms as $term ) {
						$zarez = $t >= count($terms) ? '' : ',';
						$terms_str .= '"'. $term->slug . '"' . $zarez; 
						$t++;
					}
					$terms_str .= ']';
				else :
					$terms_str = '';
				endif;
				
				?>
					
				
				<li class="grid-<?php echo $grid ? $grid : '50'; ?> item scroll tablet-grid-<?php echo $t_grid; ?> mobile-grid-100 <?php  echo ' '.$block_style; ?>" data-id="id-<?php echo $i;?>" <?php echo $terms_str ? 'data-groups='. $terms_str. ''  : null ; ?> data-date-created="<?php echo get_the_date( 'Y-m-d' ); ?>" data-title="<?php echo esc_attr(get_the_title());?>">
					
					<?php
						if( defined('WPML_ON') ) { // if WPML plugin is active
							$id			= icl_object_id( get_the_ID(), 'product', false, ICL_LANGUAGE_CODE ); 
							$lang_code	= ICL_LANGUAGE_CODE;
						}else{
							$id			= get_the_ID();
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
							$imgSizes = all_image_sizes();
							$img_width = $imgSizes[$img_format]['width'];
							$img_height = $imgSizes[$img_format]['height'];
						}
						// end DATA
						
						$prod_title = '<h4><a href="'. $link .'" title="'.esc_attr(get_the_title()).'"> ' . esc_attr(get_the_title()) .'</a></h4>';
						
						?>
				
						<div class="item-images">
						
							<?php 
							
							if( $shop_assets == 'product_buttons' ) { 
								
								do_action( 'woocommerce_after_shop_loop_item' ); 
							
							}elseif( $shop_assets ==  'quick_view' ) {
								
								echo '<div class="quick-view-holder"><a href="#qv-holder" class="button quick-view"   title="'. esc_attr(strip_tags(get_the_title())) .'" data-id="'.$id.'"  data-lang="'. $lang_code .'">'.__('Quick view','cypress').'</a>';
								
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
									
									<?php echo ( $block_style == 'style4' ) ? $prod_title : null; ?>

									<?php function_exists('woocommerce_show_product_loop_sale_flash') ? woocommerce_show_product_loop_sale_flash() : '';
									
									echo as_image( $img_format ); ?>
									
								
								</div>
								
								<div class="back">
								
									<div class="item-overlay"></div>
									
									<?php 
									if( $block_style == 'style1' ) {
										echo $prod_title; 
										woocommerce_template_loop_price();
										function_exists('woocommerce_template_loop_rating') ? woocommerce_template_loop_rating() : '';
									}elseif( $block_style == 'style4' ){
										woocommerce_template_loop_price();
									}
									?>
									
									<?php 
									// backimage for flipping effect
									if ( $attachment_ids ) {
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
						
						</div><!-- /.item-images -->
						
						<?php if( $shop_assets =='product_buttons' || $shop_assets == 'quick_view') { ?>
						
						<div class="item-text">
						
							<?php
							if( $block_style == 'style2' || $block_style == 'style3' ) {
								
								echo $prod_title; 
								
								woocommerce_template_loop_price();
								
								function_exists('woocommerce_template_loop_rating') ? woocommerce_template_loop_rating() : '';
							
								echo apply_filters( 'woocommerce_short_description', $post->post_excerpt );
							
							}
							
							
							/**
							 *	TEMPORARY DISABLED
							 *
							// IF THERE IS YITH WOOCOMPARE PLUGIN ACTIVATED:
							if( defined( 'YITH_WOOCOMPARE' ) ) {
									
								echo '<div class="compare-holder"><span class="icon-file icon"></span>';
								echo '<div class="hover-box">';
								
								$as_compare = new YITH_Woocompare_Frontend; // class in woocommerce-theme-edits.php
									echo $as_compare->compare_button_sc( $atts = '' );
									
								echo '<div class="arrow-down"></div></div></div>';
								
							}
								
							echo ( defined( 'YITH_WCWL' )  || defined( 'YITH_WOOCOMPARE' ) ) ? '</div>' : null;
							*/
							echo '<div class="clearfix"></div>';
							
							?>
							
						</div>
						
						<?php }; ?>
				
				</li>
				
				<?php 
				$i++;
			}// END foreach
			
			wp_reset_query();
			
			?>
			</ul>
					
			<?php if( $more_link_text && $more_link_url ) { ?>
			<div class="bottom-block-link">
			
				<a href="<?php echo $more_link_url ; ?>" title="<?php echo esc_attr($more_link_text); ?>" class="button">
					<?php echo esc_html($more_link_text); ?>
				</a>
				
			</div>
			<?php } //endif; $more_link_text ?>
			
			<div class="clearfix"></div>
			
		</div><!-- .content-block .cb-4 -->
		
		<?php echo '</div>';// end div.shuffle-filter-holder ?>
		
		<?php
	
		}else{
			echo '<h5 class="no-woo-notice">' . __('FILTERED PRODUCTS BLOCK DISABLED.<br> Sorry, it seems like WooCommerce is not active. Please install and activate last version of WooCommerce.','cypress') . '</h5>';
				return;
		} // if $cypress_woo_is_active
	
	}/// END func block
	
	function update($new_instance, $old_instance) {
		return $new_instance;
	}
} ?>