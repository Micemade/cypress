<!DOCTYPE html>
<?php 
//  GLOBAL OPTIONS DATA
global $of_cypress, $cypress_woo_is_active;
//
/////////// TO DELETE : ////////////////////////////////////////////
if( isset($_GET['demo_orientation']) ) {
	if( $_GET['demo_orientation'] == 'horizontal') {
		$of_cypress['orientation'] = 'horizontal';
	}
}
/////////// end DELETE : ////////////////////////////////////////////
//
// CHECK IF IT'S HTTPS
if ( !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ) {
	$of_cypress =  str_replace("http://", "https://", $of_cypress);
}
?>
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>

<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<title>
<?php
	global $page, $paged;
	wp_title( '|', true, 'right' );
	bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'cypress' ), max( $paged, $page ) );
?>
</title>

<meta name="description" content="<?php bloginfo( 'description' );?>" />
<meta name="author" content="<?php the_author_meta('display_name', 1); ?>" />

<?php $favicon = $of_cypress['custom_favicon']; ?>

<!-- Fav and touch icons -->
<link rel="shortcut icon" href="<?php echo  fImg::resize( $favicon , 32, 32, true  )?>">

<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo  fImg::resize( $favicon , 144, 144, true  )?>">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo  fImg::resize( $favicon , 72, 72, true  )?>">
<link rel="apple-touch-icon-precomposed" href="<?php echo  fImg::resize( $favicon , 57, 57, true  )?>">

<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>

<?php 
$analytics = $of_cypress['google_analytics'];
if ( $analytics ) : 
echo stripslashes($analytics);
endif;

function body_layout($classes) {
	global $of_cypress;
	if( $of_cypress['orientation'] == 'horizontal' ) {
		$class = 'horizontal-layout';
	}else{
		$class = 'vertical-layout';
	}
	$classes[] = $class;
	return $classes;
}
add_filter('body_class', 'body_layout');
?>


<?php wp_head(); ?>

</head>


<body <?php body_class();?> id="body">