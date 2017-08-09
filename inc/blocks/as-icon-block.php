<?php
/** Notifications block **/

if(!class_exists('AS_Icon_Block')) {
	class AS_Icon_Block extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Icon block',
				'size' => 'span4',
			);
			
			//create the block
			parent::__construct('as_icon_block', $block_options);
		}
		
		function form($instance) {
			
			
			$defaults = array(
				'title'			=> '',
				'content'		=> '',
				'icon'			=> '&#x21;',
				'icon_size'		=> '2', // em
				'icon_padding'	=> '5', // %
				'icon_color'	=> '#999',
				'border_size'	=> '0', // px
				'border_color'	=> '#999',
				'border_radius'	=> '0', //px
				'background'	=> '#fff',
				'transparent'	=> false,
				'layout_style'	=> 'centered',
				'block_color'	=> '#eee',
				'block_opacity'	=> '100',
				'block_border'	=> 'solid',
				'no_hover'		=> false,
				'content'		=> '',
				'wp_autop'		=> 0,
				'button_text'	=> '',
				'button_url'	=> ''
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			?>

			<div class="description half icon-field">
				
				<div class="icon-glyph">
				
					<label for="<?php echo $this->get_field_id('icon') ?>"></label>
					<?php echo as_hidden_input('icon', $block_id, $icon, $type = 'hidden')?>
				
				</div>
				
				<div class="preview-box-holder">
					
					<?php 
					$box_inl_style  = 'style="';
					$box_inl_style .= $block_color ? 'background-color:'. $block_color.'; ' : null;
					$box_inl_style .= $block_opacity ? 'opacity:'. $block_opacity/100 .'; ' : null;
					$box_inl_style .= '"';
					?>
					
					<div class="preview-box" <?php echo $box_inl_style; ?>>
					
					<?php
					$inline_style  = 'style=" ';
					$inline_style .= $icon_size ? 'font-size: '.$icon_size.'em; ' : null;
					$inline_style .= $icon_color ? 'color: '.$icon_color.'; ' : null;
					$inline_style .= $border_size ? 'border-width: '.$border_size.'px; ' : 'border-width:0px;';
					$inline_style .= $border_color ? 'border-color: '.$border_color.'; ' : null;
					$inline_style .= $border_radius ? 'border-radius: '.$border_radius.'px; ' : null;
					$inline_style .= ($background && !$transparent) ? 'background-color: '.$background.'; ' : null;
					$inline_style .= $icon_padding ? 'padding: '.$icon_padding.'px; ' : null;
					$inline_style .= '"';
					?>
						
						<div class="fs1" aria-hidden="true" data-icon="<?php echo $icon; ?>" <?php echo $inline_style; ?> data-backcolor="<?php echo $background; ?>"></div>
					
					</div>
				</div>
				
				<hr class="clearfix" />
				
				<a href="#" class="toggle-icon-controls button" rel="image">Colors and sizes show/hide</a>
				<div class="clearfix"></div>
				
				<?php 
				/**
				*	ICON PROPERTIES CONTROL
				*
				*	important: css classes slider-control and icon-size(padding etc.) 
				*	needed for live icon preview. Needed for colorpicker and slider
				*	icon properties size, padding, and color (icon, back and border)
				*
				*	JS file controlling is aqpb-fields.js in theme inc/blocks direcory
				*
				*/
				
				// ICON SIZES CONTROLS : ?>
				
				<div class="slider-controls half icon-size">
					
					<label for="<?php echo $this->get_field_id('icon_size') ?>">Icon size <span><?php echo $icon_size . 'em'; ?></span></label>
					
					<?php echo as_hidden_input('icon_size', $block_id, $icon_size, $type = 'hidden')?>
					
					<div class="slider-for-icon"></div>

				</div>
						
				<div class="slider-controls half icon-padding">
				
					<label for="<?php echo $this->get_field_id('icon_padding') ?>">Icon padding <span><?php echo $icon_padding . 'px'; ?></span></label>
					
					<?php echo as_hidden_input('icon_padding', $block_id, $icon_padding, $type = 'hidden')?>
					
					<div class="slider-for-icon"></div>
					
				</div>				
						
				<div class="slider-controls half border-width">
				
					<label for="<?php echo $this->get_field_id('border_size') ?>">Border size <span><?php echo $border_size . 'px'; ?></span></label>
					
					<?php echo as_hidden_input('border_size', $block_id, $border_size, $type = 'hidden')?>
					
					<div class="slider-for-icon"></div>
					
				</div>
				
				
				<div class="slider-controls half border-radius">
					
					<label for="<?php echo $this->get_field_id('border_radius') ?>">Border radius <span><?php echo $border_radius . 'px'; ?></span></label>
					
					<?php echo as_hidden_input('border_radius', $block_id, $border_radius, $type = 'hidden')?>
					
					<div class="slider-for-icon"></div>

				</div>
			
				
				<?php // ICON COLOR CONTROLS :?>
				
				
				<div class="slider-controls icon-color">
				
					<label for="<?php echo $this->get_field_id('icon_color') ?>">
					<?php echo __('Icon color','cypress'); ?>
					</label>
					<?php echo aq_field_color_picker('icon_color', $block_id, $icon_color ) ?>	

				</div>
				
				<div class="slider-controls icon-border-color">
				
					<label for="<?php echo $this->get_field_id('border_color') ?>">
					<?php echo __('Border color','cypress'); ?>
					</label>
					<?php echo aq_field_color_picker('border_color', $block_id, $border_color ) ?>
				
				</div>
				
				<div class="slider-controls icon-background-color">

					<label for="<?php echo $this->get_field_id('background') ?>">
					<?php echo __('Icon background color','cypress'); ?>
					</label>
					<?php echo aq_field_color_picker('background', $block_id, $background ) ?>
					
				</div>

				<div class="slider-controls icon-transparent">
			
					<label for="<?php echo $this->get_field_id('transparent') ?>">No icon background ?</label>
					<?php echo aq_field_checkbox('transparent', $block_id, $transparent); ?>
					
				</div>
				
				<hr class="clearfix" />
				
				<div class="slider-controls block-background-color">
				
					<label for="<?php echo $this->get_field_id('block_color') ?>">Block background color
					</label>
					<?php echo aq_field_color_picker('block_color', $block_id, $block_color, $block_color) ?>
				</div>
				
				<div class="slider-controls half block-opacity">
					
					<label for="<?php echo $this->get_field_id('block_opacity') ?>">Block opacity <span><?php echo $block_opacity ; ?></span></label>
					
					<?php echo as_hidden_input('block_opacity', $block_id, $block_opacity, $type = 'hidden')?>
					
					<div class="slider-for-icon"></div>

				</div>
				
				<div class="slider-controls block-no-hover">
			
					<label for="<?php echo $this->get_field_id('no_hover') ?>">Disable hover effect</label>
					<?php echo aq_field_checkbox('no_hover', $block_id, $no_hover); ?>
					
				</div>
				
				<hr>
				<div class="clearfix"></div>
				
				<label for="<?php echo $this->get_field_id('block_border') ?>">Block border style</label><br/>	
				<?php
				$border_arr = array(
					'none'		=> 'None',
					'solid'		=> 'Solid',
					'dashed'	=> 'Dashed',
					'dotted'	=> 'Dotted',
					'double'	=> 'Double'
					);
				echo aq_field_select('block_border', $block_id, $border_arr, $block_border); 
				?>
				
				<p class="clearfix description slider-controls">NOTE: To control font color, icon block can be placed inside ROW block and control font colors from ROW block settings.</p>
				
			</div>
			

			<a href="#" class="toggle-icon-choice button" rel="image">Icons show/hide</a>
			
			<div class="description half icons-controls">
				
				<div class="glyphs">
				
					<?php include('as-icon-glyphs-html.php'); ?>
				
				</div>
				
			</div>	
			
			
			
			<a href="#" class="toggle-layout-text button" rel="image">Layout, text show/hide</a>	
		
			
			<div class="description half layout-text-controls">
				
				<label for="<?php echo $this->get_field_id('layout_style') ?>">Layout style</label><br/>
					
				<?php 
				$layout_style_options = array(
					'centered'		=> 'Centered',
					'float_left'	=> 'Float left',
					'float_right'	=> 'Float right',
				);
				echo aq_field_select('layout_style', $block_id, $layout_style_options, $layout_style) ?>
				
				
				<label for="<?php echo $this->get_field_id('title') ?>">
					Title (optional)<br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			
				<label for="<?php echo $this->get_field_id('content') ?>">
					Icon Block Text<br/>
					<?php echo aq_field_textarea('content', $block_id, $content) ?>
				</label>
	
				<div class="clearfix"></div>
				
				<label for="<?php echo $this->get_field_id('wp_autop') ?>">
				<?php echo aq_field_checkbox('wp_autop', $block_id, $wp_autop) ?>
				Do not create the paragraphs automatically. <code>"wpautop"</code> disable.
				</label>
				<br/>
				
			
				<label for="<?php echo $this->get_field_id('button_text') ?>">Button text</label>
				<?php echo aq_field_input('button_text', $block_id, $button_text, $size = 'full') ?>

				
				<label for="<?php echo $this->get_field_id('button_url') ?>">Button link</label>
				<?php echo aq_field_input('button_url', $block_id, $button_url, $size = 'full') ?>
				
				<p class="description clearfix">To display button, BOTH button text and button link must be entered.</p>
				
				<p class="description clearfix">If only button link is entered, the link will be applied TO ICON</p>
			
			</div>	
			
			
			<?php
			
		}
		
		function block($instance) { // frontend output
			extract($instance);
	
			
			$css = '<style>#icon-'. $block_id .' .fs1 {' ;
			$css .= $icon_size ? 'font-size: '.$icon_size.'em; ' : null;
			$css .= $icon_color ? 'color: '.$icon_color.'; ' : null;
			$css .= $border_size ? 'border-width: '.$border_size.'px; ' : 'border-width:0px;';
			$css .= $border_color ? 'border-color: '.$border_color.'; ' : null;
			$css .= $border_radius ? 'border-radius: '.$border_radius.'px; ' : null;
			$css .= ($background && !$transparent) ? 'background-color: '.$background.'; ' : null;
			$css .= $icon_padding ? 'padding: '.$icon_padding.'px; ' : null;
			$css .= 'border-style: solid;';
			$css .= '}';
			$css .= '#icon-block-'. $block_id .'{ background-color: '. ($block_color ? $block_color : 'transparent') .';';
			$css .= $block_opacity ? 'opacity: '. $block_opacity/100 .'; filter: alpha(opacity='.$block_opacity.');' : null;
			
			$css .= '}'; //end of selector #icon-$block_id .fs1
			
			
			$double_border = ($block_border == 'double') ? 'border-width: 4px;' : null;
			$css .='#icon-block-'.$block_id.':before { border-style: '.$block_border.'; '.$double_border.'  }';
			$css .= '</style>';
			
			echo $css;
			?>
			
			<div id="icon-block-<?php echo $block_id;?>" class="icon-block inner-wrapper<?php echo $layout_style ? ' ' . $layout_style : null; echo !$no_hover ? ' icon-hover' : ''; ?> as-hover">
			
				<div id="icon-<?php echo $block_id;?>" class="icon-block-table">
					<div class="icon-block-cell">
						
						<?php echo (!$button_text && $button_url) ? '<a href="'. esc_url($button_url) .'">': null; ?>
						<div class="fs1" aria-hidden="true" data-icon="<?php echo $icon; ?>"></div>
						<?php echo (!$button_text && $button_url) ? '</a>': null; ?>
				
					</div>
				</div>
				
				<?php
				
				if ( $title || $content ) {
				
				echo '<div class="icon-block-text">';
				
				echo $title ? '<h4>'.$title.'</h4>' : null;

				//echo $content ? '<p>'. do_shortcode(htmlspecialchars_decode($content)) .'</p>' : null;
				
				echo $content ? '<div class="content">' : null; 

					$wp_autop = ( isset($wp_autop) ) ? $wp_autop : 0;
					if( $wp_autop == 1 ){
						echo do_shortcode(htmlspecialchars_decode($content));
					}
					else {
						echo wpautop(do_shortcode(htmlspecialchars_decode($content)));
					}
					
				echo $content ? '</div>' : null; 
				
				
				if( $button_text && $button_url ) {
				
					echo '<a href="'. esc_url($button_url) .'" class="button">'.$button_text.'</a>';
					
				}
				echo '</div>';
				
				}
				?>
			
				<div class="clearfix"></div>
			
			</div>
			
			<?php 
	
		}// function block()
		
	} // class AS_Icon_Block
}