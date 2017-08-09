<?php
if(!class_exists('AS_Team_Member_Block')) {
	
	class AS_Team_Member_Block extends AQ_Block {

		function __construct() {

			$block_options = array (
				'name' => 'Team Member',
				'size' => 'span6',
			);
			
			parent::__construct('as_team_member_block', $block_options);

		}
		
		function form($instance) {
	
			global $post;
			
			// default key/values array
			$defaults = array(
				'layout_style'	=> 'centered',
				'image_style'	=> 'square',
				'image_size'	=> '',
				'featured'		=> false,
				'attach_id'		=> '',
				'title' 		=> '',
				'position'		=> '',
				'bio'			=> '',
				'wp_autop'		=> 0,
				'url'			=> '',
				'phone'			=> '',
				'facebook'		=> '',
				'twitter' 		=> '',
				'google'		=> '',
				'youtube'		=> '',
				'flickr'		=> '',
				'linkedin'		=> '',
				'vimeo'			=> '',
				'pinterest'		=> '',
				'dribbble'		=> '',
				'forrst'		=> '',
				'instagram'		=> '',
				'github'		=> '',
				'picassa'		=> '',
				'skype'			=> ''
			);

			// set default values (if not yet defined)
			$instance = wp_parse_args($instance, $defaults);

			// import each array key as variable with defined values
			extract($instance);
			
			?>
			
			<div class="description fourth first">
				
				<div class="screenshot member-image">
				
					<input type="hidden" class="placeholder" value="<?php echo PLACEHOLDER_IMAGE; ?>" />
					
					<a href="#" class="remove-media"><img src="<?php echo get_template_directory_uri(); ?>/admin/images/icon-delete.png" /></a>
					
					<?php
					if( $attach_id ) {					
						$imgurl = wp_get_attachment_image_src( $attach_id, 'thumbnail' );
						echo '<img src="'. $imgurl[0] .'" class="att-image" />';
					}else{
						echo '<img src="'. PLACEHOLDER_IMAGE .'" class="att-image" />';
					}
					?>
					
				</div>
				<br />
				
				<label for="<?php echo $this->get_field_id('attach_id') ?>">
					
				<?php echo as_field_upload('attach_id', $block_id, $attach_id, 'thumbnail'); ?>
				
				</label>
				
				
			</div>	
			
			
			<div class="description fourth">
				
				<div class="clearfix"></div>
				
				<label for="<?php echo $this->get_field_id('title') ?>">Member Name *</label><br/>
					
				<?php echo aq_field_input('title', $block_id, $title) ?>
				
			</div>
			
			<div class="description fourth">
				
				<label for="<?php echo $this->get_field_id('position') ?>">Position</label><br/>
					
				<?php echo aq_field_input('position', $block_id, $position) ?>
				
			</div>
			
			<div class="description fourth">
				
				<label for="<?php echo $this->get_field_id('url') ?>">URL</label><br/>
					
				<?php echo aq_field_input('url', $block_id, $url) ?>
				
			</div>
			
			<div class="description fourth last">
				
				<label for="<?php echo $this->get_field_id('phone') ?>">Phone</label><br/>
					
				<?php echo aq_field_input('phone', $block_id, $phone) ?>
				
			</div>


			<div class="description half">
			
				<label for="<?php echo $this->get_field_id('bio') ?>">Member info</label><br/>
				<?php echo aq_field_textarea('bio', $block_id, $bio, $size = 'full') ?>
				
				<div class="clearfix"></div>
				
				<label for="<?php echo $this->get_field_id('wp_autop') ?>">
				<?php echo aq_field_checkbox('wp_autop', $block_id, $wp_autop) ?>
				Do not create the paragraphs automatically. <code>"wpautop"</code> disable.
				</label>
				
			</div>
			
			<div class="clearfix"></div>

			<a href="#" class="toggle-social button" rel="image">Social networks</a>
			
			<hr>
			
			<div class="social-fields">
			
				
				<div class="description fourth">
					
					<label for="<?php echo $this->get_field_id('facebook') ?>">Facebook</label><br/>
						
					<?php echo aq_field_input('facebook', $block_id, $facebook) ?>
					
				</div>
				
				<div class="description fourth">
					
					<label for="<?php echo $this->get_field_id('twitter') ?>">Twitter</label><br/>
						
					<?php echo aq_field_input('twitter', $block_id, $twitter) ?>
					
				</div>

				<div class="description fourth ">
					
					<label for="<?php echo $this->get_field_id('linkedin') ?>">LinkedIn</label><br/>
						
					<?php echo aq_field_input('linkedin', $block_id, $linkedin) ?>
					
				</div>			
				
				<div class="description fourth last">
				
					<label for="<?php echo $this->get_field_id('google') ?>">Google Plus</label><br/>
						
					<?php echo aq_field_input('google', $block_id, $google) ?>
					
				</div>
				
				
				<div class="clearfix"></div>
				<hr>
				
				
				<div class="description fourth">
				
					<label for="<?php echo $this->get_field_id('youtube') ?>">YouTube</label><br/>
						
					<?php echo aq_field_input('youtube', $block_id, $youtube) ?>
					
				</div>	
				
				<div class="description fourth">
					
					<label for="<?php echo $this->get_field_id('flickr') ?>">Flickr</label><br/>
						
					<?php echo aq_field_input('flickr', $block_id, $flickr) ?>
					
				</div>


				<div class="description fourth">
				
					<label for="<?php echo $this->get_field_id('vimeo') ?>">Vimeo</label><br/>
						
					<?php echo aq_field_input('vimeo', $block_id, $vimeo) ?>
					
				</div>	

					
				<div class="description fourth last">
					
					<label for="<?php echo $this->get_field_id('pinterest') ?>">Pinterest</label><br/>
						
					<?php echo aq_field_input('pinterest', $block_id, $pinterest) ?>
					
				</div>
				
				
				<div class="clearfix"></div>
				<hr>
				
				
				<div class="description fourth">
					
					<label for="<?php echo $this->get_field_id('dribbble') ?>">Dribbble</label><br/>
						
					<?php echo aq_field_input('dribbble', $block_id, $dribbble) ?>
					
				</div>
			
		
				<div class="description fourth">
				
					<label for="<?php echo $this->get_field_id('forrst') ?>">Forrst</label><br/>
						
					<?php echo aq_field_input('forrst', $block_id, $forrst) ?>
					
				</div>	
				
				<div class="description fourth">
					
					<label for="<?php echo $this->get_field_id('instagram') ?>">Instagram</label><br/>
						
					<?php echo aq_field_input('instagram', $block_id, $instagram) ?>
					
				</div>	
				
							
				
				<div class="description fourth last">
					
					<label for="<?php echo $this->get_field_id('github') ?>">Github</label><br/>
						
					<?php echo aq_field_input('github', $block_id, $github) ?>
					
				</div>
				
				
				<div class="clearfix"></div>
				<hr>

				
				<div class="description fourth ">
					
					<label for="<?php echo $this->get_field_id('picassa') ?>">Picassa</label><br/>
						
					<?php echo aq_field_input('picassa', $block_id, $picassa) ?>
					
				</div>
							
				<div class="description fourth last">
					
					<label for="<?php echo $this->get_field_id('skype') ?>">Skype</label><br/>
						
					<?php echo aq_field_input('skype', $block_id, $skype) ?>
					
				</div>
				
				<div class="clearfix"></div>
				<hr>	
				
			</div><!-- end social-fields -->
			
			
			<div class="description third">
				
				<label for="<?php echo $this->get_field_id('layout_style') ?>">Layout style</label><br/>	
				
				<?php
				$floats = array(
					'float_left'=> 'Float left',
					'float_right'=> 'Float right',
					'centered' => 'Centered',
					);
				echo aq_field_select('layout_style', $block_id, $floats, $layout_style); 
				?>
				
			</div>	
			
			<div class="description third">
				
				<label for="<?php echo $this->get_field_id('image_style') ?>">Image style</label><br/>	
				
				<?php
				$img_styles = array(
					'square'=> 'Square',
					'round' => 'Round',
					);
				echo aq_field_select('image_style', $block_id, $img_styles, $image_style); 
				?>
				
			</div>
			
			<div class="description fourth last">
				
				<label for="<?php echo $this->get_field_id('image_size') ?>">Image size (percentage)</label><br/>
					
				<?php echo aq_field_input('image_size', $block_id, $image_size, $type="number") ?>
				
			</div>

			<div class="description third last">
			
				<label for="<?php echo $this->get_field_id('featured') ?>">Featured member?</label><br />
				<?php echo aq_field_checkbox('featured', $block_id, $featured); ?>
				
			</div>
			
			<div class="clearfix"></div>

			
			<?php
			

		} // function form
		
		/*	GET IMAGE ID USING IMAGE URL FUNCTION (unused):
		*
		// USAGE: echo  $this->get_img_id_byUrl( $attach_url, 'thumbnail' );
		function get_img_id_byUrl( $image_url, $size ) {
 
			global $wpdb;
			$prefix = $wpdb->prefix;
			$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM " . $prefix . "posts" . " WHERE guid='%s';", $image_url )); 
			
			$image_thumb = wp_get_attachment_image_src( $attachment[0], $size );
			return $image_thumb[0];

		}
		*/
		
		
		function block($instance) {

			// default key/values array
			$defaults = array(
				'layout_style'	=> 'centered',
				'image_style'	=> 'square',
				'image_size'	=> '',
				'featured'		=> false,
				'attach_id'		=> '',
				'title' 		=> '',
				'position'		=> '',
				'bio'			=> '',
				'wp_autop'		=> 0,
				'url'			=> '',
				'phone'			=> '',
				'facebook'		=> '',
				'twitter' 		=> '',
				'google'		=> '',
				'youtube'		=> '',
				'flickr'		=> '',
				'linkedin'		=> '',
				'vimeo'			=> '',
				'pinterest'		=> '',
				'dribbble'		=> '',
				'forrst'		=> '',
				'instagram'		=> '',
				'github'		=> '',
				'picassa'		=> '',
				'skype'			=> ''
			);

			// set default values (if not yet defined)
			$instance = wp_parse_args($instance, $defaults);

			// import each array key as variable with defined values
			extract($instance);
		
		?>
			<div id="<?php echo $block_id; ?>" class="team-member-block <?php echo $layout_style; echo ($featured) ? ' featured' : null; ?> as-hover">
			
				<?php if( $attach_id ) { ?>
				<div class="member-image<?php echo ($image_style == 'round') ? ' round' : null; ?>">
					<?php 
					echo $url ? '<a href="'. esc_url( $url ) .'" class="button iconized-button" title="'. esc_attr($title) .'"><span class="fs" aria-hidden="true" data-icon="&#xe065;"></span></a>' : null;
					
					$attr = array(
						'class' => 'attachment-image',
						'title'	=> $title ? $title : null,
						'alt'	=> $title ? $title : null,
						'style' => $image_size ? 'width:'.$image_size.';' : ''
					);
					
					echo wp_get_attachment_image( $attach_id, 'thumbnail', false,  $attr ); 
					
					?>
				</div>
				<?php }; ?>
				
				<?php 
				
				echo '<div class="member-info">';
				
				if( $title ) {
					echo '<h3>' . $title ; 
					echo $position ? '<small>' . $position .'</small>' : null; 
					echo '</h3>';
				};	
				
				echo $phone ? '<span class="phone"><span class="fs" aria-hidden="true" data-icon="&#x5d;"></span><span class="number">' . $phone .'</span></span>' : null; 
				
				echo $bio ? '<p class="bio">' : null; 

					$wp_autop = ( isset($wp_autop) ) ? $wp_autop : 0;
					if( $wp_autop == 1 ){
						echo do_shortcode(htmlspecialchars_decode($bio));
					}
					else {
						echo wpautop(do_shortcode(htmlspecialchars_decode($bio)));
					}
					
				echo $bio ? '</p>' : null; 
				
				echo '<div class="member-social">';
				
				echo $facebook ? '<div><a href="'.$facebook.'" title="Facebook" class="fs" aria-hidden="true" data-icon="&#xe10d;"></div></a>' : '';
				
				echo $twitter ? '<div><a href="'.$twitter.'" title="Twitter" class="fs" aria-hidden="true" data-icon="&#xe111;"></div></a>' : '';
				
				echo $linkedin ? '<div><a href="'.$linkedin.'" title="LinkedIn" class="fs" aria-hidden="true" data-icon="&#xe141;"></div></a>' : '';
				
				echo $google ? '<div><a href="'.$google.'" title="Google plus" class="fs" aria-hidden="true" data-icon="&#xe109;"></div></a>' : '';
				
				echo $youtube ? '<div><a href="'.$youtube.'" title="You Tube" class="fs" aria-hidden="true" data-icon="&#xe115;"></div></a>' : '';
				
				echo $flickr ? '<div><a href="'.$flickr.'" title="Flickr" class="fs" aria-hidden="true" data-icon="&#xe11e;"></div></a>' : '';
				
				echo $vimeo ? '<div><a href="'.$vimeo.'" title="Vimeo" class="fs" aria-hidden="true" data-icon="&#xe118;"></div></a>' : '';
				
				echo $pinterest ? '<div><a href="'.$pinterest.'" title="Pinterest" class="fs" aria-hidden="true" data-icon="&#xe148;"></div></a>' : '';
				
				echo $dribbble ? '<div><a href="'.$dribbble.'" title="Dribbble" class="fs" aria-hidden="true" data-icon="&#xe123;"></div></a>' : '';
				
				echo $forrst ? '<div><a href="'.$forrst.'" title="Forrst" class="fs" aria-hidden="true" data-icon="&#xe125;"></div></a>' : '';
				
				echo $instagram ? '<div><a href="'.$instagram.'" title="Instagram" class="fs" aria-hidden="true" data-icon="&#xe10e;"></div></a>' : '';
				
				echo $github ? '<div><a href="'.$github.'" title="Github" class="fs" aria-hidden="true" data-icon="&#xe12c;"></div></a>' : '';
				
				echo $picassa ? '<div><a href="'.$picassa.'" title="Picassa" class="fs" aria-hidden="true" data-icon="&#xe11f;"></div></a>' : '' ;
				
				echo $skype ? '<div><a href="'.$skype.'" title="Skype" class="fs" aria-hidden="true" data-icon="&#xe13f;"></div></a>' : '' ;
				
				echo '</div>'; // member-social
				
				echo '</div>';
				
				?>
			
			</div>
			
		<?php 
			

		} // function block
	
	} // class
	
}// if !class_exists
?>