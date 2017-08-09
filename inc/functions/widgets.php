<?php
function cypress_widgets() {
//
	global $of_cypress, $cypress_woo_is_active;
	$icons = $of_cypress['default_widget_icons'];
	
	register_sidebar( array(
		'name'			=> __( 'Sidebar', 'cypress' ),
		'id'			=> 'sidebar',
		'description'	=> 'default Wordpress widget area - for blog, pages and archives sidebar',
		'before_widget'	=> '<aside class="widget %2$s" id="%1$s"><div class="widget-wrap">',
		'after_widget'	=> '</div><div class="clearfix"></div></aside>',
		'before_title'	=> '<h4 class="widget-title'. ($icons ? '' : ' no-icon') .'">',
		'after_title'	=> '</h4>',
	) );
//
//	
//	IF WOOCOMMERCE PLUGIN IS ACTIVATED, TURN ON THESE WIDGET AREAS:
	if( $cypress_woo_is_active ) {
	
		register_sidebar( array(
			'name'			=> __( 'Shop sidebar', 'cypress' ),
			'id'			=> 'sidebar-shop',
			'description'	=> 'for usage with sidebar on WooCommerce shop pages - catalog, single product, cart, checkout, account ...',
			'before_widget' => '<aside class="widget %2$s id="%1$s""><div class="widget-wrap">',
			'after_widget'	=> '</div><div class="clearfix"></div></aside>',
			'before_title'	=> '<h4 class="widget-title'. ($icons ? '' : ' no-icon') .'">',
			'after_title'	=> '</h4>',
		) );
	//
	//	
		register_sidebar( array(
			'name'			=> __( 'Products page filter widgets', 'cypress' ),
			'id'			=> 'product-filters-widgets',
			'description'   => 'special widgets area, only visible in products catalog (archives) page, created for usage with products filters.',
			'before_widget'	=> '<aside class="widget %2$s" id="%1$s"><div class="widget-wrap">',
			'after_widget'	=> '</div><div class="clearfix"></div></aside>',
			'before_title'	=> '<h4 class="widget-title'. ($icons ? '' : ' no-icon') .'">',
			'after_title'	=> '</h4>',
		) );
	//	
	//	
		register_sidebar( array(
			'name'			=> __( 'Filter reset widget', 'cypress' ),
			'id'			=> 'layered-nav-filter-widgets',
			'description'   => 'for usage with "WooCommerce Layered Nav Filters" widget ONLY - if Layered Nav is used, place here the "WooCommerce Layered Nav Filters" widget to remove filters',
			'before_widget'	=> '<aside class="widget %2$s" id="%1$s"><div class="widget-wrap">',
			'after_widget'	=> '</div><div class="clearfix"></div></aside>',
			'before_title'	=> '<h4 class="widget-title'. ($icons ? '' : ' no-icon') .'">',
			'after_title'	=> '</h4>',
		) );

	}	
//
//	
	register_sidebar( array(
		'name'			=> __( 'Header widgets', 'cypress' ),
		'id'			=> 'sidebar-header',
		'description'	=> 'to be used in side menu or header menu - remember to set header widget block in Theme options.',
		'before_widget'	=> '<aside class="widget %2$s" id="%1$s"><div class="widget-wrap">',
		'after_widget'	=> '</div><div class="clearfix"></div></aside>',
		'before_title'	=> '<h4 class="widget-title'. ($icons ? '' : ' no-icon') .'">',
		'after_title'	=> '</h4>',
	) );
//
//	
	register_sidebar( array(
		'name'			=> __( 'Header widgets 2', 'cypress' ),
		'id'			=> 'sidebar-header-2',
		'description'	=> 'to be used in side menu or header menu - remember to set header widget block in Theme options.',
		'before_widget'	=> '<aside class="widget %2$s" id="%1$s"><div class="widget-wrap">',
		'after_widget'	=> '</div><div class="clearfix"></div></aside>',
		'before_title'	=> '<h4 class="widget-title'. ($icons ? '' : ' no-icon') .'">',
		'after_title'	=> '</h4>',
	) );
//
//	
	register_sidebar( array(
		'name'			=> __( 'Header widgets 3', 'cypress' ),
		'id'			=> 'sidebar-header-3',
		'description'	=> 'to be used in side menu or header menu - remember to set header widget block in Theme options.',
		'before_widget'	=> '<aside class="widget %2$s" id="%1$s"><div class="widget-wrap">',
		'after_widget'	=> '</div><div class="clearfix"></div></aside>',
		'before_title'	=> '<h4 class="widget-title'. ($icons ? '' : ' no-icon') .'">',
		'after_title'	=> '</h4>',
	) );
//
//
	register_sidebar( array(
		'name'			=> __( 'Footer widgets 1', 'cypress' ),
		'id'			=> 'footer-widgets-1',
		'description'	=> 'widget area for usage in site footer.',
		'before_widget'	=> '<section class="widget %2$s" id="%1$s"><div class="widget-wrap">',
		'after_widget'	=> '</div><div class="clearfix"></div></section>',
		'before_title'	=> '<h5 class="widget-title'. ($icons ? '' : ' no-icon') .'">',
		'after_title'	=> '</h5>',
	) );
//
//
	register_sidebar( array(
		'name'			=> __( 'Footer widgets 2', 'cypress' ),
		'id'			=> 'footer-widgets-2',
		'description'	=> 'widget area for usage in site footer.',
		'before_widget'	=> '<section class="widget %2$s" id="%1$s"><div class="widget-wrap">',
		'after_widget'	=> '</div><div class="clearfix"></div></section>',
		'before_title'	=> '<h5 class="widget-title'. ($icons ? '' : ' no-icon') .'">',
		'after_title'	=> '</h5>',
	) );
//
//
	register_sidebar( array(
		'name'			=> __( 'Footer widgets 3', 'cypress' ),
		'id'			=> 'footer-widgets-3',
		'description'	=> 'widget area for usage in site footer.',
		'before_widget'	=> '<section class="widget %2$s" id="%1$s"><div class="widget-wrap">',
		'after_widget'	=> '</div><div class="clearfix"></div></section>',
		'before_title'	=> '<h5 class="widget-title'. ($icons ? '' : ' no-icon') .'">',
		'after_title'	=> '</h5>',
	) );
//
	register_sidebar( array(
		'name'			=> __( 'Footer widgets 4', 'cypress' ),
		'id'			=> 'footer-widgets-4',
		'description'	=> 'widget area for usage in site footer.',
		'before_widget'	=> '<section class="widget %2$s" id="%1$s"><div class="widget-wrap">',
		'after_widget'	=> '</div><div class="clearfix"></div></section>',
		'before_title'	=> '<h5 class="widget-title'. ($icons ? '' : ' no-icon') .'">',
		'after_title'	=> '</h5>',
	) );
//		
}
add_action( 'widgets_init', 'cypress_widgets' );
?>