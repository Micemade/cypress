jQuery.noConflict();
(function($) {
"use strict";

if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
	window.Mobile = true;
}

/*
 * hoverIntent r7 // 2013.03.11 // jQuery 1.9.1+
 * http://cherne.net/brian/resources/jquery.hoverIntent.html
 *
 * You may use hoverIntent under the terms of the MIT license. Basically that
 * means you are free to use hoverIntent as long as this header is left intact.
 * Copyright 2007, 2013 Brian Cherne
 */
 
/* hoverIntent is similar to jQuery's built-in "hover" method except that
 * instead of firing the handlerIn function immediately, hoverIntent checks
 * to see if the user's mouse has slowed down (beneath the sensitivity
 * threshold) before firing the event. The handlerOut function is only
 * called after a matching handlerIn.
 *
 * // basic usage ... just like .hover()
 * .hoverIntent( handlerIn, handlerOut )
 * .hoverIntent( handlerInOut )
 *
 * // basic usage ... with event delegation!
 * .hoverIntent( handlerIn, handlerOut, selector )
 * .hoverIntent( handlerInOut, selector )
 *
 * // using a basic configuration object
 * .hoverIntent( config )
 *
 * @param  handlerIn   function OR configuration object
 * @param  handlerOut  function OR selector for delegation OR undefined
 * @param  selector    selector OR undefined
 * @author Brian Cherne <brian(at)cherne(dot)net>
 */
(function($) {
    
	$.fn.hoverIntent = function(handlerIn,handlerOut,selector) {

        // default configuration values
        var cfg = {
            interval: 100,
            sensitivity: 7,
            timeout: 0
        };

        if ( typeof handlerIn === "object" ) {
            cfg = $.extend(cfg, handlerIn );
        } else if ($.isFunction(handlerOut)) {
            cfg = $.extend(cfg, { over: handlerIn, out: handlerOut, selector: selector } );
        } else {
            cfg = $.extend(cfg, { over: handlerIn, out: handlerIn, selector: handlerOut } );
        }

        // instantiate variables
        // cX, cY = current X and Y position of mouse, updated by mousemove event
        // pX, pY = previous X and Y position of mouse, set by mouseover and polling interval
        var cX, cY, pX, pY;

        // A private function for getting mouse position
        var track = function(ev) {
            cX = ev.pageX;
            cY = ev.pageY;
        };

        // A private function for comparing current and previous mouse position
        var compare = function(ev,ob) {
            ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
            // compare mouse positions to see if they've crossed the threshold
            if ( ( Math.abs(pX-cX) + Math.abs(pY-cY) ) < cfg.sensitivity ) {
                $(ob).off("mousemove.hoverIntent",track);
                // set hoverIntent state to true (so mouseOut can be called)
                ob.hoverIntent_s = 1;
                return cfg.over.apply(ob,[ev]);
            } else {
                // set previous coordinates for next time
                pX = cX; pY = cY;
                // use self-calling timeout, guarantees intervals are spaced out properly (avoids JavaScript timer bugs)
                ob.hoverIntent_t = setTimeout( function(){compare(ev, ob);} , cfg.interval );
            }
        };

        // A private function for delaying the mouseOut function
        var delay = function(ev,ob) {
            ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
            ob.hoverIntent_s = 0;
            return cfg.out.apply(ob,[ev]);
        };

        // A private function for handling mouse 'hovering'
        var handleHover = function(e) {
            // copy objects to be passed into t (required for event object to be passed in IE)
            var ev = jQuery.extend({},e);
            var ob = this;

            // cancel hoverIntent timer if it exists
            if (ob.hoverIntent_t) { ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t); }

            // if e.type == "mouseenter"
            if (e.type === "mouseenter") {
                // set "previous" X and Y position based on initial entry point
                pX = ev.pageX; pY = ev.pageY;
                // update "current" X and Y position based on mousemove
                $(ob).on("mousemove.hoverIntent",track);
                // start polling interval (self-calling timeout) to compare mouse coordinates over time
                if (ob.hoverIntent_s !== 1) { ob.hoverIntent_t = setTimeout( function(){compare(ev,ob);} , cfg.interval );}

                // else e.type == "mouseleave"
            } else {
                // unbind expensive mousemove event
                $(ob).off("mousemove.hoverIntent",track);
                // if hoverIntent state is true, then call the mouseOut function after the specified delay
                if (ob.hoverIntent_s === 1) { ob.hoverIntent_t = setTimeout( function(){delay(ev,ob);} , cfg.timeout );}
            }
        };

        // listen for mouseenter and mouseleave
        return this.on({'mouseenter.hoverIntent':handleHover,'mouseleave.hoverIntent':handleHover}, cfg.selector);
    };
})(jQuery);

/*! Copyright (c) 2013 Brandon Aaron (http://brandonaaron.net)
  Licensed under the MIT License (LICENSE.txt).
 
  Thanks to: http://adomas.org/javascript-mouse-wheel/ for some pointers.
  Thanks to: Mathias Bank(http://www.mathias-bank.de) for a scope bug fix.
  Thanks to: Seamus Leahy for adding deltaX and deltaY
 
  Version: 3.1.3
 
  Requires: 1.2.2+
 
(function(factory){if(typeof define==='function'&&define.amd){define(['jquery'],factory);}else if(typeof exports==='object'){module.exports=factory;}else{factory(jQuery);}}(function($){var toFix=['wheel','mousewheel','DOMMouseScroll','MozMousePixelScroll'];var toBind='onwheel'in document||document.documentMode>=9?['wheel']:['mousewheel','DomMouseScroll','MozMousePixelScroll'];var lowestDelta,lowestDeltaXY;if($.event.fixHooks){for(var i=toFix.length;i;){$.event.fixHooks[toFix[--i]]=$.event.mouseHooks;}}
$.event.special.mousewheel={setup:function(){if(this.addEventListener){for(var i=toBind.length;i;){this.addEventListener(toBind[--i],handler,false);}}else{this.onmousewheel=handler;}},teardown:function(){if(this.removeEventListener){for(var i=toBind.length;i;){this.removeEventListener(toBind[--i],handler,false);}}else{this.onmousewheel=null;}}};$.fn.extend({mousewheel:function(fn){return fn?this.bind("mousewheel",fn):this.trigger("mousewheel");},unmousewheel:function(fn){return this.unbind("mousewheel",fn);}});function handler(event){var orgEvent=event||window.event,args=[].slice.call(arguments,1),delta=0,deltaX=0,deltaY=0,absDelta=0,absDeltaXY=0,fn;event=$.event.fix(orgEvent);event.type="mousewheel";if(orgEvent.wheelDelta){delta=orgEvent.wheelDelta;}
if(orgEvent.detail){delta=orgEvent.detail*-1;}
if(orgEvent.deltaY){deltaY=orgEvent.deltaY*-1;delta=deltaY;}
if(orgEvent.deltaX){deltaX=orgEvent.deltaX;delta=deltaX*-1;}
if(orgEvent.wheelDeltaY!==undefined){deltaY=orgEvent.wheelDeltaY;}
if(orgEvent.wheelDeltaX!==undefined){deltaX=orgEvent.wheelDeltaX*-1;}
absDelta=Math.abs(delta);if(!lowestDelta||absDelta<lowestDelta){lowestDelta=absDelta;}
absDeltaXY=Math.max(Math.abs(deltaY),Math.abs(deltaX));if(!lowestDeltaXY||absDeltaXY<lowestDeltaXY){lowestDeltaXY=absDeltaXY;}
fn=delta>0?'floor':'ceil';delta=Math[fn](delta/lowestDelta);deltaX=Math[fn](deltaX/lowestDeltaXY);deltaY=Math[fn](deltaY/lowestDeltaXY);args.unshift(event,delta,deltaX,deltaY);return($.event.dispatch||$.event.handle).apply(this,args);}}));
*/
/*
 * jQuery Superfish Menu Plugin - v1.7.4
 * Copyright (c) 2013 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 *	http://www.opensource.org/licenses/mit-license.php
 *	http://www.gnu.org/licenses/gpl.html
 */

!function(e){"use strict";var t=function(){var t={bcClass:"sf-breadcrumb",menuClass:"sf-js-enabled",anchorClass:"sf-with-ul",menuArrowClass:"sf-arrows"},i=function(){var t=/iPhone|iPad|iPod/i.test(navigator.userAgent);return t&&e(window).load(function(){e("body").children().on("click",e.noop)}),t}(),n=function(){var e=document.documentElement.style;return"behavior"in e&&"fill"in e&&/iemobile/i.test(navigator.userAgent)}(),a=function(e,i){var n=t.menuClass;i.cssArrows&&(n+=" "+t.menuArrowClass),e.toggleClass(n)},o=function(i,n){return i.find("li."+n.pathClass).slice(0,n.pathLevels).addClass(n.hoverClass+" "+t.bcClass).filter(function(){return e(this).children(n.popUpSelector).hide().show().length}).removeClass(n.pathClass)},s=function(e){e.children("a").toggleClass(t.anchorClass)},r=function(e){var t=e.css("ms-touch-action");t="pan-y"===t?"auto":"pan-y",e.css("ms-touch-action",t)},l=function(t,a){var o="li:has("+a.popUpSelector+")";e.fn.hoverIntent&&!a.disableHI?t.hoverIntent(d,u,o):t.on("mouseenter.superfish",o,d).on("mouseleave.superfish",o,u);var s="MSPointerDown.superfish";i||(s+=" touchend.superfish"),n&&(s+=" mousedown.superfish"),t.on("focusin.superfish","li",d).on("focusout.superfish","li",u).on(s,"a",a,c)},c=function(t){var i=e(this),n=i.siblings(t.data.popUpSelector);n.length>0&&n.is(":hidden")&&(i.one("click.superfish",!1),"MSPointerDown"===t.type?i.trigger("focus"):e.proxy(d,i.parent("li"))())},d=function(){var t=e(this),i=f(t);clearTimeout(i.sfTimer),t.siblings().superfish("hide").end().superfish("show")},u=function(){var t=e(this),n=f(t);i?e.proxy(h,t,n)():(clearTimeout(n.sfTimer),n.sfTimer=setTimeout(e.proxy(h,t,n),n.delay))},h=function(t){t.retainPath=e.inArray(this[0],t.$path)>-1,this.superfish("hide"),this.parents("."+t.hoverClass).length||(t.onIdle.call(p(this)),t.$path.length&&e.proxy(d,t.$path)())},p=function(e){return e.closest("."+t.menuClass)},f=function(e){return p(e).data("sf-options")};return{hide:function(t){if(this.length){var i=this,n=f(i);if(!n)return this;var a=n.retainPath===!0?n.$path:"",o=i.find("li."+n.hoverClass).add(this).not(a).removeClass(n.hoverClass).children(n.popUpSelector),s=n.speedOut;t&&(o.show(),s=0),n.retainPath=!1,n.onBeforeHide.call(o),o.stop(!0,!0).animate(n.animationOut,s,function(){var t=e(this);n.onHide.call(t)})}return this},show:function(){var e=f(this);if(!e)return this;var t=this.addClass(e.hoverClass),i=t.children(e.popUpSelector);return e.onBeforeShow.call(i),i.stop(!0,!0).animate(e.animation,e.speed,function(){e.onShow.call(i)}),this},destroy:function(){return this.each(function(){var i,n=e(this),o=n.data("sf-options");return o?(i=n.find(o.popUpSelector).parent("li"),clearTimeout(o.sfTimer),a(n,o),s(i),r(n),n.off(".superfish").off(".hoverIntent"),i.children(o.popUpSelector).attr("style",function(e,t){return t.replace(/display[^;]+;?/g,"")}),o.$path.removeClass(o.hoverClass+" "+t.bcClass).addClass(o.pathClass),n.find("."+o.hoverClass).removeClass(o.hoverClass),o.onDestroy.call(n),n.removeData("sf-options"),void 0):!1})},init:function(i){return this.each(function(){var n=e(this);if(n.data("sf-options"))return!1;var c=e.extend({},e.fn.superfish.defaults,i),d=n.find(c.popUpSelector).parent("li");c.$path=o(n,c),n.data("sf-options",c),a(n,c),s(d),r(n),l(n,c),d.not("."+t.bcClass).superfish("hide",!0),c.onInit.call(this)})}}}();e.fn.superfish=function(i){return t[i]?t[i].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof i&&i?e.error("Method "+i+" does not exist on jQuery.fn.superfish"):t.init.apply(this,arguments)},e.fn.superfish.defaults={popUpSelector:"ul,.sf-mega",hoverClass:"sfHover",pathClass:"overrideThisToUse",pathLevels:1,delay:800,animation:{opacity:"show"},animationOut:{opacity:"hide"},speed:"normal",speedOut:"fast",cssArrows:!0,disableHI:!1,onInit:e.noop,onBeforeShow:e.noop,onShow:e.noop,onBeforeHide:e.noop,onHide:e.noop,onIdle:e.noop,onDestroy:e.noop},e.fn.extend({hideSuperfishUl:t.hide,showSuperfishUl:t.show})}(jQuery);
/*
 * Superclick v1.0.0 - jQuery menu widget
 * Copyright (c) 2013 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 * 	http://www.opensource.org/licenses/mit-license.php
 * 	http://www.gnu.org/licenses/gpl.html
 */
;(function($){var methods=(function(){var c={bcClass:'sf-breadcrumb',menuClass:'sf-js-enabled',anchorClass:'sf-with-ul',menuArrowClass:'sf-arrows'},outerClick=(function(){$(window).load(function(){$('body').children().on('click.superclick',function(){var $allMenus=$('.sf-js-enabled');$allMenus.superclick('reset');});});})(),toggleMenuClasses=function($menu,o){var classes=c.menuClass;if(o.cssArrows){classes+=' '+c.menuArrowClass;}
$menu.toggleClass(classes);},setPathToCurrent=function($menu,o){return $menu.find('li.'+o.pathClass).slice(0,o.pathLevels).addClass(o.activeClass+' '+c.bcClass).filter(function(){return($(this).children('ul').hide().show().length);}).removeClass(o.pathClass);},toggleAnchorClass=function($li){$li.children('a').toggleClass(c.anchorClass);},toggleTouchAction=function($menu){var touchAction=$menu.css('ms-touch-action');touchAction=(touchAction==='pan-y')?'auto':'pan-y';$menu.css('ms-touch-action',touchAction);},clickHandler=function(e){var $this=$(this),$ul=$this.siblings('ul'),func;if($ul.length){func=($ul.is(':hidden'))?over:out;$.proxy(func,$this.parent('li'))();return false;}},over=function(){var $this=$(this),o=getOptions($this);$this.siblings().superclick('hide').end().superclick('show');},out=function(){var $this=$(this),o=getOptions($this);$.proxy(close,$this,o)();},close=function(o){o.retainPath=($.inArray(this[0],o.$path)>-1);this.superclick('hide');if(!this.parents('.'+o.activeClass).length){o.onIdle.call(getMenu(this));if(o.$path.length){$.proxy(over,o.$path)();}}},getMenu=function($el){return $el.closest('.'+c.menuClass);},getOptions=function($el){return getMenu($el).data('sf-options');};return{hide:function(instant){if(this.length){var $this=this,o=getOptions($this);if(!o){return this;}
var not=(o.retainPath===true)?o.$path:'',$ul=$this.find('li.'+o.activeClass).add(this).not(not).removeClass(o.activeClass).children('ul'),speed=o.speedOut;if(instant){$ul.show();speed=0;}
o.retainPath=false;o.onBeforeHide.call($ul);$ul.stop(true,true).animate(o.animationOut,speed,function(){var $this=$(this);o.onHide.call($this);});}
return this;},show:function(){var o=getOptions(this);if(!o){return this;}
var $this=this.addClass(o.activeClass),$ul=$this.children('ul');o.onBeforeShow.call($ul);$ul.stop(true,true).animate(o.animation,o.speed,function(){o.onShow.call($ul);});return this;},destroy:function(){return this.each(function(){var $this=$(this),o=$this.data('sf-options'),$liHasUl=$this.find('li:has(ul)');if(!o){return false;}
toggleMenuClasses($this,o);toggleAnchorClass($liHasUl);toggleTouchAction($this);$this.off('.superclick');$liHasUl.children('ul').attr('style',function(i,style){return style.replace(/display[^;]+;?/g,'');});o.$path.removeClass(o.activeClass+' '+c.bcClass).addClass(o.pathClass);$this.find('.'+o.activeClass).removeClass(o.activeClass);o.onDestroy.call($this);$this.removeData('sf-options');});},reset:function(){return this.each(function(){var $menu=$(this),o=getOptions($menu),$openLis=$($menu.find('.'+o.activeClass).toArray().reverse());$openLis.children('a').trigger('click');});},init:function(op){return this.each(function(){var $this=$(this);if($this.data('sf-options')){return false;}
var o=$.extend({},$.fn.superclick.defaults,op),$liHasUl=$this.find('li:has(ul)');o.$path=setPathToCurrent($this,o);$this.data('sf-options',o);toggleMenuClasses($this,o);toggleAnchorClass($liHasUl);toggleTouchAction($this);$this.on('click.superclick','a',clickHandler);$liHasUl.not('.'+c.bcClass).superclick('hide',true);o.onInit.call(this);});}};})();$.fn.superclick=function(method,args){if(methods[method]){return methods[method].apply(this,Array.prototype.slice.call(arguments,1));}
else if(typeof method==='object'||!method){return methods.init.apply(this,arguments);}
else{return $.error('Method '+method+' does not exist on jQuery.fn.superclick');}};$.fn.superclick.defaults={activeClass:'sfHover',pathClass:'overrideThisToUse',pathLevels:1,animation:{opacity:'show'},animationOut:{opacity:'hide'},speed:'normal',speedOut:'fast',cssArrows:true,onInit:$.noop,onBeforeShow:$.noop,onShow:$.noop,onBeforeHide:$.noop,onHide:$.noop,onIdle:$.noop,onDestroy:$.noop};})(jQuery);
(function($) {

	$.fn.watch = function(props, func, interval, id) {
		/// <summary>
		/// Allows you to monitor changes in a specific
		/// CSS property of an element by polling the value.
		/// when the value changes a function is called.
		/// The function called is called in the context
		/// of the selected element (ie. this)
		/// </summary>    
		/// <param name="prop" type="String">CSS Property to watch. If not specified (null) code is called on interval</param>    
		/// <param name="func" type="Function">
		/// Function called when the value has changed.
		/// </param>    
		/// <param name="func" type="Function">
		/// optional id that identifies this watch instance. Use if
		/// if you have multiple properties you're watching.
		/// </param>
		/// <param name="id" type="String">A unique ID that identifies this watch instance on this element</param>  
		/// <returns type="jQuery" /> 
		if (!interval)
			interval = 200;
		if (!id)
			id = "_watcher";

		return this.each(function() {
			var _t = this;
			var el = $(this);
			var fnc = function() { __watcher.call(_t, id) };
			var itId = null;

			if (typeof (this.onpropertychange) == "object")
				el.bind("propertychange." + id, fnc);
			else if ($.browser.mozilla)
				el.bind("DOMAttrModified." + id, fnc);
			else
				itId = setInterval(fnc, interval);

			var data = { id: itId,
				props: props.split(","),
				func: func,
				vals: []
			};
			$.each(data.props, function(i) { data.vals[i] = el.css(data.props[i]); });
			el.data(id, data);
		});

		function __watcher(id) {
			var el = $(this);
			var w = el.data(id);

			var changed = false;
			var i = 0;
			for (i; i < w.props.length; i++) {
				var newVal = el.css(w.props[i]);
				if (w.vals[i] != newVal) {
					w.vals[i] = newVal;
					changed = true;
					break;
				}
			}
			if (changed && w.func) {
				var _t = this;
				w.func.call(_t, w, i)
			}
		}
	}
	$.fn.unwatch = function(id) {
		this.each(function() {
			var w = $(this).data(id);
			var el = $(this);
			el.removeData();

			if (typeof (this.onpropertychange) == "object")
				el.unbind("propertychange." + id, fnc);
			else if ($.browser.mozilla)
				el.unbind("DOMAttrModified." + id, fnc);
			else
				clearInterval(w.id);
		});
		return this;
	}
})(jQuery);
/**
 *	CUSTOM AS PLUGIN hoverBlockItems: Hover effect
 *
 */
(function( $ ){
	$.fn.hoverBlockItems = function() {
	
	return this.each(function() {
				
		var whichEase = 'easeOutSine';
		var time = 280;
		var $_this = $(this);
		var image = $(this).find('img');
		var tekst = $(this).find('.item-text');
		
		if( image.length > 0 ) {
			
			if ( $.browser.msie && parseInt($.browser.version,10) <= 8 ) {
				imageWrap.height(image.height());
			}
			var ie8 = false;
			if ( $.browser.msie ) {
				if( parseInt($.browser.version, 10) <= 8 ){
					ie8 = true;
				}else{
					ie8 = false;
				}
			}
			//if( !ie8 ) {
				//tekst.animate({transform: 'scale(0,0)','opacity':0 }, {duration: 0});
				
				$(this).hover(function() {
					tekst.stop(false,true).animate({'opacity':1 },{duration:time, easing: whichEase}), 
					$_this.css('z-index', 100);
					//$_this.siblings().stop(false,true).animate({'opacity':0.35 },{duration:time });    
  
				},
				function() {
					tekst.stop(false,true).animate({'opacity':0 },{duration:time,easing:whichEase}), $_this.css('z-index', 0);
					//$_this.siblings().stop(false,true).animate({'opacity':1 },{duration:time})
					; 
				});
			//}//endif
		}
	});
  };//end $.fn.hoverBlockItems = function()
})( jQuery );
//
/**
 *	CUSTOM AS PLUGIN as_Hover: Site-wide buttons, images, over effect
 *
 */
(function( $ ){
	$.fn.as_Hover = function() {
	
	return this.each(function() {
				
		var whichEase = 'easeOutBack';
		var time = 500;
		
		var img		= $(this).find('img'),
			overlay = $(this).find('.link'),
			title	= $(this).find('h4'),
			icon	= $(this).find('.icon-block-cell');
		
		
		// get browser - IE < 9 alert !
		var ie8 = false;
		if ( $.browser.msie ) {
			if( parseInt($.browser.version, 10) <= 8 ){
				ie8 = true;
			}else{
				ie8 = false;
			}
		}
		
		if( $(this).hasClass('category-image') ) {
			
			$(this).hover(function() {
				img.stop(true,false).animate({transform: 'scale(1.3, 1.3)' },{duration:800, easing: whichEase});   
				overlay.stop(true,false).delay(100).animate({'opacity':0.2 },{duration:600});

				
			},
			function() {
				img.stop(true,false).animate({transform:'scale(1,1)'},{duration:800,easing:whichEase});
				overlay.stop(true,false).delay(100).animate({'opacity':0.7 },{duration:500});

			});
		
		}else
		if( $(this).hasClass('icon-hover') ) {

			$(this).hover(function() {
				icon.stop(true,false).animate({transform:'rotate(10deg)' },{duration:time, easing: whichEase});
				$(this).addClass('active');
			},
			function() {
				icon.stop(true,false).animate({transform: 'rotate(0deg)'},{duration:time,easing:whichEase});
				$(this).removeClass('active');
			});
		}else
		if( img ) {
			var oldZ = $(this).css('z-index') ? $(this).css('z-index') : '0';

			$(this).hover(function() {
				img.stop(true,false).animate({transform:' rotate(10deg)' },{duration:time, easing: whichEase});
				$(this).css('z-index',100);
			},
			function() {
				img.stop(true,false).animate({transform:'rotate(0deg)'},{duration:time,easing:whichEase});
				$(this).css('z-index', oldZ );
			});
		}
	});
  };//end $.fn.as_Hover = function()
})( jQuery );
//
/*
*
* CUSTOM AS PLUGIN: equalizeHeights
*
*/
(function( $ ){
$.fn.equalizeHeights = function() {
	
  var maxHeight = this.map(function(i,e) {
    return $(e).height();
  }).get();
  
  return this.height( Math.max.apply(this, maxHeight) );
};
})( jQuery );
/* (function( $ ){
$.fn.equalizeHeights = function() {
	
	this.each( function () {
	
		var highest = 0;
		$(this).each(function() {
			var height = $(this).height();
			if(height > highest) {
			  highest = height;
			}
		});
		return highest; 

	});
};
})( jQuery ); */
//
/**
 *	CUSTOM AS PLUGIN: eqHeights
 *
 */
(function( $ ) {
$.fn.extend({
equalHeights: function(){
    var top=0;
    var classname=('equalHeights'+Math.random()).replace('.','');
    $(this).each(function(){
      if ($(this).is(':visible')){
        var thistop=$(this).offset().top;
        if (thistop>top) {
            $('.'+classname).removeClass(classname); 
            top=thistop;
        }
        $(this).addClass(classname);
        $(this).height('auto');
        var h=(Math.max.apply(null, $('.'+classname).map(function(){ return $(this).outerHeight(); }).get()));
        $('.'+classname).height(h);
      }
    }).removeClass(classname); 
}       

});
})( jQuery );
//
//
//
//
/**
 *	AS FUNCTION AND PLUGIN CALLS
 *
 *	small jQuery code snippets.
 *
 */

$(document).ready(function() {
	
	if( window.Mobile ) { $('body, #site-menu.vertical, .mega-clone').css('overflow','auto'); }
	
	if( $('img').attr("title") ) { $("img").removeAttr("title"); }
	
	/**
	 *	INTERNET EXPLORERS "SNIFFER":
	 *
	 */
	var ua = navigator.userAgent,
		isIE11	= ua.match(/Trident\/7\./), //  is Internet Explorer 11
		isIE10	= /MSIE 10.0/.test(ua), //  is Internet Explorer 10
		isIE9	= /MSIE 9.0/.test(ua); //  is Internet Explorer 9
	
	if( isIE9 ) {
		$('body').addClass('ie9');
	}

	
	
	/**	
	 *	REMOVE EMPTY <P> TAGS FROM CONTENT .
	 *
	 */
	$('p').filter(function() {
		
		return $.trim($(this).text()) === '' && $(this).children().length === 0;
		
	})
	.remove();
	
	
/**
 *	MENUS (main, secondary, and block categories menus)
 *
 */
	
	 
	$('.product-categories, .widget_nav_menu ul').superfish({
		autoArrows		: false, 
		animation		: { opacity:'show', height:'show' },
		cssArrows		: false,
		delay			: 0
	});	
	
	
	
	$('.menu-toggler a').click(function(e) {
		e.preventDefault();
		$(this).parent().parent().find('.mobile-dropdown').slideToggle();
		$(this).parent().parent().find('.taxonomy-menu').slideToggle();
		$(this).parent().parent().find('#secondary-nav').slideToggle();
		
	});
	
	$('.mobile-dropdown').find('.navigation li.menu-item-has-children').hover(function(e) {
		
		e.preventDefault();
		
		$(this).find('> .sub-menu').slideToggle();		
	});
	
	
	

/**
 *	PRODUCT FILTERS WIDGET TOGGLE.
 *
 */
	var prod_filters = false
	$('.product-filters-title, .product-filters .fs').click(function() {

		var filters		= $(this).parent().find('.product-filters');
		if( $(this).hasClass('fs') ) {
			filters		= $(this).parent().parent().find('.product-filters');
		}
		
		if ( prod_filters == false ) {
			
			filters.slideDown( 300, 'easeInOutQuart', function() { 
				prod_filters = true; 
				$('.product-filters .fs').fadeIn(300);

			} );
			
		}else{
		
			$('.product-filters .fs').fadeOut(300);
			
			filters.slideUp( 300, 'easeInOutQuart', function() { 
				prod_filters = false; 

			} );
			
		}	
		
	});
	
/**
 *	MINICART TOGGLE.
 *
 */
	var minicart_active = false
	$(document).on('click','#site-menu .header-cart', function(e) {

		e.preventDefault();
		
		var minicart	= $(this).parent().find('#mini-cart-list'),
			arrow		= minicart.find('.arrow-up'),
			mc_button	= minicart.prev('.header-cart'),
			arrow_pos	= (mc_button.outerWidth(true)/2) + mc_button.position().left ;
			
		
		arrow.css('left', arrow_pos );
		
		if ( minicart_active == false ) {
			
			minicart.slideDown( 300, 'easeInOutQuart', function() { 
				minicart_active = true; 
			});
			
		}else{
		
			minicart.slideUp( 300, 'easeInOutQuart', function() { 
				minicart_active = false; 

			} );
		}	
		
	});

	$('#mini-cart-list').parent().mouseleave(
		
		function () {
			if( minicart_active == true) {
				$('#mini-cart-list').delay(300).slideUp( 300, 'easeInOutQuart', function() { 
					minicart_active = false; 

				} );
			}
		}
	);
/** end minicart toggle */
	
/**
 *	ADD BUTTON CLASS TO:
 */
	$('#comments').find('input#submit').addClass('button');
	$('ul.page-numbers').find('a.page-numbers, span.page-numbers').addClass('button');
	$('.page-link').find('span').addClass('button');
	$('.tagcloud').find('a').addClass('button');
	$('input[type="submit"], input[type="reset"], input[type="button"]').addClass('button');
	
	$('.btn').addClass('button');
	$('.clear-all').addClass('button');
	
	
/**
 *	EQUALIZE BLOCKS IN SELECTED ROW BLOCK
 *
 *	in Page builder edit page - row block settings check the "Equalize inner blocks heights"
 */

	
	$(window).resize(function() {
        $('.eq_heights .grid-container').each(function() {
			$(this).find('.inner-wrapper').equalizeHeights();
		});
    }).trigger('resize');
	
/**
 *	POST META and NAV TOGGLER: 
 *
 */
	
	$('.post-meta-bottom .date_meta, .post-meta-bottom .user_meta, .post-meta-bottom .permalink, .post-meta-bottom .cat_meta ,.post-meta-bottom .tag_meta, .post-meta-bottom .comments_meta, .nav-single a, .wishlist-compare > div').hover(function() {
			
			var parent = $(this).parent();
			var hoverBox = $(this).find('.hover-box');
			var leftPos = - ( hoverBox.outerWidth(true)/2 - $(this).outerWidth(true)/2 );
			
			if( $(this).hasClass('left') || parent.hasClass('left') ) {
				hoverBox.css('left', 0);
			}else if( $(this).hasClass('right') || parent.hasClass('right') ) {
				hoverBox.css('left', 'auto').css('right', 0);
			}else{
				hoverBox.css('left', leftPos);
			}
			
			hoverBox.fadeToggle(400);
		},
		function () {
			var hoverBox = $(this).find('.hover-box');

			hoverBox.fadeToggle(150);
		}
	
	);
	/** END POST META*/


/**
 *	SIDEBAR WIDGETS - if full page AND
 *
 */
	var numW = 0;
	$('#secondary > .widget').each(function() {
		if ( numW === 0 || numW - 3 === 0 ) {
			$(this).addClass("first");
			numW = 0;
        } 
		numW++;
	});
	
/**
 *	FOOTER WIDGETS - add scaffolding css depending on widgets number
 *
 */
	var footerWidgets = $('#footerwidgets').find('.grid-container').children();
	var fwNum = footerWidgets.length;
	footerWidgets.each(function() {
		$(this).addClass('grid-'+ (Math.floor(100/fwNum))).addClass('tablet-grid-100');
	});

/**
 *	WP NATIVE GALLERY FIX.
 *
 *	adding styles and effect from theme to WP native gallery.
 */		
	$(function (){
	
		var gallery_item = $('.gallery-item');
		
		gallery_item.each(function() {
			
			var gallID		= $(this).parent().attr('id');
			var gallClass	= $(this).parent().attr('class');
			var link		= $(this).find('a').attr('href');
			var title		= $(this).find('a').attr('title');
			var image 		= $(this).find('img');
			
			var caption = $(this).find('dd').html();
			$(this).find('dd').remove();
			
						
			$(this).addClass('item'); // class for flip effect
			$(this).addClass('scroll'); // class for flip effect
			
			// find number of columns and convert it to grid
			var columns = gallClass.match( /gallery-columns-\d/ );
			var colNum = columns[0].match(/\d/);
			$(this).addClass('grid-' + Math.floor( 100 / colNum[0] ));
			
			
			$(this).find(' > .gallery-icon').addClass('item-content');
			$(this).find('a').addClass('item-img');
			$(this).find('a').attr('data-rel', 'prettyPhoto[pp_gal-' + gallID +']' );
						
			var extension = link.substr( (link.lastIndexOf('.') +1) )
			
			switch(extension) {
				case 'jpg':
				case 'png':
				case 'gif':
					image.wrapAll('<div class="front" />');
					
					$(this).find('a').append('<div class="back"><div class="item-overlay"><a href="' + link + '" class="button"><div class="fs" aria-hidden="true" data-icon="&#xe022;"></div></a><p class="caption"></p></div></div>');
					
					image.clone().appendTo($(this).find('.back') );
					
					$(this).find('.link').find('p').html(caption);
				
				break;
				
			}
			
		});
		
	});


/**
 *	BEGIN ON WINDOW LOAD 
 *
 */	
	
	$(window).load(function(){
		
/**
 *	AQUA PAGE BUILDER
 *
 */
		/* CONVERT AQUA GRID (SPAN 1-12) TO UNSEMANTIC GRID (GRID 10-100)*/
		
		var multiP = 100 / 12;
		$('.aq-block').each(function() {
			var gridSuf = 0		
			for ( var i=1; i<=12; i++ ) {

				//(this).hasClass('aq_span'+i) ? $(this).removeClass('aq_span'+i).addClass('span'+i) : null;
				if( $(this).hasClass('aq_span'+i) ) {
					switch ( i ) {
						case 1 :
							gridSuf = 10
						break;
						case 2 :
							gridSuf = 20 // 15 ?
						break;
						case 3 :
							gridSuf = 25
						break;
						case 4 :
							gridSuf = 33
						break;
						case 5 :
							gridSuf = 40
						break;
						case 6 :
							gridSuf = 50
						break;
						case 7 :
							gridSuf = 60
						break;
						case 8 :
							gridSuf = 66
						break;
						case 9 :
							gridSuf = 75
						break;
						case 10 :
							gridSuf = 80 // 75 ?
						break;
						case 11 :
							gridSuf = 90
						break;
						case 12 :
							gridSuf = 100
						break;						
					}
					$(this).removeClass('aq_span'+i).addClass('grid-'+gridSuf);
                }
				
			}
			
			if( $(this).parent().hasClass('aq-block-aq_column_block') ) {
				
				var elm = $(this);
				var regEx = /^grid-/;
				var classes = elm.attr('class').split(/\s+/); //it will return  span1, span2, span3, span4
	 
				for (var i = 0; i < classes.length; i++) {
				  var className = classes[i];
					 
				  if (className.match(regEx)) {
					elm.removeClass(className);
				  }
				}
				
				elm.addClass('grid-100');

			}
		});
		 
		/* 
		$('.page-template-default .aq-block-as_row_block').each(function() {
				$(this).find('> div').wrapAll('<div style="padding:20px" />');
			}
		); */
		//
		$('.block-recent').each(function() {
		
			if( $(this).find('.more-block').length ) {
				$(this).css('margin-bottom', 120);
			}
		});
		
/** end AQUA PAGE BUILDER */		
		
		
		
/**
 *	ANIMATE ELEMENTS ON HOVER ETC.
 *
 */
		
		$('.as-hover, .icon-block-cell .fs1, .owl-page span').as_Hover();
		
		$('.cb-3 .item.style1').hoverBlockItems();

/**
 *	BANNER ANIMATE COLOR (transitions in css)
 *
 */ 
	
	$('.banner-block').each(function () {
	
		if( $(this).hasClass('disable-invert') ) {
		
			return;
			
		}else{
			// from block settings:
			var fontSet	= $(this).find('.varsHolder').attr('data-fontColor'),
				boxSet	= $(this).find('.varsHolder').attr('data-boxColor');
			
			// define all inner elements:
			var box			= $(this).find('.overlay'),
				title		= $(this).find('h3'),
				text		= $(this).find('.text'),
				subtitle	= $(this).find('.block-subtitle');
				
			// get elem. default vaules:
			var boxDef		= box.css('background-color'),
				titleDef	= title.css('color'),
				textDef		= text.css('color'),
				subtitleDef = subtitle.css('color');
			//invert values on hover:
			$(this).hover(
				function (){
					
					fontSet ? box.css('background-color', fontSet) : box.css('background-color', textDef);
					//$(this).css('color', boxSet);
					boxSet ? title.css('color', boxSet) : title.css('color', boxDef);
					boxSet ? text.css('color', boxSet) : text.css('color', boxDef);
					boxSet ? subtitle.css('color', boxSet) : subtitle.css('color', boxDef);
				},
				function () {
					
					boxSet ? box.css('background-color', boxSet) : box.css('background-color', boxDef);
					//$(this).css('color', fontSet);
					fontSet ? title.css('color', fontSet) : title.css('color', titleDef);			
					fontSet ? text.css('color', fontSet) : text.css('color', textDef);			
					fontSet ? subtitle.css('color', fontSet) : subtitle.css('color',subtitleDef);			
				}
			);
		
		} // end if
	
	});
/**
 *	PRETTYPHOTO
 *
 */
		
	$('#review_form_wrapper').hide();
		
		
		$('a[data-rel]').each(function() {
			$(this).attr('rel', $(this).data('rel'));
		});		
		$('a[rel^="prettyPhoto"]').prettyPhoto(
			{	
				theme				: 'light_square',
				opacity				: 0.6,
				slideshow			: 5000, 
				social_tools		: false,
				autoplay_slideshow	: false,
				show_title			: false,
				deeplinking			: false,
				markup: 			'<div class="pp_pic_holder"> \
						<div class="ppt">&nbsp;</div> \
						<div class="pp_top"> \
							<div class="pp_left"></div> \
							<div class="pp_middle"></div> \
							<div class="pp_right"></div> \
						</div> \
						<div class="pp_content_container"> \
							<div class="pp_left"> \
							<div class="pp_right"> \
								<div class="pp_content"> \
									<div class="pp_loaderIcon"></div> \
									<div class="pp_fade"> \
										<a href="#" class="pp_expand" title="Expand the image"></a> \
										<div class="pp_hoverContainer"> \
											<a class="pp_next" href="#"></a> \
											<a class="pp_previous" href="#"></a> \
										</div> \
										<div id="pp_full_res"></div> \
										<div class="pp_details"> \
											<div class="pp_nav"> \
												<a href="#" class="pp_arrow_previous"></a> \
												<p class="currentTextHolder">0/0</p> \
												<a href="#" class="pp_arrow_next"></a> \
											</div> \
											<p class="pp_description"></p> \
											{pp_social} \
											<a class="pp_close" href="#"></a> \
										</div> \
									</div> \
								</div> \
								<div class="clearfix"></div>\
							</div> \
							</div> \
						</div> \
						<div class="pp_bottom"> \
							<div class="pp_left"></div> \
							<div class="pp_middle"></div> \
							<div class="pp_right"></div> \
						</div> \
					</div> \
					<div class="pp_overlay"></div>',
					ajaxcallback: function(){
						if( $("video,audio").length ) {
							$("video,audio").mediaelementplayer();
						}
					}
			});
/** END PRETTYPHOTO */



/**
 *	STICKY MENU ( for onepager usage )
 *		
 **/		
		
		
	//$('.sticky-block').waypoint('sticky', { stuckClass: 'stuck',  offset: 1});
	
	$('.sticky-block').each(function() {
		
		var sticky = new Waypoint.Sticky({
			element: $(this)[0],
			stuckClass: 'stuck',
			offset: 1
			//handler:handlerFunction()
		})
		
	});

	function correctStickyWidth() {
	
		var stickyBlock = $('.sticky-block');
		stickyBlock.width( stickyBlock.parent().width() );
		
		stickyBlock.parent().closest('.aq-block').css('z-index', '10');
		stickyBlock.parent().closest('.aq-block-as_row_block').css('overflow', 'visible');
		stickyBlock.parent().closest('.full-width').css('position', 'static');
	}
	
	$( window ).resize( function () {
		correctStickyWidth();
	});
	
	correctStickyWidth();

		
/**
 *	SHUFFLE PLUGIN initiate and setup filters.
 *
 */
	$('.shuffle-filter-holder').each( function () {
		
		var filterBlock = $(this);
		
		var $grid = filterBlock.find('.shuffle'),
			$sizer = $grid.find('.item'),
			$filterOptions = filterBlock.find('ul.tax-filters');
	
			
		$grid.shuffle({
			group: 'all',
			itemSelector: '.item',
			sizer: null,
			throttle: $.throttle,
			speed: 450, 
			easing: 'ease-out'
		});
		
		function setupFilters() {
			
			var $btns = $filterOptions.children();
			
			$btns.find('a').on('click', function(event) {
				
				event.preventDefault();
				
				var $this = $(this),
				isActive = $this.hasClass( 'active' ),
				group = isActive ? 'all' : $this.data('group');

				// Hide current label, show current label in title
				if ( !isActive ) {
					$('ul.tax-filters .active').removeClass('active');
				}

				$this.toggleClass('active');

				// Filter elements
				$grid.shuffle( 'shuffle', group );
			
			});

			$btns = null;	
			
		}
		setupFilters();
		
		function setupSorting() {
			// Sorting options
			filterBlock.find('.sort-options').on('change', function() {
				var sort = this.value,
					opts = {};

				// We're given the element wrapped in jQuery
				if ( sort === 'date-created' ) {
					opts = {
					  reverse: true,
					  by: function($el) {
						return $el.data('date-created');
					  }
					};
				}else if ( sort === 'title' ){
					opts = {
						by: function($el) {
						return $el.data('title').toLowerCase();
						}
					};
				}

				// Sort elements
				$grid.shuffle('sort', opts);
			});
		}
		
		setupSorting();
		
		$grid.on('layout.shuffle', function() {
			$.waypoints('refresh');
		});
		
	});
/** end Shuffle plugin setup */
	
	
/**/});// ||||||||||||||| 	END ON WINDOW LOAD

// continue on document ready:



/**
 *	MEGA MENU and REGULAR MENU SYSTEM
 *
 */		
	// 1. REMOVE MEGA MENU FOR MOBILE DEVICES ( displays as regular submenu )
	
	$('.mobile-dropdown').find('.sub-menu').removeClass('sf-mega').css('display','none');
	$('.mobile-dropdown').find('.mega-parent').removeClass('mega-parent');
	
	$('body').append('<div class="active-mega arrow-left"><span class="arrow-left"></span></div>');
	 
	// CLONE SUBMENUS WITH CLASS SF-MEGA
	var $megaID = 0;
	$('.sf-mega').each(function () {
		
		$megaID ++;
		
		var header		 = $(this).closest('#site-menu'),
			parentOfMenu = $(this).closest('#site-menu').find('.grid-container');
		
		
		if( header.hasClass('vertical') ) {
			$(this).clone().addClass('mega-clone').addClass('vertical-mega').attr('id','mega-'+$megaID).appendTo( 'body' );
		}else if( header.hasClass('horizontal') ){
			$(this).clone().addClass('mega-clone').addClass('horizontal-mega').removeClass('sub-menu').attr('id','mega-'+$megaID).appendTo( parentOfMenu );
		}
		
		verticalMega_Hposition();
		
		$(this).prev('a').attr('data-megaid', 'mega-'+$megaID);
		
		$('.mega-clone').css('display','none');
		
	});
	// CLONE REGULAR SUBMENUS
	var $subCloneID = 0;
	$('#site-menu .navigation > li > .sub-menu').each(function () {
		
		$subCloneID ++;
		
		var header		 = $(this).closest('#site-menu'),
			parentOfMenu = $(this).closest('#site-menu').find('.grid-container'),
			thisParent	 = $(this).parent();
		
		if( thisParent.hasClass('mega-parent') ) 
			return;
			
			if( header.hasClass('vertical') ) {
				$(this).clone().addClass('sub-clone').addClass('vertical-sub').attr('id','sub-'+$subCloneID).removeClass('sub-menu').appendTo( 'body' );
			}else if( header.hasClass('horizontal') ) {
				$(this).clone().addClass('sub-clone').addClass('horizontal-sub').attr('id','sub-'+$subCloneID).removeClass('sub-menu').appendTo( parentOfMenu );
			}
			
			$(this).prev('a').attr('data-subid', 'sub-'+$subCloneID);
			
			$('.sub-clone').css('display','none');
		
		
		
	});
	
	
	
	// MAKE CLONED MEGA SUBMENU GO AWAY
	$('.navigation li a').click( function() {
		if(!window.Mobile ) { 
			$('.mega-clone').fadeOut(100);
		}
	});
	/*
	 $('.navigation li a').mouseenter( function() {
		$( '.active-mega').remove();
	});
	 */
	
	// MAKE MEGA VISIBLE:
	$('#site-menu ul.navigation > .menu-item-has-children a').mouseenter(

		function(e) {
		
			// FIX FOR MEGA PARENT OFFSET TOP:
			var adminbar = $('#wpadminbar').height(), // if there's admin bar, add this to fix
				offsetFix =  $('#site-menu').offset().top - ($(this).outerHeight(true)/2 + adminbar); 
			
			
			if( $('.mega-clone').length || $('.sub-clone').length ) {
				megaPosition( $(this) );
			}
		
			e.preventDefault();
			e.stopPropagation();
			
			// RESET (HIDE) ANY SUB OR MEGA, FIRST:
			$('.sub-menu, .mega-clone, .sub-clone').css('display','none');
			
			
			var mega_link = $(this).attr('data-megaid');
			var sub_link = $(this).attr('data-subid');
			
			
			// vertical pos. of arrow
			$('.vertical-layout .active-mega').css('top', $(this).offset().top - offsetFix );
			
			// vertical pos. of regular sub-menu
			if( $('#'+ sub_link).hasClass('vertical-sub') ) {
				var offsetSub = offsetFix + ( $('#'+ sub_link).outerHeight(true) /2 );
				$('#'+ sub_link).css('top', $(this).offset().top - offsetSub );
			}
			
			// fix position 
			verticalMega_Hposition();

			// MAKE VISIBLE:
			$('#'+ mega_link).stop(true,false).css('display','block').animate({'opacity':1 },{duration:300, easing: 'linear'});
			$('#'+ sub_link).stop(true,false).css('display','block').animate({'opacity':1 },{duration:300, easing: 'linear'});
			
			
			
			
			$('.vertical-layout .active-mega').stop(true,false).css('display','block').animate({'opacity':1 },{duration:300, easing: 'linear'});
			
		}
	).mouseleave(
	
		function (e) {
		
			var mega_link = $(this).attr('data-megaid');
			var sub_link = $(this).attr('data-subid');
			
			$('#'+ mega_link).stop(true,false).delay(300).animate( {'opacity':0 },{duration:100, easing: 'linear', complete: 
				function() {
					$('#'+ mega_link).css('display','none');
				} 
			} );
			$('#'+ sub_link).stop(true,false).delay(300).animate( {'opacity':0 },{duration:100, easing: 'linear', complete: 
				function() {
					$('#'+ sub_link).css('display','none');
				} 
			} );
			
			$( '.vertical-layout .active-mega').stop(true,true).delay(300).animate( {'opacity':0 },{duration:300, easing: 'linear'});
			
			
		}
		
	);
	// MAKE SUBS VISIBLE ( IN DEPTH ) :
	$('.sub-clone li').mouseenter(
		
		function(e) {
		
			e.stopPropagation();
			
			var $this		= $(this),
				clonesub	= $this.find('.sub-menu'),
				clonesubPos	= $this.offset().left + $this.outerWidth(true) + 220;
						
			
			if( clonesubPos >= $( document ).width() ) {
				clonesub.css('left','auto').css('right','100%');
			}
			
			clonesub.fadeIn();
		}
		
	)
	.mouseleave(	
		function(e) {
			var clonesub = $(this).find('.sub-menu');
			clonesub.fadeOut();
		}
	);
	
	$('#menu-secondary li.dropdown').mouseover(
		function (e) {
			$(this).find('ul.sub-menu').fadeIn();
			console.log();
		}
	).mouseleave(
		function (e) {
			$(this).find('ul.sub-menu').fadeOut();
		}
	);
	
	
	//
	// MEGA or SUB MENU CONFIRM IS ACTIVE:
	$(document).on('mouseover','.mega-clone, .sub-clone', function (e) {
		e.stopPropagation();
		$(this).stop(true,false).css('display','block').animate({'opacity':1 },{duration:300, easing: 'linear'});
		$( '.vertical-layout .active-mega').stop(true,false).css('display','block').animate({'opacity':1 },{duration:300, easing: 'linear'});
	});
	
	// HIDE MEGA MENU WHEN MOUSE LEAVES MEGA MENU
	$(document).on('mouseleave','.mega-clone, .sub-clone', function (e) {
		e.stopPropagation();
		$(this).stop(false,true).delay(300).fadeOut( 200 );
		$('.vertical-layout .active-mega').delay(300).css('display','none');
	});
	
	$(document).click(function () {
		if( !window.Mobile ) { 
			$('.mega-clone').fadeOut( 200, function() {$('.mega-clone').fadeOut(); } );
		}
	});

	$('.horizontal ul.navigation > li').find('> .sub-menu').each(
		function () {
			var sub = $(this),
				sub_parent = $(this).parent(),
				horiz_sub_pos	= sub_parent.outerWidth(true)/2  - sub.outerWidth(true)/2  ;
				
			sub.css('left', horiz_sub_pos )
		}
	);
	
/**
 *	MENU POSITION ON HORIZONTAL LAYOUT:
 */
function megaPosition( triggered ) {
		
	var megaid	= triggered.attr("data-megaid"),
		mega	= $('#' + megaid ),
		subid	= triggered.attr("data-subid"),
		sub		= $('#' + subid);
	
	if( mega.hasClass('horizontal-mega') || sub.hasClass('horizontal-sub') ) {
		
		var top_shift		= triggered.offset().top, // top position of hovered nav element
			parentoffsetTop	= triggered.closest('.grid-container').offset().top, // first positioned el. top
			parentoffsetLeft= triggered.closest('.grid-container').offset().left,// first positioned el. left
			triggered_H		= triggered.outerHeight(true), // height of hovered nav element
			triggered_L		= triggered.offset().left, // left position of hovered nav element
			triggered_W		= triggered.outerWidth(true) / 2, // width of hovered nav element
			sub_W			= sub.outerWidth(true) / 2 ; // width of sub element
		
		// calculate positions
		var topPosition		= top_shift - parentoffsetTop + triggered_H,
			leftPosition	= ( triggered_L + triggered_W )- sub_W - parentoffsetLeft ;
		
		// apply positions
		mega.css('top', topPosition );
		sub.css('top', topPosition );
		sub.css('left',leftPosition );
				
	}

}
/** end postion of mega menu */

	
/**
 *	MAKE RELATIVE - depending on WATCH plugin 
 *
 *	if element's height is exceeding parent change css position absolute to relative.
 *	used in single product block ( AQPB )
 */
if ( $.browser.mozilla ) {
	$('.wrap').closest('.single-product-block').addClass('mozilla');
}else{
	$('.wrap').closest('.single-product-block').addClass('not-mozilla');
}
function makeRelative( el ) {
   
	var parent		= el.parent(),
		parentH		= parent.height(),
		thisH		= el.height();
   
	if( parentH >= thisH ) {
		parent.removeClass('adapt-to-child');
	}else
	if( parentH < thisH) {
		parent.addClass('adapt-to-child');
	}
	
}
$('.wrap').watch("height",
	function() {                         
		makeRelative( $('.wrap') );
	},
100);
/** end MAKE RELATIVE */


/**
 *	VERTICAL MEGA - vert. position fix - correct X position of vertical mega menu
 *
 */
function verticalMega_Hposition() {
	
	var htmlW		= $('html').width(),
		bodyW		= $('body').width();
		
	
	if( htmlW >= bodyW ) {
		var megaShift	= htmlW/2 - bodyW/2;
		var menuW		= $('#site-menu').width();
		$(".vertical-mega").css( 'left', megaShift + menuW );
		$('.active-mega').css( 'left', megaShift + menuW - 11  );
		$(".vertical-sub").css( 'left', megaShift + menuW );
	}
}
verticalMega_Hposition();

	
/**
 *	WINDOW RESIZE EVENTS.
 *
 */
	$(window).resize(function() {
		
		makeRelative( $('.wrap') );
		
		verticalMega_Hposition();
		/*
		if( $('.mega-clone').length) {
			megaPosition( $('.mega-clone') );
		}
		*/
	});
	
/** end WINDOW RESIZE */
	

/**
 *
 * OWL CAROUSELS.
 *
 */
	
	function owlCarousels() {
		
		// CONTENT SLIDERS - posts, product, portfolio lists
		var contentSlides = $(".contentslides");
		
		contentSlides.each(	function() {
			
			var $this = $(this);
			
			var cs_navig		= $this.prev('input.slides-config').attr('data-navigation');
			var cs_pagin		= $this.prev('input.slides-config').attr('data-pagination');
			var cs_auto			= $this.prev('input.slides-config').attr('data-auto');
			var cs_transition	= $this.prev('input.slides-config').attr('data-trans');
			
			$(this).owlCarousel({
						singleItem			: true,
						autoPlay			: cs_auto == 0 ? false : cs_auto,
						stopOnHover			: true,
						navigation			: cs_navig == 1 ? true : false,
						pagination			: cs_pagin == 1 ? true : false,
						addClassActive		: false,
						autoHeight 			: true,
						mouseDrag			: true,
						rewindNav			: true,
						paginationNumbers	: false,
						navigationText		:["&#xe16d;","&#xe170;"],
						beforeInit			: function () {
							// fixes row block fixed background image in Chrome/Safari:
							$('.aq-block-as_row_block').css('-webkit-transform:', 'translate3d(0,0,0)');
						},
						transitionStyle		: cs_transition ? cs_transition : false
					});
			cs_navig = cs_pagin = cs_auto = cs_transition = '';
		});
		
		// SINGLE PRODUCT BLOCK IMAGES SLIDER
		var singleSlides = $(".singleslides");
		
		singleSlides.each(	function() {
			
			var $this = $(this);
			
			var sp_navig		= $this.prev('input.slides-config').attr('data-navigation');
			var sp_pagin		= $this.prev('input.slides-config').attr('data-pagination');
			var sp_auto			= $this.prev('input.slides-config').attr('data-auto');
			var sp_transition	= $this.prev('input.slides-config').attr('data-trans');
			
			$this.owlCarousel({
						singleItem			: true,
						autoPlay			: sp_auto == 0 ? false : sp_auto,
						stopOnHover			: true,
						navigation			: sp_navig == 1 ? true : false,
						pagination			: sp_pagin == 1 ? true : false,
						addClassActive		: false,
						autoHeight 			: true,
						mouseDrag			: true,
						rewindNav			: true,
						paginationNumbers	: false,
						navigationText		:["&#xe16d;","&#xe170;"],
						/* beforeInit			: function () {
							// fixes row block fixed background image in Chrome/Safari:
							$('.aq-block-as_row_block').css('-webkit-transform:', 'translate3d(0,0,0)');
						} */
						transitionStyle		: sp_transition ? sp_transition : false
					});
			sp_navig = sp_pagin = sp_auto = '';
		});
		
		
		// SIMPLE IMAGE SLIDER - owl default responsiveness
		var imageSlides = $(".simpleslides");
		
		imageSlides.each(	function() {
			
			var $this	= $(this),
				config	= $this.prev('input.simpleslides-config');
			
			var ss_navig	= config.attr('data-navigation');
			var ss_pagin	= config.attr('data-pagination');
			var ss_auto		= config.attr('data-auto');			
			var ss_desk		= config.attr('data-desktop');			
			var ss_desksmall= config.attr('data-desktop-small');			
			var ss_tablet	= config.attr('data-tablet');			
			var ss_mobile	= config.attr('data-mobile');			
			var ss_transition	= config.attr('data-trans');			
			
			$this.owlCarousel({
						
						items				: ss_desk ? ss_desk : 4,
						itemsCustom			: false,
						itemsDesktop		: [1199,ss_desk ? ss_desk : 4],
						itemsDesktopSmall	: [980,ss_desksmall ? ss_desksmall : 3],
						itemsTablet			: [768,ss_tablet ? ss_tablet : 2],
						itemsTabletSmall	: false,
						itemsMobile			: [479,ss_mobile ? ss_mobile : 1],
						singleItem			: ss_transition ? true : false,
						autoPlay			: ss_auto == 0 ? false : ss_auto,
						stopOnHover			: true,
						navigation			: ss_navig == 1 ? true : false,
						pagination			: ss_pagin == 1 ? true : false,
						addClassActive		: false,
						autoHeight 			: true,
						mouseDrag			: true,
						rewindNav			: true,
						paginationNumbers	: false,
						navigationText		:["&#xe16d;","&#xe170;"],
						beforeInit			: function () {
							// fixes row block fixed background image in Chrome/Safari:
							$('.aq-block-as_row_block').css('-webkit-transform:', 'translate3d(0,0,0)');
						},
						transitionStyle		: ss_transition ? ss_transition : false
						
					});
			ss_navig = ss_pagin = ss_auto = ss_transition = '';
			
		});
		
		
		// BIG SLIDERS
		var myOwlCarousel = $(".owlcarousel-slider");

		myOwlCarousel.each( function (){
			
			var $this = $(this);
			
			var myowl_navig = $this.prev('input.slides-config').attr('data-navigation');
			var myowl_pagin = $this.prev('input.slides-config').attr('data-pagination');
			var myowlauto	= $this.prev('input.slides-config').attr('data-auto');
			var myowltrans	= $this.prev('input.slides-config').attr('data-trans');
			
			var owlData = $this.data(); // get carousel object data (once owlCarousel plugin initiated)
			
			$(this).owlCarousel({
				singleItem		: true,
				autoPlay		: myowlauto ? myowlauto : myowlauto, // bocypressn or miliseconds: 5000 for 5 sec.
				stopOnHover		: true,
				navigation		: myowl_navig == 1 ? true : false,
				pagination		: myowl_pagin == 1 ? true : false,
				addClassActive	: true,
				autoHeight		: true,
				rewindNav		: true,
				navigationText	:["&#xe16d;","&#xe170;"],
				transitionStyle	: myowltrans ? myowltrans : false,
				beforeInit		: function () {
							// fixes row block fixed background image in Chrome/Safari:
							$('.aq-block-as_row_block').css('-webkit-transform:', 'translate3d(0,0,0)');
						},
				afterInit		: function () {
					var item = $this.find('.owl-item');// get items of this slider object
					item.each(function () {
						initLayers( $(this) )
					});
				},
				startDragging	: function () {
	
					var direction = owlData.owlCarousel.playDirection;
					var prevNext = (direction === 'prev') ? 'prevItem' : 'currentItem';
					
					var currItem =  owlData.owlCarousel[prevNext] ;
					
					var item = $this.find('.owl-item');// get items of this carousel object
					item.each( function() {
						
						if( $(this).index() == currItem ){
							slider_anim_out($(this));
						}
					
					});
					
				},
				beforeMove		: function () {
					
					var oldItem =  owlData.owlCarousel.prevItem ;
					var item = $this.find('.owl-item'); // get items of previous carousel object
					item.each( function() {
						if( $(this).index() == oldItem ){
							slider_anim_out($(this));
						}
					});
					

				},
				afterMove		: function () {
	
					var currItem =  owlData.owlCarousel.currentItem ;
					var item = $this.find('.owl-item');// get items of this slider object
					item.each( function() {	
						if( $(this).index() == currItem ){
							slider_anim_in($(this));
						}
					});

				}
			});		
		});
		
	}
	
	
	$(window).load(function() {
		owlCarousels();
	})
	
	$( '.contentslides, .singleslides, .slider, .simpleslides' )
		.hover(function() {
			$('.owl-buttons', this).stop(false,true).animate({'left': 0, 'right':  0 },{duration:200, easing: 'linear'});
			$('.owl-pagination', this).stop(false,true).animate({'bottom': 0 },{duration:200, easing: 'linear'});
			
		},
		function() {
			$('.owl-buttons', this).stop(false,true).animate({'left':-50, 'right': -50 },{duration:200, easing: 'linear'});
			$('.owl-pagination', this).stop(false,true).animate({'bottom':-50 },{duration:200, easing: 'linear'});
		});
/**
 *
 *	Sliders styles.
 *	different styles of animation of slider block
 *
 */
	
	/**
	 *	Functions for current and new slide for out and in animations
	 *	called from sliders() function
	 *
	 */
	function initLayers ( item ){
		
		item.find('.text').children().each( function(index, value) {
			
				$(this).addClass('inactive');
				
				if( item.index() == 0 ){
					$(this).removeClass('inactive').addClass('active');
				}
			}
		);
		
	}
	function slider_anim_in (new_in) {
		
		new_in.find('.text').children().each( function(index, value) {
			$(this).delay(200 * index).queue(
				function() {
					$(this).removeClass('inactive').addClass('active');
				}
			).dequeue();
		});
	
	}
	
	function slider_anim_out(old_out) {
		
		old_out.find('.text').children().each( function(index, value) {
			$(this).delay(300 * index).removeClass('active').addClass('inactive');
		});

	}	

	
	
/**
 *
 *	Google maps initiate and unload.
 *
 *	if issues with this - add in body tag - <body onload="initialize()" onunload="GUnload()">
 */
	
	if( $('.google-map').length ) {
		$(window).load(function() {
			initialize(); 
		});
		$(window).unload(function() {
			unload();
		});
	}

	/** end Slider styles */
	
	
	/**
	 * Posts, product, portfolios items image hover effect.
	 *
	 */	
	$(function () {
			
		var itemImg = $('.item-content, .item-images').find('.item-img');
		
		$('html').removeClass('csstransforms3d');
		
		//itemImg.find('.back').css('bottom', ($(this).height() * -1) );
		itemImg.find('.back').css('opacity', 0 );
		
		// CSS 3D is not supported, use the scroll up effect instead
		itemImg.hover(
			function (event) {
				$(this).find('.back').stop().animate({opacity: 1}, 500, 'easeOutCubic');
			},
			function (event) {
				$(this).find('.back').stop().animate({opacity: 0 }, 500, 'easeOutCubic');			
			}
		);

	});
	
	$(function () {
			
		var itemImg = $('.single-slide');
		
		$('html').removeClass('csstransforms3d');
		
		//itemImg.find('.back').css('bottom', ($(this).height() * -1) );
		itemImg.find('.back').css('opacity', 0 );
		
		// CSS 3D is not supported, use the scroll up effect instead
		itemImg.hover(
			function (event) {
				$(this).find('.back').stop().animate({opacity: 1}, 500, 'easeOutCubic');
			},
			function (event) {
				$(this).find('.back').stop().animate({opacity: 0 }, 500, 'easeOutCubic');			
			}
		);

	});
	
	/** end image hover effect */
	

	/**
	 *	WAYPOINTS REFRESH
	 *
	 */
	$(window).resize(function() {
		$.waypoints('refresh');
	});
	
	/**
	 *	WC Variations image changes ( magnifier, slider or default view )
	 */
	
	window.variableProductImages = function () {
		
		var single_product		= $('.single-product .product, .qv-holder .product');
		
		single_product.each( function() {
			
			var $_this			= $(this),										// single product object
				$_images		= $_this.find('.images');
			
			var	featuredProdImage	= $_images.find('.featured'),
				larger_image_url	= $_images.find('a.larger-image-link'),		// modal image url
				defaultProdImage	= larger_image_url.attr('data-zoom-image'),	// cache featured image ( for reset dropdown select )
				defaultLargeImage	= larger_image_url.attr( 'data-o_href' ),	// cache large featured image
				productsOwlSlider	= $_this.find('.owl-carousel');				// option: images slider
											
			if( productsOwlSlider.length ) {
				productsOwlSlider.on('initialized.owl.carousel', function(event) { 
					featuredProdImage	= $_images.find('.featured');
				});
			}
			
			// Variations form in this single product object
			var var_form = $_this.find('form.variations_form ');
			
			// Change event on select element
			var_form.on('change','.variations select' , function(e){ 
				
				var zoomWindow			= $('.zoomWindow');
				
				// Get select dropdown data :  all variations data and get selected index
				var select			= $(this),
					//parse_form_data	= $.parseJSON( var_form.attr('data-product_variations') ),
					//form_data		= parse_form_data.reverse(),
					form_data		= $.parseJSON( var_form.attr('data-product_variations') ),
					selected_index	= select.find('option:selected').index(),
					selected		= form_data[selected_index -1];

				// Get variation data by selected dropdown index
				var var_id, image_src = '';
				if( selected !== undefined  ) {
					// 3.0.0 < Fallback conditional
					if( ! $("body").hasClass( "WC2.7" ) ) {
						var_id			= form_data[selected_index -1].variation_id;
						image_src		= form_data[selected_index -1].image_src;
					}else{
						var_id			= form_data[selected_index -1].id;
						image_src		= form_data[selected_index -1].image.src;
					}
					
					
				}else{
					// BACK TO DEFAULT IMAGE ( if select is set to default (no variataion))
					featuredProdImage.attr( 'src', defaultProdImage );
					zoomWindow.css('background-image', 'url(' + defaultProdImage + ')');
					larger_image_url.attr( 'href', defaultLargeImage );
					// if slider: reset Owl carosel to first (featured) image
					if( productsOwlSlider.length ) {
						productsOwlSlider.trigger('owl.goTo', [0]);
					}
					return;
				}
				
				// if no variation image - ABORT MISSION - back to default image (same as above):
				if( image_src === '' ) {
					// BACK TO DEFAULT IMAGE
					featuredProdImage.attr( 'src', defaultProdImage );
					zoomWindow.css('background-image', 'url(' + defaultProdImage + ')');
					larger_image_url.attr( 'href', defaultLargeImage );
					// if slider: reset Owl carosel to first (featured) image
					if( productsOwlSlider.length ) {
						productsOwlSlider.trigger('owl.goTo', [0]);
					}
					return;
				}
				
				// AJAX load image (background-image) to zoomWindow,  with preload:
				var preload = '<div class="zoom-image-preload"><span class="icon-spinner"></span></div>';
				zoomWindow.html( preload );
				$_images.append( preload );
				// Clear Zoom window background-image:
				zoomWindow.css('background-image', '' );
				// Resize trigger quick view window when price toggles on change variation:
				setTimeout( function() { $(window).trigger("resize"); }, 300 );
				
				console.log( image_src + " || " + zoomWindow.attr( "class" ) );
				
				$.ajax({

					type: "POST",
					url: window.cypress_ajaxurl,
					data: { "action": "var-image", var_id: var_id  },
					success: function(response) {

						// Remove preloaders
						$('.zoom-image-preload').fadeOut( 300, function() { $(this).remove(); } );
						zoomWindow.html( '' );
						
						// replace featured image
						featuredProdImage.attr( 'src', image_src );
						
						// Link to larger image / zoom window image
						larger_image_url.attr( 'href', $.trim( response ) );							
						zoomWindow.css('background-image', 'url(' + $.trim( image_src )  + ')' );
													
						// if slider: reset Owl carosel to first (featured) image
						if( productsOwlSlider.length ) {
							productsOwlSlider.trigger('owl.goTo', [0]);
							featuredProdImage.attr( 'src', image_src );
						}
						
						$(window).trigger("resize");

					}, // end success
					error: function () {
						alert("Ajax error");
					} //end error
				});
				
			}); // end on change
			var_form.on( 'click','.reset_variations', function(){
				
				var zoomWindow	= $('.zoomWindow');
				
				zoomWindow.css('background-image', 'url(' + defaultProdImage + ')');
				larger_image_url.attr( 'href', defaultLargeImage );
				
				if( productsOwlSlider.length ) {
					productsOwlSlider.trigger('owl.goTo', [0]);
					featuredProdImage.attr( 'src', defaultProdImage );
				}
			}); // end on click
			
		}); // end images.each
		
	}; // end function variableProductImages()
	
	var variableProductImages = window.variableProductImages();
	// end WC Variations image changes
	
	
}); // end document.ready


/**
 *	WooCommerce messages
 *
 */
	$('.theme-shop-message').find('.woocommerce-message').append('<div class="message-remove"></div>');
	$('.theme-shop-message,.woocommerce-message .message-remove').on('click',function() {
		$('.theme-shop-message').fadeOut();
	});
	
	setTimeout( "jQuery('.theme-shop-message').fadeOut();",3000 );


})(jQuery);