<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package	   TGM-Plugin-Activation
 * @subpackage Example
 * @version	   2.3.6
 * @author	   Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author	   Gary Jones <gamajo@gamajo.com>
 * @copyright  Copyright (c) 2012, Thomas Griffin
 * @license	   http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
//require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

require_once get_template_directory() . '/inc/tgm-plugin-activation/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for Cypress theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// REQUIRED PLUGINS
		array(
			'name' 				=> 'GitHub Updater',
			'slug' 				=> 'github-updater',
			'source'			=> get_template_directory() . '/inc/plugins/github-updater.zip',
			'required' 			=> true,
			'force_activation' 	=> true,
			'force_deactivation'=> false,
		),
		
		array(
			'name'     				=> 'Aqua Page Builder',
			'slug'     				=> 'aqua-page-builder',
			'required' 				=> true,
			'version' 				=> '1.1.4.',
			'force_activation' 		=> false, 
			'force_deactivation' 	=> false
		),
		array(
			'name' 				=> 'WooCommerce',
			'slug' 				=> 'woocommerce',
			'required' 			=> true,
		),
		array(
			'name' 				=> 'Aligator Shortcodes',
			'slug' 				=> 'aligator-shortcodes',
			'source'			=> get_template_directory() . '/inc/plugins/aligator-shortcodes.zip',
			'required' 			=> true,
			'force_activation' 	=> false,
			'force_deactivation'=> false,
		),
		array(
			'name' 				=> 'Aligator Custom Post Types',
			'slug' 				=> 'aligator-custom-post-types',
			'source'			=> get_template_directory() . '/inc/plugins/aligator-custom-post-types.zip',
			'required' 			=> true,
			'force_activation' 	=> true,
			'force_deactivation'=> true,
		),
		array(
			'name' 				=> 'Revolution Slider',
			'slug' 				=> 'revslider',
			'source'			=> 'http://aligator-studio.com/tgm_pa_plugins/revslider.zip',
			'external_url'		=> 'http://aligator-studio.com/tgm_pa_plugins/',
			'required' 			=> true,
		),
		array(
			'name' 				=> 'Envato Wordpress Toolkit',
			'slug' 				=> 'envato-wordpress-toolkit',
			'source'			=> get_template_directory() . '/inc/plugins/envato-wordpress-toolkit.zip',
			'required' 			=> true,
		),
		array(
			'name' 				=> 'YITH WooCommerce Wishlist',
			'slug' 				=> 'yith-woocommerce-wishlist',
			'required' 			=> false,
		),
		
		//	Recommended plugins
		//	
		array(
			'name' 				=> 'WooCommerce ShareThis Integration',
			'slug' 				=> 'woocommerce-sharethis-integration',
			'required' 			=> false
		),
		

	);


	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'default_path' => '',						// Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins',	// Menu slug.
        'has_notices'  => true,						// Show admin notices or not.
        'dismissable'  => true,						// If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',						// If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => true,						// Automatically activate plugins after installation or not.
        'message'      => '',						// Message to output right before the plugins table.
		
		// 'strings'	=> array(); // check for edit in inc/tgm-plugin-activation/class-tgm-plugin-activation.php file
	);

	tgmpa( $plugins, $config );

}