<!DOCTYPE html>
<!-- saved from url=(0054)http://twitter.github.com/bootstrap/examples/hero.html -->
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>Cypress WP theme documentation</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Theme documentation fo Cypress - WP theme">
<meta name="author" content="http://aligator-studio.com">


<link href="assets/css/bootstrap.css" rel="stylesheet">
<style type="text/css">
body {
padding-top: 60px;
padding-bottom: 40px;
}
.toc {float:right;}
</style>
<link href="assets/css/bootstrap-theme.css" rel="stylesheet">
<link rel="stylesheet" href="assets/js/prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen, projection">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Fav and touch icons -->
<link rel="shortcut icon" href="assets/images/cypress_favicon-32-32-c.png">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/cypress_favicon-144-144-c.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/cypress_favicon-72-72-c.png">
<link rel="apple-touch-icon-precomposed" sizes="57x57" href="assets/images/cypress_favicon-57-57-c.png">
</head>

<body>

	<div class="wrap">
	
	<div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Cypress Theme Documentation</a>
          </div>
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
             <li><a href="#theme-main" class="dropdown-toggle">Theme main set up </a></li>
			 <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Theme features<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li class="dropdown-header"><strong>Theme-specific content</strong></li>
				  <li><a href="#products">Products</a></li>
				  <li><a href="#portfolio">Portfolio items</a></li>
                  <li><a href="#sliders">Sliders</a></li>
                  <li><a href="#featured">Featured content</a></li>
                  <li><a href="#media">Media sizes and formats</a></li>
				  <li><a href="#page-templates">Page templates </a></li>
                  <li class="divider"></li>
                  <li class="dropdown-header"><strong>Theme special features</strong></li>
                  <li><a href="#page-builder">Aqua/Cypress Page builder blocks </a></li>
                  <li><a href="#post-formats">Post formats and custom meta </a></li>
                  <li><a href="#mega-menu">Menu locations and mega menu</a></li>
                  <li><a href="#widgets">Widgets areas (sidebars)</a></li>
                  <li><a href="#theme-options">Theme options</a></li>
                  <li><a href="#plugins">Plugins</a></li>
                  <li><a href="#wpml">WPML plugin compatibility</a></li>
                </ul>
              </li>
			   <li><a href="#scripts-credits" class="dropdown-toggle">Scripts and credits</a></li>
			  
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
	
	
	

	<div class="container" >

		<!-- Main hero unit for a primary marketing message or call to action -->
		<div class="jumbotron">
			
			<h1>Cypress theme</h1>
			
			<small>
			Version 1.0 created: February the 10<sup>th</sup> , 2014. | By: Aligator Studio | Email: <a href="mailto:themes@aligator-studio.com">themes@aligator-studio.com</a>
			</small>
			
			<h3 class="alert alert-info">Revolution Slider plugin included</h3>
		
		</div>			
			
		<div class="row">		
		
			<div class="col-lg-12" style="text-align: center;">
						
				<strong>Thank you for purchasing our theme.</strong><br />Cypress theme is e-commerce WordPress theme compatible with WooCommerce plugin
				
				<p><strong>NOTE:</strong> In documentation bellow, by clicking on buttons like <a href="#" class="btn btn-primary btn-xs">this</a> , <a href="#" class="btn btn-success btn-xs">this</a> , <a href="#" class="btn btn-info btn-xs">this</a> , <a href="#" class="btn btn-warning btn-xs">this</a> , <a href="#" class="btn btn-info btn-xs">this</a> or <a href="#" class="btn btn-danger btn-xs">this</a> you'll learn more, often <strong>important</strong> details about theme.<br />
				Aqua Page Builder will be in most cases referred as <strong><span class="label label-default">AQPB</span></strong>
			</p>
			</div>	
			
		</div>
		
		
		<!-- ===================== THEME MAIN SET UP ============================== -->
		
		<div class="row">

			<div class="col-lg-12">

				<h2 class="well" id="theme-main"><strong>Theme main set up</strong></h2>

				<p class="alert alert-info"><strong>THIS DOCUMENTATION ASSUMES YOU ALREADY KNOW HOW TO INSTALL WORDPRESS ON YOUR SITE (DOWNLOAD INSTALLATION, SET UP DATABASE AND RUN SERVER WORDPRESS INSTALLATION), AND HAVE BASIC KNOWLEDGE OF WORDPRESS CONCEPTS, ROUTINES AND TERMINOLOGY. </strong>
				</p>
				
				<h3 id="install-best-procedure">CYPRESS THEME INSTALLATION BEST PRACTICE:</h3>
				
				<hr>
				
				<ul class="list-group">
					
					<li class="list-group-item"><strong><span class="badge">1.</span> make clean WP installation</strong></li>
					<li class="list-group-item"><strong><span class="badge">2.</span> install and activate Cypress theme</strong>
					 - 
						<a data-toggle="modal" href="#modal-after-activation" class="btn btn-primary btn-success btn-xs" style="text-shadow: none;">IMPORTANT -After theme activation</a>
					
					</li>
					<li class="list-group-item">
						<h5><strong><span class="badge">3.</span> install REQUIRED PLUGINS</strong> (install and activate):</h5>
						
						<a data-toggle="modal" href="#modal-setup-plugins" class="btn btn-primary btn-success btn-xs" style="text-shadow: none;">IMPORTANT - Plugins installation procedure</a>
						
						<br />
						<br />
						
						<p>Cypress theme <strong>heavily depends on Aqua Page Builder (<strong><span class="label label-default">AQPB</span></strong>) plugin</strong>. Although theme could function properly  without plugin (especially blog and standard pages), theme would miss some great features targeted for integration AQPB plugin.</p>
						
					
						<br /><br />
						
						<ol class="list-group">
							<li class="list-group-item">Aqua Page Builder plugin <strong><span class="label label-default">AQPB</span></strong></li>
							<li class="list-group-item">WooCommerce - <a data-toggle="modal" href="#modal-setup-woo" class="btn btn-warning btn-xs">Important notes</a></li>
							<li class="list-group-item">Aligator Custom posts</li>
							<li class="list-group-item">Aligator Shortcodes Plugin</li>
							<li class="list-group-item">Revolution Slider - <a data-toggle="modal" href="#modal-revolution" class="btn btn-warning btn-xs">Important notes</a></li>
						</ol><br />
					</li>
					<li class="list-group-item"><strong><span class="badge">4.</span> import demo content</strong> - <a data-toggle="modal" href="#modal-setup-import" class="btn btn-warning btn-xs">Import notes</a></li>
					
					<li class="list-group-item"><strong><span class="badge">5.</span> set home page</strong> 
					<br /><br />				
					<div class="alert alert-danger">
						<h5>IMPORTANT NOTE -DEFAULT HOME PAGE:</h5>
						Since default WP home page is set to display <strong>blog posts</strong>, such is the case with Cypress theme, too.<br /><br />
						To set home page <u>as in theme demo</u> (with imported content) in <strong>Settings > Reading</strong> set "Front page displays" to "<strong>A static page (select below)</strong>" and select imported <strong>"Home page"</strong>.
					
					</div>
					
					</li>
					
					<li class="list-group-item"><strong><span class="badge">5.</span> set permalinks</strong> - <a data-toggle="modal" href="#modal-setup-permalinks" class="btn btn-warning btn-xs">Important notes</a></li>
					
					<li class="list-group-item"><strong><span class="badge">6.</span> set menus</strong> - <a data-toggle="modal" href="#modal-setup-menus" class="btn btn-warning btn-xs">Important notes</a></li>
					
				</ul>



			</div><!-- /col-lg-12 -->

		</div><!-- /row -->
		
		
		<!-- ======================= MODALS FOR THEME MAIN SETUP =========================== -->
		
		
		<!-- Modal SET UP - PLUGINS -->
		<div class="modal fade" id="modal-after-activation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">After theme activation</h4>
					</div>
					
					<div class="modal-body">
					
						<p class="alert alert-info">After theme activation, some files CSS and Javascript are created to apply theme options DEFATULT settings (mostly font settings and css styles). <br><br>
						
						<strong>If you are updating theme :</strong>
						<br />
						<br />
						Navigate to <strong>Appearance > Theme options</strong> and hit <strong>"Save all changes"</strong></p>
					
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
		
		

		<!-- Modal SET UP - PLUGINS -->
		<div class="modal fade" id="modal-setup-plugins" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Theme plugins installation procedure</h4>
					</div>
					
					<div class="modal-body">
						<p>After theme activation, the "Install Plugins" link will appear (after the Customize OPTIONS:Widgets, Menus , Page Builder, Theme Options) - click on it to install required plugins ( WooCommerce and Aqua Page Builder from Wordpress.org plugins repositoriy, Aligator Studio plugins from theme)</p>
						
						<p>
						<img src="assets/images/02-plugins-required.png" class="img-responsive"/>
						</p>
						
						<p>If you ignore "Install Plugins", link, the <strong>yellow box</strong> on the top of the admin pages with required and optional plugins info and installation routines will display notice the start plugins installation.
						</p>
						
						
						<p>Click on <strong>"Begin installing plugins"</strong> (at the message box bottom) and install theme required plugins. On "Install required plugins" page check the 
						<ul>
							<li>"Aligator Shortcodes",</li>
							<li>"Aligator Custom Posts",</li>
							<li>"Aqua Page Builder"</li>
							<li>"WooCommerce" and</li> 
							<li>"Revolution slider"</li> 
						</ul>
						plugins, set <strong>"Bulk actions"</strong> to "Install" and click "Apply".
						</p>
						
						<p>After plugins are installed, check the same plugins and select "Activate".</p>
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
		
		<!-- Modal SET UP - WooCommerce-->
		<div class="modal fade" id="modal-setup-woo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">WooCommerce shop pages creation</h4>
					</div>
					<div class="modal-body">
						<p>
						After WooCommerce plugin installation and activation, the WooCommerce prompt message <strong>(in the box at the top - "Welcome to WooCommerce – You're almost ready to start selling :)")</strong>  asking to create shop pages:
						</p>
						
						<p class="alert alert-danger"><strong>RECOMMENDED: Click on <u>"Install WooCommerce Pages"</u>. All the pages for shop will be added and all the endpoints for "My account", "Cart" and "Checkout" will be set in WooCommerce settings .</strong>
						</p>
						
						<img src="assets/images/woopages.png" class="img-responsive" />
						
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
		<!-- Modal SET UP - IMPORT-->
		<div class="modal fade" id="modal-setup-import" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Import demo content</h4>
					</div>
					<div class="modal-body">
						<p>After installing and activating theme and all the plugins related, it's advisable to import demo content to have easier start with a lots of features theme is offering.</p>
						<p>In WP admin menu go to <strong>Tools > Import</strong>, and select <strong>"Wordpress"</strong>  from import choices table.</p>
						
						<p class="alert alert-success">The xml file for import can be found <strong>in the theme root</strong> and it's called <strong>cypress.demo.content.xml</strong></p>
						
						<p>If you choose to <strong>Import Attachments</strong>, <u>please be patient</u>, as the <strong>downloading of images may take a while</strong> due to some number of quality images to download. It might happen that your server has time or upload limits so the download interrupts or fails, so check your server settings.</p>
						
						
						<div class="alert alert-warning">
							
							<strong>NOTE:</strong><br />
							Due to limitations of WP export/import procedure not every data is transferred.
							What is not imported from demo content:
							<ul>
								<li>product categories images</li>
								<li>post formats for custom post types</li>
								<li>loss of data in <span class="label label-default">AQPB</span> (plugin bug - hopefully be fixed in near future)</li>
							</ul>
							
							<br /><br />	

						</div>
						

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
		<!-- Modal SET UP - PERMALINKS-->
		<div class="modal fade" id="modal-setup-permalinks" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Set permalinks</h4>
					</div>
					<div class="modal-body">
						<p>
						It's important that after the installing theme, plugins and demo content import the permalinks are set to re-create inner connections between content (posts, taxonomies, meta data...) and create permalink, which are important for SEO.
						</p>
						<p>
						In WP admin menu go to Settings > Permalinks and in "Common Settings" section select "Post name".<br />
						In "Product permalink base" we recommend setting "Shop base with category" as permalinks base for your shop.
						</p>
						
					
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
		
		<!-- Modal SET UP - MENUS-->
		<div class="modal fade" id="modal-setup-menus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Set menus</h4>
					</div>
					<div class="modal-body">
						<p>
						If you imported demo content, the menus and menu items will also be imported. However, the import process <strong>doesn't manage menus created by import and menus locations</strong>, programmed by theme.
						</p>
						
						<p>Also, the custom field used for creating Mega menus are also not exported/imported. So, you'll need to set those manually.
						For more help check out these videos:</p>
						<ul>
							<li><strong><a href="http://www.screenr.com/QjHN">creating mega menu</a></strong></li>
							<li><strong><a href="http://www.screenr.com/UIHN">inserting images into Mega Menu</a></strong></li>
						</ul>
						<p>And learn more about Mega Menus in <a href="#mega-menu"><strong>"Menu locations and mega menu"</strong></a> section.</p>
						
						<br />
						<br />
						<p>
						Cypress theme has following menus location (both in header) so set following imported menus to menus locations:
							<ul>
								<li>Main menu </li>
								<li>Main horizontal menu</li>
								<li>Main mobile menu</li>
								<li>Secondary menu - "Secondary menu"</li>
							</ul>
						</p>
						
						Theme specific menu feature "Mega menu" is explained in section <a href="#mega-menu"><strong>"Menu locations and mega menu"</strong></a>
						
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
		<!-- Modal REVOLUTION SLIDER-->
		<div class="modal fade" id="modal-revolution" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Revolution slider</h4>
					</div>
					<div class="modal-body">
						
						<p>
						Cypress theme includes the great <strong>"Revolution slider" - a Premium CodeCanyon plugin</strong>.
						</p>
						
						<p>Revolution slider zip included in theme plugins installation procedure does not contain documentation or plugin import files to minimize the theme total size for shorter download time. The plugin authors have made the documentation available online:<br />
						<a data-toggle="modal" href="http://themepunch.com/codecanyon/revolution_wp/documentation/" class="btn btn-primary btn-success btn-xs" style="text-shadow: none;" target="_blank">Click here for Revolution Slider documentation</a>
						</p>
						
						<p>
						Cypress theme includes also "Cypress slider 1" and "Cypress slider 2 "slider import files <strong>"cypress-slider-1.zip"</strong> and <strong>"cypress-slider-2.zip"</strong>, and this file can be found in theme's "inc/plugins" directory.
						</p>
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
		
		<!-- ======================= END MODALS FOR THEME MAIN SETUP =========================== -->
		
		
		<!-- ============ PRODUCTS ===============-->
	
		<div class="row">
		
			<div class="col-lg-12">
			
				<h2><b>Theme features<br /><small>theme specific content</small></b></h2>
			
			</div>
			
		</div>	
		
		
		<div class="row well" id="products">	
			
			<div class="col-lg-12">
			
				<h3><b>Products</b></h3>
			
			</div>	
		
			<div class="col-lg-12">
			
				<p>After installing WooCommerce plugin, you will be able to add products, which are actually custom post type ("product" custom post type).</p>
				
				<p>Adding products can be done in WP admin menu -<strong> Products > Add product</strong>, the list of all products is in <strong>Products > Products</strong></p>
				
				<p>
				If you imported demo content you'll be able to see that there are set <strong>Product categories, Attributes</strong> and <strong>product tags</strong>.
				<p>
				There are plenty of settings, options and possibilities you can add to your products and this is all covered in <a href="http://docs.woothemes.com/documentation/plugins/woocommerce/"><strong>WooCommerce documentation</strong></a> which we highly recommend to use during your e-commerce shop activation.
				</p>
				
				<p class="alert alert-info">
				NOTE:<br />
				Cypress theme adds <u>nothing in administering</u> shop or products, <strong> all the shop related settings are part of WooCommerce plugin</strong> - theme is dealing with products front end presentation (css styling and adapting shop pages layout to theme), especially in Aqua Page Builder custom theme blocks.
				</p>
				
				<h4>Cypress theme / WooCommerce related specifics :</h4>
				
				<br />
				
				<p>Administering Aqua Page Builder blocks with products content (and other) is explained in <a href="#page-builder"><strong>Aqua Page Builder custom theme blocks</strong></a> section.</p>
				
				<p>Theme options Shop settings adds additional layer of control over displaying products. For more info, head over to <a href="#theme-options"><strong>Theme options section</strong></a>.</p>
				<br />
				
				
			</div>	
		
			<hr>
		
		</div>
		
		
		<!-- ============ PORTFOLIO  ===============-->
		
		<div class="row well" id="portfolio">

		
			<div class="col-lg-12">
			
				<h3><b>Portfolio items</b></h3>
			
			</div>	
		
			<div class="col-lg-12">
			
				<p>After installing Aligator Custom Post Types plugin your theme installation will have two additional custom post types registered - Portfolio and Sliders.
				</p>
				
				<p>
				<strong>Portfolio post type </strong>is another way to format you content in special way - different then posts, pages or products - to show your latest projects, models, sales actions ...
				</p>
				
				<br />
				
				<h4>Adding portfolio item</h4>
				<ul>
					<li>In WP admin menu go to Portfolio > Add New Item</li>
					<li>Add title, text and set featured image</li>
					<li>Create and select <strong>portfolio categories</strong> and <strong>tags</strong> (in side meta boxes)</li>
					<li><strong>Featured item</strong> - in first side meta box check if you want to make item featured (for usage in blocks and sliders)</li>
					<li class="alert alert-info"><strong>Post formats tabs (above the title)</strong> are used to assign post format to the portfolio item (<em>standard, image, gallery, audio, video or quote</em>) - details about Post formats settings (custom meta boxes) are in the section<a href="#post-formats" class="btn btn-primary"> <strong>"Post formats"</strong></a></li>
					<li><strong>Portfolio custom meta box:</strong><br /><br />
						<ul>
							Portfolio custom meta box adds additional information to main content and featured image and that data is displayed <strong>in single portfolio page only</strong>:
							<li><strong>Tagline</strong> - displayed bellow the item title</li>
							<li><strong>Layout mode</strong> - float image left, right or stretch in full width (good for image post format)</li>
							<li><strong>Featured image format</strong> - choose between registered image formats</li>
							<li><strong>Number of related items</strong> - in the single page bottom there are related portfolio items section - set the number of items</li>
							<li><strong>Button URL and label</strong> - button and link to eventual external or internal "project" page</li>
						</ul>
					</li>
					
				</ul>
				
				<br />
				
				<h4>Creating portfolio page</h4>
				
				Portfolio page (or page section) can be created with <span class="label label-default">AQPB</span> plugin - "Ajax content" or "Filtered content" block.
				<span class="label label-default">AQPB</span> block are explained more detailed in "<a href="#page-builder"><strong>Aqua/Cypress Page Builder blocks</strong></a>" section.
				
			</div>	
		
			<hr>
		
		</div>
		
		
		<!-- ============ SLIDER  ===============-->
		
		<div class="row well" id="sliders">

		
			<div class="col-lg-12">
			
				<h3><b>Slider items</b></h3>
			
			</div>	
		
			<div class="col-lg-12">
			
				<p>After installing Aligator Custom Post Types plugin your theme installation will have two additional custom post types registered - Portfolio and Sliders.
				</p>
				
				<p>
				<strong>Slide post type </strong>are created to be used exclusively with <strong><span class="label label-default">AQPB</span> "Slider block"</strong> ... <strong>
				</p>
				
				<p>
				Slides</strong> are built to be used as part of <strong>Sliders</strong> (custom taxonomy) - Slider taxonomy is used on <span class="label label-default">AQPB</span> "Slider block".
				</p>
				
				<br />
				
				<h4>Adding slide item</h4>
				<ul>
					<li>In WP admin menu go to Slide > Add New Slide</li>
					<li>Add title, set featured image (for Slider style 2 and 3 - see <span class="label label-default">AQPB</span> blocks) and create <strong>slide layers</strong> (custom meta box)</li>
					<li>Create and select <strong>sliders</strong> (slide taxonomy) (in side meta box)</li>
					<li><strong>Featured item</strong> - in first side meta box check if you want to make item featured (for usage in Slider block)</li>
					
				</ul>
				
				<br />
				
				<h4>Creating slider </h4>
				
				<strong>Slider</strong> is actually a <em>taxonomy (custom category)</em> for individual slides. So, basically - create <strong>individual</strong> slides and then <strong>assign them to slider</strong>. You can interchange slides and sliders in any combination.
				<br /><br />
				<span class="label label-default">AQPB</span> <strong>"Slider block"</strong> is explained more detailed in "<a href="#page-builder"><strong>Aqua/Cypress Page Builder blocks</strong></a>" section.
				
			</div>	
		
			<hr>
		
		</div>
		
		<!-- ============ FEATURED CONTENT  ===============-->
		
		<div class="row well">
		
			<div class="col-lg-12">
			
				<h3 id="featured"><b>Featured content</b></h3>
			
			</div>
			
			<div class="col-lg-12">
			
				<h4>Featured posts, products, portfolios ...</h4><br />
				
				<p>Cypress theme utilizes featured content for additional layer of filtering content. Since great deal of delivering content is done with <span class="label label-default">AQPB</span> plugin, in plugin blocks there is a option <strong>"Show only featured"</strong> and it filters featured posts, products, portfolio items or sliders, along with other filter (post type, taxonomy, number of items etc ...)</p>
				
				Making items featured:<br />
				<ul>
				<li><strong>Posts</strong> - use "sticky post" feature - in post <strong>"Publish"</strong> box - toggle "Visibility" setting and check the <strong>"Stick this post to the front page"</strong></li>
				<li><strong>Products</strong> - in products list page (WP menu - Products > Products)- click on little grey star in line of each product you want to be featured</li>
				<li><strong>Portfolio and slide items </strong>- in item edit page, in <strong>"Featured" </strong>box check the <strong>"Make this item featured"</strong></li>
				</ul>
				<br />
				<h4>Featured image ( or, post thumbnail)</h4><br />
				
				<p>Each of upper post types are using Featured post image - this is the image that represents the content and it is used in archive pages and single pages as bellow post titles and  title background, respectively. </p>
			</div>
			
		</div>	
		
		
		<!-- ============ MEDIA  ===============-->
		
		<div class="row well">
		
			<div class="col-lg-12">
			
				<h3 id="media"><b>Media sizes and formats</b></h3>
			
			</div>
			
			<div class="col-lg-12">
			
				 <br />
				 <h4><strong>Image sizes</strong></h4>
				
				<h4><u>Cypress recommended image size is <strong>min. 1400px in width</strong></u>. Ideally, the ratio between with / height would be in ratio 1 : 1.618 (golden ratio) - 1400px x 860px in landscape mode or 1400px x 2200px in portrait mode.</h4>
				<br />
				<p class="alert alert-info"><strong>Additional mage sizes created  by theme are - Cypress portrait and Cypress landscape.</strong></p>
				
				<br />
				
				<div class="alert alert-danger">NOTE: because of the theme <strong>responsive</strong> and <strong>flexible</strong> nature, the relevant concepts for images are: <br><br>
					<ul>
						<li><strong>width/height ratio (aka portrait or landscape)</strong> and </li>
						<li><strong>image resolution</strong> (the bigger resolution the better quality - but loading time is longer / more bandwidth consumed).</li>
					</ul><br>
					We recommend usage of <strong>Cypress portrait</strong> of <strong>landscape</strong> formats, and only if necessary custom image sizes (available in Aqua Page Builder blocks), smaller sizes (bigger sizes will heavy load image resizing script.)
				</div>
				
				<h4><strong>Audio</strong></h4>
				
				<p>Since WP version 3.6 it' very easy to use audio and video with embedded media player.</p>
				<p><strong>Audio files</strong> - upload files (<strong>mp3 </strong>) via media uploader ( activate "Audio" post format tab ) from custom meta box "Audio settings" for self-hosted audio, or simply enter audio file URL in the same input field. Audio files uploaded this way will be display in <strong>post archive pages, single pages and in page builder blocks</strong> ( ajax content and filtered content blocks ) </p>
				
				
				<p>Audio mp3 files can be added with "Add media" pop-up window, in which case for the uploaded audio will be added [audio] shortcode. Audio files added that way will be visible only on posts <strong>single page</strong>.
				</p>
				 <br />
				<h4><strong>Video</strong></h4>
				
				<p>Cypress is using video hosting services such as YouTube, Vimeo, Sreenr etc. to add video as featured media using post formats and custom meta boxes.<br /><br />
				<strong>First</strong> - select <strong>post format video</strong> tab, then in custom meta box "Video settings" enter <strong>video ID</strong> code (not full address of video), and then enter the values of width and heigh of video. </p>
				<p>
				To add more video media inside the post content it is recommended to use <strong>Aligator Studio Shortcodes</strong> (installed in automated theme plugins installation). Assuming the Aligator Studio Shortcodes are installed and activated - click on "Add shortcodes" button, select "Video" and, same as in post format way - choose video host service, <strong>enter only video ID code</strong>, and then enter the values of width and heigh of video. </p>
				
			</div>
			
		</div>	
		
		
		<!-- ============ PAGE TEMPLATES  ===============-->
		
		<div class="row well" id="page-templates">
		
			<div class="col-lg-12">
			
				<h3><b>Page templates</b></h3>
			
			</div>
			
			<div class="col-lg-12">
			
				Cypress has following defined page templates ( "static" pages - in WP admin menu - "Pages" )
				<br><br>
				<ol>
					<li>Default template - standard WP template with sidebar</li>
					<li>Blank template - template with no header (with logo and menus) and footer - good for "Landing pages"</li>
					<li>Full width page - page without the sidebar</li>
					<li>Page builder template - page template best suited for usage with Aqua Page Builder templates</li>
					<li>Page of posts - page with blog posts archive display capability ( with pagination )</li>
				</ol>
				
			</div>
			
		</div><!-- end PAGE TEMPLATES  ===============-->
		
		
		
		
		
		<!-- ============ AQUA PAGE BUILDER  =============== -->
		
		
		<div class="row well" id="page-builder">
		
			<div class="col-lg-12">
			
				<h3><b>Aqua Page builder blocks</b></h3>
			
			</div>
			
			<div class="col-lg-12">
			
				<p class="alert alert-info">
				As stated before, Cypress theme <strong>heavily relies on AQUA Page Builder plugin</strong> - building custom pages with pre packed blocks, using page builder page scaffolding ( grid system ) and many blocks customization options.
				<br /><br />
				To learn some AQPB basics before continuing with Cypress page builder block, please visit <strong><a href="http://wordpress.org/plugins/aqua-page-builder/">plugin's page</a></strong>
				
				</p>
				<br />
				
				<h4>To extend plugin's capability Cypress theme offers following powerful page builder blocks : </h4>
				
				<br />
				
				<ul class="list-group col-md-10 col-md-offset-1">
					<li class="list-group-item"><strong>ROW block</strong>
					
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#block-row">
						block settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="block-row" class="collapse in">
							<hr>
							<p>
							<strong><u>The base block for Cypress content</u> - ROW block is the block that holds page scaffolding and where you add other page builder blocks</strong>.
							</p>
							
							<strong>The ROW BLOCK is built to be used primarily in "Page builder template"</strong> - page builder template has different layout - maximally adapted to ROW BLOCK.
							<br /><br />
							<strong>Options:</strong>
							<br />
							<ul>
								
								<li>Titles color - overrides the color default or theme options values  for headings inside the row.</li>
								<li>Text color - overrides text color values</li>
								<li>Link color - overrides link color values.</li>
								<li>Overlay color -  applies over the background image, with usage of opacity control - can be used as background color, too</li>
								<li>Overlay opacity - set opacity/transparecy of overlay colo</li>
								<li>Row background image - upload your image as row background</li>
								<li>Background repeat and size </li>
								<li>Padding top and bottom - adjust the paddings</li>
								<li>Full width content - blocks inside are stretched to full width page, not contained with scaffolding (css grid) container</li>
								<li>Equalize inner blocks heights - if different amount of content in inner blocks, set heights of each to same value.</li>
								<li>Paralax background - activates paralax effect - to be used if bakground image is set</li>
								<li>Paralax background ratio - the ratio for paralax background background position and speed</li>
								<li>----------YOUTUBE VIDEO BACKGROUND---------</li>
								<li>YouTube video ID - enter YT video id ONLY, not the full address to YT video.</li>
								<li>Auto play video - starts the video play automatically after page load</li>
								<li>Mute video - mute the sound of the video</li>
								<li>Optimize display - fit the video size into the window size optimizing the view</li>
								<li>Loop video - loops the movie once ended</li>
								<li>Volume - loudness of the sound (in percentage)</li>
								<li>Video quality - default’ or “small”, “medium”, “large”, “hd720”, “hd1080”, “highres”</li>
								<li>Video image ratio -  ‘4/3’ or “16/9” to set the aspect ratio of the movie</li>
							</ul>
							
						</div>
					
					</li>
					<li class="list-group-item"><strong>Ajax content</strong>
						
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#block-ajax-content">
						block settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="block-ajax-content" class="collapse">
							<hr>
							<p>
							Ajax content is using ajax loading of posts, products or portfolio items by selecting it's categories.<br /><br />
							<strong>IMPORTANT NOTES</strong>
							<ul>
								<li><strong>Post type and categories (taxonomies) must match</strong> - post with categories, products with product categories, and portfolio items with portfolio categories.</li>
								<li>Multiple categories are selected using CTRL + click (use same combination to deselect ) - when selected the menu (with two different layouts will display)</li>
							</ul>
							<strong>OPTIONS</strong>
								<ul>
									<li>Block title and subtitle / block style (float left, right, centered) - optional</li>
									<li>Post type - first and the most important filter - required</li>
									<li>Post, product or portfolio categories select</li>
									<li>Block style - 4 styles of Ajax content block layout</li>
									<li>Taxonomy menu style - display inline or in toggle menu</li>
									<li>Image format - registered image sizes (automatically created upon image uploads)</li>
									<li>Image width and height - custom image size - if set overrides registered image formats - using image resizing script</li>
									<li>Use slider, slider pagination, navigation - if items should be displayed in slider ( OWL carousel slider - responsive, touch and mouse drag capable slider)</li>
									<li>Total items - total number of items to display - default is 8 if empty it will display max. item number, given the filters above.</li>
									<li>In one row, in one slide - items can displayed in a number of variations - - for example - you can display 4 items in one slide rotation with 2 items per row (if "use slider" is unchecked only "In one row" value will apply)(values  change on mobile devices - check the demo)</li>
									<li>Display only featured - additional filter layer - if checked only featured (or sticky) items will display</li>
									<li>Display or hide excerpt or post meta or hide</li>
									
									<li>"Read more" and URL address - custom link to given URL address</li>
							</ul>
							
							
							</p>
							
						</div>
					
					</li>
					
					<li class="list-group-item"><strong>Ajax products</strong>
						
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#block-ajax-prods">
						block settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="block-ajax-prods" class="collapse">
							<hr>
							<p>
							Ajax products block is displaying products, filtered by product categories, selected via ajax loading.
							</p>
							
							<strong>IMPORTANT NOTES</strong>
							<ul>
								<li>Multiple categories are selected using CTRL + click (use same combination to deselect ) - when selected the menu (with two different layouts will display)</li>
								<li>Ajax products categories block is designed to display <strong>product categories images</strong> in menu, so it's advisable to upload images for your products categories</li>
							</ul>
							
							<strong>OPTIONS</strong>
								<ul>
									<li>Block title and subtitle / block style (float left, right, centered) - optional</li>
									<li>Product categories select</li>
									<li>Categories menu - select between categories images, categories titles only or none</li>
									<li>Menu columns - select the style of menu columns (items) display</li>
									Special filters
									<li>Product image format - registered image sizes (automatically created upon image uploads)</li>
									<li>Shop assets - select shop assets - between displaying "Add to Cart/Select options", "Quick view" (ajax single product) or none</li>
									<li>Use slider, slider pagination, navigation, slider timing (in miliseconds) - if items should be displayed in slider ( OWL carousel slider - responsive, touch and mouse drag capable slider)</li>

									<li>Total items - total number of items to display - default is 8 if empty it will display max. item number, given the filters above.</li>
									<li>In one row, in one slide - items can displayed in a number of variations - - for example - you can display 4 items in one slide rotation with 2 items per row (if "use slider" is unchecked only "In one row" value will apply)(values  change on mobile devices - check the demo)</li>
									<li>"Text for more" and "URL address" - custom link to given URL address</li>
							</ul>
							
						</div>
					
					
					</li>
					
					
					<li class="list-group-item"><strong>Filtered content</strong>
						
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#block-filter-content">
						block settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="block-filter-content" class="collapse">
							<hr>
							<p>
							Filter content is displaying content filtered by number of filters (categories, number of items. etc.) with dynamic javascript filtering and sorting with auto sizing and layout.
							</p>
							
							<strong>IMPORTANT NOTES</strong>
							<ul>
								<li><strong>Post type and categories (taxonomies) must match</strong> - post with categories, products with product categories, and portfolio items with portfolio categories.</li>
								<li>Multiple categories are selected using CTRL + click (use same combination to deselect ) - when selected the menu (with two different layouts will display)</li>
							</ul>
							
							<strong>OPTIONS</strong>
								<ul>
									<li>Block title and subtitle / block style (float left, right, centered) - optional</li>
									<li>Post type - first and the most important filter - required</li>
									<li>Post or portfolio categories select</li>
									<li>Display only featured - additional filter layer - if checked only featured (or sticky) items will display</li>
									<li>Image format - registered image sizes (automatically created upon image uploads)</li>
									<li>Image width and height - custom image size - if set overrides registered image formats - using image resizing script</li>
									<li>Block style - 4 styles of block layout</li>
									<li>Taxonomy menu style - display inline, toggling menu or none</li>
									<li>Show sorting dropdown - select menu to sort items dynamically</li>
									<li>Total items - total number of items to display - default is 8 if empty it will display max. item number, given the filters above.</li>
									<li>In one row - number if items in one row (value changes on mobile devices - check the demo)</li>
									<li>Display post format icon, excerpt or post meta</li>
									<li>Excerpt length (in letter) - choice between predefined number of letters for displaying in excerpt</li>
									<li>"Read more" and URL address - custom link to given URL address</li>
							</ul>
							
						</div>
					
					
					</li>
					
					
					<li class="list-group-item"><strong>Filtered products</strong>
						
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#block-filter-prod">
						block settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="block-filter-prod" class="collapse">
							<hr>
							<p>
							Filtered products is displaying products filtered by number of filters (categories, number of items. etc.) with dynamic javascript filtering and sorting with auto sizing and layout.
							</p>
							
							<strong>IMPORTANT NOTES</strong>
							<ul>
							
								<li>Multiple categories are selected using CTRL + click (use same combination to deselect ) - when selected the menu (with two different layouts will display)</li>
							</ul>
							
							<strong>OPTIONS</strong>
								<ul>
									<li>Block title and subtitle / block style (float left, right, centered) - optional</li>
									<li>Product categories select</li>
									<li>Special filters - select to display latest, featured, BEST SELLING or BEST RATED products (WooCommerce features)</li>
									<li>Display only featured - additional filter layer - if checked only featured (or sticky) items will display</li>
									<li>Shop assets - select shop assets - between displaying "Add to Cart/Select options", "Quick view" (ajax single product) or none</li>
									<li>Image format - registered image sizes (automatically created upon image uploads)</li>
									<li>Image width and height - custom image size - if set overrides registered image formats - using image resizing script</li>
									<li>Block style - 4 styles of block layout</li>
									<li>Taxonomy menu style - display inline, toggling menu or none</li>
									<li>Show sorting dropdown - select menu to sort items dynamically</li>
									<li>Total items - total number of items to display - default is 8 if empty it will display max. item number, given the filters above.</li>
									<li>In one row - number if items in one row (value changes on mobile devices - check the demo)</li>
									<li>Display post format icon, excerpt or post meta</li>
									<li>"Read more" and URL address - custom link to given URL address</li>
							</ul>
							
						</div>

					</li>
					
					
					<li class="list-group-item"><strong>Single product</strong>
						
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#block-single">
						block settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="block-single" class="collapse">
							<hr>
							<p>
							Cypress "specialty" - single product block - best used in combination with ROW block and it's paralax property (using large product image as paralax background - as in theme demo.)
							</p>
							<p><strong>OPTIONS</strong></p>
							<ul>
								<li>Block title and subtitle / block style (float left, right, centered) - optional</li>
								<li>Image format - use one of the registered image formats</li>
								<li>(product) Image gallery pagination, navigation and timing - settings for sliding product images.</li>
								<li>Style - style of the layout - centred , or float left or right</li>
								<li>Background color - back color for single product block</li>
								<li>Background opacity - opacity for background color</li>
								Product options display- choice between displaying product details with options dropdowns (like in WooCommerce product single page - "Reduced"), or displaying simple "Add to Cart/Select options" (like in WooCommerce catalog page - "Full")
								<li>Product select - select single product for display</li>
							</ul>
						</div>
					
					</li>
					
					
					<li class="list-group-item"><strong>Headings</strong>
						
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#block-heads">
						block settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="block-heads" class="collapse">
							<hr>
							<p>
							Simple headings block - enter the title (or heading), it's size, sub(or sup)-title and subtitle position.
							</p>
							
						</div>
					
					</li>
					
					<li class="list-group-item"><strong>Banner block</strong>
						
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#block-banner">
						block settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="block-banner" class="collapse">
							<hr>
							<p>
							Banner block can be used for discounts announcements, big notices, and additional attraction to different aspects of your site.
							</p>
							<strong>OPTIONS</strong>
							<ul>
								<li>Banner image - background banner image upload</li>
								<li>Background size and position - css background properties</li><
								<li>Image format - size of the image used for background</li>
								<li>Overlay color - coloured layer between back image and texts</li>
								<li>Overlay opacity - opacity for coloured layer between back image and texts</li>
								<li>Block opacity - overall block opacity</li>
								<li>Padding - padding for all the block</li>
								<li>Border style - choice between solid, dashed, dotted and double border</li>
								<li>Title and text</li>
								<li>Title size - choose between extra large, large, medium and normal</li>
								<li>Subtitle - additional layer of text</li>
								<li>Text color - applies to title and text</li>
								<li>Text float - choice between right. left and centred</li>
								<li>Link - applies to whole banner block</li>
							</ul>
						</div>
					</li>

					
					<li class="list-group-item"><strong>Image block</strong>
						
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#block-image">
						block settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="block-image" class="collapse">
							<hr>
							<p>
							Simple image upload with some options:
							</p>
							<strong>OPTIONS</strong>
							<ul>
								<li>Image upload</li>
								<li>Image format - size of the image used for background</li>
								<li>Image width and height</li>
								<li>Caption title</li>
								<li>Caption title size</li>
								<li>Textfield - additional caption text</li>
								<li>Caption and text color</li>
								<li>Text floating</li>
							</ul>
						</div>
					</li>
					
					
					
					<li class="list-group-item"><strong>Team member</strong>
						
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#block-team">
						block settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="block-team" class="collapse">
							<hr>

							<strong>OPTIONS</strong>
								<ul>
									<li>Member image - upload your image</li>
									<li>Member name - required</li>
									<li>Position, URL, Phone, Member info - fields are optional</li>
									<li>Social networks (available via toggle button) - optional</li>
									<li>Layout style - choose between centred, float left or right</li>
									<li>Image style - square or round</li>
									<li>Image size - enter image size in percentage ( for example 55% )</li>
							</ul>
						</div>
					
					</li>
					
					<li class="list-group-item"><strong>Google Map block</strong>
						
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#block-gmap">
						block settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="block-gmap" class="collapse">
							<hr>
							<p class="alert alert-danger">
							IMPORTANT NOTICE: Only one Google Map Block per page can be used
							</p>
							<p><strong>OPTIONS</strong></p>
							<ul>
								<li>Location latitude and longitude (get the values using given URL address bellow)</li>
								<li>Address input fields - first input field is bold (for title or similar) - information will be displayed with click on map marker</li>
								<li>Location image - thumbnail image that will be displayed with click on map marker</li>
								<li>Width and height of the map (enter units - preferable percentage for width and pixels for height)</li>
								<li>Map color - color overlay for map - adjust it to your site's color</li>
								<li>Map desaturation - desaturation of color - default or the one set above</li>
								<li>Disable scroll zoom - useful disabling to prevent "un-scrolling" of the page</li>
							</ul>
							
						</div>
						
					</li>
					
					<li class="list-group-item"><strong>Contact form</strong>
						
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#block-contact">
						block settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="block-contact" class="collapse">
							<hr>
							<p><strong>OPTIONS</strong></p>
							
							<ul>
								<li>Block title and subtitle / block style (float left, right, centered) - optional</li>
								<li>Recipient email address - required</li>
								<li>Location image - optional image - example usage - company headquarters</li>
								<li>Location description</li>
								<li></li>
							</ul>
						</div>
					
					</li>
					
					
					<li class="list-group-item"><strong>Testimonials</strong>
						
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#block-test">
						block settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="block-test" class="collapse">
							<hr>
							<p><strong>OPTIONS</strong></p>
							<ul>
								<li>Block title / block style (float left, right, centered) - optional</li>
								<li>Testimonial sub-block - add image, title, testimonial text and name per each sub-block</li>
								<li>Add testimonial button - add as many sub-blocks as you like</li>
								<li>Images style - square (default) or rounded (not applicable in IE8 and less)</li>
								<li>Slider pagination, navigation toggle and timing input (in miliseconds)</li>
							</ul>
						</div>
					
					</li>
					
					
					<li class="list-group-item"><strong>Icon block</strong>
						
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#block-icon">
						block settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="block-icon" class="collapse">
							<hr>
							<p>
							Create your customized icon with the choice of over 470 glyph icons from <a href="http://icomoon.io/">Icomoon</a>
							</p>
							<strong>OPTIONS</strong>
							<ul>
								<li>Icons select - select icon to customize by clicking on it</li>
								<li>
								Icon and block color and size controls (toggled)
									<ul>
										<li>glyph size,</li>
										<li>glyph color,</li>
										<li>padding,</li>
										<li>border size,</li>
										<li>border radius,</li>
										<li>border color, </li>
										<li>background color,</li>
										<li> no icon background checkbox (transparent background)</li>
										<li>Block color and opacity option</li>
									</ul>
								</li>
								<li>Block border style -  solid, dotted, dashed, double </li>
								
								<li>Icon block title and text (optional)</li>
								<li>Additional button (must be entered both label and link to display the button)</li>
							</ul>
						</div>
					
					</li>
					
					
					<li class="list-group-item"><strong>Slider block</strong>
						
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#block-slider">
						block settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="block-slider" class="collapse">
							<hr>
							<p>
							Slider block is mostly designed to be used for displaying "Slide" post types, grouped in "Slider" taxonomy, but can display posts and portfolio items, too.
							</p>
							
							<p><strong>IMPORTANT NOTE</strong></p>
							<p>Slide styles apply on if post type "Slide" is selected.</p>
							
							<strong>OPTIONS</strong>
								<ul>
									<li>Image format - registered image sizes (automatically created upon image uploads)</li>
									<li>Post type - the most important filter - required</li>
									<li>Layout style - 4 styles applicable any post type</li>
									<li>Animation style - 4 automated animations styles applicable any post type</li>
									<li>Slider, post, product or portfolio categories select</li>
									<li>Special filters - choice between latest, featured (sticky) and best selling and best rated (WooCommerce products only)</li>

									<li>Total items - total number of items to display - default is 8 if empty it will display max. item number, given the filters above.</li>
									
									<li>Use slider pagination, navigation, slides auto-play delay time</li>

									<li>"Read more" and URL address - custom link to given URL address</li>
							</ul>
						
						</div>
					
					</li>
						
					<li class="list-group-item"><strong>Revolution slider block</strong>
						
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#block-rev">
						block settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="block-rev" class="collapse">
							<hr>
							<p>
							Revolution slider block <strong>requires Revolution Slider plugin</strong> to be installed and activated, and to have at least one slider created, which <strong>shortcode</strong> can be inserted in Revolution Slider block.
							</p>
							<p>Cypress theme included slider used in theme demo - the <strong>"home_slider_1.zip"</strong> file for import is theme's "inc/plugins" folder</p>
							<strong>OPTIONS</strong>
							<ul>
								<li>Insert revolution slider shortcode</li>
							</ul>
						</div>
					
					</li>
					
					<li class="list-group-item"><strong>Images slider block</strong>
						
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#block-imgslider">
						block settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="block-imgslider" class="collapse">
							<hr>
							<p><strong>OPTIONS</strong></p>
							<ul>
								<li>Block title / block style (float left, right, centered) - optional</li>
								<li>Images sub-block - add image, title and captions text per each sub-block</li>
								<li>Add new image button - add as many sub-blocks as you like</li>
								<li>Images style - square (default) or rounded (applicable only to thumbnail image format)</li>
								<li>Slider pagination, navigation toggle and timing input (in miliseconds)</li>
								<li>Responsive settings - number of items to show for different device widths.</li>
							</ul>
						</div>
					
					</li>
					
					
					<li class="list-group-item"><strong>Social icons</strong>
						
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#block-clear">
						block settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="block-clear" class="collapse">
							<hr>
							<p>
							Block for entering contact information and social networks profile links
							</p>
							<p><strong>NOTE: if horizontal line type is "none", height will apply as blank space. In case of "none" the margin settings won't apply.</strong></p>
							<strong>OPTIONS</strong>
							<ul>
								<li>Block title</li>
								<li>Title and block elements float - left, right centered</li>
								<li>Horizontal or vertical - display contact info and social icons horizontally or vertically</li>
								<li>Contact info fields sub-blocks - add any number of info fields - each block has field type choice: phone, mobile, email, website, (physical) address</li>
								<li>Social network info fields ( toggled )</li>
							</ul>
						</div>
					
					</li>
					
					<li class="list-group-item"><strong>Clear block</strong>
						
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#block-clear">
						block settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="block-clear" class="collapse">
							<hr>
							<p>
							Some blocks need more vertical spacing between them or simply need to go to new row - so use "Clear block"
							</p>
							<p><strong>NOTE: if horizontal line type is "none", height will apply as blank space. In case of "none" the margin settings won't apply.</strong></p>
							<strong>OPTIONS</strong>
							<ul>
								<li>Horizontal line type - none, single, double, dotted, dashed</li>
								<li>Line color</li>
								<li>Line width - applies to any line style</li>
								<li>Margin - applies to top and bottom margin, NOT left and right.</li>
							</ul>
						</div>
					
					</li>
					
					<li class="list-group-item"><strong>Onepager menu block</strong>
						
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#block-onepager">
						block settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="block-onepager" class="collapse">
							<hr>
							<p>
							One pager menu block - insert menu items and connect them to anchored links ( ROW block ID's ) 
							</p>
							<p><strong>NOTE: recommended to create all the link targets ( ROW blocks with content ) first, as after saving the template the ID's structure is refreshed and reassigned ( ID's are needed to be inserted in menu items)</strong></p>
							<strong>OPTIONS</strong>
							<ul>
								<li>Menu items adding
									<ul>
										<li>Menu item label</li>
										<li>Menu item anchor link</li>
										<li>Item icon dropdown select</li>
									</ul>
								</li>
								<li>Sticky menu - on scroll it will stay fixed on top</li>
								<li>Menu margin - a space between menu and container boundaries</li>
								<li>Copy menu to side menu /header - can include existing menu from that location - Main menu location is used.</li>
								<li>Menu background color</li>
								<li>Menu style - 2 styles</li>
								<li>Menu alignment - left, center, right</li>
							</ul>
						</div>
					
					</li>
					
					<li class="list-group-item"><strong>Product categories block</strong>
						
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#block-prod-cat">
						block settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="block-prod-cat" class="collapse">
							<hr>
							<p>
							Simple product categories block.
							</p>
							<p><strong>NOTE: same menu as in Ajax Products block, except for ajax loading products, this menu links to product archive pages.</strong></p>
							<strong>OPTIONS</strong>
							<ul>
								<li>Block title</li>
								<li>Block subtitle</li>
								<li>Block title style</li>
								<li>Product categories multiple select</li>
								<li>Categories menu - with category images (set on Products > Categories) or without images</li>
								<li>Menu columns - autostretch, autofloat or fixed number</li>
								<li>Images width and height</li>
							</ul>
						</div>
					
					</li>
					
					
					<li class="list-group-item"><strong>Button block</strong>
						
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#block-button">
						block settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="block-button" class="collapse">
							<hr>
							<p>
							Simple button block.
							</p>
							<p><strong>NOTE: same menu as in Ajax Products block, except for ajax loading products, this menu links to product archive pages.</strong></p>
							<strong>OPTIONS</strong>
							<ul>
								<li>Block title</li>
								<li>Block subtitle</li>
								<li>Button float - left, centered, right</li>
								<li>Button style - default, smaller, larger, extra large</li>
								<li>Button margin control</li>
								<li>Button colors - background, border and font color</li>
								<li>Border size</li>
								<li>Border label - text to be shown inside button</li>
								<li>Border link - url address when button is clicked</li>
							</ul>
						</div>
					
					</li>
					
					
					
				</ul>
			</div>
			
		</div>	
		
		<!-- ============ POST FORMATS  ===============-->
		
		<div class="row well" id="post-formats">
		
			<div class="col-lg-12">
			
				<h3><b>Post formats and custom meta</b></h3>
			
			</div>
			
			<div class="col-lg-12">
			
				<p>Cypress theme uses (relatively) new Wordpress feature - <strong>post formats</strong> - to add one more layer of control over content.</p>
				
				<p><strong>CUSTOM META</strong> - each post type has it's own specific settings, grouped in <strong>custom meta boxes</strong> and meta fields.</p>
				
				
				<p><strong>Post formats are used in POSTS and PORTFOLIO ITEMS</strong></p>
				
				<p class="alert alert-info"><strong>NOTE:</strong> after import of demo content <strong>WP importer doesn't import post formats for PORTFOLIO items</strong>, so those will need to be set after the import of demo content.</p>
				
				
				
				<h4>POST FORMATS used in Cypress theme:</h4>
				
				<ul class="list-group col-md-10 col-md-offset-1">
					
					<li  class="list-group-item"audio><strong>Standard</strong>
					- no special settings, apart from "General settings" metabox
					</li>
					<li class="list-group-item"><strong>Audio</strong>
					
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#pf-audio">
						post format settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="pf-audio" class="collapse">
							<hr>
							<p>
							by clicking on <strong>"Audio" post format tab</strong> the following <strong>custom meta box</strong> options will appear bellow the main editor
							</p>
							<strong>OPTIONS</strong>
							<ul>
								<li>Audio file - upload your mp3 audio file.</li>
							</ul>
						</div>
					
					</li>
					<li class="list-group-item"><strong>Video</strong>
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#pf-video">
						post format settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="pf-video" class="collapse">
							<hr>
							<p>
							by clicking on <strong>"Video" post format tab</strong> the following <strong>custom meta box</strong> options will appear bellow the main editor.
							</p>
							<p class="alert alert-info">NOTE: Cypress utilizes video host services to deliver video content, self-hosted video is not supported. With custom meta box settings add featured video, but you can add more videos with use of shortcodes.</p>
							<strong>OPTIONS</strong>
							<ul>
								<li>Video host site - choose between video host services</li>
								<li>Video ID - <strong>enter ONLY video ID</strong>, not the whole URL address to video page</li>
								<li>Width of video - enter the value AND the unit (px, em or %)</li>
								<li>Height of video - same as above</li>
								<li>Featured image or video thumbnail - Cypress theme supports automatic usage of video thumbnails for featured image, but we recommend usage of standard WP featured image (post thumbnail)</li>
							</ul>
						</div>
					</li>
					<li class="list-group-item"><strong>Gallery</strong>
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#pf-gallery">
						post format settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="pf-gallery" class="collapse">
							<hr>
							<p>
							by clicking on <strong>"Gallery" post format tab</strong> the following <strong>custom meta box</strong> options will appear bellow the main editor.
							</p>
							<p class="alert alert-info">NOTE: we recommend usage of <strong>gallery meta box</strong> for displaying image galleries - <strong>if using WP native gallery the gallery meta box settings won't apply</strong></p>
							<strong>OPTIONS</strong>
							<ul>
								<li>Gallery images - add/remove/sort images with <em>sortable and repeatable fields</em> box</li>
								<li>Gallery image format - front-end image display format (choose between registered image sizes)</li>
								<li>Slider or thumbs - display image in slider sequence or thumbnails</li>
								<li>Thumbnail columns - if "thumbs" (from prev. settings is selected) enter the number of columns</li>
								<li><strong>If slider is selected for images presentation</strong></li>
								<li>Slider navigation - show previous / next arrows on hover</li>
								<li>Slider pagination - show pagination on hover</li>
								<li>Slider timing - interval between slide transitions ( in milliseconds )</li>
								<li>Slider transition effect - css transitions</li>

							</ul>
						</div>
					</li>
					<li class="list-group-item"><strong>Image</strong>
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#pf-image">
						post format settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="pf-image" class="collapse">
							<hr>
							<p>
							by clicking on <strong>"Image" post format tab</strong> the following <strong>custom meta box</strong> options will appear bellow the main editor.
							</p>
							Use standard "Featured image" (post thumbnail) feature. If the image caption is entered (when uploading image or in "Media" settings).
						</div>
					</li>
					
					<li class="list-group-item"><strong>Quote</strong>
					
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#pf-quote">
						post format settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="pf-quote" class="collapse">
							<hr>
							<p>
							by clicking on <strong>"Quote" post format tab</strong> the following <strong>custom meta box</strong> options will appear bellow the main editor.
							</p>
							<strong>OPTIONS</strong>
							<ul>
								<li></li>
							</ul>
						</div>
					</li>
				</ul>
				
				<div class="clearfix"></div>
				
				<p class="alert alert-info"><strong>GENERAL CUSTOM META</strong> - regardless on whether you are editing post, page, portfolio or slide, there is CUSTOM META BOX <strong>"General settings"</strong> on the side of the edit page. Those settings are "cross-posts" settings, some can be applied to several post types, some to all.<br />
				All general settings are explained in the general settings metabox.
				</p>
			
			</div>
			
		</div>	
		
		
		<!-- ============ MEGA MENU  ===============-->
		
		<div class="row well" id="mega-menu">
		
			<div class="col-lg-12">
			
				<h3><b>MENU LOCATIONS and MEGA MENU</b></h3>
			

			</div>
			
			<div class="col-lg-12">
			
				<p>Cypress has following registered menus locations:</p>
				
				<ol>
					<li>Main menu (default) </li>
					<li>Main horizontal menu</li>
					<li>Main mobile menu</li>
					<li>Secondary menu </li>
				</ol>
				
				<p>Any number of menu items, grouped under any menu name can be created, as long as they are <strong>assigned to menu locations using "Manage locations"</strong> or in "<strong>Menu Settings</strong>" at the bottom of menu items edit section.</p>
				
				<div class="alert alert-info">
				
					<strong>NOTICE:</strong><br>
					- one created menu can be assigned to <strong>any location</strong> or <strong>multiple locations</strong><br>
					- it's recommended to use at least two menu locations:
					<ul>
						<li>one of the MAIN menus (default and horizontal) and </li>
						<li>main MOBILE menu</li>
					</ul>
					
					Using Main mobile menu is recommended becuase of different layout and resolution of mobile devices.
					<br>
					<br>
					To make editing menus faster, there is a nice plugin for duplicating menus - <a href="http://wordpress.org/plugins/duplicate-menu/" target="_blank"><strong>Duplicate Menu</strong></a>
				
				</div>
				
				
				<div class="alert alert-warning">To learn basics of administering Wordpress menu system - visit this Wordpress.org address - <a href="http://codex.wordpress.org/WordPress_Menu_User_Guide">http://codex.wordpress.org/WordPress_Menu_User_Guide</a></div>
				
				<h4><strong>MEGA MENU</strong></h4>
				
				<p><strong>Mega menu</strong> is theme built-in specific feature of Cypress theme. It turns regular WP menu into Mega menu capable menu using <strong>custom post meta</strong> additional input fields in menu items edit page (Appearance > Menus)</p>
				
				<br />
				<h4>VIDEO SCREENCAST ON SETTING UP MEGA MENUS:</h4>
				
				<ul>
					<li><strong><a href="http://www.screenr.com/QjHN">creating mega menu</a></strong></li>
					<li><strong><a href="http://www.screenr.com/UIHN">inserting images into Mega Menu</a></strong></li>
				</ul>
				
				
				<br />
				<h4><strong>Create Mega menu:</strong></h4><br />
				
				<ul class="list-group col-md-10 col-md-offset-1">
					
					<li class="list-group-item">
					
					Create 1st level menu item using <strong>"Links" (custom menu item)</strong> - drag and drop to main items editor
					
					Check the "Mega menu" checkbox - this will be the "parent" of mega menu - on this item mouse hover the sub-menu with "mega menu capabilities" will appear 
						
						<br><strong>NOTES:</strong><br>
						<p class="alert alert-danger"><strong>Only the 1st level of menu items can be MEGA MENU PARENTS</strong></p>
						<p class="alert alert-danger"><strong>Only "Links" (custom menu item) can be MEGA MENU PARENTS (or mega menu holder)</strong></p>
					
					</li>
					
					<li class="list-group-item">Under the same 1st level menu item, create <strong>sub-menu (2nd level) item</strong> as<strong> mega menu section</strong> title (can be link too - use any menu type)
					
					</li>
					
					<li class="list-group-item">Under the 2nd level menu item (added as section title) - add any number of menu items (in 3rd level) - those items will be grouped under the same section with title of the 2nd level item</li>
				</ul>
			
				<div class="clearfix"></div>
				
				<h5><strong>Mega menu custom image:</strong></h5><br />
				
				
				<ul class="list-group col-md-10 col-md-offset-1">
					
					<li class="list-group-item">Create 2nd level menu item - under 1st level menu item with checked "Mega menu" checkbox</li>
					
					<li class="list-group-item">
					In 2nd level item edit box, under "Custom image", click on <strong>"Upload"</strong> button to upload image or select the image from media library
					</li>
					
				</ul>
				
				<div class="clearfix"></div>
				
				<h5><strong>Mega menu post with thumb and excerpt:</strong></h5><br />
				
				
				<ul class="list-group col-md-10 col-md-offset-1">
					
					<li class="list-group-item">Create 2nd level menu item - under 1st level menu item with checked "Mega menu" checkbox
					
						<br><br>
						<p class="alert alert-danger"><strong>NOTE: item must be "Posts", "Products" or "Portfolio"</strong></p>
					
					</li>
					
					<li class="list-group-item">
					In 2nd level item edit box, check the "Post thumb and excerpt" checkbox.
					</li>
					
				</ul>
				
				<div class="clearfix"></div>
				
				<h5><strong>Mega menu new row:</strong></h5><br />
				
				After creation of several 2nd level menu sections (and 3rd level menu items inside), it's possible to shift new menu sections in new row, separated by line. To do that:<br /><br />
				
				<ul class="list-group col-md-10 col-md-offset-1">
					
					<li class="list-group-item">Create 2nd level menu item - under 1st level menu item with checked "Mega menu" checkbox</li>
					
					<li class="list-group-item">
					In 2nd level item edit box, check the <strong>"Clear for row"</strong> checkbox.
					</li>
					
					<li class="list-group-item">
					Add more 2nd level section with 3rd level menu items (or mega menu images) after item marked "Clear new row).
					</li>
					
				</ul>
				
				<div class="clearfix"></div>
				
				<h5><strong>"Simple clear" - mega menu item :</strong></h5><br />
				
				<p class="alert alert-info"><strong>2nd level mega menu items</strong> are formatted to <strong>act as section titles</strong>. To override this feature and use them as regular menu items just add <strong>simple-clear</strong> css class selector in "CSS classes (optional)" menu item field (that field must be enabled in "Screen options" )</p>
				
				<div class="alert alert-danger"><strong>NOTE:</strong> custom fields used for creating Mega menus are also not imported with XML file- you'll need to set those manually.	
				</div>
				
				
				
			</div>
			
		</div><!-- end MEGA MENU  ===============-->
		
		
		
		<!-- ============ WIDGETS  ===============-->
		
		<div class="row well" id="widgets">
		
			<div class="col-lg-12">
			
				<h3><b>Widget areas (sidebars)</b></h3>
			
			</div>
			
			<div class="col-lg-12">
			
				Cypress has following defined sidebars (or, widget areas) available for adding widgets (WP default, WooComerce or theme specific)
				<br><br>
				<ol>
					<li><strong>Sidebar</strong> - standard (left or right, depending on theme options)</li>
					<li><strong>Shop sidebar</strong> - used only on shop pages</li>
					<li><strong>Product page filter widgets</strong> only in product catalog page - use with <strong>WooCommerce Layered  Navigation</strong> widget</li>
					<li><strong>Filter reset widget</strong> - widget area reserved ONLY for reset layered navigation - use "<strong>WooCommerce Layered Nav Filters</strong>" widget <strong>ONLY</strong></li>
					<li><strong>Header widgets</strong> - in vertical AND horizontal menu/header area</li>
					<li><strong>Footer widgets 1</strong></li>
					<li><strong>Footer widgets 2</strong></li>
					<li><strong>Footer widgets 3</strong></li>
					<li><strong>Footer widgets 4</strong></li>
				</ol>
				<br><br>
				<p><strong>Widgets icons</strong> - All the <u>default widgets, WooCommerce widgets and theme widgets</u> have icons representing specific widgets feature or purpose - this is Cypress specific and will be turned off on theme switch. </p>
				
				<p><strong>Widget icons</strong> can also be "turned off" in theme options (Appearance > Theme options > Blog settings > "Widget title icons ?" section)</p>
				<p><strong>NOTE: Widget icons won't apply on 3rd party widgets (the ones not mentioned above)</strong></p>
				
				<p class="alert alert-info">
				NOTE: <strong>"Shop sidebar"</strong> and widgets inside will appear only on shop pages (All products, product categories, single product, cart, checkout, account page ...) and INSTEAD of standard sidebar</p>
				
			</div>
			
		</div><!-- end WIDGETS  ===============-->
		
		
		<!-- ============ THEME OPTIONS  ===============-->
		
		<div class="row well" id="theme-options">
		
			<div class="col-lg-12">
			
				<h3><b>Theme options</b></h3>
			
			</div>
			
			<div class="col-lg-12">
			
				Cypress has large array of theme options settings that will affect your site's look, feel and behaviour.
				We won't go in detailed explanation of each and every option as those are explained in Theme options panel itself (in little icon <strong>"i"</strong> on side of each option)
				
				<h4><strong>Theme options list</strong></h4>
				
				<ul class="list-group col-md-10 col-md-offset-1">
					<li class="list-group-item"><strong>General settings</strong>
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#to-general">
						option group detailed settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="to-general" class="collapse">
							<ul>
								<li>Site logo image</li>
								<li>Logo, site title and site description on/off</li>
								<li>Custom favicon</li>
								<li>Placeholder image</li>
								<li>Layout</li>
								<li>Use Nice scroll toggle</li>
								<li>Nice scroll settings</li>
								<li>Use Nice scroll on SIDE MENU and MEGA MENUS</li>
								<li>Show breadcrumbs toggle</li>
								<li>Language flags toggle (if WPML plugin is active)</li>
								<li>Sidebar missing widget replacement content</li>
								<li>Use lazy load effect toggle</li>
								<li>Show header icons in pages toggle</li>
								<li>Hide edit pages metaboxes</li>
								<li>Tracking Code</li>
								<li>Theme contact form</li>
							</ul>
						</div>
					</li>
					<li class="list-group-item"><strong>Shop settings</strong>
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#to-shop">
						option group detailed settings<span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="to-shop" class="collapse">
							<ul>
								<li>Products page numbers (Products per page, Products columns, Related total, Related columns)</li>
								<li>Products page QUICK VIEW or default buttons</li>
								<li>Products catalog full width page toggle</li>
								<li>Single product full width page</li>
								<li>Cart and checkout full width page</li>
								<li>Products display settings (Products display settings, Disable zoom button,Disable link button)</li>
								<li>Image format for products catalog page</li>
								<li>Single product image display ( slider, thumbnails or magnifier )</li>
								<li>Single product image format select</li>
								<li>Display shop title background image ?</li>
								<li>Shop title background image</li>
							</ul>
						</div>
					</li>
					<li class="list-group-item"><strong>Typography</strong>
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#to-typo">
						option group detailed settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="to-typo" class="collapse">
							<ul>
								<li>Google fonts or Typekit fonts (or system)? toggle</li>
								<li>HEADINGS FONT : Google Font</li>
								<li>BODY FONT - Google Font</li>
								<li>HEADINGS FONT : Typekit font ID</li>
								<li>HEADINGS - system font</li>
								<li>BODY FONT - system fonts</li>
							</ul>
						</div>
					</li>
					<li class="list-group-item"><strong>Styling options</strong>
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#to-style">
						option group detailed settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="to-style" class="collapse">
							<ul>
								Borders style
								Buttons style
								<li>Links color (primary)</li>
								<li>Links hover color (secondary)</li>
								<li>Site background color</li>
								<li>Site background tiles or uploaded images</li>
								<li>Site tiles</li>
								<li>Site upload</li>
								<li>Site repeat, attachment, scroll</li>
								<li>Body background color</li>
								<li>Theme background tiles or uploaded images</li>
								<li>Background tiles</li>
								<li>Background upload</li>
								<li>Background repeat, attachment, scroll</li>
								<li>Custom CSS</li>
							</ul>
						</div>
					</li>
					<li class="list-group-item"><strong>Side menu / header menu</strong>
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#to-header">
						option group detailed settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="to-header" class="collapse">
							<ul>
								<li>Side menu or header menu (layout orientation)</li>
								<li>Side menu blocks (default)</li>
								<li>Header menu blocks</li>
								<li>Logo max height</li>
								<li>Header menu Custom CSS</li>
								<li>Header/menu blocks for MOBILE DEVICES</li>
								<li>Side menu / Header menu font color</li>
								<li>Side menu / Header menu links color (primary)</li>
								<li>Side menu / Header menu links hover color (secondary)</li>
								<li>Side menu / Header menu background color</li>
								<li>Social icons </li>
							</ul>
						</div>
					</li>
					<li class="list-group-item"><strong>Footer settings</strong>
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#to-footer">
						option group detailed settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="to-footer" class="collapse">
							<ul>
								<li>Footer font color</li>
								<li>Footer links and buttons color (primary)</li>
								<li>Footer links and buttons hover color (secondary)</li>
								<li>Footer background color</li>
								<li>Footer background color opacity</li>
								<li>Footer Credits text</li>
							</ul>
						</div>
					</li>
					<li class="list-group-item"><strong>Home settings</strong>
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#to-home">
						option group detailed settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="to-home" class="collapse">
							<ul>
								<li>Blog home page title</li>
								<li>Blog home page header background image</li>
								<li>Upload blog home page header background image</li>
							</ul>
						</div>
					</li>
					<li class="list-group-item"><strong>Blog</strong>
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#to-blog">
						option group detailed settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="to-blog" class="collapse">
							<ul>
								<li>Single blog page title background image (featured) ?</li>
								<li>Blog archive title background image ?</li>
								<li>Upload blog archive title background image</li>
								<li>Blog CATEGORIES/TAGS title background image ?</li>
								<li>Upload blog CATEGORIES/TAGS title background image</li>
								<li>Blog AUTHOR pages title background image ?</li>
								<li>Upload blog AUTHOR pages title background image</li>
								<li>Post meta settings</li>
								<li>Post date format</li>
								<li>Show post format icons ?</li>
								<li>Widget title icons ?</li>
							</ul>
						</div>
					</li>
					<li class="list-group-item"><strong>Portfolio</strong>
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#to-port">
						option group detailed settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="to-port" class="collapse">
							<ul>
								<li>Single portfolio page title background image (featured) ?</li>
								<li>Portfolio archive/taxonomies title background image ?</li>
								<li>Set portfolio archive/taxonomies title background image</li>
							</ul>
						</div>
					</li>
					<li class="list-group-item"><strong>Backup</strong>
						<button type="button" class="btn btn-info btn-xs pull-right" data-toggle="collapse" data-target="#to-backup">
						option group detailed settings <span class="glyphicon glyphicon-chevron-down"></span>
						</button>

						<div id="to-backup" class="collapse">
							<ul>
								<li>Backup theme options</li>
								<li>Transfer Theme Options Data</li>
							</ul>
						</div>
					</li>
					
				</ul>
				
				
				
			</div>
			
		</div>	
		
		<!-- ============ Plugins =============== -->
		
		
		<div class="row well" id="plugins">
			
			<div class="col-lg-12">
			
				<h3><b>Plugins</b></h3>
			
			</div>
			
			<div class="col-lg-12">
			
				<p>
				Cypress theme is crafted to work with few obligatory plugins (or better - <u>highly recommended</u> - Cypress can function without any plugin), such as:</p>
				
				<strong>
				<ul>
					<li>WooCommerce</li>
					<li>Aqua Page Builder</li>
					<li>Aligator Custom Post Types (included in download package)</li>
					<li>Aligator Shorcodes (included in download package)</li>
					<li>Revolution Slider (included in download package)</li>
				</ul>
				</strong>
				
				<p>and is compatible with few recommended plugins, such as:</p>
				
				<strong>
				<ul>
					<li>WMPL - multilingual WP</li>
					<li>MailChimp for Wordpress (Lite)</li>
				</ul>
				</strong>
				
				<hr>
				<h4><em>MailChimp / Cypress specifics</em></h4>
				
				To set up <strong>MailChimp widget form</strong> for same appearance as in theme demo (http://aligator-studio.com/cypress), use following HTML code in form: ( in MailChimp fo WP > Forms )
				
				<p>
				<strong>
				<pre>
	&lt;label for="mc4wp_email"&gt;Email address: &lt;/label&gt; 

	&lt;div class="cypress-mailchimp"&gt;
		&lt;input type="email" id="mc4wp_email" name="EMAIL" required placeholder="Your email address" /&gt;
		&lt;input type="submit" value="Sign up" /&gt;
	&lt;/div&gt;
				</pre>
				</strong>
				</p>
				
				If you want to revert to default (starter) MailChip form, here's the code to copy:
				<strong>
				<pre>
	&lt;p&gt;
		&lt;label for="mc4wp_email"&gt;Email address: &lt;/label&gt;
		&lt;input type="email" id="mc4wp_email" name="EMAIL" required placeholder="Your email address" /&gt;
	&lt;/p&gt;
	&lt;p&gt;
		&lt;input type="submit" value="Sign up" /&gt;
	&lt;/p&gt;
				</pre>
				</strong>		
			</div>
		
		</div>	
		
		<!-- ============ WPML =============== -->
		
		
		<div class="row well" id="wpml">	
		
			<div class="col-lg-12">
			
				<h3><b>WPML plugin compatibility</b></h3>
			
			</div>
			
			
			<div class="col-lg-12">
			
				<p class="alert alert-info">Cypress theme is compatible with WPML plugin. Since WPML is third party plugin, please, first get all the info on WMPL setting up and functioning on <a href="http://wpml.org" target="_blank">WPML.org</a> pages.
				</p>
				
				<h4 class="info">LANGUAGE FILES:</h4>
				
				<ul>
					<li><strong>To translate Cypress strings</strong> (words and phrases in theme code), use .po (and .mo) files found in Cypress's "<strong>languages</strong>" folder.</li>
					<li><strong>WooCommerce language file</strong> can be found in plugin's "<strong>i18n/languages</strong>" directory</li>
					<li><strong>Wordpress languages files</strong> can be found in <a href="http://codex.wordpress.org/WordPress_in_Your_Language" target="_blank">Your Country WP site</a> and should be add to "<strong>wp-content/languages</strong>" directory. WP langauge files are mostly usable for default widgets translation.</li>
				
				</ul>
				
				<p>With Cypress theme activated, translate posts, pages and products (and categories, custom taxonomies etc.) as for default WP themes (TwentyThirteen, TwentyTwelve ...) - Cypress will display all the translations. However, there are some Cypress specifics in functioning with WPML:</p>
				

				
				<strong>Cypress and WMPL specific features and settings:</strong><br /><br /> 
				
				<ol>
					<li>
						<strong>[wmpl_translate] </strong>shortcodes:<br /><br /> 
						Cypress utilizes custom shortcode function for usage for

						<strong>WIDGETS TITLES</strong> (if you are not going to use <a href="http://wpml.org/download/wpml-string-translation/" target="_blank">"String translation"</a> WMPL extension - <strong>NOTE: String translation for widgets work only if widgets are activated after WPML and String translation plugin activation</strong>)
						
						
						Example of shortcode usage:<br />
						
<pre>
[wpml_translate lang=en]This is my english content[/wpml_translate]
[wpml_translate lang=es]Este es el contenido español[/wpml_translate]
</pre>
				<div class="clearfix"></div>

						
					</li>
					<li><strong>Aqua Page Builder and WPML</strong>:<br /><br /> 
						
						<p>Although Aqua Page Builder is supported for multilingual features (translatable custom post type "Template" we recommend creating separate templates for each language and insert page builder templates in translated pages.</p>
						
					</li>
					
					
					<li><strong>WOOCOMMERCE AND WPML</strong>:<br /><br /> 
						<p class="info"><strong>IMPORTANT</strong>: WooCommerce and WMPL must have <a href="http://wordpress.org/extend/plugins/woocommerce-multilingual/"><strong>WooCommerce multilingual</strong></a> plugin installed (along with both WooCommerce and WPML plugins)</p>
						
						<p>For translating WooCommerce products, product categories, attributes, tags and all related to WooCommerce, please read the "<a href="http://wpml.org/documentation/related-projects/woocommerce-multilingual/" title="_blank"><strong>WooCommerce multilingual</strong></a>" tutorial section on wpml.org website</p>
					
					</li>
					
					
					<li><strong>List of all WMPL related necessary plugins</strong> (or recommended) for Cypress/WooCommerce:
						<ul>
							<li>WPML Multilingual CMS - necessary</li>
							<li>WooCommerce Multilingual -necessary </li>
							<li>WPML CMS Nav - necessary</li>
							<li>WPML String Translation (recommended)</li>
							<li>WPML Translation Management (recommended)</li>
							<li>WPML Sticky Links (recommended)</li>
						</ul>

					</li>
					
					
				</ol>
			
			</div>
		
		</div>	
		
		
		
		<!-- ============ CSS, JAVASCRIPTS, CREDITS  =============== -->
		
		<div class="row well" id="scripts-credits">	
			
			<div class="col-lg-12">
			
				<h3><b>Scripts and credits</b></h3>
			
			</div>
			
			<br />
			
			<div class="col-lg-12">
			
				<h4><b>CSS files</b></h4>
			
			</div>
			
			<div class="col-lg-12">
			
				<p>If you would like to edit the color, font, or style of any elements, and you have the knowledge to edit CSS files there are couple of CSS files included in theme:
				
				<ul>
					<li><strong>style.css</strong> - main Cypress styles</li>
					<h5>In "CSS" folder:</h5>
					<li><strong>reset.css</strong></li>
					<li><strong>unsemantic-grid-responsive.css</strong></li>
					<li><strong>glyphs.css</strong></li>
					<li><strong>admin_styles.css</strong> - styles for admin post editor</li>
					<li><strong>owl.carousel.css</strong></li>
					<li><strong>ie-8.css</strong></li>
					<li><strong>prettyPhoto.css</strong></li>
					<li><strong>wp_default.css</strong></li>
				</ul>
				</p>

				<p>or, you can edit appearance in theme options under menu in admin section ( Appearance - Theme Options - Styling Options ).</p> 	
			
			</div>

			<hr>
			
			<div class="col-lg-12">
				<h4><b>SCRIPTS :Javascript files (jQuery).</b></h4>
			</div>
			
			<div class="col-lg-12">
			
				<p>Cypress uses couple of javascript files, mostly jQuery plugins by other people, and some custom created code by us. Here is the list of jQuery files use in Cypress, all (most) in "js" folder</p>
				
				<ol>
					<li>PrettyPhoto</li>
					<li>OwlCarousel plugin</li>
					<li>jQuery Transform</li>
					<li>Debounced Resize jQuery plugin</li>
					<li>Modernizr</li>
					<li>jQuery Waypoints</li>
					<li>jQuery Easing</li>
					<li>jQuery Formalize</li>
					<li>jQuery Shuffle</li>
					<li>jQuery Paralax</li>
					<li>jQuery NiceScroll</li>
					<li>jQuery mb.YTPlayer</li>
					<li>retina.js</li>
					<li>jQuery Elevate Zoom</li>
					<li>jQuery One Page Nav Plugin</li>
					<li>Cypress Custom jQuery code</li>
					
				</ol>
				  

				<p>jQuery is a Javascript library that greatly reduces the amount of code that you must write.<br />
				Most of the animation in this site is carried out from the jQuery plugins included in theme and some or executed by customs scripts.<br /><br />
				To learn more about usage of <b>jQuery plugins</b> visit <a href="http://jquery.com/">jQuery site</a>:	
				</p>
			
			</div>
			
			<hr>
			
			<div class="col-lg-12">
				<h4><b>Other (PHP frameworks and scripts)</b></h4>
			</div>
			
			<div class="col-lg-12">
			
				<ol>
					<li>SMOF by Aquagraphite - theme options framework</li>
					<li>Custom Metaboxes and Fields framework</li>
					<li>TGM-Plugin-Activation</li>
				</ol>
			
			</div>

			<hr>
			
			<div class="col-lg-12">
				<h4 id="plugins"><strong>Plugins</strong></h4>
			</div>
			
			<div class="col-lg-12">
			
				<p>Cypress have included Aligator Shortcodes, Aligator Custom Post Types and <strong>Revolution Slider</strong> inside the theme, but their separate installation is needed, as well as WooCommerce and Aqua Page Builder, which are not included. All the plugins bellow are required: </p>
				
				<ul>
					<li><strong>WooComerce</strong>,</li> 
					<li><strong>Aqua Page Builder</strong>,</li> 
					<li><strong>Aligator Shortcodes</strong>,</li> 
					<li><strong>Aligator Custom Post Types</strong>,</li>
					<li><strong>Revolution Slider</strong></li>
				</ul>
				
				<div class="alert alert-info">
				Cypress theme is <strong><em>highly dependable on Aqua Page builder plugin</em></strong>, so it is advisable to install <strong>Aqua Page Builder plugin</strong>.<br />
				Also, Cypress theme is built for WooCommerce plugin, and as base for Wordpress shop site driven by WooCommerce ( not compatible with other e-commerce plugins - WP e-Commerce, Jiggo Shop etc.)<br /><br />
				<strong>Revolution Slider plugin</strong> (although proclaimed as required) is optional, but we actually highly recommend it. <a href="http://themepunch.com/codecanyon/revolution_wp/documentation/" target="_blank"><strong>Revolution slider documentation.</strong></a>
				</div>
			
			</div>
			
			<hr>
			
			
			<div class="col-lg-12">
			
				<h4 id="credits"><strong>Sources and Credits</strong> </h3>
				
			</div>
			<div class="col-lg-12">
			
				<p>We've used the following assets, listed with licencing info.</p> 
		
				<ul>
					
					<li><a href="http://aquagraphite.com">SMOF by Aquagraphite</a> - theme options framework (  KIA Options Framework, Options Framework forks), /under GNU GPL licence </li>				
									
					<li><a href="https://github.com/thomasgriffin/TGM-Plugin-Activation">TGM-Plugin-Activation</a> by Thomas Griffin / Licence under GPL v2 licence</li>
					
					<li>Custom Metaboxes and Fields by <a href="http://andrewnorcross.com "> Andrew Norcross</a> ( @norcross ), <a href="http://jaredatchison.com">Jared Atchison</a> ( @jaredatch ), 
				<a href="http://billerickson.net ">Bill Erickson</a> ( @billerickson ), 
				<a href="http://hmn.md">Human Made Limited</a> ( @humanmadeltd ), 
				<a href="http://jonathanbardo.com">Jonathan Bardo</a> ( @jonathanbardo ) / Licence under GPL v2 licence or later</li>
					
					<li><a href="http://twitter.github.io/bootstrap/index.html">Twitter Bootstrap</a> - licensed under Apache License v2.0</li>
									
					<li><a href="http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/#prettyPhoto" target="_blank">prettyPhoto</a> / Licenced under MIT and GPLv2 and “Creative Commons 2.5”</li>
					
					<li><a href="http://owlgraphic.com/owlcarousel/" target="_blank">Owl Carousel jQuery plugin</a> by Bartosz Wojciechowski / Licenced under the MIT License </li>
					
					
					<li><a href="https://github.com/louisremi/jquery.transform.js">jQuery Transform </a>by Lous Remi / Licenced under MIT licence</li>
					
					<li><a href="https://github.com/louisremi/jquery-smartresize/blob/master/jquery.debouncedresize.js">Debounced Resize jQuery plugin</a> by Louis Remi / Licenced under MIT licence</li>
					
					<li><a href="http://modernizr.com/">Modernizr</a> / Licenced under BSD and MIT licences.</li>
					
					<li><a href="https://github.com/imakewebthings/jquery-waypoints">jQuery Waypoints</a> by Caleb Troughton / Dual licensed under the MIT license and GPL license.</li>
					
					<li><a href="http://remysharp.com/" target="_blank">jQuery html5 enabling-script</a> by Remy Sharp / Licenced under MIT</li>

					
					<li><a href="http://gsgd.co.uk/sandbox/jquery/easing/">jQuery Easing</a> by George McGinley Smith/ Released under the BSD License</li>
					
					<li><a href="http://vestride.github.io/Shuffle/">jQuery Shuffle Plugin</a> by Glen Cheney / Licenced under MIT license</li>
					
					<li><a href="http://www.ianlunn.co.uk/plugins/jquery-parallax/">jQuery Parallax</a> by Ian Lunn / Licenced under MIT licence</li>
					
					<li><a href="http://malsup.com/jquery/form/">jQuery form plugin</a> Dual licensed under the MIT and GPL licenses </li>
					
					<li><a href="https://github.com/inuyaksa/jquery.nicescroll">jQuery Nicescroll plugin</a> Licensed under the MIT license </li>
					
					<li><a href="http://pupunzi.open-lab.com">jquery.mb.YTPlayer</a> by Matteo Bicocchi (Pupunzi) / Licenced under MIT licence</li>
					
					<li><a href="https://github.com/imulus/retinajs">retina.js</a> by imulus  / Licenced under MIT licence</li>
					
					<li><a href="http://github.com/davist11/jQuery-One-Page-Nav">jQuery One Page Nav Plugin</a> by Trevor Davis  / Dual licensed under the MIT and GPL licenses</li>
					
					<li><a href="http://flesler.blogspot.com/2007/10/jqueryscrollto.html">jQuery.ScrollTo </a> by Ariel Flesler  / Dual licensed under the MIT and GPL licenses</li>
					
					<li><a href="www.elevateweb.co.uk/image-zoom">jQuery Elevate Zoom</a> by Andrew Eades / Dual licensed under the GPL and MIT licenses.</li>
					
					<li><a href="http://trevordavis.net">jQuery One Page Nav Plugin</a> by Trevor Davis Dual licensed under the GPL and MIT licenses.</li>
					
				</ul>
				
			</div>
			
			<hr>
			
			<div class="col-lg-12">
			
				<h4><strong>Photos and images authors:</strong></h4>
				
			</div>
			<div class="col-lg-12">
			
				<p class="alert alert-info">Bellow listed are Flickr profiles, and they are linked to Flickr profile pages, except for YouTube and Vimeo videos, which are linked to video pages and video author (profile) pages .<br /><br /><strong>All assets used in demo are Creative Commons licensed for commercial use with atributon to their authors:</strong></p>
				
				<ul>
					<li><a href="http://www.flickr.com/photos/andreasoverland/">Andreas Øverland</a></li>
					<li><a href="http://www.flickr.com/photos/bagsgroove/">bagsgroove</a></li>
					<li><a href="http://www.flickr.com/photos/brennuskrux/">Christian Mairitsch(brennuskrux)</a></li>
					<li><a href="http://www.flickr.com/photos/danielviero/">Daniel M Viero</a></li>
					<li><a href="http://www.flickr.com/photos/nebcat/">Deneb Catalan</a></li>
					<li><a href="http://www.flickr.com/photos/61808613@N06/">Ejja Pahlevi (saturatedhigh)</a></li>
					
					<li><a href="http://www.flickr.com/photos/31246066@N04/">Ian Sane</a></li>
					<li><a href="http://www.flickr.com/photos/jirka_matousek/">Jirka Matousek</a></li>
					<li><a href="http://www.flickr.com/photos/jonomueller/">Jono Mueller</a></li>
					<li><a href="http://www.flickr.com/photos/10797963@N03">Kuhlman</a></li>
					<li><a href="http://www.flickr.com/photos/limaoscarjuliet/">Pawel Loj</a></li>
					<li><a href="http://www.flickr.com/photos/milchcow_peng/">Peng Chen</a></li>
					<li><a href="http://www.flickr.com/photos/85546319@N04/">Robert Sheie</a></li>
					<li><a href="http://www.flickr.com/photos/abeslice/">Ryan Abel</a></li>
					<li><a href="http://www.flickr.com/photos/sbl83/">stilletobootlover</a></li>
					<li><a href="http://www.flickr.com/photos/backgroundsetc/">Bakgrounds Etc.</a></li>

					<li><strong>------------------ no flickr: ------------------------</strong></li>
					<li><a href="http://subtlepatterns.com/">Subtle patterns</a></li>
					<li><strong>------------------ VIDEO VIMEO: ------------------------</strong></li>
					<li><strong><a href="http://vimeo.com/60736012">ETXART & PANNO | Fashion Film SS12</a></strong> from  <a href="http://vimeo.com/casanova">Casanova Comunicación</a></li>
					<li><strong><a href="http://vimeo.com/65878164">Phuong My Fashion - The Full Video</a></strong> from  <a href="http://vimeo.com/cinematicstudios">The Cinematic Studio</a></li>
					<li><strong>------------------ VIDEO YOUTUBE: ------------------------</strong></li>
					<li><a href="http://www.youtube.com/watch?v=ZRswkqtANFc"><strong>WOW Love's Carner Barcelona RIMA XI</strong></a> by <a href="http://www.youtube.com/user/WOWRevista">WOW Revista</a> </li>
					<li><a href="http://www.youtube.com/watch?v=HsluhvZrtFw"><strong>Lufthansa Cargo Product Specials EN</strong></a> by <a href="http://www.youtube.com/user/LHCargoAG?feature=watch">LHCargoAG</a></li>
					<li><a href="http://www.youtube.com/watch?v=aq3P0NqxiD0"><strong>Y  & Y | River Island - Life Of Tailor Teaser</strong></a> by <a href="http://www.youtube.com/user/YinnYang7?feature=watch">Yin and Yang blog</a></li>
				</ul>
				
			
			</div>
			
			<hr>
			
			<div class="col-lg-12">
			
				<h4><strong>Fonts used by Cypress:</strong></h4>
				
			</div>
			<div class="col-lg-12">
			
				<p>Cypress features scripts for utilizing <a href="http://typekit.com">Typekit.com</a> fonts - premium web service for quality web font</p>
				
				<p>standard system fonts and web fonts and <a href="http://www.google.com/webfonts" target="_blank">Google Web Fonts</a></p>
				<hr>
			
			</div>
			
			
			
			<p class="alert alert-info">Once again, thank you very much for purchasing this theme. We would be glad to help you if you have any questions relating to this theme. No guarantees, but we'll do our best to assist.</p> 
			
			
		</div><!-- /.row -->

		<footer>
			<p>© Aligator Studio 2014</p>
		</footer>

	</div> <!-- /container -->

	
	</div> <!-- /wrap -->
	
	<!-- Le javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/prettyPhoto/js/jquery.prettyPhoto.js" type="text/javascript"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		
		$("a[rel^='prettyPhoto']").prettyPhoto();

	});// end document ready
	</script>

</body></html>