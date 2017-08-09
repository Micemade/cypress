<?php
/**
 * The 404 page - 
 *
 *
 * @since cypress1.0
 **/
get_header(); 
global $of_cypress, $border_decor; 
$header_icons = $of_cypress['header_icons'];
$layout = $of_cypress['layout'];
?>	

					
<header class="page-header">
	
	<?php	
	$blog_title_bcktoggle = $of_cypress['blog_title_bcktoggle'];
	$blog_title_backimg = $of_cypress['blog_title_backimg'];
	if( $blog_title_bcktoggle ) {
		
		$image =  $blog_title_backimg;
		
		echo'<div class="header-background" style="background-image: url('.$image.');"></div>';
	}
	?>
	
	<div class="grid-container">
	
		<div class="grid-100">
		
		<h1 class="page-title"><?php _e( 'The (in)famous 404 - not found page', 'cypress' ); ?></h1>
	
		</div><!-- /.grid-100 -->
		
	</div><!-- /.grid-container -->

</header>

<div class="grid-container">
	
	<div class="grid-100"><span class="title-border<?php echo !$header_icons ? '-no-icon' : null; ?>"></span></div>
	
</div>			


<div class="grid-container">

	<div id="primary" role="main" class="grid-100">
		
		<article id="post-0" class="post error404 not-found">
		
			<h3><?php echo __("Reason why you're seeing this page could be one of the following:",'cypress')?></h3>
			
			<div class="article-border"></div>
			
			<h4>
				<?php echo __('<ul><li>You clicked the broken link</li><li>You typed incorrect link directly in the address bar</li><li>There is a glitch in the server, database or system, or</li><li>Maybe, but just maybe, it might be our mistake</li></ul> ','cypress') ?>
			</h4>
			
			<p><strong>
			<?php echo __('Please, try to: click browser "Back" button, use search to find what are you looking for, or use menu to browse our site.','cypress')?>
			</strong></p>
		
		
		<?php get_template_part('searchform','nav'); ?>
		
		<div class="article-border <?php echo $border_decor; ?>"></div>
		
		</article><!-- #primary -->
		
		<?php get_template_part('site','map'); ?>
		
	</div><!-- #primary -->		

</div><!-- /.gridcontainer -->
	
<?php get_footer(); ?>