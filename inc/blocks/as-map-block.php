<?php
/** 
 * Maps block
 * 
 * get map based on Latitude and Longitude
**/
if(!class_exists('AS_Map_Block')) {

class AS_Map_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Google map',
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('as_map_block', $block_options);
	}
	
	
	function form($instance) {
		
		$defaults = array(
			// 51.51379710359708 , -0.09957700967788696 this lat/long is London, St. Paul's cathedral ;) ...
			'latitude'		=> '', 
			'longitude'		=> '', 
			'title'			=> '',
			'address'		=> '',
			'address2'		=> '',
			'address3'		=> '',
			'address4'		=> '',
			'attach_id'		=> '',
			'width'			=> '100%',
			'height'		=> '420px',
			'map_color'		=> '',
			'map_desatur'	=> '20',
			'zoom'			=> '20',
			'scroll_zoom'	=> true,
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
				
		?>
		
		<p class="description clearfix notice"><strong>Only one map block per page can be used</strong></p>
		
		<h4>TITLE AND ADDRESS FIELDS (only address fields are used for GMaps search) </h4>
		
		<div class="description third">
		
			<label for="<?php echo $this->get_field_id('title') ?>">Title or name</label><br/>
				
			<?php echo aq_field_input('title', $block_id, $title,'full' ,'text') ?>
			
		</div>
		
		
		<div class="description third">
			
			<label for="<?php echo $this->get_field_id('address2') ?>">Address (street) *</label><br/>
				
			<?php echo aq_field_input('address2', $block_id, $address2, 'full' ,'text') ?>
		
		</div>
		<div class="description third last">
		
			<label for="<?php echo $this->get_field_id('address3') ?>">Address ( town, country ) *</label><br/>
				
			<?php echo aq_field_input('address3', $block_id, $address3, 'full' ,'text') ?>
		
		</div>
		
		<hr>
		
		<div class="description fourth">
			
			<label for="<?php echo $this->get_field_id('address4') ?>">Address (additional info)</label><br/>
				
			<?php echo aq_field_textarea('address4', $block_id, $address4, $size = 'full') ?>

		</div>
		
		
		<div class="description fourth">
			
			<label for="<?php echo $this->get_field_id('latitude') ?>">
				Location latitude<br/>
				<?php echo aq_field_input('latitude', $block_id, $latitude, 'full', 'text') ?>
			</label>
			
			<label for="<?php echo $this->get_field_id('longitude') ?>">
				Location longitude<br/>
				<?php echo aq_field_input('longitude', $block_id, $longitude, 'full', 'text') ?>
			</label>
			
			<p class="description clearfix">To get your location latitude/longitude values, you can use application on <a href="http://universimmedia.pagesperso-orange.fr/geo/loc.htm" target="_blank">THIS ADDRESS</a>.<br><br><strong>NOTE:</strong> these values will override google search address fields from above</p>
			
			
		</div>

		
		<div class="description fourth">
			
			<label for="<?php echo $this->get_field_id('width') ?>">Map width</label><br/>
			<?php echo aq_field_input('width', $block_id, $width, 'full', 'text') ?>	
			
			<label for="<?php echo $this->get_field_id('height') ?>">Map height</label><br/>	
			<?php echo aq_field_input('height', $block_id, $height, 'full', 'text') ?>
			
			
			<label for="<?php echo $this->get_field_id('map_color') ?>">Map color</label>
			<?php echo aq_field_color_picker('map_color', $block_id, $map_color, $map_color) ?>
			

			<div class="slider-controls map-desaturation">
					
				<label for="<?php echo $this->get_field_id('map_desatur') ?>">Desaturation <span><?php echo $map_desatur . '%'; ?></span></label>
				
				<?php echo as_hidden_input('map_desatur', $block_id, $map_desatur, $type = 'hidden')?>
				
				<div class="slider-for-icon"></div>

			</div>
			
			<div class="slider-controls zoom-level">
					
				<label for="<?php echo $this->get_field_id('zoom') ?>">Map zoom level<span> <?php echo $zoom; ?></span></label>
				
				<?php echo as_hidden_input('zoom', $block_id, $zoom, $type = 'hidden')?>
				
				<div class="slider-for-icon"></div>

			</div>
			
			<div class="clearfix"></div>
			
			<label for="<?php echo $this->get_field_id('scroll_zoom') ?>">Disable scroll zoom ?</label><br />
			<?php echo aq_field_checkbox('scroll_zoom', $block_id, $scroll_zoom); ?>
			
		</div>
			
		
		
	
		<div class="description fourth">
			
			<label for="<?php echo $this->get_field_id('attach_id') ?>">Location image (optional)</label>	
			
			<br />
			
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
			
			<?php echo as_field_upload('attach_id', $block_id, $attach_id, 'thumbnail'); ?>

		</div>

		
		

		<?php
		
	}
	
	function block($instance) {
		extract($instance);
		
		wp_register_script('gmap', 'http://maps.googleapis.com/maps/api/js?sensor=true');
		wp_enqueue_script ('gmap', 'http://maps.googleapis.com/maps/api/js?sensor=true','', '1.0');

		?>
		
		<div id="map-<?php echo $block_id; ?>-holder" class="content-block inner-wrapper" >

            <?php
			$add_str  = '<div class="marker">';
			$add_str .=  $title   ? '<p><strong>' . $title.'</strong></p>' : null;
			$add_str .=  $address2  ? '<p>' . $address2.'</p>' : null;
			$add_str .=  $address3  ? '<p>' . $address3.'</p>' : null;
			$add_str .=  $address4  ? '<p>' . $address4.'</p>' : null;
			$add_str .=  $attach_id ? '<div class="entry-image">'. wp_get_attachment_image( $attach_id, 'thumbnail' ).'</div>' : null;
			$add_str  .= '</div>';

			$add_str = wpautop($add_str);
			$address_final = json_encode($add_str);
			
			
			// GET LONGITUDE AND LATITUDE BY USING ADDRESS:
			$address_flds = $address2 .', '. $address3; 
			$prepAddr = str_replace(' ','+',$address_flds);
			// IF THERE IS ADDRESS DATA AND NO "MANUAL" LONGITUDE/LATITUDE INPUT
			if( $prepAddr && !$latitude && !$longitude ) {
				
				$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
				 
				$output= json_decode($geocode);
				
				//	IF THERE'S AND ERROR IN ADDRESS, AND GOGLE CAN'T FIND IT
				if( empty( $output->results ) || ($output->status != 'OK') ) {
					echo '<h3 style="text-align:center">' . __("Google maps error","olea") .' :</h3>';
					echo '<p style="text-align:center">' . __("Please check your address inputs - there's a probable error in data, or use manual longitude and latitude inputs.","olea") .'</p>';
					return;
				} 

				$lat = $output->results[0]->geometry->location->lat;
				$long = $output->results[0]->geometry->location->lng;	
			}
			 
			// IF LATITUDE AND LONGITUDE ARE ENTERED MANUALLY:
			if( $latitude && $longitude ) {
				$lat	= $latitude;
				$long	= $longitude;
			}
	
			?>
			
			<script type="text/javascript">
            function initialize() {

                var leeds = new google.maps.LatLng( <?php echo $lat; ?>, <?php echo $long; ?> );

                var firstLatlng = new google.maps.LatLng( <?php echo $lat; ?>, <?php echo $long; ?> );              

                var firstOptions = {
                    scrollwheel: <?php echo $scroll_zoom ? 'false' : 'true'; ?>,
					zoom: <?php echo $zoom ? $zoom : '16'; ?>,
                    center: firstLatlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP 
                };

                var map = new google.maps.Map(document.getElementById("map-<?php echo $block_id; ?>"), firstOptions);

                firstmarker = new google.maps.Marker({
                    map:map,
                    draggable:false,
                    animation: google.maps.Animation.DROP,
                    title: "<?php echo $title ? $title : ''; ?>",
                    position: leeds
                });

                var contentString1 = <?php echo $address_final; ?>;


                var infowindow1 = new google.maps.InfoWindow({
                    content: contentString1
                });

                google.maps.event.addListener(firstmarker, 'click', function() {
                    infowindow1.open(map,firstmarker);
                });
				
				var styles = [
					{
						featureType: "all",
						stylers: [
							{ hue: "<?php echo $map_color; ?>"},
							{ saturation: -<?php echo $map_desatur; ?> }
						]
					},{
						featureType: "road.arterial",
						elementType: "geometry",
						stylers: [
							{ hue: "#00FFEE" },
							{ saturation: 50 }
						]
					},{
						featureType: "poi.business",
						elementType: "labels",
						stylers: [
							{ visibility: "on" }
						]
					}
				]

				map.setOptions({styles: styles});

            }
            </script>

            <div class="google-map">

                <div id="map-<?php echo $block_id; ?>" style="width: <?php echo $width; ?>; height:<?php echo $height;?>"></div>  

            </div>

        </div> 
		
		<?php
		
	}
	
} // end class

} // end classs_exists