<?php
/** A simple text block **/
class AS_Headings_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name'	=> 'Headings',
			'size'	=> 'span12',
		);
		
		//create the block
		parent::__construct('as_headings_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'title'			=> '',
			'h_size'		=> 'h2',
			'subtitle'		=> '',
			'sub_position'	=> 'above',
			'title_style'	=> 'center'
			
		);
		
		$h_options = array(
			'h1' => 'Heading 1',
			'h2' => 'Heading 2',
			'h3' => 'Heading 3',
			'h4' => 'Heading 4',
			'h5' => 'Heading 5',
			'h6' => 'Heading 6',
		);
		
		$sub_options = array(
			'above'		=> 'Above heading',
			'bellow'	=> 'Bellow heading',
		);
		
		
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		?>
		<div class="description third">
		
			<label for="<?php echo $this->get_field_id('title') ?>">Heading text</label><br />
				
			<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			
		</div>
		
		<div class="description third">
		
			<label for="<?php echo $this->get_field_id('h_size') ?>">
			Pick a heading size</label><br/>
			
			<?php echo aq_field_select('h_size', $block_id, $h_options, $h_size, $block_id); ?>
			
		</div>
		
		<div class="description third last">
			<label for="<?php echo $this->get_field_id('title_style') ?>">
				Title style
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
		
		<div class="description half">
		
			<label for="<?php echo $this->get_field_id('subtitle') ?>">Optional sub title</label><br />
				
			<?php echo aq_field_input('subtitle', $block_id, $subtitle, $size = 'full') ?>
			
		</div>
		
		<div class="description half last">
		
			<label for="<?php echo $this->get_field_id('sub_position') ?>">
			Position of the subtitle</label><br/>
			
			<?php echo aq_field_select('sub_position', $block_id, $sub_options, $sub_position, $block_id); ?>
			
		</div>
				
		
		<?php
	}
	
	function block($instance) {
		global $border_decor;
		
		extract($instance);
		
		echo ( $subtitle && $sub_position == 'above' ) ? '<div class="block-subtitle above '. $title_style .'">'.$subtitle.'</div>' : '';
		
		if( $title ) echo '<'.$h_size.' class="block-title '. $title_style .'">'.strip_tags($title).'</'.$h_size.'>';
		
		echo '<div class="block-title-border '.$border_decor.' '. $title_style .'"></div>';
		
		echo ( $subtitle && $sub_position == 'bellow' ) ? '<div class="block-subtitle bellow '. $title_style .'">'.$subtitle.'</div>' : '';

		echo '<div class="clearfix"></div>';
	}
	
}
