<?php
/**
 * Template Name: Page builder template
 *
 * Page for template builder - bulit for using row blocks
 *
 * @since cypress1.0
 **/
get_header(); 
global $post, $of_cypress, $cypress_woo_is_active;
$header_icons			= $of_cypress['header_icons'];
$layout 				= $of_cypress['layout'];
//
$hide_title = get_post_meta( get_the_ID() ,'as_hide_title');
//
// VARS IF IT'S  SHOP:
if( $cypress_woo_is_active ) {
	$is_shop = ( is_shop() || is_woocommerce() || is_cart() || is_checkout() || is_account_page()) ? true : false ;
}else{
	$is_shop = false;
}

if( !$hide_title  ) {
?>
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
}; // end if $image
}; // end if !$hide_title ?>	


<section id="post-<?php the_ID(); ?>" <?php post_class(); ?> >	
		
	<?php
	
	if( have_posts() ) : while ( have_posts() ) : the_post(); 
	
		the_content();
			
	endwhile;
	
	endif;
	
	?>

	<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'cypress' ), 'after' => '</div>' ) ); ?>
				
	<div class="clearfix"></div>

</section>
	
<?php get_footer(); ?>