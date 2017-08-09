<?php
/**
 * Template Name: Full width page
 *
 * Default page template - full width
 *
 * @since cypress1.0
 **/
get_header(); 
// 
global $of_cypress, $cypress_woo_is_active;
$header_icons	= $of_cypress['header_icons'];
$layout			= $of_cypress['layout'];

// CUSTOM META:
$hide_title		=  get_post_meta( get_the_ID() ,'as_hide_title', true);

// VARS IF IT'S  SHOP:
if( $cypress_woo_is_active ) {
	$is_shop = ( is_shop() || is_woocommerce() || is_cart() || is_checkout() || is_account_page()) ? true : false ;
}else{
	$is_shop = false;
}
?>

<?php if( !$hide_title  ) { ?>		
<header class="page-header">

	<?php	
	$shop_title_bcktoggle = $of_cypress['shop_title_bcktoggle'];
	$shop_title_backimg = $of_cypress['shop_title_backimg'];
	
	if( $shop_title_bcktoggle && $shop_title_backimg && $is_shop ) {
		
		$image =  $shop_title_backimg;
		
		echo'<div class="header-background" style="background-image: url('.$image.');"></div>';
		
	}elseif( has_post_thumbnail() ) {
		// get image by attachment id:
		$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'as-landscape' );
		$image = $image[0];
		
		echo'<div class="header-background" style="background-image: url('.$image.');"></div>';
	}else{
		$image = '';
	}
	?>
	
	<div class="grid-container">
	
		<div class="grid-100">
		
			<h1 class="page-title"><?php esc_html(the_title()); ?></h1>
		
		</div>
		
	</div><!-- /.grid-container -->

</header>

<?php if( $image ) { ?>
<div class="grid-container">
	
	<div class="grid-100"><span class="title-border<?php echo !$header_icons ? '-no-icon' : null; ?>"></span></div>
	
</div>
<?php 
} // end if $image 
 
} // end if !hide_title
?>

<div class="grid-container">

	<div id="primary" class="grid-100' <?php echo $layout ? $layout : null; ?> tablet-grid-100 mobile-grid-100" role="main">
		
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

			<?php !$is_shop ? comments_template( '', true ) : null; ?>

		<?php endwhile;  ?>

		
	</div><!-- #primary -->


</div><!-- /.grid-container -->
	
<?php get_footer(); ?>