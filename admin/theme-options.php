<?php

add_action('init','of_options');

if (!function_exists('of_options')) {
function of_options(){

global $cypress_woo_is_active;

include('google-fonts.php');

/***************** GET POST CATEGORIES ****************/
$post_cats = array();  
$post_cats_obj = get_categories('hide_empty=0');
if ($post_cats_obj) {
	foreach ($post_cats_obj as $cat) {
		$post_cats[$cat->cat_ID] = $cat->name ;
	}
}else{
	$post_cats[0] = '';
}
//$categories_tmp = array_unshift($blog_categories, array("= Select Blog Category =",'0') );    
//$blog_categories_tmp = $blog_categories;    



/***************** GET PRODUCT CATEGORIES ****************/
if( $cypress_woo_is_active ) {
	$product_cats = array();  
	$product_cats_obj = get_terms('product_cat','hide_empty=0');
}
if ( !empty( $product_cats_obj ) ) {
	foreach ($product_cats_obj as $product_cat) {
		$product_cats[$product_cat->term_id] = $product_cat->name ;
	}
}else{
	$product_cats[0] = '';
}

/***************** GET PORTFOLIO CATEGORIES ****************/
if( post_type_exists( 'portfolio' ) ) {
	$portfolio_cats = array();  
	$portfolio_cats_obj = get_terms('portfolio_category','hide_empty=0');
	if ($portfolio_cats_obj) {
		foreach ($portfolio_cats_obj as $portfolio_cat) {
			$portfolio_cats[$portfolio_cat->term_id] = $portfolio_cat->name ;
		}
	}else{
		$portfolio_cats[0] = '';
	}
}


/***************** GET SLIDE CATEGORIES ****************/
if( post_type_exists( 'slide' ) ) {
	$sliders = array();  
	$sliders_obj = get_terms ('slider','hide_empty=0');
	if ($sliders_obj) {
		foreach ($sliders_obj as $sl) {
			$sliders[$sl->term_id] = $sl->name ;
		}
	}else{
		$sliders[0] = '';
	}
}

//Access the WordPress Pages via an Array
$of_pages = array();
$of_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($of_pages_obj as $of_page) {
    $of_pages[$of_page->ID] = $of_page->post_name; }
$of_pages_tmp = array_unshift($of_pages, "Select a page:");       


// Access Aqua Page templates
$template_posts = get_posts( array( 
					'post_type' 		=> 'template', 
					'posts_per_page'	=> -1,
					'post_status' 		=> 'publish',
					'order'				=> 'ASC',
					'orderby'			=> 'title'
		    		)
				);
if($template_posts) {
	foreach( $template_posts as $templ ){
		$templates[$templ->ID] = $templ->post_title; 
	}
}else{
	$templates = array();
}

		
// BLOCK NAME | BLOCK WIDTH
$default_header_blocks_arr = array( 
	"enabled" => array (
		"placebo"			=> "placebo|1", //REQUIRED!
		"cart_lang"			=> "Shopping cart| 100",
		"border_0"			=> "Border block| 100",
		"site_title"		=> "Site title or logo| 100",
		"border_1"			=> "Border block| 100",
		"menu_one"			=> "Menu one| 100",
		"border"			=> "Border block| 100",
		"prod_search_block"	=> "Products search| 100",
		"social"			=> "Social block| 100",
		"widgets_block"		=> "Widgets block| 100",
		
	),	
	"disabled" => array (
		"placebo"			=> "placebo| 1", //REQUIRED!
		"border_2"			=> "Border block| 100",
		"border_3"			=> "Border block| 100",
		"border_4"			=> "Border block| 100",
		"search_block"		=> "Simple search| 100",
		"widgets_block_2"	=> "Widgets block 2| 100",
		"widgets_block_3"	=> "Widgets block 3| 100"
	), 

);
$horiz_header_blocks_arr = array( 
	"enabled" => array (
		"placebo"			=> "placebo|1", //REQUIRED!
		"cart_lang"			=> "Shopping cart| 50",
		"social"			=> "Social block| 50",
		"border_0"			=> "Border block| 100",
		"prod_search_block"	=> "Products search| 33",
		"site_title"		=> "Site title or logo| 33",
		"menu_one"			=> "Menu one| 33",
		
		
	),	
	"disabled" => array (
		"placebo"			=> "placebo| 1", //REQUIRED!
		"border_1"			=> "Border block| 100",
		"border_2"			=> "Border block| 100",
		"border_3"			=> "Border block| 100",
		"border_4"			=> "Border block| 100",
		"widgets_block"		=> "Widgets block| 100",
		"search_block"		=> "Simple search| 100",
		"widgets_block_2"	=> "Widgets block 2| 100",
		"widgets_block_3"	=> "Widgets block 3| 100"
	), 
);

$mobile_header_blocks_arr = array( 
	"enabled" => array (
		"placebo"			=> "placebo|1", //REQUIRED!
		"border_0"			=> "Border block| 100",
		"prod_search_block"	=> "Products search| 100",
		"menu_one"			=> "Menu mobile| 100",
		"cart_lang"			=> "Shopping cart| 100",
		"border"			=> "Border block| 100",
		"social"			=> "Social block| 100",
	),	
	"disabled" => array (
		"placebo"			=> "placebo| 1", //REQUIRED!
		"border_1"			=> "Border block| 100",
		"border_2"			=> "Border block| 100",
		"border_3"			=> "Border block| 100",
		"border_4"			=> "Border block| 100",
		"widgets_block"		=> "Widgets block| 100",
		"search_block"		=> "Simple search| 100",
		"widgets_block_2"	=> "Widgets block 2| 100",
		"widgets_block_3"	=> "Widgets block 3| 100"

	), 

);

//Stylesheets Files Reader
$alt_stylesheet_path = LAYOUT_PATH;
$alt_stylesheets = array();

if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}

//Background Images Files Reader
$bg_images_path = get_template_directory() . '/img/bg/'; // change this to where you store your bg images
$bg_images_url = get_template_directory_uri().'/img/bg/'; // change this to where you store your bg images
$bg_images = array();

if ( is_dir($bg_images_path) ) {
    if ($bg_images_dir = opendir($bg_images_path) ) { 
        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
                $bg_images[] = $bg_images_url . $bg_images_file;
            }
        }    
    }
}

/*-----------------------------------------------------------------------------------*/
/* TO DO: Add options/functions that use these */
/*-----------------------------------------------------------------------------------*/

//More Options
$uploads_arr = wp_upload_dir();
$all_uploads_path = $uploads_arr['path'];
$all_uploads = get_option('of_uploads');
$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");

// Image Alignment radio box
$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 

// Image Links to Options
$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;

$images_url =  ADMIN_DIR . 'images/';

$of_options = array();

//=================== GENERAL SETTINGS TAB ================================ 

$of_options[] = array( 
					"name"			=> "General Settings",
					"id"			=> "TAB - general",
                    "type"			=> "heading",
					"std"			=> ""
					);

$of_options[] = array(
					"name"			=> "DYNAMIC CSS AND JS ?",
					"desc"			=> '',
					"id"			=> "dynamic_css_js",
					"std"			=> 0,
					"on"			=> "True",
					"off"			=> "False",
					"type"			=> "switch"
					);
$of_options[] = array(
					"name"			=> "",
					"desc_html"		=> '<strong>DYNAMIC CSS AND JS FILES</strong> are AJAX created and loaded styles and scripts via Wordpress admin ajax. This is alternative to default, creating css and javascript files upon theme options saving.<br><strong>Use in case of write/execute restrictive servers</strong><br><br>',
					"id"			=> "dynamic_css_js_info",
					"std"			=> '',
					"type"			=> "html"
					); 
		
$of_options[] = array( 
					"name"			=> "Site logo image",
					"desc"			=> "Upload your logo image used for site header.</a></b>. ",
					"id"			=> "site_logo",
					"std"			=> get_template_directory_uri().'/img/logo.png',
					"mod"			=> "min",
					"type"			=> "media");		

$of_options[] = array(
					"name"			=> "Logo, site title and site description on/off",
					"desc"			=> "Choose if you want to display logo or site title and description. Site title are set in <a href='options-general.php'>WP general settings</a><br /><br />NOTE: If logo display is off, the textual site title will be displayed",
					"id"			=> "logo_desc",
					"std"			=> array("logo_on"),
				  	"type"			=> "multicheck",
					"options"		=> array(
							"logo_on"		=> "Display Logo ?",
							"desc_on"		=> "Display site description"
					)
					);	
					
$of_options[] = array(
					"name"			=> "Custom Favicon",
					"desc"			=> "Upload a Png/Gif image that will represent your website's favicon.<br /><br /><b>NOTE: Image size should be minimum 144x144 px, because of some high resolution devices.</b>",
					"id"			=> "custom_favicon",
					"std"			=> get_template_directory_uri(). '/img/favicon.png',
					"type"			=> "upload"); 

$of_options[] = array(
					"name"			=> "Placeholder image",
					"desc"			=> "The image to show when no post/product/portfolio image is uploaded.",
					"id"			=> "placeholder_image",
					"std"			=> get_template_directory_uri().'/img/no-image.jpg',
					"mod"			=> "min",
					"type"			=> "media");			
					

$of_options[] = array(
					"name"			=> "",
					"desc_html"		=> '<h3>Layout settings</h3>',
					"id"			=> "layout_settings_group",
					"std"			=> '',
					"type"			=> "html"
					); 				
					
		
$of_options[] = array(
					"name"			=> "Layout",
					"desc"			=> 'Choose layout for the site - APPLIES TO MAIN CONTENT, NOT TO THE SIDE MENU OR HEADER MENU. This setting will apply to all the site - blog, product, portfolio archives and taxonomy pages, single post  and single pages. <br /> Can be overriden in SHOP SETTINGS and/or individual page settings. ',
					"id"			=> "layout",
					"std"			=> "float_left",
					"type"			=> "images",
					"options"		=> array(
						'float_left'		=> $images_url . 'layout_fl_left.png',
						'float_right'		=> $images_url . 'layout_fl_right.png',
						'full_width'		=> $images_url . 'layout_full.png'	
						)
					);

$of_options[] = array(
					"name"			=> "Smooth mousewheel scrolling",
					"desc"			=> "use smooth mousewheel scrolling for nicer parallax effects and general slicker scrolling. Disable in case of performance issues.",
					"id"			=> "smooth_wheelscroll",
					"std"			=> 1,
					"on"			=> "Smooth mousewheel",
					"off"			=> "Disable smooth mousewheel",
					"folds"			=> 0,
					"type"			=> "switch"
					);
$of_options[] = array(
					"name"			=> "Use Nice scroll on SIDE MENU and MEGA MENUS",
					"desc"			=> "if there are a lot of items in side menu or mega menus it may happen they will go off screen. Use this to make them appear with scroll.",
					"id"			=> "use_nice_scroll_menus",
					"std"			=> 1,
					"on"			=> "Use Nice scroll",
					"off"			=> "Disable Nice scroll",
					"folds"			=> 0,
					"type"			=> "switch"
					);
					
					
$of_options[] = array(
					"name"			=> "Show breadcrumbs ?",
					"desc"			=> "",
					"id"			=> "show_breadcrumbs",
					"std"			=> 1,
					"on"			=> "Breadcrumbs on",
					"off"			=> "Breadcrumbs off",
					"type"			=> "switch"
				);

	
$of_options[] = array(
					"name"			=> "Display languages flags? (<strong>WPML plugin required</strong>) ",
					"desc"			=> "If you installed, activated and configured WMPL plugin, choose if you want to display language flags in header",
					"id"			=> "lang_sel",
					"std"			=> 1,
					"on"			=> "Show flags",
					"off"			=> "Hide flags",
					"folds"			=> 0,
					"type"			=> "switch"
				);
				
$of_options[] = array(
					"name"			=> "Sidebar missing widget replacement content",
					"desc"			=> "how should sidebars or widget areas appear in case they are empty of widgets.",
					"id"			=> "empty_sidebar_meta",
					"std"			=> "empty_notice",
					"fold_toggles"	=> '',
					"type"			=> "radio",
					"options"		=> array(
						'meta_login'	=> 'Meta login',
						'empty_notice'	=> 'Notice for sidebar without widgets',
						'none'			=> 'Only system fonts'
						)
					);


$of_options[] = array(
					"name"			=> "Use lazy load effect",
					"desc"			=> "lazy load effect is toggling elements opacity (or transparency) on browser scroll. Disable it here if for some reason (too much content, images, sliders ...) page rendering slows down.",
					"id"			=> "use_lazy_load",
					"std"			=> 0,
					"on"			=> "Use lazy load",
					"off"			=> "Disable lazy load",
					"folds"			=> 0,
					"type"			=> "switch"
					);

	


	
$of_options[] = array(
					"name"			=> "Show header icons in pages",
					"desc"			=> "icons in header are representing current context (archive, shop, portfolio, single post format ... to hide, toggle this switch).",
					"id"			=> "header_icons",
					"std"			=> 1,
					"on"			=> "Show icons",
					"off"			=> "Hide icons",
					"folds"			=> 0,
					"type"			=> "switch"
				);

$of_options[] = array(  
					"name"			=> "Hide edit pages metaboxes",
					"desc"			=> "force hiding metaboxes in post, pages or custom post type edit pages, not used with theme (Exceprt, Revisions, Slug)",
					"id"			=> "hidden_metaboxes",
					"std"			=> 1,
					"on"			=> "Hide metaboxes",
					"off"			=> "Show metaboxes",
					"folds"			=> 0,
					"type"			=> "switch"
				);


$of_options[] = array(
					"name"			=> "Tracking Code",
					"desc"			=> "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
					"id"			=> "google_analytics",
					"std"			=> "",
					"type"			=> "textarea");  

  					
$of_options[] = array( 
					"name"			=> "Theme Contact Form",
					"desc"			=> "If you want to use Theme Contact Form (to activate it <b>select Contact page template</b>), you can enter your email address here. Default email address is admin address enteres in <b><a href='options-general.php'>WP general settings</a></b> (Email address field)  ",
					"id"			=> "contact_email",
					"std"			=> get_option('admin_email'),
					"type"			=> "text"); 

$of_options[] = array(
					"name"			=> "Demo mode",
					"desc"			=> 'to display demo switcher (as in Theme forest theme demo) and theme demo variables (for developers - check theme_demo_vars.php and theme_demo_switcher.php files)',
					"id"			=> "demo_mode",
					"std"			=> 0,
					"on"			=> "Demo mode on",
					"off"			=> "Demo mode false",
					"type"			=> "switch"
					);

/****************************** SHOP SETTINGS TAB *************************************/					
					
					
$of_options[] = array(
					"name"			=> "Shop Settings",
					"id"			=> "TAB - shop settings",
                    "type"			=> "heading",
					"std"			=> ""
					); 


$of_options[] = array(
					"name"			=> "Products (catalog) pages numbers",
					"desc"			=> "set the numbers for products (and product taxonomies) page, including the numbers for related items on single product page.",
					"id"			=> "products_page_settings",
					"mod"			=> "mini",
					"multi"			=> true, // if true - in 'std' goes array
					"std" 			=>  array(
									"Products per page" => 12,
									"Products columns" => 3,
									"Related total" => 3,
									"Related columns" => 3
								),
					"type"			=> "text"
					);
					
$of_options[] = array(
					"name"			=> "Single product page - upsell products total",
					"desc"			=> "",
					"id"			=> "upsell_total",
					"mod"			=> "mini",
					"std"			=> 3,
					"type"			=> "text"
					); 	
				
$of_options[] = array(
					"name"			=> "Single product page -upsell products in row",
					"desc"			=> "",
					"id"			=> "upsell_in_row",
					"mod"			=> "mini",
					"std"			=> 3,
					"type"			=> "text"
					); 
					
$of_options[] = array(
					"name"			=> "Products (catalog) page QUICK VIEW or default buttons",
					"desc"			=> "choice between QUICK VIEW button with popup, and default WooCommerce ADD TO CART / SELECT OPTIONS buttons",
					"id"			=> "catalog_buttons",
					"std"			=> "as-portrait",
					"type"			=> "radio",
					"options"		=> array(
									'default'		=> 'Default buttons',
									'quick_view'	=> 'Quick view button'
									)
					);
					
					
/* 					
$of_options[] = array(
					"name"			=> "",
					"desc_html"		=> '<p><em>Wishlist</em> and <em>compare</em> button are part of optional Y<strong>ITH WooCommerce Wishlist</strong> and <strong>YITH Woocommerce Compare</strong> plugins. Above disabling controls are just another layer of control. If you do not need add to wishlist and add to compare buttons, you can simply uninstall those plugins.</p>',
					"id"			=> "wishlist_compare",
					"std"			=> '',
					"type"			=> "html"
					);	
					 */
$of_options[] = array(
					"name"			=> "Products (catalog) full width page",
					"desc"			=> 'If set <strong>float left</strong> or <strong>float right</strong> for site-wide layout, you can still make cart and checkout in full width here.',
					"id"			=> "products_full_width",
					"std"			=> 1,
					"folds"			=> 1,
					"on"			=> "Full width",
					"off"			=> "No full width",
					"type"			=> "switch"
				);
$of_options[] = array(
					"name"			=> "Single product full width page",
					"desc"			=> 'If set <strong>float left</strong> or <strong>float right</strong> for site-wide layout, you can still make cart and checkout in full width here.',
					"id"			=> "single_full_width",
					"std"			=> 0,
					"folds"			=> 1,
					"on"			=> "Full width",
					"off"			=> "No full width",
					"type"			=> "switch"
				);				
				
$of_options[] = array(
					"name"			=> "Cart, checkout full width page",
					"desc"			=> 'If set <strong>float left</strong> or <strong>float right</strong> for site-wide layout, you can still make cart and checkout in full width here. <br /><br />NOTE: you can also choose full width page template in Page edit.',
					"id"			=> "shop_cart_full_width",
					"std"			=> 1,
					"folds"			=> 1,
					"on"			=> "Full width",
					"off"			=> "No full width",
					"type"			=> "switch"
				);
					
$of_options[] = array(
					"name"			=> "Products (catalog) page display settings",
					"desc"			=> "",
					"id"			=> "products_settings",
					"std"			=> array(),
				  	"type"			=> "multicheck",
					"options"		=> array(
									'disable_zoom_button' => 'Disable zoom button',
									'disable_link_button' => 'Disable link button'
									/* ,
									'disable_add_to_wishlist' => 'Disable add to wishlist button',
									'disable_add_to_compare' => 'Disable add to compare button',
									*/
								)
					);
					
$of_options[] = array(
					"name"			=> "Products (catalog) page images format",
					"desc"			=> "Choose between theme PREDEFINED formats or WooCommerce plugin's <strong>Shop catalog </strong>image format (can be customized in WooCommerce settings).",
					"id"			=> "shop_image_format",
					"std"			=> "as-portrait",
					"type"			=> "radio",
					"options"		=> array(
									'as-portrait'	=> 'Cypress portrait',
									'as-landscape'	=> 'Cypress landscape',
									'plugin'		=> 'WooCommerce Plugin image settings'
									)
					);					
$of_options[] = array(
					"name"			=> "Single product images display",
					"desc"			=> "choice between standard thumbnails with zoom, sliding images with zoom or magnifier (zooming on hover).",
					"id"			=> "single_product_images",
					"std"			=> "slider",
					"type"			=> "radio",
					"options"		=> array(
									'thumbnails'	=> 'Featured image with thumbnails',
									'slider'		=> 'Slider with all images',
									'magnifier'		=> 'Magnifier on featured image'
									)
					);
					
$of_options[] = array(
					"name"			=> "Single product images format",
					"desc"			=> "Choose between theme PREDEFINED formats or WooCommerce plugin's <strong>Single product image</strong> format (can be customized in WooCommerce settings ).",
					"id"			=> "single_product_image_format",
					"std"			=> "as-portrait",
					"type"			=> "radio",
					"options"		=> array(
									'as-portrait'	=> 'Cypress portrait',
									'as-landscape'	=> 'Cypress landscape',
									'plugin'		=> 'WooCommerce Plugin image settings'
									)
					);
					
					
$of_options[] = array(
					"name"			=> "Quick view images format",
					"desc"			=> "Choose between theme PREDEFINED formats or WooCommerce plugin's <strong>Single product image</strong> format (can be customized in WooCommerce settings ).",
					"id"			=> "quick_view_image_format",
					"std"			=> "as-portrait",
					"type"			=> "radio",
					"options"		=> array(
									'as-portrait'	=> 'Cypress portrait',
									'as-landscape'	=> 'Cypress landscape',
									'plugin'		=> 'WooCommerce Plugin image settings (for single product)'
									)
					);
					
$of_options[] = array(
					"name"			=> "Display shop title background image ?",
					"desc"			=> 'for products page or product categories page (if no product category images is set), it is required to set background image (switch to "Display" and the upload manager will appear)',
					"id"			=> "shop_title_bcktoggle",
					"std"			=> 1,
					"folds"			=> 1,
					"on"			=> "Display",
					"off"			=> "Hide",
					"type"			=> "switch"
				);					
					
$of_options[] = array(
					"name"			=> "Shop title background image",
					"desc"			=> "upload image for shop (product page) title background. For product categories the product category image will be used (must be uploaded in WooCommerce > Categories)",
					"id"			=> "shop_title_backimg",
					"fold"			=> "shop_title_bcktoggle", /* the folding hook */
					"std"			=> get_template_directory_uri(). '/img/header-shop.jpg',
					"type"			=> "media"
					);

					
					
//=================== TYPOGRAPHY TAB ================================ 

$of_options[] = array(
					"name"			=> "Typography",
					"id"			=> "TAB - typography",
					"type"			=> "heading",
					"std"			=> ""
					);
		

$of_options[] = array( 
					"name"			=> "Google fonts or Typekit fonts?",
					"desc"			=> "",
					"id"			=> "google_typekit_toggle",
					"std"			=> "google",
					"fold_toggles"	=> '',
					"type"			=> "radio",
					"options" => array(
							'google'		=> 'Google fonts',
							'typekit'		=> 'Typekit fonts',
							'none'			=> 'Only system fonts'
						)
					);
	
		
$of_options[] = array(
					"name"			=> "HEADINGS FONT : Google Font",
					"desc"			=> "choose <strong>google font</strong> for your headings, titles, etc ... Preview font size is fixed.",
					"id"			=> "google_headings",	
					"fold"			=> "google", /* the radio hook for show */
					"unfold"		=> "google_typekit_toggle",/* the radio hook for hide */
					"std"			=> array('face'=>'Open Sans', 'weight'=>'light', 'color'=>''),
					"type"			=> "select_google_font",
					"preview"		=> array(
									"text" => "My heading is my title.", //this is the text from preview box
									"size" => "36px" //this is the text size from preview box
						),
					"options"		=> google_fonts(),
					);
$of_options[] = array( 
					"name"			=> "BODY FONT - Google Font",
					"desc"			=> "choose <strong>google font</strong> for your headings, titles, etc ... Preview font size iz fixed.",
					"id"			=> "google_body",
					"fold"			=> "google",
					"unfold"		=> "google_typekit_toggle",/* the radio hook for hide */
					"std"			=> array('face'=>'Raleway', 'weight'=>'normal', 'size'=> '15px','color'=>'#333333'),
					"type"			=> "select_google_font",
					"preview"		=> array(
									"text" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.", //this is the text from preview box
									"size" => "15px" //this is the text size from preview box
						),
					"options"		=> google_fonts()
					);			
					
$of_options[] = array(
					"name"			=> "TYPEKIT FONTS: Typekit font kit ID",
					"desc"			=> "You can find your Typekit font kit ID on typekit.com under Kit Editor -> Embed Code.",
					"id"			=> "typekit_id",
					"std"			=> '',
					"fold"			=> "typekit", /* the radio hook for show */
					"unfold"		=> "google_typekit_toggle",/* the radio hook for hide */
					"type"			=> "text"
					); 

$of_options[] = array(
					"name"			=> "",
					"desc_html"		=> 'Enter the Typekit ID - find your Typekit ID on <strong><a href="http://typekit.com">typekit.com</a></strong> under Kit Editor -> Embed Code. Cypress theme uses two main fonts grouped for usage in following css selectors: <ol><li>body, #site-menu, .block-subtitle, .bottom-block-link a, .button,  .onsale, .taxonomy-menu h4, .tk-brandon-grotesque,   button, input#s, input[type="button"], input[type="email"], input[type="reset"], input[type="submit"], input[type="text"], select,  textarea, ul.post-portfolio-tax-menu li a</li><li>h1,  h2, h3,  h4,  h5,  h6, .billing_country_chzn, .chzn-drop, .navbar .nav, .price, .tk-adobe-garamond-pro, footer</li></ol> Copy each group of selectors to Typekit font selected on your preference ( use Typekit Kit Editor ).',
					"id"			=> "typekit_signin",
					"std"			=> '',
					"fold"			=> "typekit", /* the radio hook for show this */
					"unfold"		=> "google_typekit_toggle",/* the radio hook for hide this */
					"type"			=> "html"
					); 

////////// SYSTEM FONTS:
					
$of_options[] = array(
					"name"			=> "HEADINGS - system font",
					"desc"			=> "Specify <strong>system</strong> fonts for headings, titles etc ...",
					"id"			=> "sys_heading_font",
					"std"			=> array('face' => '','weight' => '', 'style' => '' ,'color' => ''),
					"type"			=> "typography"
					);
		
$of_options[] = array(
					"name"			=> "BODY FONT - system fonts",
					"desc"			=> "Specify <strong>system</strong> fonts for body.",
					"id"			=> "sys_body_font",
					"std"			=> array('face' => '','style' => '','color' => '', 'size' => '', 'height' => ''),
					"type"			=> "typography");  		

					
					
//=================== STYLING TAB ================================ 
												  
$of_options[] = array(
					"name"			=> "Styling Options",
					"id"			=> "TAB - styling",
					"type"			=> "heading",
					"std"			=> ""
					);
				
$of_options[] = array(
					"name"			=> "Borders style",
					"desc"			=> "change the borders style throughout the site. The decorations are vector font icons.",
					"id"			=> "border_icon",
					"std"			=> array(
										'width'		=> '1',
										'style'		=> 'dotted',
										'color'		=> '#adadad',
										'decoration'=> 'deco-icon-ornament_10',
									),
					"type"			=> "border"
				);	

				
$of_options[] = array(
					"name"			=> "Disable border in side menu /header menu",
					"desc"			=> "remove the border outline on side menu and/or header menu",
					"id"			=> "no_border_sitemenu",
					"std"			=> 0,
					"type"			=> "checkbox"); 

			
$of_options[] = array( 
					"name"			=> "Links color (primary accent)",
					"desc"			=> "change overall color (affects font AND button border color).",
					"id"			=> "links_buttons_color",
					"std"			=> "",
					"type"			=> "color"
					);   				
			
$of_options[] = array( 
					"name"			=> "Links hover color (secondary accent)",
					"desc"			=> "change overall color (affects font AND button border color).",
					"id"			=> "links_buttons_hover_color",
					"std"			=> "",
					"type"			=> "color"
					);   				
	
$of_options[] = array(
					"name"			=> "Buttons and form elements style",
					"desc"			=> 'Change buttons nd form elements style site-wide.',
					"id"			=> "buttons_style",
					"std"			=> "default",
					"type"			=> "images",
					"options"		=> array(
						'default'		=> $images_url . 'button_style_1.png',
						'style2'		=> $images_url . 'button_style_2.png'	
						)
					);


$of_options[] = array( 
					"name"			=> "Buttons background color",
					"desc"			=> "change overall background color of buttons.",
					"id"			=> "buttons_bck_color",
					"std"			=> "",
					"type"			=> "color"
					);   	

$of_options[] = array( 
					"name"			=> "Buttons HOVER background color",
					"desc"			=> "change overall background color of buttons.",
					"id"			=> "buttons_hover_bck_color",
					"std"			=> "",
					"type"			=> "color"
					);   	
					

$of_options[] = array( 
					"name"			=> "Site background",
					"desc_html"		=> "options for site background ( changes will apply to body html tag)",
					"id"			=> "site_background_heading",
					"std"			=> "",
					"type"			=> "html"
					);
			
$of_options[] = array( 
					"name"			=> "Site background color",
					"desc"			=> "change overal background color.",
					"id"			=> "site_back_color",
					"std"			=> "",
					"type"			=> "color"
					);    									

$of_options[] = array(
					"name"			=> "Site background - tiles or uploaded images ?",
					"desc"			=> "Select if you want to use our selection of background tile images, or if you want to upload your own.",
					"id"			=> "site_bg_toggle",
					"std"			=> "none",
					"fold_toggles"	=> '',
					"type"			=> "radio",
					"options"		=> array(
							'default'	=> 'Default background tiles',
							'upload'	=> 'Uploaded background images',
							'none'		=> 'None'
						)
					);					
					
$of_options[] = array(
					"name"			=> "Site background - tiles",
					"desc"			=> "Select a site background tile pattern. Tile pattern can only have fixed back position.<br /><br /><strong>NOTE: The last image is completey transparent, so if you don't want any background tile, select last pattern.</strong>",
					"id"			=> "site_bg_default",
					"fold"			=> "default", /* the radio hook for show */
					"unfold"		=> "site_bg_toggle",/* the radio hook for hide */
					"std"			=> "",
					"type"			=> "tiles",
					"options"		=> $bg_images,
					);
				
				
$of_options[] = array(
					"name"			=> "Site background - upload your  image",
					"desc"			=> "Upload images for site background, or define the URL directly",
					"id"			=> "site_bg_uploaded",
					"fold"			=> "upload", /* the radio hook for show */
					"unfold"		=> "site_bg_toggle",/* the radio hook for hide */
					"std"			=> "",
					"type"			=> "media");	
					
					
$of_options[] = array(
					"name"			=> "Site background - controls ",
					"desc"			=> "<b>If you uploaded your own background image</b>, select how do you want your uploaded image to repeat or if you want to repeat image at all.",
					"id"			=> "site_bg_controls",
					"std" => array(
							//'color'			=> '',
							'repeat'		=> 'repeat',
							'position'		=> '',
							'attachment'	=> ''
							),
					"type"			=> "background",
					);    			

					
$of_options[] = array( 
					"name"			=> "Body background",
					"desc_html"		=> "options for body background - main content area between header and footer ( changes will apply to div#page html tag)",
					"id"			=> "site_background_heading",
					"std"			=> "",
					"type"			=> "html"
					);					


$of_options[] = array( 
					"name"			=> "Body background color",
					"desc"			=> "change overal background color.",
					"id"			=> "body_back_color",
					"std"			=> "",
					"type"			=> "color"
					);    									

$of_options[] = array(
					"name"			=> "Body background - tiles or uploaded images ?",
					"desc"			=> "Select if you want to use our selection of background tile images, or if you want to upload your own.",
					"id"			=> "body_bg_toggle",
					"std"			=> "none",
					"fold_toggles"	=> '',
					"type"			=> "radio",
					"options"		=> array(
							'default'	=> 'Default background tiles',
							'upload'	=> 'Uploaded background images',
							'none'		=> 'None'
						)
					);					
					
$of_options[] = array(
					"name"			=> "Body background - tiles",
					"desc"			=> "Select a body background tile pattern. Tile pattern can only have fixed back position.<br /><br /><strong>NOTE: The last image is completey transparent, so if you don't want any background tile, select last pattern.</strong>",
					"id"			=> "body_bg_default",
					"fold"			=> "default", /* the radio hook for show */
					"unfold"		=> "body_bg_toggle",/* the radio hook for hide */
					"std"			=> "",
					"type"			=> "tiles",
					"options"		=> $bg_images,
					);
				
				
$of_options[] = array(
					"name"			=> "Body background - upload your  image",
					"desc"			=> "Upload images for body background, or define the URL directly",
					"id"			=> "body_bg_uploaded",
					"fold"			=> "upload", /* the radio hook for show */
					"unfold"		=> "body_bg_toggle",/* the radio hook for hide */
					"std"			=> "",
					"type"			=> "media");	
					
					
$of_options[] = array(
					"name"			=> "Body background - controls ",
					"desc"			=> "<b>If you uploaded your own background image</b>, select how do you want your uploaded image to repeat or if you want to repeat image at all.",
					"id"			=> "body_bg_controls",
					"std" => array(
							//'color'			=> '',
							'repeat'		=> 'repeat',
							'position'		=> '',
							'attachment'	=> ''
							),
					"type"			=> "background",
					);    			

					
					
												   
$of_options[] = array(
					"name"			=> "Custom CSS",
					"desc"			=> "If you want additionally to customize theme styles, you can enter custom css code in this textfiled",
					"id"			=> "custom_css",
					"std"			=> "",
					"type"			=> "textarea"
					);    
						
	
					
//============================= HEADER TAB ================================

				
$of_options[] = array(
					"name"			=> "Side menu / Header menu",
					"type"			=> "heading",
					"std"			=> ""
					);
 			
$of_options[] = array(
					"name"			=> "Side menu or header menu (layout orientation)",
					"desc"			=> "Choose orientation of header and menu - logo, title, navigation, search and breadcrumb ",
					"id"			=> "orientation",
					"std"			=> "default",
					"fold_toggles"	=> '',
					"type"			=> "radio",
					"options"		=> array(
							'default'		=> 'Side menu (default - vertical layout)',
							'horizontal'	=> 'Header menu (horizontal layout)',
						)
					);
			
$of_options[] = array(
					"name"			=> "Side menu blocks (default)",
					"desc"			=> "Rearrange the latest section by <strong>dragging and dropping </strong> blocks and  <strong>resize </strong> them.",
					"id"			=> "default_header_blocks",
					"resizable"		=> false,
					"fold"			=> "default", /* the radio hook for show */
					"unfold"		=> "orientation",/* the radio hook for hide */
					"std"			=> $default_header_blocks_arr,
					"type"			=> "sorter"
				);

				
$of_options[] = array(
					"name"			=> "Header menu blocks",
					"desc"			=> "Rearrange the latest section by <strong>dragging and dropping </strong> blocks and  <strong>resize </strong> them.",
					"id"			=> "horiz_header_blocks",
					"resizable"		=> true,
					"fold"			=> "horizontal", /* the radio hook for show */
					"unfold"		=> "orientation",/* the radio hook for hide */
					"std"			=> $horiz_header_blocks_arr,
					"type"			=> "sorter"
				);

			
$of_options[] = array(
					"name"			=> "Logo/title width (height is auto)",
					"desc"			=> "change the width of logo image or title (set in WP settings) in header. Insert <strong>only the number</strong>, units as hardcoded in pixels (px)",
					"id"			=> "logo_width",
					"fold"			=> "default", /* the radio hook for show */
					"unfold"		=> "orientation",/* the radio hook for hide */
					"mod"			=> "mini",
					"std"			=> '',
					"type"			=> "text"
					); 					

$of_options[] = array(
					"name"			=> "",
					"desc_html"		=> '<strong>TITLE SETTINGS (if logo is disabled)',
					"fold"			=> "default", /* the radio hook for show */
					"unfold"		=> "orientation",/* the radio hook for hide */
					"id"			=> "logo_title_expl",
					"std"			=> '',
					"type"			=> "html"
					); 
			
			
$of_options[] = array(
					"name"			=> "Title font size (percentage)",
					"desc"			=> "site title font is 2em in size by default. Change font size by percentage - minimum is 50%, maximum is 300%",
					"id"			=> "title_font_size",
					"std"			=> "100",
					"min"			=> "50",
					"step"			=> "10",
					"max"			=> "300",
					"type"			=> "sliderui" 
					);
					
$of_options[] = array(
					"name"			=> "Title word breaking",
					"desc"			=> "if your site title has long words and you need to fit it into sidebar",
					"id"			=> "title_break_word",
					"std"			=> 0,
					"on"			=> "Break title words",
					"off"			=> "Breaks after words",
					"folds"			=> 0,
					"type"			=> "switch"
					);		
					
					
				
$of_options[] = array(
					"name"			=> "",
					"desc_html"		=> '<strong>IMPORTANT NOTE: Logo width applies for side menu (vertical layout) and it\'s limited with maximum width of 300 pixels due to layout limitations .</strong>',
					"fold"			=> "default", /* the radio hook for show */
					"unfold"		=> "orientation",/* the radio hook for hide */
					"id"			=> "logo_width_expl",
					"std"			=> '',
					"type"			=> "html"
					); 

					
$of_options[] = array(
					"name"			=> "Logo max. height",
					"desc"			=> "change the maximum height of logo image in header. Insert <strong>only the number</strong>, units as hardcoded oin pixels (px) - <strong>if NOTE:Horizontal header Custom css is used this value will be overriden</strong>",
					"id"			=> "logo_height",
					"fold"			=> "horizontal", /* the radio hook for show */
					"unfold"		=> "orientation",/* the radio hook for hide */
					"mod"			=> "mini",
					"std"			=> '',
					"type"			=> "text"
					); 					

$of_options[] = array(
					"name"			=> "Header menu Custom CSS",
					"desc"			=> "horizontal header will probably need some custom css for tweaking. Some css knowledge is required to know how to handle css cascading overrides.",
					"id"			=> "header_custom_css",
					"std"			=> ".horizontal .header-cart { margin-bottom:0;} 
.horizontal #site-title h1 img { max-height: 120px;} 
.horizontal ul.navigation { text-align: right; margin: 2.8em 0; }
.social { text-align: right; }
.horizontal .searchform-menu { margin: 2em 0; }
.horizontal .mega-clone > li { float: right }
.horizontal .mega-clone {  left: auto; }
/* if you need css assistance, contact us */",
					"fold"			=> "horizontal", /* the radio hook for show */
					"unfold"		=> "orientation",/* the radio hook for hide */
					"type"			=> "textarea"
					); 			

				
$of_options[] = array(
					"name"			=> "Header/menu blocks for MOBILE DEVICES",
					"desc"			=> "Set the visibility of blocks for mobile devices (under 1024px of horizontal resoultion).",
					"id"			=> "mobile_header_blocks",
					"resizable"		=> false,
					"std"			=> $mobile_header_blocks_arr,
					"type"			=> "sorter"
				);

$of_options[] = array( 
					"name"			=> "Side menu / Header menu font color",
					"desc"			=> "change font colors in header.",
					"id"			=> "header_font_color",
					"std"			=> "",
					"type"			=> "color"
					);  
					
$of_options[] = array(
					"name"			=> "",
					"desc_html"		=> '<strong>IMPORTANT NOTE: header font color applies to any text not in menu, or link and applies to separation lines between menus.</strong>',
					"id"			=> "header_font_color_expl",
					"std"			=> '',
					"type"			=> "html"
					); 
					
$of_options[] = array( 
					"name"			=> "Side menu / Header menu  links color (primary)",
					"desc"			=> "change header links color (font and button border).",
					"id"			=> "header_links_buttons_color",
					"std"			=> "",
					"type"			=> "color"
					);   				
			
$of_options[] = array( 
					"name"			=> "Side menu / Header menu  links hover color (secondary)",
					"desc"			=> "change header hover color (font and button border).",
					"id"			=> "header_links_buttons_hover_color",
					"std"			=> "",
					"type"			=> "color"
					);   				
									
			
$of_options[] = array( 
					"name"			=> "Side menu / Header menu  background color",
					"desc"			=> "change header background color (applies to menus background, too).",
					"id"			=> "header_back_color",
					"std"			=> "",
					"type"			=> "color"
					);  

					
$of_options[] = array(
					"name"			=> "",
					"desc_html"		=> '<h3>SOCIAL BLOCK - SOCIAL ICONS LINKS</h3>',
					"id"			=> "header_note",
					"std"			=> '',
					"type"			=> "html"
					); 
				
					
					
$of_options[] = array(
					"name"			=> "Include RSS button in Social links buttons ?",
					"desc"			=> "",
					"id"			=> "soc_rss",
					"std"			=> 0,
					"on"			=> "RSS on",
					"off"			=> "RSS off",
					"type"			=> "switch"
					);
						
$of_options[] = array(
					"name"			=> "Open social links in new window ?",
					"desc"			=> "",
					"id"			=> "social_target",
					"std"			=> 0,
					"on"			=> "In new window/tab",
					"off"			=> "In same window/tab",
					"type"			=> "switch"
					);
					
					
$of_options[] = array(
					"name"			=> "Google plus",
					"desc"			=> "",
					"id"			=> "soc_gplus",
					"std"			=> "http://gplus.com/aligator-studio",
					"type"			=> "text"
					);
					
$of_options[] = array(
					"name"			=> "Facebook",
					"desc"			=> "",
					"id"			=> "soc_facebook",
					"std"			=> "http://facebook.com/pages/Aligator-Studio/218035174894908",
					"type"			=> "text"
					);
					
$of_options[] = array( 
					"name"			=> "Twitter",
					"desc"			=> "",
					"id"			=> "soc_twitter",
					"std"			=> "http://twitter.com/@AligatorStudio",
					"type"			=> "text"
					);

$of_options[] = array(
					"name"			=> "Flickr",
					"desc"			=> "",
					"id"			=> "soc_flickr",
					"std"			=> "",
					"type"			=> "text"
					);
	
$of_options[] = array(
					"name"			=> "LinkedIn",
					"desc"			=> "",
					"id"			=> "soc_linkedin",
					"std"			=> "",
					"type"			=> "text"
					);
	
$of_options[] = array(
					"name"			=> "You Tube",
					"desc"			=> "",
					"id"			=> "soc_youtube",
					"std"			=> "",
					"type"			=> "text"
					);
	
$of_options[] = array(
					"name"			=> "Vimeo",
					"desc"			=> "",
					"id"			=> "soc_vimeo",
					"std"			=> "http://www.vimeo.com/aligator-studio/",
					"type"			=> "text"
					);

$of_options[] = array(
					"name"			=> "Pinterest",
					"desc"			=> "",
					"id"			=> "soc_pinterest",
					"std"			=> "http://www.pinterest.com/aligator-studio/",
					"type"			=> "text"
					);
	
$of_options[] = array(
					"name"			=> "Dribbble",
					"desc"			=> "",
					"id"			=> "soc_dribbble",
					"std"			=> "",
					"type"			=> "text"
					);
	
$of_options[] = array(
					"name"			=> "Forrst",
					"desc"			=> "",
					"id"			=> "soc_forrst",
					"std"			=> "",
					"type"			=> "text"
					);
	
$of_options[] = array(
					"name"			=> "Instagram",
					"desc"			=> "",
					"id"			=> "soc_instagram",
					"std"			=> "http://www.instagram.com/aligator-studio/",
					"type"			=> "text"
					);
	
$of_options[] = array(
					"name"			=> "Github",
					"desc"			=> "",
					"id"			=> "soc_github",
					"std"			=> "",
					"type"			=> "text"
					);

$of_options[] = array(
					"name"			=> "Picassa",
					"desc"			=> "",
					"id"			=> "soc_picassa",
					"std"			=> "",
					"type"			=> "text"
					);
	
$of_options[] = array(
					"name"			=> "Skype",
					"desc"			=> "",
					"id"			=> "soc_skype",
					"std"			=> "http://www.about.me/aligator-studio/",
					"type"			=> "text"
					);

					
//=================== FOOTER TAB ================================ 

$of_options[] = array(
					"name"			=> "Footer Settings",
					"id"			=> "TAB - footer settings",
					"type"			=> "heading",
					"std"			=> ""
					);
					
$of_options[] = array( 
					"name"			=> "Footer font color",
					"desc"			=> "change font colors in footer.",
					"id"			=> "footer_font_color",
					"std"			=> "",
					"type"			=> "color"
					);   				

					
$of_options[] = array( 
					"name"			=> "Footer links and buttons color (primary)",
					"desc"			=> "change overal color (font and button border).",
					"id"			=> "footer_links_buttons_color",
					"std"			=> "",
					"type"			=> "color"
					);   				
			
$of_options[] = array( 
					"name"			=> "Footer links and buttons hover color (secondary)",
					"desc"			=> "change overal color (font and button border).",
					"id"			=> "footer_links_buttons_hover_color",
					"std"			=> "",
					"type"			=> "color"
					);   				
									
			
$of_options[] = array( 
					"name"			=> "Footer background color",
					"desc"			=> "change overal background color.",
					"id"			=> "footer_back_color",
					"std"			=> "",
					"type"			=> "color"
					);  

$of_options[] = array(
					"name"			=> "Footer background color opacity",
					"desc"			=> "",
					"id"			=> "footer_back_opacity",
					"std"			=> "80",
					"min"			=> "1",
					"step"			=> "1",
					"max"			=> "100",
					"type"			=> "sliderui" 
					);
					
$of_options[] = array(
					"name"			=> "Footer Credits text",
                    "desc"			=> "You can enter custom footer text here. If you want default footer text (&copy; - site title), just leave the textfield blank.",
                    "id"			=> "footer_text",
                    "std"			=> "",
                    "type"			=> "textarea"
					);			
							
	
/******************************** HOME PAGE TAB ***************************************/
					
					
$of_options[] = array(
					"name"			=> "Home Settings",
					"id"			=> "TAB - home settings",
					"type"			=> "heading",
					"std"			=> ""
					);

  					                                               
       
$of_options[] = array(
					"name"			=> "Blog home page title",
					"desc"			=> "If <strong>Your latest posts</strong> is chosen for site home page, choose if you want to display page title ( the site title with site description - set it up in <strong>Settings - General</strong> ).",
					"id"			=> "index_title",
					"std"			=> 1,
					"type"			=> "switch"
        );
		
$of_options[] = array(
					"name"			=> "Blog home page header background image",
					"desc"			=> 'If "Your latest posts" is chosen for site home page, choose if you want to display header backgroud image',
					"id"			=> "index_title_bcktoggle",
					"std"			=> 1,
					"folds"			=> 1,
					"type"			=> "switch"
        );
$of_options[] = array(
					"name"			=> "Upload blog home page header background image",
					"desc"			=> "upload image for home page blog title background (optional)",
					"id"			=> "index_title_backimg",
					"fold"			=> "index_title_bcktoggle", /* the folding hook */
					"std"			=> get_template_directory_uri(). '/img/header-portfolio.jpg',
					"type"			=> "media");
					

					
				

/****************************** BLOG SETTINGS TAB *************************************/					
					
					
$of_options[] = array(
					"name"			=> "Blog Settings",
					"id"			=> "TAB - blog settings",
                    "type"			=> "heading",
					"std"			=> ""
					);

					
$of_options[] = array(
					"name"			=> "<strong>Single blog page</strong> title background image (featured) ?",
					"desc"			=> 'choice to have image background on single blog. Use featured image.<br /><br /><strong>IMPORTANT NOTE: if no featured image is set and this option is ON, the blog archive background image will be used</strong>',
					"id"			=> "single_blog_title_bcktoggle",
					"std"			=> 1,
					"folds"			=> 1,
					"on" 			=>"Show",
					"off"			=> "Hide",
					"type"			=> "switch"
				);
				
				
$of_options[] = array(
					"name"			=> "Blog archive title background image ?",
					"desc"			=> 'choice to have image background on blog archive and taxonomies pages. For single blog pages, use featured image.',
					"id"			=> "blog_title_bcktoggle",
					"std"			=> 1,
					"folds"			=> 1,
					"on"			=> "Show",
					"off"			=> "Hide",
					"type"			=> "switch"
				);	
					
					
$of_options[] = array(
					"name"			=> "Upload blog archive title background image",
					"desc"			=> "upload image for blog/taxnomies titles background (optional)",
					"id"			=> "blog_title_backimg",
					"fold"			=> "blog_title_bcktoggle", /* the folding hook */
					"std"			=> get_template_directory_uri(). '/img/header-archive.jpg',
					"type"			=> "media");


				
$of_options[] = array(
					"name"			=> "Blog CATEGORIES/TAGS title background image ?",
					"desc"			=> 'choice to have image background on blog categories pages. For single blog pages, use featured image.',
					"id"			=> "blog_cat_title_bcktoggle",
					"std"			=> 1,
					"folds"			=> 1,
					"on"			=> "Show",
					"off"			=> "Hide",
					"type"			=> "switch"
				);	
					
					
$of_options[] = array(
					"name"			=> "Upload blog CATEGORIES/TAGS title background image",
					"desc"			=> "upload image for blog categories titles background (optional)",
					"id"			=> "blog_cat_title_backimg",
					"fold"			=> "blog_cat_title_bcktoggle", /* the folding hook */
					"std"			=> get_template_directory_uri(). '/img/header-cats.jpg',
					"type"			=> "media"
					);
				
$of_options[] = array(
					"name"			=> "Blog AUTHOR pages title background image ?",
					"desc"			=> 'choice to have image background on blog author pages. For single blog pages, use featured image.',
					"id"			=> "blog_author_title_bcktoggle",
					"std"			=> 1,
					"folds"			=> 1,
					"on"			=> "Show",
					"off"			=> "Hide",
					"type"			=> "switch"
					);	
					
					
$of_options[] = array(
					"name"			=> "Upload blog AUTHOR pages title background image",
					"desc"			=> "upload image for blog author pages titles background (optional)",
					"id"			=> "blog_author_title_backimg",
					"fold"			=> "blog_author_title_bcktoggle", /* the folding hook */
					"std"			=> get_template_directory_uri(). '/img/header-author.jpg',
					"type"			=> "media"
					);


$of_options[] = array(
					"name"			=> "BLOG AND PORTFOLIO POST META AND POST FORMAT SETTINGS",
					"desc_html"			=> '<p><strong></strong><br />Settings bellow are appliable to both blog posts and portfolio items - in the single view or archive view. Page builder settings are not affected with this settings.</p>',
					"id"			=> "blog_portfolio_meta_format",
					"std"			=> '',
					"type"			=> "html"
					); 	
					
					
					
$of_options[] = array(
					"name"			=> "Post meta settings",
					"desc"			=> "turn on/off post meta, date and author, categories and tags, comments, and permalink boxes.",
					"id"			=> "post_meta",
					"std"			=> array('date_author','categories_tags','comments', 'link'),
				  	"type"			=> "multicheck",
					"options"		=> array(
									'date_author'		=> 'Date and author',
									'categories_tags'	=> 'Post categories and tags',
									'comments'			=> 'Comments count',
									'link'				=> 'Link button'
									
								)
					);	

					
$of_options[] = array(
					"name"			=> "Post date format",
					"desc"			=> "Which date format would you like to use: day, month, year, or different. Type in the order the <strong>d</strong> or <strong>D</strong> for day, <strong>m</strong> or <strong>M</strong> for month, <strong>Y</strong> for year ...",
					"id"			=> "post_date_format",
					"std"			=> "d M Y",
					"type"			=> "text"
					);

					
$of_options[] = array(  
					"name"			=> "Show post format icons ?",
					"desc"			=> 'throughout the theme post format icons are displayed to emphasize post format ( audio, video, image, gallery ... ).',
					"id"			=> "post_format_icons",
					"std"			=> 1,
					"on"			=> "Show icons",
					"off"			=> "Hide icons",
					"type"			=> "switch"
					);

$of_options[] = array(
					"name"			=> "Widget title icons ?",
					"desc"			=> 'sidebar (and other widget areas) has <em>iconized </em>titles. To remove icons, toggle this switch. NOTE: Icons are applied only to default WP widgets, WooCommerce widgets and theme widgets. Third party widgets are icon-free',
					"id"			=> "default_widget_icons",
					"std"			=> 1,
					"on"			=> "Show widget icons",
					"off"			=> "Hide widget icons",
					"type"			=> "switch"
					);

					
/****************************** PORTFOLIO SETTINGS TAB *************************************/					
					
					
$of_options[] = array(
					"name"			=> "Portfolio Settings",
					"id"			=> "TAB - blog settings",
                    "type"			=> "heading",
					"std"			=> ""
					);

					
$of_options[] = array(  
					"name"			=> "<strong>Single portfolio page</strong> title background image (featured) ?",
					"desc"			=> 'choice to have image background on single portfolio item. Use featured image.<br /><br /><strong>IMPORTANT NOTE: if no featured image is set and this option is ON, the portfolio archive background image will be used</strong>',
					"id"			=> "single_portfolio_title_bcktoggle",
					"std"			=> 1,
					"folds"			=> 1,
					"on"			=> "Show",
					"off"			=> "Hide",
					"type"			=> "switch"
				);
				
				
$of_options[] = array(
					"name"			=> "Portfolio archive/taxonomies title background image ?",
					"desc"			=> 'choice to have image background on portfolio archive and taxonomies pages. For single portfolio pages, use portfolio item featured image.',
					"id"			=> "portfolio_title_bcktoggle",
					"std"			=> 1,
					"folds"			=> 1,
					"on"			=> "Show",
					"off"			=> "Hide",
					"type"			=> "switch"
				);	
					
					
$of_options[] = array(
					"name"			=> "Set portfolio archive/taxonomies title background image",
					"desc"			=> "upload image for portfolio archive or taxonomies (portfolio categories and tags) titles background (optional)",
					"id"			=> "portfolio_title_backimg",
					"fold"			=> "portfolio_title_bcktoggle", /* the folding hook */
					"std"			=> get_template_directory_uri(). '/img/header-portfolio.jpg',
					"type"			=> "media");


		

//=================== BACKUP TAB ================================ 					
					
$of_options[] = array(
					"name"			=> "BACKUP",
					"id"			=> "TAB - backup",
					"type"			=> "heading",
					"std"			=> ""
					);

					
$of_options[] = array(
					"name"			=>"Backup theme options",
					"id"			=>"backup_options",
					"std"			=> "",
					"type"			=>"backup",
					"options"		=> "Please, use this to save theme options in case you want to allow upgrading theme to new version."
					
				);
				
$of_options[] = array(
					"name"			=> "Backup help",
					"desc"			=> "",
					"id"			=> "backup_help",
					"std"			=> "<h3>HELP:</h3>This utility backups <b>SAVED</b> theme options.<br />Remember, when restoring backuped options: after you click on <b>'Restore options'</b>, you must click on <b>'Save All Changes'</b> to apply restored options. So, in short:<ul><li><b> &rarr; to backup </b>- first save, then backup</li><li><b>&rarr; to restore </b>- first restore, then save</li></ul>",
					"icon"			=> true,
					"type"			=> "info");	
					
$of_options[] = array(
					"name"			=> "Transfer Theme Options Data",
                    "id"			=> "of_transfer",
                    "std"			=> "",
                    "type"			=> "transfer",
					"desc"			=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".
						',
					);

					
	} // end function of_options
}
?>