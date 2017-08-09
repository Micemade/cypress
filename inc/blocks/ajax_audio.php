<?php
/*
*	Getting video host provider video via AJAX.
*	
*	@since Cypress 1.0
*/
//
define('WP_USE_THEMES', false);
require('../../../../../wp-blog-header.php');

$audio_file		= $_GET['audio_file'];
$large_image	= $_GET['large_image'];
$post_id		= $_GET['post_id'];


echo '<img src="'. fImg::resize(  $large_image , 1280, 960, true  ) .'" title="" alt="" class="audio-featured-image" />';

if ( $audio_file ) : 
	
	$post = get_post( $post_id );
	
	if ($post) {
	
		setup_postdata($post);

		
		$attr = array(
			'src'      => $audio_file,
			'loop'     => false,
			'autoplay' => false,
			'preload'  => 'none'
		);
		
		echo wp_audio_shortcode($attr);

	};
	
else: 
	
	echo '<h4>'. __('Error fetching audio. No audio file is provided.','cypress') .'</h4>';

endif; 

?>
