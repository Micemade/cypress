(function( $ ){

	$(document).ready(function(){
	 
		function draw() {
			requestAnimationFrame(draw);
			// Drawing code goes here
			scrollEvent();
		}
		draw();
	 
	});
	 
	function scrollEvent(){
	 
		if(!is_touch_device()){
			viewportTop = $(window).scrollTop();
			windowHeight = $(window).height();
			viewportBottom = windowHeight+viewportTop;
	 
			if($(window).width())
	 
			$('[data-parallax="true"]').each(function(){
				
				parentTop = $(this).parent().offset().top;
				
				shift = viewportTop - parentTop;
				
				speed = parseFloat($(this).attr('data-speed'));
				distance = shift * speed ;
				if($(this).attr('data-direction') === 'up'){ sym = ''; } else { sym = '-'; }
				$(this).css('transform','translate3d(0, ' + sym + distance +'px,0 ) scale('+ (1 + speed) +')');
			});
	 
		}
	}   
	 
	function is_touch_device() {
	  return 'ontouchstart' in window // works on most browsers 
		  || 'onmsgesturechange' in window; // works on ie10
	}

})( jQuery );