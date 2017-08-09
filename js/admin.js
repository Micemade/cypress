var $j = jQuery.noConflict();
$j(document).ready( function() {
	/**
	 *	Remove WooCommerce setting field for turn on Woo CSS:
	 *
	 */
	
	$j('input#woocommerce_frontend_css').parent().parent().html('<strong>WooCommerce styles disabled by Cypress theme.</strong><p class="description">WooCommerce frontend styles are not supported by Cypress theme.</p>');
	
	
	
	/**
	 *	Custom wp_nav_menu fields control.
	 *
	 *	for mega menu control input fields.	 
	 */
	 	
	$j('.custom-menu-megamenu').find('input[type=checkbox]').each( function () {
		
		var $this = $j(this);
		var itemParent = $this.parent().parent().parent().parent();
		var itemTypeLabel = itemParent.find('.item-type');
		
		if( $this.prop( "checked" ) ) {
			itemTypeLabel.prepend('<span class="label-mega">Mega menu - </span>');
		}
		
		$this.on('click', function () {
			
			if ( $j(this).prop( "checked" ) ) {
				itemTypeLabel.prepend('<span class="label-mega">Mega menu - </span>')
			}else{
				$j(this).val('');
				itemTypeLabel.find('span.label-mega').remove();
			}	
			
		});
	
	});// end each
	 	
	$j('.custom-menu-clear').find('input[type=checkbox]').each( function () {
		
		var $this = $j(this);
		var itemParent = $this.parent().parent().parent().parent();
		var itemTypeLabel = itemParent.find('.item-type');
		
		if( $this.prop( "checked" ) ) {
			itemTypeLabel.prepend('<span class="label-clear">Clear (new row) - </span>');
		}
		
		$this.on('click', function () {
			
			if ( $j(this).prop( "checked" ) ) {
				itemTypeLabel.prepend('<span class="label-clear">Clear (new row) - </span>')
			}else{
				$j(this).val('');
				itemTypeLabel.find('span.label-clear').remove();
			}	
			
		});
	
	});// end each	
	 	
	$j('.custom-menu-post_thumb').find('input[type=checkbox]').each( function () {
		
		var $this = $j(this);
		var itemParent = $this.parent().parent().parent().parent();
		var itemTypeLabel = itemParent.find('.item-type');
		
		if( $this.prop( "checked" ) ) {
			itemTypeLabel.prepend('<span class="label-clear">Post thumb w. excerpt - </span>');
		}
		
		$this.on('click', function () {
			
			if ( $j(this).prop( "checked" ) ) {
				itemTypeLabel.prepend('<span class="label-clear">Post thumb w. excerpt - </span>')
			}else{
				$j(this).val('');
				itemTypeLabel.find('span.label-clear').remove();
			}	
			
		});
	
	});// end each	
	
	$j('.custom-menu-image').find('input.input-upload').each( function () {
		
		var $this = $j(this);
		var itemParent = $this.parent().parent().parent().parent().parent();
		var itemTypeLabel = itemParent.find('.item-type');
		
		if( $j.trim(this.value).length ) {
			itemTypeLabel.prepend('<span class="label-image">Custom image - </span>');
		}
		
		$this.parent().find('.remove-media').on('click', function () {

			$j(this).val('');
			itemTypeLabel.find('span.label-image').remove();	
		
		});
	
	});// end each
	
	/** 
	 *	Media Uploader
	 *
	 */
	$j(document).on('click', '.as_upload_button', function(event) {
		var $clicked = $j(this), frame,
			input_id = $clicked.prev().attr('id'),
			img_size = $clicked.prev().attr("data-size"),
			media_type = $clicked.attr('rel');
			itemParent = $clicked.parent().parent().parent().parent().parent(); // main menu holder (li)
			itemTypeLabel = itemParent.find('.item-type'); // menu item label
			
		event.preventDefault();
		
		// If the media frame already exists, reopen it.
		if ( frame ) {
			frame.open();
			return;
		}
		
		// Create the media frame.
		frame = wp.media.frames.aq_media_uploader = wp.media({
			// Set the media type
			library: {
				type: media_type
			},
			view: {
				
			}
		});
		
		// When an image is selected, run a callback.
		frame.on( 'select', function() {
			// Grab the selected attachment.
			var attachment = frame.state().get('selection').first();
			
			$j('#' + input_id).val(attachment.attributes.id);
			
			if(media_type == 'image') $j('#' + input_id).parent().parent().parent().find('.image-holder img.att-image').attr('src', attachment.attributes.sizes[img_size].url);
			
			itemTypeLabel.prepend('<span class="label-image">Image - </span>');
			
		});

		frame.open();
	
	});
	$j(document).on('click', 'a.remove-media', function(event) {
		
		event.preventDefault();
		
		var imgDiv = $j(this).parent().parent().find('.image-holder');
		var placeHolderImg = imgDiv.find('input.placeholder').val();
		
		imgDiv.find('img.att-image').attr('src', placeHolderImg );
		
		$j(this).parent().parent().find('input.input-upload').val('');
		
	});
	
	
});
