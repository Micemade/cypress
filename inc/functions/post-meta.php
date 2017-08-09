<?php
/**
 *	RETURN TRUE IF BLOG HAS NORE THEN ONE CATEGORY
 *
 */
function cypress_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );
		//
		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );
		//
		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}
	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so cypress_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so cypress_categorized_blog should return false
		return false;
	}
}
//
/**
 *	META INFO BLOCK - generate all the post meta - user, tags, categories
 *
 */
if ( ! function_exists( 'entryMeta_dateUser' ) ) :
function entryMeta_dateUser( $style = 'default' ) {
	
	global $of_cypress;
	
	$link = esc_url( get_permalink() );
	$time = esc_attr( get_the_time() );
	$date = esc_attr( get_the_date( 'c' ) );
	$date_formatted = esc_html( get_the_date( $of_cypress['post_date_format'] ) );
	$author_link = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
	$author = esc_html( get_the_author() );
	
	
	if( $style == 'default' ) {
		
	// date/time
		$output  = '<span class="date_meta"><span class="icon-calendar meta-icon"></span>';
		$output .= '<div class="hover-box"><a href="'.$link.'" title="'.$time.'" rel="bookmark" class="date-time button-mini"><time class="entry-date" datetime="'.$date.'" >'.$date_formatted.'</time></a><div class="arrow-down"></div></div>';
		$output .= '</span>';
		
		// author:
		$output .='<span class="user_meta"><span class="icon-user meta-icon"></span>';
		$output .= '<div class="hover-box"><a class="url fn n author vcard" href="'.$author_link.'" title="'. esc_attr(__('View all post by ','cypress') .$author ).'" rel="author">'.$author.'</a><div class="arrow-down"></div></div>';
		$output .= '</span>';
		
	}elseif( $style == 'style2' ) {
	
		// date/time:
		$output = '<a href="'.$link.'" title="'.$time.'" rel="bookmark" class="date-time button-mini"><span class="icon-calendar meta-icons"></span><time class="entry-date" datetime="'.$date.'" >'.$date_formatted.'</time></a>';
		// author:
		$output .= '<a class="url fn n author vcard" href="'.$author_link.'" title="'. esc_attr(__('View all post by ','cypress') .$author ).'" rel="author"><span class="icon-user meta-icons"></span>'.$author.'</a>';
	
	}
	
	echo $output;
	
}
endif;
if( ! function_exists( 'entryMeta_cats_tags' )) :

	function entryMeta_cats_tags( $style = 'default' ) {
		
		global $post;
		
		//GET ALL THE TERMS WITH LINKS:
		
		$cats = get_the_terms( $post->ID, 'category' );		
		if ( $cats && ! is_wp_error( $cats ) ) { 
			$cats_list = '';
			foreach ( $cats as $cat ) {
				$cats_list .= '<a href="'.get_term_link($cat->slug, 'category') .'">'.$cat->name .'</a>';
			}					
		}else{
			$cats_list = '';
		};
		$tags = get_the_terms( $post->ID, 'post_tag' );		
		if ( $tags && ! is_wp_error( $tags ) ) { 
			$tags_list = '';
			foreach ( $tags as $tag ) {
				$tags_list .= '<a href="'.get_term_link($tag->slug, 'post_tag') .'">'.$tag->name .'</a>';
			}					
		}else{
			$tags_list = '';
		};
		$port_cats = get_the_terms( $post->ID, 'portfolio_category' );		
		if ( $port_cats && ! is_wp_error( $port_cats ) ) { 
			$port_cats_list = '';
			foreach ( $port_cats as $cat ) {
				$port_cats_list .= '<a href="'.get_term_link($cat->slug, 'portfolio_category') .'">'.$cat->name .'</a>';
			}					
		}else{
			$port_cats_list = '';
		};
		$port_tags = get_the_terms( $post->ID, 'portfolio_tag' );		
		if ( $port_tags && ! is_wp_error( $port_tags ) ) { 
			$port_tags_list = '';
			foreach ( $port_tags as $tag ) {
				$port_tags_list .= '<a href="'.get_term_link($tag->slug, 'portfolio_tag') .'">'.$tag->name .'</a>';
			}					
		}else{
			$port_tags_list = '';
		};
		
		
		// DISPLAY ALL THE TERMS WITH LINKS :
		if ( $cats_list ) :
		
			echo '<span class="cat_meta">';
			printf( '<span class="icon-folder meta-icon"></span><div class="hover-box">%1$s<div class="arrow-down"></div></div>' , $cats_list );
			echo '</span>';
			
		elseif ( $port_cats_list  && !is_wp_error($port_cats_list) ) :
		
			echo '<span class="cat_meta">';
			printf( '<span class="icon-folder meta-icon"></span><div class="hover-box">%1$s<div class="arrow-down"></div></div>', $port_cats_list );
			echo '</span>';	
			
		endif;
		//
		//
		if ( $tags_list ) :
		
			echo '<span class="tag_meta">';
			printf( '<span class="icon-tags meta-icon"></span><div class="hover-box">%1$s<div class="arrow-down"></div></div>', $tags_list);
			echo '</span>';
		
		
		elseif ( $port_tags_list && !is_wp_error($port_tags_list) ):
		
			echo '<span class="tag_meta ">';
			printf( '<span class="icon-tags meta-icon"></span><div class="hover-box">%1$s<div class="arrow-down"></div></div>' , $port_tags_list );
			echo '</span>';	
			
		endif;	
	}
endif;
if( ! function_exists( 'entryMeta_comments' )) :
	function entryMeta_comments( $style = 'default' ) {
		if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) :
			
			$no_comments = ' 0';
			$one_comment = ' 1';
			$more_comments = ' %';
			$css_class = '';
			
			echo '<span class="comments_meta"><span class="icon-bubble meta-icon"></span><div class="hover-box">';

			comments_popup_link( $no_comments, $one_comment, $more_comments ,$css_class );
		
			echo '<div class="arrow-down"></div></div></span>';
			
		endif;
	}
endif;
if( ! function_exists( 'entryMeta_permalink' )) :
	function entryMeta_permalink() {
	global $post;
	?>
	<span class="permalink">
		
			<span class="icon-link meta-icon"></span>
			
			<div class="hover-box">
				
				<a href="<?php esc_attr(the_permalink());?>" title="<?php esc_attr(the_title());?>">
				<?php echo __('More ...','cypress'); ?>
				</a>
				
				<div class="arrow-down"></div>
				
			</div>
			
		</span>	
	<?php }
endif;
?>