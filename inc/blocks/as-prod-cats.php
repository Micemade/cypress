<?php
/**
 *	AS_Product_Categories.
 *
 *	block and class for displaying product categories.
 */
class AS_Product_Categories extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Product categories',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('as_product_categories', $block_options);
	}
	
	function form($instance) {
		
		global $cypress_woo_is_active;
		
		$defaults = array(
			'title'				=> '',
			'subtitle'			=> '',
			'title_style'		=> 'center',
			'img_width'			=> 300,
			'img_height'		=> 180,
			'prod_cat_menu'		=> 'images',
			'menu_columns'		=> 'stretch',
			'product_cats'		=> '',
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
		
		<div class="description third">
			
			<label for="<?php echo $this->get_field_id('product_cats') ?>">Product categories:</label><br/>
			<?php
			if( $cypress_woo_is_active ) {
				$product_cats_arr = array();  
				$product_cats_obj = get_terms('product_cat','hide_empty=0&hierarchical=true');
				if ($product_cats_obj) {
					foreach ($product_cats_obj as $product_cat) {
						$product_cats_arr[$product_cat->slug]= $product_cat->name ;
					}
				}else{
					$product_cats_arr = array();
				}
				echo aq_field_multiselect('product_cats', $block_id, $product_cats_arr, $product_cats); 
			}else{
				echo '<p class="description">WooCommerce plugin is not active. Please, activate it to use product categories.</p>';
			}
			?>
			
			
		</div>
		
		
		<div class="description third">
		
			
			<label for="<?php echo $this->get_field_id('prod_cat_menu') ?>">Categories menu</label><br />
			<?php
			$prod_cat_menu_arr = array(
				'images'		=> 'With category images',
				'no_images'		=> 'Without category images',
				);
			echo aq_field_select('prod_cat_menu', $block_id, $prod_cat_menu_arr, $prod_cat_menu); 
			?>
			
			<div class="clearfix"></div>
			
			<label for="<?php echo $this->get_field_id('menu_columns') ?>">Menu columns</label><br />
			<?php
			$menu_columns_arr = array(
				'stretch'	=> 'Auto stretch',
				'auto'		=> 'Auto float',
				'1'			=> '1',
				'2'			=> '2',
				'3'			=> '3',
				'4'			=> '4',
				'6'			=> '6'
				);
			echo aq_field_select('menu_columns', $block_id, $menu_columns_arr, $menu_columns); 
			?>
			
		</div>
		
		
		<div class="description third last">			
					
			<label for="<?php echo $this->get_field_id('img_width') ?>">Image width</label><br />
			<?php echo aq_field_input('img_width', $block_id, $img_width, $size = 'min');	?>
			
			<div class="clearfix"></div>
			
			<label for="<?php echo $this->get_field_id('img_height') ?>">Image height</label><br />
			<?php echo aq_field_input('img_height', $block_id, $img_height, $size = 'min');	?>
			
			<div class="clearfix"></div>
		
		</div>
		
							
		
		<div class="clearfix clear"></div>
		
		

	<?php
	
	}
	
	function block($instance) {
		
		global $post, $cypress_woo_is_active, $product, $woocommerce_loop, $wp_query, $woocommerce;
		
		extract($instance);
		
		if( $cypress_woo_is_active ) {
				
		
		//
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
		
		<?php if( $tax_terms ) { ?>
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
		
		$img_width	= $img_width ? $img_width : 300;
		$img_height = $img_height ? $img_height : 180;
		
		
		// DISPLAY TAXONOMY MENU:
		foreach ( $term_Objects as $term_obj ) {
			
			$term_link = get_term_link( $term_obj->slug, 'product_cat' );
			
			if( $prod_cat_menu == 'images' ) { // if images should be displayed:
			
				$thumbnail_id = get_woocommerce_term_meta( $term_obj->term_id, 'thumbnail_id' );
				$image = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail' );

				if ( $image ) {
		
					echo '<li id="cat-'.$term_obj->term_id .'" class="category-image'. $grid_cat .' as-hover">';
					echo '<a href="'.$term_link.'" class="'.$term_obj->slug .'" data-id="'. $term_obj->slug .'">';
					echo '<div class="item-overlay"></div>';
					echo '<div class="term">' . $term_obj->name . '</div>';
					echo '<img src="' . fImg::resize( $image[0] , $img_width, $img_height, true  ). '" alt="" />';
					echo '<div class="arrow-down"></div></a>';
					echo '</li>';
				}else{
					echo '<li id="cat-'.$term_obj->term_id .'" class="category-image'. $grid_cat .' mobile-grid-50 as-hover">';
					echo '<a href="'.$term_link.'" class="'.$term_obj->slug .'" data-id="'. $term_obj->slug .'">';
					echo '<div class="item-overlay"></div>';
					echo '<div class="term">' . $term_obj->name . '</div>';
					echo '<img src="' . fImg::resize( PLACEHOLDER_IMAGE , $img_width, $img_height, true  ). '" alt="" />';
					echo '<div class="arrow-down"></div></a>';
					echo '</li>';
				}
				
			}elseif( $prod_cat_menu == 'no_images' ){
			
				echo '<li id="cat-'.$term_obj->term_id .'" class="category-link'. $grid_cat .' mobile-grid-50">';
				echo '<a href="'.$term_link.'" class="'.$term_obj->slug .'" data-id="'. $term_obj->slug .'">';
				echo '<div class="term">' . $term_obj->name . '</div>';
				echo '</a>';
				echo '</li>';
				
			}
		
		}

		?>
		</ul>
		
		<?php }// endif $tax_terms ?>
	
		
		<?php
	
		}else{
		
			echo '<h5 class="no-woo-notice">' . __('PRODUCT CATEGORIES BLOCK DISABLED.<br> Sorry, it seems like WooCommerce is not active. Please install and activate last version of WooCommerce.','cypress') . '</h5>';
				return;
		} // if $cypress_woo_is_active
	
	}/// END func block
	
	function update($new_instance, $old_instance) {
		return $new_instance;
	}
} ?>