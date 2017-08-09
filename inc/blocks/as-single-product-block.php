<?php

class AS_Single_Product_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Single Product',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('as_single_product_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'title'				=> '',
			'subtitle'			=> '',
			'title_style'		=> 'center',
			'img_format'		=> 'medium',
			'slider_navig'		=> true,
			'slider_pagin'		=> true,
			'slider_timing'		=> '',
			'transition'		=> '',
			'style'				=> 'float_right',
			'back_color'		=> '#e8e8e8',
			'opacity'			=> '100',
			'product_options'	=> 'reduced',
			'more_link_text'	=> '',
			'more_link_url'		=> '',
			'single_product'	=> ''
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
			$title_styles = array(
				'center'		=> 'Center',
				'float_left'	=> 'Float left',
				'float_right'	=> 'Float right'
				);
			echo aq_field_select('title_style', $block_id, $title_styles, $title_style); 
			?>	
		</div>
		
		<hr>
		<div class="clearfix"></div>	
		
		<div class="description third">
			
			<label for="<?php echo $this->get_field_id('img_format') ?>">Image format</label>
			<br/>
			<?php
			$img_format_arr = array(
				'thumbnail'		=> 'Thumbnail',
				'medium'		=> 'Medium',
				'as-portrait'	=> 'Cypress portrait',
				'as-landscape'	=> 'Cypress landscape',
				'large'			=> 'Large'
				);
			echo aq_field_select('img_format', $block_id, $img_format_arr, $img_format); 
			?>
			
			<div class="clearfix clear"></div>
			
			<label for="<?php echo $this->get_field_id('slider_pagin') ?>">Image gallery pagination</label><br />
			<?php echo aq_field_checkbox('slider_pagin', $block_id, $slider_pagin); ?>
			
			<div class="clearfix clear"></div>
					
			<label for="<?php echo $this->get_field_id('slider_navig') ?>">Image gallery navigation</label><br />
			<?php echo aq_field_checkbox('slider_navig', $block_id, $slider_navig); ?>
			
			<div class="clearfix clear"></div>
					
			<label for="<?php echo $this->get_field_id('slider_timing') ?>">Image gallery timing</label><br />
			<?php echo aq_field_input('slider_timing', $block_id, $slider_timing, $size = 'min');	?>
			
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
		
		<div class="description third">
		
			<label for="<?php echo $this->get_field_id('style') ?>">Style</label>
			<br/>
			<?php
			$style_arr = array(
				'float_left'=> 'Float left',
				'float_right' => 'Float right',
				'centered' => 'Centered'
				);
			echo aq_field_select('style', $block_id, $style_arr, $style); 
			?>
			
			<p class="description"><strong>If "Centered", product image will be removed</strong>, product data (title, price, description etc.) will be display centered - for product image <strong>use row background image</strong></p>
			
			
			<label for="<?php echo $this->get_field_id('back_color') ?>">Background color
			</label><br />
			<?php echo aq_field_color_picker('back_color', $this->block_id, $back_color, $back_color) ?>
			
			<div class="clearfix clear"></div>
					
			<label for="<?php echo $this->get_field_id('opacity') ?>">Background color opacity</label><br />
			<?php echo aq_field_input('opacity', $block_id, $opacity, $size = 'min');	?> %
		
		
		</div>		
		
		<div class="description third last">
			<label for="<?php echo $this->get_field_id('product_options') ?>">
				Product options display
			</label>	<br/>
			<?php
			$options_array = array(
				'reduced'	=> 'Reduced product options',
				'full'		=> 'Full product options'
				
				);
			echo aq_field_select('product_options', $block_id, $options_array, $product_options); 
			?>
			
			<p class="description">Choose to display reduced options (as in products page), or full product options (as in single product page).</p>
			
		</div>
		
		
		<div class="clearfix clear"></div>
		<hr />	

<?php /// GET TAXONOMIES FOR FILTERING ?>
		
	
								
		<p class="description third last">
			<label for="<?php echo $this->get_field_id('single_product') ?>">
				Select one of the products :
			</label>	<br/>
				<?php
				$args = array(
					'post_type' => 'product',
					'posts_per_page' => -1,
					'suppress_filters' => true
				);
				$products_arr = array();  
				$products_obj = get_posts($args);
				if ( $products_obj ) {
					foreach( $products_obj as $prod ) {
						
						$products_arr[$prod->ID] = $prod->post_title  ;
					}
				}else{
					$products_arr[0] = '';
				}
				echo aq_field_select('single_product', $block_id, $products_arr, $single_product); 
				?>
		</p>	
		
		<div class="clearfix clear"></div>
		
		<hr />	
		
	<?php
	
	}
	
	function block($instance) {
		
		global $post, $cypress_woo_is_active, $product, $wp_query, $woocommerce;
		
		extract($instance);
		
		if ( $cypress_woo_is_active ) {
		
		
		$display_args = array(
			'no_found_rows'		=> 1,
			'post_status'		=> 'publish',
			'post_type'			=> 'product',
			'post_parent'		=> 0,
			'suppress_filters'	=> false,
			'numberposts'		=> 1,
			'include'			=> $single_product
		);
		
		$content = get_posts($display_args);
		
		$opacity = $opacity / 100;
		
		if( $style == 'float_right') {
			$arrow_color = 'border-left-color:rgba('.hex2rgb( $back_color ).','.$opacity.')  !important;' ;
		}elseif( $style == 'float_left'){
			$arrow_color = 'border-right-color:rgba('.hex2rgb( $back_color ).','.$opacity.')  !important;' ;
		}else{
			$arrow_color = null;
		}
		
		// Enqueue variation scripts
		wp_enqueue_script( 'wc-add-to-cart-variation' );
		
		
		echo '<style>';
		if( $back_color ) {
			if( $style == 'centered') {
				echo '#'.$block_id.' .item-text { background-color: rgba('.hex2rgb( $back_color ).','.$opacity.') !important;}';
			}else{
				echo '#'.$block_id.' { background-color: rgba('.hex2rgb( $back_color ).','.$opacity.') !important;}';
			}
			
			echo '#'.$block_id.'.single-product-block .arrow { '. $arrow_color .' ; opacity: 1 !important; }';
		}
		
		echo '</style>';
		
		echo $subtitle	? '<div class="block-subtitle '. $title_style .'">' . $subtitle . '</div>' : ''; 
		echo $title		? '<h2 class="block-title '. $title_style .'">' .$title.'</h2>' : ''; 
		?>	
		
		<div id="<?php echo $block_id; ?>" class="content-block single-product-block inner-wrapper product <?php echo $style; ?>">
			
			<?php 			
			foreach ( $content as $post ) {
			
				setup_postdata( $post );
				
				global $product;

				$id = get_the_ID();
				$link = get_permalink($id);
				
				// GET ATTACHED PRODUCT IMAGE (FIRST FROM GALLERY)FOR BACK IMAGE (FLIP)
				
				// 3.0.0 < Fallback conditional
				if( apply_filters( 'cypress_wc_version', '3.0.0' )	) {
					$attachment_ids   = $product->get_gallery_image_ids();
				}else{
					$attachment_ids   = $product->get_gallery_attachment_ids();
				}
				
				if ( $attachment_ids ) {
					$image_url = wp_get_attachment_image_src( $attachment_ids[0], 'large'  ); // first image
					$img_url = $image_url[0];
					$imgSizes = all_image_sizes(); // as custom fuction
					$img_width = $imgSizes[$img_format]['width'];
					$img_height = $imgSizes[$img_format]['height'];
				}
				
				?>
				
																	
				<?php function_exists('woocommerce_show_product_loop_sale_flash') ? woocommerce_show_product_loop_sale_flash() : '';
				
				/* if( $product_options == 'full' ) {
					do_action( 'woocommerce_before_single_product' );
				} */
				?>					
					
				<?php if( $style != 'centered' ) {  ?>
				<div class="images-holder">
								
					<?php if( $style == 'float_right') { ?>
						<div class="arrow arrow-right"></div>						
					<?php }elseif( $style == 'float_left'){ ?>
						<div class="arrow arrow-left"></div>	
					<?php } ?>
					
					<input type="hidden" class="slides-config" data-navigation="<?php echo $slider_navig; ?>" data-pagination="<?php echo $slider_pagin; ?>" data-auto="<?php echo $slider_timing; ?>" <?php echo ($transition != 'none') ? 'data-trans="'.$transition.'"' : ''; ?> />
					
					<?php do_action( 'do_single_product_images', $img_format );	?>
					
				</div>
				<?php } ?>
				
				<div class="item-text">
				
					<div class="wrap">
					
					<h2><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($post->post_title); ?></a></h2>
					
					<?php
					// REDUCED PRODUCT OPTIONS (AS IN CATALOG)
					if( $product_options == 'reduced' ) {
					
						echo '<div class="reduced">';
						
						if ( $post->post_excerpt ) {
						?>
							<div itemprop="description" class="description">
							
								<?php echo apply_filters( 'woocommerce_short_description', substr( strip_shortcodes($post->post_excerpt), 0, 200 ) . ' ...' );
								
								do_action('as_wishlist_button');?>
								
							</div>
						
						<?php }
						
						woocommerce_template_loop_price();
						
						echo '<div class="clearfix"></div>';
						
						do_action( 'woocommerce_after_shop_loop_item' );
						
						echo '</div>';
						
					}else{
					// FULL PRODUCT OPTIONS (AS IN SINGLE PRODUCT PAGE)
						//add_action('woocommerce_single_product_summary', 'do_wishlist', 35);
						do_action( 'woocommerce_single_product_summary' );
					}
					
					
					if( ! function_exists('do_wishlist') ) {
						function do_wishlist() {
							do_action('as_wishlist_button');
						}						
					} 
					?>
					
					</div>
				
				</div>
				
				<div class="clearfix"></div>
					
						
			
			<?php }// END foreach ?>


		</div><!-- /.content-block single-product-block -->
		

		<?php
	
		}else{
			echo '<h5 class="no-woo-notice">' . __('SINGLE PRODUCT BLOCK DISABLED.<br> Sorry, it seems like WooCommerce is not active. Please install and activate last version of WooCommerce.','cypress') . '</h5>';
				return;
		} // if $cypress_woo_is_active
		
	}/// END func block
	
	function update($new_instance, $old_instance) {
		return $new_instance;
	}
} ?>